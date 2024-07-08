<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Lembaga;
use App\Models\Dokumen;
use App\Models\Evaluasi;
use App\Models\RTM;
use App\Models\LaporanAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $today = Carbon::today();
        $admin = Auth::guard('admin')->user();
        $lembagaScores = Lembaga::with('evaluasi')->get()->map(function ($lembaga) {
            return [
                'nama_lembaga' => $lembaga->nama_lembaga,
                'total_score' => $lembaga->evaluasi->sum('score')
            ];
        })->sortByDesc('total_score')->values();
        $maxScore = $lembagaScores->max('total_score');

       $riwayat = Lembaga::with('evaluasi')->get()->map(function ($lembaga) {
            return [
                'nama_lembaga' => $lembaga->nama_lembaga,
                'total_score' => $lembaga->evaluasi->sum('score'),
                'updated_at' => $lembaga->evaluasi->max('updated_at'),
            ];
        });

        $previousScores = Cache::get('previousScores', []);
        $currentScores = [];

        // Bandingkan skor saat ini dengan skor sebelumnya dan tentukan 'is_increased'
        $riwayat = $riwayat->map(function ($lembaga) use ($previousScores, &$currentScores) {
            $previousScore = $previousScores[$lembaga['nama_lembaga']] ?? 0;
            $currentScores[$lembaga['nama_lembaga']] = $lembaga['total_score'];
            return array_merge($lembaga, [
                'previous_score' => $previousScore,
                'is_increased' => $lembaga['total_score'] > $previousScore,
            ]);
        })->sortByDesc('total_score')->values();

        Session::put('previousScores', $currentScores);


        // Radar Dashboard
        $radar = Lembaga::with('evaluasi')->get()->map(function ($lembaga) {
            return [
                'nama_lembaga' => $lembaga->nama_lembaga,
                'major' => $lembaga->evaluasi->where('status_docs', 2)->count(),
                'minor' => $lembaga->evaluasi->where('status_docs', 1)->count(),
                'close' => $lembaga->evaluasi->where('status_docs', 3)->count()
            ];
        })->values();

        return view('admin.index', compact('admin', 'lembagaScores','maxScore', 'riwayat','radar'));
    }

    public function dokumen (){
        $minor = Dokumen::where('status_docs', 1)->count();
        $major = Dokumen::where('status_docs', 2)->count();
        $close = Dokumen::where('status_docs', 3)->count();

        $dokumens = Dokumen::with(['lembaga.user'])
                    ->where(function($query) {
                        $query->where('status_pengisian', 2)
                        ->orwhere('status_pengisian', 0);
                    })
                    ->where('score', NULL)
                    ->get();

        $riwayatDocs = Dokumen::with(['lembaga.user'])->where('status_pengisian', 2)->get();

        $countDokumens = Dokumen::with(['lembaga.user'])
        ->where(function($query) {
            $query->where('status_pengisian', 0)
                ->orWhere('status_pengisian', 3);
        })
        ->count();
        return view('admin.dokumen', compact('close','major','minor','dokumens', 'riwayatDocs', 'countDokumens'));
    }

    public function editStatusDocs(Request $request, $id){
        try {
            $request->validate([
                'status' => 'required|in:1,2,3',
            ]);

            $dokumen = Dokumen::findOrFail($id);
            $dokumen->status_docs = $request->input('status');
            $dokumen->status_pengisian = 2;
            // $dokumen->status_pengisian = ($request->input('status') == 3) ? 2 : 0;

            $score = $request->input('score', 4);
            $dokumen->score = $score;

            $dokumen->save();

            return redirect('/dokumen')->with('status', 'success')->with('message', 'Status Dokumen Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/dokumen')->with('status', 'error')->with('message', 'Gagal Mengubah Status Dokumen: ' . $e->getMessage());
        }
    }

    public function displayUser() {
        $getData = User::get();
        return view('admin.displayUser', compact('getData'));
    }

    public function editUser(Request $request, $id){
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|unique:users,email,' . time(),
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            $user->save();

            return redirect('/manageUser')->with('status', 'success')->with('message', 'Data Akun User Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/manageUser')->with('status', 'error')->with('message', 'Gagal Mengubah Data Akun User: ' . $e->getMessage());
        }
    }

    public function formDokumen() {
        $getData = Lembaga::has('user')->with('user')->get();
        return view('admin.formDokumen', compact('getData'));
    }

    public function addDokumen(Request $request){
        try {
            $request->validate([
                'field_judul' => 'required|string|max:255',
                'field_tautan' => 'required|string|max:255|url',
                'id_lembaga' => 'required|string|exists:lembaga,id',
            ]);
            $existingDokumen = Dokumen::where('tautan', $request->input('field_tautan'))->first();
            if ($existingDokumen) {
                return redirect('/dokumen')->with('status', 'error')->with('message', 'Tautan dokumen sudah ada.');
            }

            $send = new Dokumen;
            $send->judul = $request->input('field_judul');
            $send->tautan = $request->input('field_tautan');
            $send->id_lembaga = $request->input('id_lembaga');
            $send->status_pengisian = 0;
            $send->status_docs = 0;
            $send->deadline = $request->input('field_durasi');
            $send->save();

            return redirect('/dokumen')->with('status', 'success')->with('message', 'Dokumen Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/dokumen')->with('status', 'error')->with('message', 'Gagal Menambahkan Dokumen: ' . $e->getMessage());
        }
    }

    public function hapusDokumen($id){
        try {
            $dokumen = Dokumen::findOrFail($id);
            $dokumen->delete();
            return redirect('/dokumen')->with('status', 'success')->with('message', 'Dokumen Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/dokumen')->with('status', 'error')->with('message', 'Gagal Menghapus Dokumen: ' . $e->getMessage());
        }
    }


    public function temuanAudit() {
        $evaluasi = Evaluasi::with(['lembaga.user'])->where(function($query) {
            $query->where('status_pengisian', 0)
                ->orWhere('status_pengisian', 2)
                ->where('score', NULL);
        })
        ->get();

        $riwayat = Evaluasi::with(['lembaga.user'])->where(function($query) {
            $query->where('status_pengisian', 1)
                ->orWhere('status_pengisian', 2)
                ->where('score', '!=', NULL);
        })
        ->get();

        $score = Evaluasi::with(['lembaga.user'])
        ->where(function($query) {
            $query->where('status_pengisian', 1)
                ->orWhere('status_pengisian', 2)
                ->where('score', '!=', NULL);
        })
        ->get();

        // total skor dan jumlah temuan per lembaga
        $skorPerLembaga = Evaluasi::select(
                'id_lembaga',
                DB::raw('SUM(score) as total_score'),
                DB::raw('COUNT(id) as total_temuan')
            )
            ->groupBy('id_lembaga')
            ->with('lembaga.user')
            ->where('score', '!=', NULL)
            ->orderBy('total_score', 'desc')
            ->get();

        // total semua skor dan jumlah temuan
        $totalSkor = $score->sum('score');
        $totalTemuan = $evaluasi->count();

        $minor = Evaluasi::where('status_docs', 1)->count();
        $major = Evaluasi::where('status_docs', 2)->count();
        $close = Evaluasi::where('status_docs', 3)->count();

        return view('admin.evaluasi', compact('evaluasi', 'riwayat','skorPerLembaga','totalSkor','totalTemuan', 'minor','major','close'));
    }

    public function formTemuan() {
            $getData = Lembaga::whereHas('dokumen', function ($query) {
                $query->whereIn('status_docs', [1, 2]);
            })->with(['dokumen' => function ($query) {
                $query->whereIn('status_docs', [1, 2]);
            }])->get();

            return view('admin.formTemuan', compact('getData'));
    }

    public function addTemuan(Request $request){
        try {
            $request->validate([
                'temuan' => 'required|string|max:255',
                'tautan_temuan' => 'required|string|max:255|url',
                'rtk' => 'required|string|max:255',
                'tautan_rtk' => 'required|string|max:255|url',
                'id_lembaga' => 'required|string|exists:lembaga,id',
                'id_docs' => 'required|string|exists:dokumen,id',
            ]);

            $existingTautanRTK = Evaluasi::where('tautan_rtk', $request->input('tautan_rtk'))->first();
            $existingTautanTemuan = Evaluasi::where('tautan_temuan', $request->input('tautan_temuan'))->first();

            if ($existingTautanRTK) {
                return redirect('/temuanAudit')->with('status', 'error')->with('message', 'Tautan dokumen RTK sudah ada.');
            } elseif ($existingTautanTemuan) {
                return redirect('/temuanAudit')->with('status', 'error')->with('message', 'Tautan dokumen Temuan sudah ada.');
            }

            $send = new Evaluasi;
            $send->temuan = $request->input('temuan');
            $send->rtk = $request->input('rtk');
            $send->id_lembaga = $request->input('id_lembaga');
            $send->id_docs = $request->input('id_docs');
            $send->status_pengisian = 0;
            $send->status_docs = 0;
            $send->tautan_rtk = $request->input('tautan_rtk');
            $send->tautan_temuan = $request->input('tautan_temuan');
            $send->deadline = $request->input('deadline');
            $send->save();

            return redirect('/temuanAudit')->with('status', 'success')->with('message', 'Temuan Audit Berhasil Ditambakan.');
            } catch (\Exception $e) {
                return redirect('/temuanAudit')->with('status', 'error')->with('message', 'Gagal Menambahkan Temuan Audit: ' . $e->getMessage());
        }
    }

    public function editTemuan(Request $request, $id){
        try {
            $request->validate([
                'status' => 'required|in:1,2,3',
            ]);

            $temuan = Evaluasi::findOrFail($id);
            $temuan->status_docs = $request->input('status');
            $temuan->status_pengisian = 2;

            $score = $request->input('score', 4);
            $temuan->score = $score;

            $temuan->save();

            return redirect('/temuanAudit')->with('status', 'success')->with('message', 'Status Temuan Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/temuanAudit')->with('status', 'error')->with('message', 'Gagal Mengubah Status Tautan: ' . $e->getMessage());
        }
    }

    public function hapusTemuan($id){
        try {
            $temuan = Evaluasi::findOrFail($id);
            $temuan->delete();

            return redirect('/temuanAudit')->with('status', 'success')->with('message', 'Temuan Audit Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/temuanAudit')->with('status', 'error')->with('message', 'Gagal Menghapus Temuan Audit: ' . $e->getMessage());
        }
    }

    public function displayRTM(){
        $getData = RTM::with(['lembaga.user'])->get();

        $count = RTM::count();
        $getLembaga = Lembaga::whereHas('dokumen', function ($query) {
            $query->where('status_docs', 2);
        })->with('dokumen')->get();

        return view('admin.rtm', compact('getData','count', 'getLembaga'));
    }

    public function addRTM(){
        $getLembaga = Lembaga::whereHas('dokumen', function ($query) {
            $query->where('status_docs', 2);
        })->with('dokumen')->get();
        return view('admin.addRTM', compact('getLembaga'));
    }

    public function postRTM(Request $request){
        try {
            $send = new RTM;
            $send->tgl_rapat = $request->input('selectedDate');
            $send->tempat = $request->input('tempatRapat');
            $send->id_lembaga = $request->input('id_lembaga');
            $send->status = 0;
            $send->save();

            return redirect('/addRTM')->with('status', 'success')->with('message', 'Jadwal RTM Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/addRTM')->with('status', 'error')->with('message', 'Gagal Menambahkan Jadwal RTM: ' . $e->getMessage());
        }
    }

    public function hapusRTM($id){
        try {
            $rtm = RTM::findOrFail($id);
            $rtm->delete();
            return redirect('/RTM')->with('status', 'success')->with('message', 'Jadwal RTM Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/RTM')->with('status', 'error')->with('message', 'Gagal Menghapus Jadwal RTM: ' . $e->getMessage());
        }
    }

    public function editRTM(Request $request, $id) {
        try {
            $rtm = RTM::findOrFail($id);

            $rtm->id_lembaga = $request->input('lembaga');
            $rtm->tgl_rapat = $request->input('tglRapat');
            $rtm->tempat = $request->input('lokasiRapat');
            $rtm->save();

            return redirect('/RTM')->with('status', 'success')->with('message', 'Jadwal RTM Berhasil Diedit.');
        } catch (\Exception $e) {
            return redirect('/RTM')->with('status', 'error')->with('message', 'Gagal Mengedit Jadwal RTM: ' . $e->getMessage());
        }
    }


    public function laporanAudit(){
        $getData = LaporanAudit::get();
        return view('admin.laporanAudit', compact('getData'));
    }

    public function addLaporan(Request $request){
        try {
            $send = new LaporanAudit;
            $send->judul = $request->input('judul');
            $send->tautan = $request->input('tautan');
            $send->save();

            return redirect('/laporan')->with('status', 'success')->with('message', 'Laporan Audit Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/laporan')->with('status', 'error')->with('message', 'Gagal Menambahkan Jadwal Laporan Audit: ' . $e->getMessage());
        }
    }

    public function hapusLaporan($id) {
        try {
            $laporan = laporanAudit::findOrFail($id);
            $laporan->delete();
            return redirect('/laporan')->with('status', 'success')->with('message', 'Laporan Audit Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/laporan')->with('status', 'error')->with('message', 'Gagal Menghapus Laporan Audit: ' . $e->getMessage());
        }
    }

    public function editLaporan(Request $request, $id){
        try {
            $request->validate([
                'laporan' => 'required|',
                'tautan' => 'required|',
            ]);

            $laporan = laporanAudit::findOrFail($id);
            $laporan->judul = $request->input('laporan');
            $laporan->tautan = $request->input('tautan');

            $laporan->save();

            return redirect('/laporan')->with('status', 'success')->with('message', 'Laporan Audit Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/laporan')->with('status', 'error')->with('message', 'Gagal Mengubah Laporan Audit: ' . $e->getMessage());
        }
    }

}
