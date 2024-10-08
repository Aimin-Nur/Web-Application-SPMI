<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lembaga;
use App\Models\Dokumen;
use App\Models\Evaluasi;
use App\Models\RTM;
use App\Models\Auditor;
use App\Models\LaporanAudit;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $lembagaScores = Lembaga::with('evaluasi')->get()->map(function ($lembaga) {
            return [
                'nama_lembaga' => $lembaga->nama_lembaga,
                'total_score' => $lembaga->evaluasi->sum('score')
            ];
        })->sortByDesc('total_score')->values();
        $maxScore = $lembagaScores->max('total_score');

        $lembagaScoresDocs = Lembaga::with('dokumen')->get()->map(function ($lembaga) {
            return [
                'nama_lembaga' => $lembaga->nama_lembaga,
                'total_score' => $lembaga->dokumen->sum('score')
            ];
        })->sortByDesc('total_score')->values();
        $maxScoreDocs = $lembagaScoresDocs->max('total_score');

        // Radar Dashboard
        $radar = Lembaga::with('evaluasi')->get()->map(function ($lembaga) {
            return [
                'nama_lembaga' => $lembaga->nama_lembaga,
                'average' => $lembaga->evaluasi->where('status_docs', 2)->count(),
                'poor' => $lembaga->evaluasi->where('status_docs', 1)->count(),
                'good' => $lembaga->evaluasi->where('status_docs', 3)->count(),
                'excellent' => $lembaga->evaluasi->where('status_docs', 4)->count()
            ];
        })->values();

        $countUser = User::count();
        $countLembaga = Lembaga::count();
        $countDocs = Dokumen::count();
        $countTemuan = Evaluasi::count();
        $countLaporan = LaporanAudit::count();
        $countAuditor = Auditor::count();

        $poorLembaga = Lembaga::with('evaluasi')
            ->whereHas('evaluasi', function ($query) {
                $query->where('status_docs', 1)
                ->whereNotNull('score');
            })
            ->get()
            ->map(function ($lembaga) {
                $totalStatus1 = $lembaga->evaluasi->filter(function ($evaluasi) {
                    return $evaluasi->status_docs == 1;
                })->count();
                $totalScoreStatus1 = $lembaga->evaluasi->filter(function ($evaluasi) {
                    return $evaluasi->status_docs == 1 && !is_null($evaluasi->score);
                })->sum('score');

                return [
                    'nama_lembaga' => $lembaga->nama_lembaga,
                    'total_score' => $lembaga->evaluasi->sum('score'),
                    'updated_at' => $lembaga->evaluasi->max('updated_at'),
                    'total_status1' => $totalStatus1,
                    'total_score_status1' => $totalScoreStatus1,
                ];
            })
            ->take(3);

            $averageLembaga = Lembaga::with('evaluasi')
            ->whereHas('evaluasi', function ($query) {
                $query->where('status_docs', 2)
                ->whereNotNull('score');
            })
            ->get()
            ->map(function ($lembaga) {
                $totalStatus2 = $lembaga->evaluasi->filter(function ($evaluasi) {
                    return $evaluasi->status_docs == 2;
                })->count();
                $totalScoreStatus2 = $lembaga->evaluasi->filter(function ($evaluasi) {
                    return $evaluasi->status_docs == 2 && !is_null($evaluasi->score);
                })->sum('score');

                return [
                    'nama_lembaga' => $lembaga->nama_lembaga,
                    'total_score' => $lembaga->evaluasi->sum('score'),
                    'updated_at' => $lembaga->evaluasi->max('updated_at'),
                    'total_status2' => $totalStatus2,
                    'total_score_status2' => $totalScoreStatus2,
                ];
            })
            ->sortByDesc('total_score_status2')
            ->take(3);

            $goodLembaga = Lembaga::with('evaluasi')
            ->whereHas('evaluasi', function ($query) {
                $query->where('status_docs', 3)
                    ->whereNotNull('score');
            })
            ->get()
            ->map(function ($lembaga) {
                $totalStatus3 = $lembaga->evaluasi->filter(function ($evaluasi) {
                    return $evaluasi->status_docs == 3;
                })->count();
                $totalScoreStatus3 = $lembaga->evaluasi->filter(function ($evaluasi) {
                    return $evaluasi->status_docs == 3 && !is_null($evaluasi->score);
                })->sum('score');

                return [
                    'nama_lembaga' => $lembaga->nama_lembaga,
                    'total_score' => $lembaga->evaluasi->sum('score'),
                    'updated_at' => $lembaga->evaluasi->max('updated_at'),
                    'total_status3' => $totalStatus3,
                    'total_score_status3' => $totalScoreStatus3,
                ];
            })
            ->sortByDesc('total_score_status3')
            ->take(3);

            $excellentLembaga = Lembaga::with('evaluasi')
            ->whereHas('evaluasi', function ($query) {
                $query->whereNotNull('score')
                ->where('status_docs', 4);
            })
            ->get()
            ->map(function ($lembaga) {
                $totalStatus4 = $lembaga->evaluasi->filter(function ($evaluasi) {
                    return $evaluasi->status_docs == 4;
                })->count();
                $totalScoreStatus4 = $lembaga->evaluasi->filter(function ($evaluasi) {
                    return $evaluasi->status_docs == 4 && !is_null($evaluasi->score);
                })->sum('score');

                return [
                    'nama_lembaga' => $lembaga->nama_lembaga,
                    'total_score' => $lembaga->evaluasi->sum('score'),
                    'updated_at' => $lembaga->evaluasi->max('updated_at'),
                    'total_status4' => $totalStatus4,
                    'total_score_status4' => $totalScoreStatus4,
                ];
            })
            ->sortByDesc('total_score_status4')
            ->take(3);


        return view('livescore', compact('lembagaScoresDocs','lembagaScores','maxScore','radar','countUser','countLembaga','countDocs','countTemuan','countLaporan','countAuditor','poorLembaga','averageLembaga','goodLembaga','excellentLembaga'));
    }
}
