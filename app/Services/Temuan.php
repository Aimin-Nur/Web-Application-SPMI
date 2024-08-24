<?php

namespace App\Services;

use App\Models\Evaluasi;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class Temuan
{
    public function getTemuans()
    {
        return Evaluasi::with(['lembaga.user', 'dokumen'])
            ->where('score', NULL)
            ->get();
    }

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

    public function getScores()
    {
        return Evaluasi::with(['lembaga.user'])
            ->where(function($query) {
                $query->where('status_pengisian', 1)
                    ->orWhere('status_pengisian', 2)
                    ->where('score', '!=', NULL);
            })
            ->get();
    }

    public function getScoresPerLembaga()
    {
        return Evaluasi::select(
                'id_lembaga',
                \DB::raw('SUM(score) as total_score'),
                \DB::raw('COUNT(id) as total_temuan')
            )
            ->groupBy('id_lembaga')
            ->with('lembaga.user')
            ->where('score', '!=', NULL)
            ->orderBy('total_score', 'desc')
            ->get();
    }

    public function getTemuanUsers()
    {
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        return Evaluasi::with(['lembaga.user'])
            ->where('id_lembaga', $idLembaga)
            ->where(function($query) {
                $query->where('status_pengisian', 0)
                    ->orWhere('status_pengisian', 3);
            })
            ->where('deadline', '!=', 0);
    }

    public function generateDataTable($query)
    {
        return DataTables::of($query)
            ->addColumn('lembaga', function($row) {
                return '
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row->lembaga->nama_lembaga . '</h6>
                        <p class="text-xs text-secondary mb-0">' . $row->lembaga->user->name . '</p>
                    </div>
                </div>';
            })
            ->addColumn('temuan', function($row) {
                $linkClass = ($row->status_pengisian == 2 || $row->status_pengisian == 1) ? 'text-success' : 'text-secondary';
                return '
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row->temuan . '</h6>
                        <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="' . $row->tautan . '"><i class="fa fa-external-link ' . $linkClass . '" aria-hidden="true"></a></i></small>
                    </div>
                </div>';
            })
            ->addColumn('rtk', function($row) {
                $linkClass = ($row->status_pengisian == 2 || $row->status_pengisian == 1) ? 'text-success' : 'text-secondary';
                return '
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row->rtk . '</h6>
                        <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="' . $row->tautan_rtk . '"><i class="fa fa-external-link ' . $linkClass . '" aria-hidden="true"></a></i></small>
                    </div>
                </div>';
            })
            ->addColumn('status_pengisian', function($row) {
                $badgeClass = $row->status_pengisian == 2 ? 'bg-gradient-success' : ($row->status_pengisian == 1 ? 'bg-gradient-danger' : 'bg-gradient-secondary');
                $status = $row->status_pengisian == 2 ? 'Selesai' : ($row->status_pengisian == 1 ? 'Terlambat' : 'Pending');
                return '
                <small class="badge badge-sm ' . $badgeClass . '">' . $status . '</small>';
            })
            ->addColumn('create', function ($row) {
                return '<span class="text-secondary text-xs font-weight-bold">' . \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y') . '</span>';
            })
            ->addColumn('deadline', function($row) {
                $deadline = $row->deadline != 0 ? \Carbon\Carbon::parse($row->deadline)->locale('id')->translatedFormat('l, d F Y') : '-';
                return '<span class="text-secondary text-xs font-weight-bold">' . $deadline . '</span>';
            })
            ->addColumn('action', function ($row) {
                if (Auth::guard('admin')->check()) {
                    $edit = '';
                    $unsend = '';
                    if (in_array($row->status_pengisian, [1, 2])) {
                        $edit = '<i class="fas fa-pencil-alt ms-3 text-success cursor-pointer" data-toggle="modal" data-target="#editModalCenter' . $row->id . '" title="Edit Status"></i>';
                    } else {
                        $unsend = '<i class="fas fa-pencil-alt ms-3 text-dark cursor-pointer" data-toggle="modal" data-target="#unsend' . $row->id . '" title="Edit Status"></i>';
                    }
                    $delete = '<i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalCenter' . $row->id . '" title="Hapus Data"></i>';

                    return $edit . ' ' . $unsend . ' ' . $delete;
                }

                return '';
            })
            ->rawColumns(['lembaga', 'temuan', 'rtk', 'status_pengisian', 'create', 'deadline','action'])
            ->make(true);
    }

    public function generateDataTableUsers($temuanQueryUsers)
    {
        return DataTables::of($temuanQueryUsers)
            ->addColumn('temuan', function($row) {
                $linkClass = ($row->status_pengisian == 2 || $row->status_pengisian == 1) ? 'text-success' : 'text-secondary';
                return '
                <td class="align-middle text-center text-sm">
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->temuan . '</h6>
                            <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="' . $row->tautan . '"><i class="fa fa-external-link ' . $linkClass . '" aria-hidden="true"></a></i></small>
                        </div>
                    </div>
                </td>';
            })
            ->addColumn('rtk', function($row) {
                $linkClass = ($row->status_pengisian == 2 || $row->status_pengisian == 1) ? 'text-success' : 'text-secondary';
                return '
                <td class="align-middle text-center text-sm">
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">' . $row->rtk . '</h6>
                            <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="' . $row->tautan_rtk . '"><i class="fa fa-external-link ' . $linkClass . '" aria-hidden="true"></a></i></small>
                        </div>
                    </div>
                </td>';
            })
            ->addColumn('create', function ($row) {
                return '
                 <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">' . \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y') . '</span>
                </td>';
            })
            ->addColumn('deadline', function($row) {
                $deadline = $row->deadline != 0 ? \Carbon\Carbon::parse($row->deadline)->locale('id')->translatedFormat('l, d F Y') : '-';
                return '
                <td class="align-middle text-center text-sm">
                    <span class="text-secondary text-xs font-weight-bold">' . $deadline . '</span>
                </td>';
            })
            ->addColumn('action', function ($row) {
                return '
                <td class="align-middle text-center text-sm">
                    <a class="btn text-xs btn-sm bg-gradient-primary mt-3" data-toggle="modal" data-target="#hapusModalCenter' . $row->id . '">Send Docs</a>
                </td>';
            })
            ->rawColumns(['temuan', 'rtk', 'create', 'deadline', 'action'])
            ->make(true);
    }

}
