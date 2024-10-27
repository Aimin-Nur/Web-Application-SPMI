<?php

namespace App\Services;

use App\Models\Evaluasi;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class HistoryTemuan
{
    public function getRiwayat()
    {
        return Evaluasi::with(['lembaga.user', 'dokumen'])
            ->where(function($query) {
                $query->where('status_pengisian', 2)
                    ->orWhere('status_pengisian', 1)
                    ->where('score', '!=', NULL)
                    ->where('tgl_pengumpulan', '!=', NULL);
            })->get();
    }

    public function getRiwayatUsers()
    {
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        return Evaluasi::where('id_lembaga', $idLembaga)
            ->where(function($query) use ($idLembaga) {
                $query->where('status_pengisian', 1)
                    ->orWhere('status_pengisian', 2)
                    ->whereNotNull('score')
                    ->where('id_lembaga', $idLembaga);
            });
    }

    public function generateDataTable($query)
    {
        if (Auth::guard('web')->check()) {
            return DataTables::of($query)
            ->addColumn('temuan', function($row) {
                return $this->generateTemuanColumn($row);
            })
            ->addColumn('rtk', function($row) {
                return $this->generateRtkColumn($row);
            })
            ->addColumn('status_pengisian', function($row) {
                return $this->generateStatusColumn($row);
            })
            ->addColumn('status_docs', function ($row) {
                return $this->generateStatusDocsColumn($row);
            })
            ->addColumn('create', function($row) {
                return $this->generateCreateColumn($row);
            })
            ->addColumn('deadline', function($row) {
                return $this->generateDeadlineColumn($row);
            })
            ->addColumn('score', function($row) {
                return $this->generateScoreColumn($row);
            })
            ->rawColumns(['temuan', 'rtk', 'status_pengisian', 'status_docs', 'create', 'deadline', 'score'])
            ->make(true);
        }

        if (Auth::guard('admin')->check()) {
            return DataTables::of($query)
            ->addColumn('lembaga', function($row) {
                return $this->generateLembagaColumn($row);
            })
            ->addColumn('temuan', function($row) {
                return $this->generateTemuanColumn($row);
            })
            ->addColumn('rtk', function($row) {
                return $this->generateRtkColumn($row);
            })
            ->addColumn('status_pengisian', function($row) {
                return $this->generateStatusColumn($row);
            })
            ->addColumn('status_docs', function ($row) {
                return $this->generateStatusDocsColumn($row);
            })
            ->addColumn('score', function($row) {
                return $this->generateScoreColumn($row);
            })
            ->addColumn('action', function ($row) {
                return $this->generateActionColumn($row);
            })
            ->rawColumns(['lembaga', 'temuan', 'rtk', 'status_pengisian', 'status_docs', 'score','action'])
            ->make(true);
        }
    }

    private function generateLembagaColumn($row)
    {
        return '
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">' . $row->lembaga->nama_lembaga . '</h6>
                    <p class="text-xs text-secondary mb-0">' . $row->lembaga->user->name . '</p>
                </div>
            </div>';
    }

    private function generateTemuanColumn($row)
    {
        $linkClass = ($row->status_pengisian == 2 || $row->status_pengisian == 1) ? 'text-success' : 'text-secondary';
        return '
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">' . $row->temuan . '</h6>
                    <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="' . $row->tautan . '"><i class="fa fa-external-link ' . $linkClass . '" aria-hidden="true"></a></i></small>
                </div>
            </div>';
    }

    private function generateCreateColumn($row)
    {
        return '<span class="text-secondary text-xs font-weight-bold">' . \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y') . '</span>';
    }

    private function generateRtkColumn($row)
    {
        $linkClass = ($row->status_pengisian == 2 || $row->status_pengisian == 1) ? 'text-success' : 'text-secondary';
        return '
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">' . $row->rtk . '</h6>
                    <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="' . $row->tautan_rtk . '"><i class="fa fa-external-link ' . $linkClass . '" aria-hidden="true"></a></i></small>
                </div>
            </div>';
    }

    private function generateStatusColumn($row)
    {
        $badgeClass = $row->status_pengisian == 2 ? 'bg-gradient-success' : ($row->status_pengisian == 1 ? 'bg-gradient-danger' : 'bg-gradient-secondary');
        $status = $row->status_pengisian == 2 ? 'Selesai' : ($row->status_pengisian == 1 ? 'Terlambat' : 'Pending');
        return '<small style="font-size:11px" class="badge badge-sm ms-4 ' . $badgeClass . '">' . $status . '</small>';
    }

    private function generateStatusDocsColumn($row)
    {
        switch ($row->status_docs) {
            case 4:
                $badgeClass = 'bg-gradient-success';
                $status = 'Excellent';
                break;
            case 3:
                $badgeClass = 'bg-gradient-info';
                $status = 'Good';
                break;
            case 2:
                $badgeClass = 'bg-gradient-warning';
                $status = 'Average';
                break;
            case 1:
                $badgeClass = 'bg-gradient-danger ';
                $status = 'Poor';
                break;
            default:
                $badgeClass = 'bg-gradient-secondary align-items-center';
                $status = 'Unknown';
                break;
        }
        return '<small style="font-size:11px" class="badge badge-sm ms-4 ' . $badgeClass . '">' . $status . '</small>';
    }

    private function generateScoreColumn($row)
    {
        return '<span class="text-secondary text-xs font-weight-bold ms-4">' . $row->score . '</span>';
    }

    private function generateDeadlineColumn($row)
    {
        return '<span class="text-secondary text-xs font-weight-bold">' . \Carbon\Carbon::parse($row->deadline)->locale('id')->translatedFormat('l, d F Y') . '</span>';
    }

    private function generateActionColumn($row)
    {
        if (Auth::guard('admin')->check()) {
            return '
            <i class="far fa-trash-alt ms-2 text-danger cursor-pointer me-2" data-toggle="modal" data-target="#hapusModalCenter' . $row->id . '" title="Hapus Data"></i>
            <i class="fa fa-info-circle text-secondary cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id . '" title="Detail Riwayat"></i>
         ';
        }
        return '
           <i class="fa fa-info-circle text-secondary cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id . '" title="Detail Riwayat"></i>
        ';
    }
}
