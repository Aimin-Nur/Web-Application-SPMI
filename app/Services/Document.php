<?php

namespace App\Services;

use App\Models\Dokumen;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class Document
{
    public function getDokumens()
    {
        return Dokumen::with(['lembaga.user'])
            ->whereIn('status_pengisian', [0, 1, 2])
            ->whereNull('score');
    }

    public function getUserDokumens()
    {
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        return Dokumen::with(['lembaga.user'])
            ->where('id_lembaga', $idLembaga)
            ->where(function($query) {
                $query->where('status_pengisian', 0)
                    ->orWhere('status_pengisian', 3);
            })
            ->where('deadline', '!=', 0);
    }

    public function generateDataTable($dokumensQuery)
    {
        return Datatables::eloquent($dokumensQuery)
            ->filterColumn('lembaga', function($query, $keyword) {
                $query->whereHas('lembaga', function($query) use ($keyword) {
                    $query->where('nama_lembaga', 'like', "%{$keyword}%")
                        ->orWhereHas('user', function($query) use ($keyword) {
                            $query->where('name', 'like', "%{$keyword}%");
                        });
                });
            })
            ->filterColumn('dokumen', function($query, $keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('tautan', 'like', "%{$keyword}%");
            })
            ->addColumn('lembaga', function ($row) {
                return $row->lembaga->nama_lembaga . '<br><p class="text-xs text-secondary mb-0">' . $row->lembaga->user->name . '</p>';
            })
            ->addColumn('dokumen', function ($row) {
                return $row->judul . '<br><small>Link Dokumen: <a href="' . $row->tautan . '"><i class="fa fa-external-link text-success" aria-hidden="true"></i></a></small>';
            })
            ->addColumn('status', function ($row) {
                if ($row->status_pengisian == 2) {
                    return '<small class="badge badge-sm bg-gradient-success text-center">Selesai</small>';
                } elseif ($row->status_pengisian == 1) {
                    return '<small class="badge badge-sm bg-gradient-danger text-center">Terlambat</small>';
                } else {
                    return '<small class="badge badge-sm bg-gradient-secondary align-items-center ms-5">Pending</small>';
                }
            })
            ->addColumn('created', function ($row) {
                return \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y');
            })
            ->addColumn('deadline', function ($row) {
                if ($row->deadline != 0) {
                    return \Carbon\Carbon::parse($row->deadline)->locale('id')->translatedFormat('l, d F Y');
                } else {
                    return '-';
                }
            })
            ->addColumn('actions', function ($row) {
                if (Auth::guard('admin')->check()) {
                    // $edit = '<i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-toggle="modal" data-target="#exampleModalCenter' . $row->id . '" title="Edit Status"></i>';
                    $delete = '<i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalCenter' . $row->id . '" title="Hapus Data"></i>';
                    return $delete;
                }
                return '';
            })
            ->rawColumns(['lembaga', 'dokumen', 'status', 'actions'])
            ->make(true);
    }

    public function generateUserDataTable($dokumensQueryUsers)
    {
        return Datatables::eloquent($dokumensQueryUsers)
            ->addColumn('dokumen', function ($row) {
                return '
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row->judul . '</h6>
                        <small class="text-xs text-secondary mt-2">Created : ' . \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y') . '</small>
                    </div>
                </div>';
            })
            ->addColumn('tautan', function ($row) {
                return '
                <td class="align-middle text-center text-sm">
                    <a href="' . $row->tautan . '" target="_blank">
                        <i class="fa fa-share-square-o ms-3 text-success cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Open Docs"></i>
                    </a>
                </td>';
            })
            ->addColumn('deadline', function ($row) {
                return '
                <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">' . \Carbon\Carbon::parse($row->deadline)->locale('id')->translatedFormat('l, d F Y') . '</span>
                </td>';
            })
            ->addColumn('actions', function ($row) {
                return '
                <td class="align-middle text-center text-sm">
                    <a class="btn text-xs btn-sm bg-gradient-primary mt-3" data-toggle="modal" data-target="#hapusModalCenter' . $row->id . '">Send Docs</a>
                </td>';
            })
            ->rawColumns(['dokumen', 'tautan', 'deadline', 'actions'])
            ->make(true);
    }

}
