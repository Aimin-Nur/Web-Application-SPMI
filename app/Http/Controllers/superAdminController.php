<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Auditor;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class superAdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:superadmin');
    }

    public function index (){
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

        $countUser = User::count();
        $countLembaga = Lembaga::count();
        $countDocs = Dokumen::count();
        $countTemuan = Evaluasi::count();
        $countLaporan = LaporanAudit::count();
        $countAdmin = Admin::count();
        $countAuditor = Auditor::count();

        return view('superadmin.index', compact('admin', 'lembagaScores','maxScore', 'riwayat','radar','countUser','countLembaga','countDocs','countTemuan','countLaporan','countAdmin','countAuditor'));
    }

    public function lembaga (){
        $getData = Lembaga::get();
        return view('superadmin.lembaga', compact('getData'));
    }

    public function addLembaga(Request $request){
        try {
            $send = new Lembaga;
            $send->nama_lembaga = $request->input('filed_lembaga');
            $send->save();

            return redirect('/lembaga')->with('status', 'success')->with('message', 'Data Lemabaga Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/lembaga')->with('status', 'error')->with('message', 'Gagal Menambahakan Data Lembaga' . $e->getMessage());
        }
    }

    public function hapusLembaga($id){
        try {
            $lembaga = Lembaga::findOrFail($id);
            $lembaga->delete();

            return redirect('/lembaga')->with('status', 'success')->with('message', 'Lembaga Berhasil Dihapus.');

        } catch (\Exception $e) {
            return redirect('/lembaga')->with('status', 'error')->with('message', 'Gagal Menghapus Lembaga: ' . 'Gagal Menghapus Lembaga Karena Terdapat Dokumen Audit yang Terdaftar Dalam Aplikasi');
        }
    }


    public function editLembaga(Request $request, $id){
        try {
            $request->validate([
                'nama_lembaga' => 'required',
            ]);

            $lembaga = Lembaga::findOrFail($id);

            $lembaga->nama_lembaga = $request->input('nama_lembaga');
            $lembaga->save();

            return redirect('/lembaga')->with('status', 'success')->with('message', 'Data Lembaga Berhasil Diedit.');
        } catch (\Exception $e) {
            return redirect('/lembaga')->with('status', 'error')->with('message', 'Gagal Mengubah Status Dokumen: ' . $e->getMessage());
        }
    }

    public function displayUser(){
        $getData = User::with('lembaga')->get();

        return view('superadmin.user', compact('getData'));
    }

    public function deleteUser($id){
        try{
            $user = User::findOrFail($id);
            $user->delete();

            return redirect('/user')->with('status', 'success')->with('message', 'User Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/user')->with('status', 'error')->with('message', 'Gagal Menghapus Akun User: ' . $e->getMessage());
        }
    }

    public function editUser(Request $request, $id){
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $user = User::findOrFail($id);

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            return redirect('/user')->with('status', 'success')->with('message', 'Akun User Berhasil Diedit.');
        } catch (\Exception $e) {
            return redirect('/user')->with('status', 'error')->with('message', 'Gagal Mengubah Data Akun User: ' . 'Data Email Harus Lengkap.');
        }
    }

    public function deleteUserAndDocuments($id){
        try{
            $user = User::findOrFail($id);
            $idLembaga = $user->id_lembaga;

            $cekDocUser = Dokumen::where('id_lembaga', $idLembaga)->count();
            $cekEvalUser = Evaluasi::where('id_lembaga', $idLembaga)->count();

            if ($cekDocUser > 0) {
                Dokumen::where('id_lembaga', $idLembaga)->delete();
            }

            if ($cekEvalUser > 0) {
                Evaluasi::where('id_lembaga', $idLembaga)->delete();
            }

            $user->delete();

             return redirect('/user')->with('status', 'success')->with('message', 'User Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/user')->with('status', 'error')->with('message', 'Gagal Menghapus Akun User: ' . $e->getMessage());
        }
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
        return view('superadmin.vieDocs', compact('close','major','minor','dokumens', 'riwayatDocs', 'countDokumens'));
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

        return view('superadmin.viewTemuan', compact('evaluasi', 'riwayat','skorPerLembaga','totalSkor','totalTemuan', 'minor','major','close'));
    }

    public function laporanAudit(){
        $getData = LaporanAudit::get();
        return view('superadmin.viewLaporan', compact('getData'));
    }

    public function displayAdmin(){
        $getData = Admin::get();
        return view('superadmin.manageAdmin', compact('getData'));
    }

    public function registrasiAdmin(Request $request){
        try {
            $admin = new Admin;
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('email'));
            $admin->save();

            return redirect('/manageAdmin/superadmin')->with('status', 'success')->with('message', 'Registrasi Admin Berhasil.');
        } catch (\Exception $e) {
            return redirect('/manageAdmin/superadmin')->with('status', 'error')->with('message', 'Gagal Registrasi Admin' . $e->getMessage());
        }
    }

    public function editAdmin(Request $request, $id){
        try {
            $admin = Admin::findOrFail($id);

            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->save();

            return redirect('/manageAdmin/superadmin')->with('status', 'success')->with('message', 'Akun Admin Berhasil Diedit.');
        } catch (\Exception $e) {
            return redirect('/manageAdmin/superadmin')->with('status', 'error')->with('message', 'Gagal Mengubah Data Akun Admin: ' . $e->getMessage());
        }
    }

    public function hapusAdmin($id){
        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();

            return redirect('/manageAdmin/superadmin')->with('status', 'success')->with('message', 'Admin Berhasil Dihapus.');

        } catch (\Exception $e) {
            return redirect('/manageAdmin/superadmin')->with('status', 'error')->with('message', 'Gagal Menghapus Admin: ' . $e->getMessage());
        }
    }

    public function auditor(){
        $getData = Auditor::get();
        return view('superadmin.auditor', compact('getData'));
    }

    public function addAuditor(Request $request){
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'foto' => 'required|image|mimes:jpeg,png,PNG,jpg|max:10096', // 4MB
            ]);

            $auditor = new Auditor;
            $auditor->nama = $request->input('nama');

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('auditors'), $filename);
                $auditor->foto = $filename;
            }

            $auditor->save();

            return redirect('/auditor/superadmin')->with('status', 'success')->with('message', 'Berhasil Menambahkan Data Auditor.');
        } catch (\Exception $e) {
            return redirect('/auditor/superadmin')->with('status', 'error')->with('message', 'Gagal Menambahkan Data Auditor: ' . $e->getMessage());
        }
    }

    public function hapusAuditor($id){
        try {
            $auditor = Auditor::findOrFail($id);
            $auditor->delete();

            return redirect('/auditor/superadmin')->with('status', 'success')->with('message', 'Auditor Berhasil Dihapus.');

        } catch (\Exception $e) {
            return redirect('/auditor/superadmin')->with('status', 'error')->with('message', 'Gagal Menghapus Auditor: ' . $e->getMessage());
        }
    }

    public function editAuditor(Request $request, $id){
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:4096', // 4MB
        ]);

        try {
            $auditor = Auditor::findOrFail($id);
            $auditor->nama = $request->input('nama');

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('auditors'), $filename);
                $auditor->foto = $filename;
            }

            $auditor->save();

            return redirect('/auditor/superadmin')->with('status', 'success')->with('message', 'Auditor Berhasil Diedit.');
        } catch (\Exception $e) {
            return redirect('/auditor/superadmin')->with('status', 'error')->with('message', 'Auditor Gagal Diedit.' . $e->getMessage());
        }
    }


}
