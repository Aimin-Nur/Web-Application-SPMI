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
use App\Services\Document;
use App\Services\HistoryDocument;
use App\Services\Temuan;
use App\Services\HistoryTemuan;

class UserController extends Controller
{
    protected $dokumenService;
    protected $historyDokumensUsers;
    protected $temuanServiceUsers;
    protected $historyTemuan;

    public function __construct(Document $dokumenService, HistoryDocument $historyDokumensUsers, Temuan $temuanServiceUsers, HistoryTemuan $historyTemuan)
    {
        $this->dokumenService = $dokumenService;
        $this->historyDokumensUsers = $historyDokumensUsers;
        $this->temuanServiceUsers = $temuanServiceUsers;
        $this->historyTemuan = $historyTemuan;
    }

    public function index (){
        $pageTitle = "Dashboard";
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

        return view('user.index', compact('pageTitle','lembagaScores','radar','maxScore','totalTemuan','getLembaga','userRanking','countDocs','countDocsUnsend','countTemuan','countEvalUnsend'));
    }

    public function dokumenUser(Request $request) {
        $pageTitle = "Dokumen Audit";
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        if ($request->ajax() && $request->has('history')) {
            $dokumensHistoryUsers = $this->historyDokumensUsers->getUserDokumensHistory();
            return $this->historyDokumensUsers->generateUserHistoryDataTable($dokumensHistoryUsers);
        }

        if ($request->ajax()) {
            $dokumensQueryUsers = $this->dokumenService->getUserDokumens();
            return $this->dokumenService->generateUserDataTable($dokumensQueryUsers);
        }

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

        return view('user.dokumen', compact('pageTitle','dokumens', 'finishDocs', 'cekDokumens'));
    }

    public function temuanAudit(Request $request) {
        $pageTitle = "Temuan Audit";

        if ($request->ajax()) {
            if ($request->has('history') && $request->get('history')) {
                $riwayat = $this->historyTemuan->getRiwayatUsers();
                return $this->historyTemuan->generateDataTable($riwayat);
            } else {
                $evaluasi = $this->temuanServiceUsers->getTemuanUsers();
                return $this->temuanServiceUsers->generateDataTableUsers($evaluasi);
            }
        }

        $user = Auth::user();
        $getLembaga = $user->id_lembaga;

        $evaluasi = Evaluasi::with(['lembaga.user'])->where(function($query) use ($getLembaga) {
            $query->where('status_pengisian', 0)
                ->where('score', NULL)
                ->where('id_lembaga', $getLembaga);
        })
        ->where('deadline', '!=',0)
        ->get();

        $riwayat = Evaluasi::with(['lembaga.user'])->where(function($query) use ($getLembaga) {
            $query->where('status_pengisian', 1)
                ->orWhere('status_pengisian', 2)
                ->where('score', '!=', NULL)
                ->where('id_lembaga', $getLembaga);;
        })
        ->get();

        // Score Temuan
        $score = Evaluasi::with(['lembaga.user'])->where(function($query) use ($getLembaga) {
            $query->where('status_pengisian', 1)
                ->orWhere('status_pengisian', 2)
                ->where('score', '!=', NULL);
        })
        ->where('id_lembaga', $getLembaga)
        ->get();

        // Score Dokumen
        $scoreDocs = Dokumen::with(['lembaga.user'])->where(function($query) use ($getLembaga) {
            $query->where('status_pengisian', 1)
                ->orWhere('status_pengisian', 2)
                ->where('score', '!=', NULL);
        })
        ->where('id_lembaga', $getLembaga)
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

        // total semua skor temuan
        $totalSkor = $score->sum('score');

        // Total semua skor dokumen
        $totalSkorDocs = $scoreDocs->sum('score');

        return view('user.temuanAudit', compact('pageTitle','evaluasi', 'riwayat','skorPerLembaga','totalSkor','totalSkorDocs'));
    }

    public function sendDocs(Request $request, $id){
        try {
            $request->validate([
                'score' => 'required|integer|min:0',
            ], [
                'score.required' => 'Angka harus diisi.',
                'score.integer' => 'Score anda tidak valid.',
                'score.min' => 'Score Melewati Angka Minimum.',
            ]);

            $docs = Dokumen::findOrFail($id);
            $deadline = $docs->deadline;
            $score = $request->input('score');

            $now = Carbon::now('Asia/Makassar');

            if ($now->lessThan($deadline)) {
                $docs->status_pengisian = 2;
            } else {
                $docs->status_pengisian = 1;
            }

            $docs->tgl_pengumpulan = $now;
            $docs->score = $score;
            $docs->save();

            return redirect('/dokumenUser')->with('status', 'success')->with('message', 'Dokumen Berhasil Dikirim.');
        } catch (\Exception $e) {
            return redirect('/dokumenUser')->with('status', 'error')->with('message', 'Gagal Mengirim Dokumen: ' . $e->getMessage());
        }
    }

    public function sendTemuan ($id){
        try {
            $docs = Evaluasi::findOrFail($id);
            $deadline = $docs->deadline;

            $now = Carbon::now('Asia/Makassar')->locale('id_ID');

            if ($now->lessThan($deadline)) {
                $docs->status_pengisian = 2;
            } else {
                $docs->status_pengisian = 1;
            }

            $docs->tgl_pengumpulan = $now;
            $docs->save();

            return redirect('/temuan')->with('status', 'success')->with('message', 'Dokumen Berhasil Dikirim.');
        } catch (\Exception $e) {
            return redirect('/temuan')->with('status', 'error')->with('message', 'Gagal Mengirim Dokumen: ' . $e->getMessage());
        }
    }

    public function profileUser() {
        $pageTitle = 'Profile';
        return view('user.profileUser', compact('pageTitle'));
    }


}
