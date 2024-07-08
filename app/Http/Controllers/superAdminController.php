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
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

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

        return view('superadmin.index', compact('admin', 'lembagaScores','maxScore', 'riwayat','radar','countUser','countLembaga'));
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
            $dokumen = Lembaga::findOrFail($id);
            $dokumen->delete();
            return redirect('/lembaga')->with('status', 'success')->with('message', 'Lembaga Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/lembaga')->with('status', 'error')->with('message', 'Gagal Menghapus Lembaga: ' . $e->getMessage());
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


}
