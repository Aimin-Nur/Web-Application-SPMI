<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Lembaga;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\Evaluasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index (){
        $today = Carbon::today();

        $user = Auth::user();
        if (!$user) {
            return redirect('/login')->withErrors(['message' => 'Akun Anda Tidak Terdaftar']);
        }

        logger()->info('User data on dashboard:', ['user' => $user]);


        $getLembaga = $user->id_lembaga;

        $lembagaScores = Lembaga::with('evaluasi')->get()->map(function ($lembaga) {
            return [
                'id_lembaga' => $lembaga->id,
                'nama_lembaga' => $lembaga->nama_lembaga,
                'total_score' => $lembaga->evaluasi->sum('score')
            ];
        })->sortByDesc('total_score')->values();
        $maxScore = $lembagaScores->max('total_score');

        $lembaga = Lembaga::with('evaluasi')->where('id', $getLembaga)->first();

        $radar = [
            'nama_lembaga' => $lembaga->nama_lembaga,
            'major' => $lembaga->evaluasi->where('status_docs', 2)->count(),
            'minor' => $lembaga->evaluasi->where('status_docs', 1)->count(),
            'close' => $lembaga->evaluasi->where('status_docs', 3)->count()
        ];


        $totalTemuan = Evaluasi::where('id_lembaga', $lembaga)->where('status_docs', 2)->count();

        $userRanking = $lembagaScores->search(function ($lembaga) use ($getLembaga) {
            return $lembaga['id_lembaga'] === $getLembaga;
        }) + 1;

        $countDocs = Dokumen::where('id_lembaga', $getLembaga)->count();
        $countDocsUnsend = Dokumen::where('id_lembaga', $getLembaga)->where('status_docs', 0)->count();

        $countTemuan = Evaluasi::where('id_lembaga', $getLembaga)->count();
        $countEvalUnsend = Evaluasi::where('id_lembaga', $getLembaga)->where('status_docs', 0)->count();

        return view('user.index', compact('lembagaScores','radar','maxScore','totalTemuan','getLembaga','userRanking','countDocs','countDocsUnsend','countTemuan','countEvalUnsend'));
    }

    public function dokumenUser() {
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        $dokumens = Dokumen::where('id_lembaga', $idLembaga)
                    ->where(function($query) {
                        $query->where('status_pengisian', 0)
                            ->orWhere('status_pengisian', 3);
                    })
                    ->where('deadline', '!=',0)
                    ->get();


        $finishDocs = Dokumen::where('id_lembaga', $idLembaga)->where('status_pengisian', 2)->orwhere('status_pengisian', 1)->get();

        $cekDokumens = Dokumen::where('id_lembaga', $idLembaga)->where(function($query) {
            $query->where('status_pengisian', 0)
                ->orWhere('status_pengisian', 3);
        })
        ->count();

        $minor = Dokumen::where('status_docs', 1)->where('id_lembaga', $idLembaga)->count();
        $mayor = Dokumen::where('status_docs', 2)->where('id_lembaga', $idLembaga)->count();
        $close = Dokumen::where('status_docs', 3)->where('id_lembaga', $idLembaga)->count();

        return view('user.dokumen', compact('dokumens', 'finishDocs', 'cekDokumens','minor','mayor','close'));
    }

    public function sendDocs($id){
        try {
            $docs = Dokumen::findOrFail($id);
            $deadline = $docs->deadline;

            $now = Carbon::now('Asia/Makassar')->locale('id_ID');
            $formattedDate = $now->isoFormat('dddd, DD MMMM YYYY');

            if ($formattedDate < $deadline) {
                $docs->status_pengisian = 1;
            } else {
                $docs->status_pengisian = 2;
            }

            $docs->tgl_pengumpulan = $now;
            $docs->save();

            return redirect('/dokumenUser')->with('status', 'success')->with('message', 'Dokumen Berhasil Dikirim.');
        } catch (\Exception $e) {
            return redirect('/dokumenUser')->with('status', 'error')->with('message', 'Gagal Mengedit Jadwal RTM: ' . $e->getMessage());
        }
    }

    public function temuanAudit() {

        $user = Auth::user();
        $getLembaga = $user->id_lembaga;

        $evaluasi = Evaluasi::with(['lembaga.user'])->where(function($query) use ($getLembaga) {
            $query->where('status_pengisian', 0)
                ->where('score', NULL)
                ->where('id_lembaga', $getLembaga);
        })
        ->get();


        $riwayat = Evaluasi::with(['lembaga.user'])->where(function($query) use ($getLembaga) {
            $query->where('status_pengisian', 1)
                ->orWhere('status_pengisian', 2)
                ->where('score', '!=', NULL)
                ->where('id_lembaga', $getLembaga);;
        })
        ->get();

        $score = Evaluasi::with(['lembaga.user'])->where(function($query) use ($getLembaga) {
            $query->where('status_pengisian', 1)
                ->orWhere('status_pengisian', 2)
                ->where('score', '!=', NULL)
                ->where('id_lembaga', $getLembaga);
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
            ->where('id_lembaga', $getLembaga)
            ->orderBy('total_score', 'desc')
            ->get();

        // total semua skor dan jumlah temuan
        $totalSkor = $score->sum('score');
        $totalTemuan = $evaluasi->count();
        $totalTemuanMayor = Evaluasi::where('id_lembaga', $getLembaga)->where('status_docs', 2)->count();
        $totalTemuanMinor = Evaluasi::where('id_lembaga', $getLembaga)->where('status_docs', 1)->count();
        $totalTemuanClose = Evaluasi::where('id_lembaga', $getLembaga)->where('status_docs', 3)->count();

        return view('user.temuanAudit', compact('evaluasi', 'riwayat','skorPerLembaga','totalSkor','totalTemuan','totalTemuanMayor','totalTemuanMinor','totalTemuanClose'));
    }

    public function sendTemuan ($id){
        try {
            $docs = Evaluasi::findOrFail($id);
            $deadline = $docs->deadline;

            $now = Carbon::now('Asia/Makassar')->locale('id_ID');
            $formattedDate = $now->isoFormat('dddd, DD MMMM YYYY');

            if ($formattedDate < $deadline) {
                $docs->status_pengisian = 1;
            } else {
                $docs->status_pengisian = 2;
            }

            $docs->tgl_pengumpulan = $now;
            $docs->save();

            return redirect('/temuan')->with('status', 'success')->with('message', 'Dokumen Berhasil Dikirim.');
        } catch (\Exception $e) {
            return redirect('/temuan')->with('status', 'error')->with('message', 'Gagal Mengedit Dokumen: ' . $e->getMessage());
        }
    }

    public function profileUser() {
        return view('user.profileUser');
    }


}
