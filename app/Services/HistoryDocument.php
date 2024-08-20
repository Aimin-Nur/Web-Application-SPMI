<?php

namespace App\Services;

use App\Models\Dokumen;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class HistoryDocument
{
    public function getHistoryDocument()
    {
        $query = Dokumen::with(['lembaga.user'])
            ->whereNotNull('score');

        return DataTables::of($query)
            ->filterColumn('lembaga', function ($query, $keyword) {
                $query->whereHas('lembaga', function ($query) use ($keyword) {
                    $query->where('nama_lembaga', 'like', "%{$keyword}%")
                        ->orWhereHas('user', function ($query) use ($keyword) {
                            $query->where('name', 'like', "%{$keyword}%");
                        });
                });
            })
            ->filterColumn('dokumen', function ($query, $keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('tautan', 'like', "%{$keyword}%");
            })
            ->filterColumn('status_pengisian', function ($query, $keyword) {
                $query->where('status_pengisian', $keyword);
            })
            ->filterColumn('score', function ($query, $keyword) {
                $query->where('score', 'like', "%{$keyword}%");
            })
            ->addColumn('lembaga', function ($row) {
                return '<div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">' . $row->lembaga->nama_lembaga . '</h6>
                                <p class="text-xs text-secondary mb-0">' . $row->lembaga->user->name . '</p>
                            </div>
                        </div>';
            })
            ->addColumn('dokumen', function ($row) {
                return '<h6 class="mb-0 text-sm">' . $row->judul . '</h6>
                        <small class="text-xs text-secondary mt-2">Link Dokumen: <a href="' . $row->tautan . '" target="_blank"><i class="fa fa-external-link text-success" aria-hidden="true"></i></a></small>';
            })
            ->addColumn('status_pengisian', function ($row) {
                if ($row->status_pengisian == 1) {
                    return '<span class="badge badge-sm bg-gradient-danger ms-4">Terlambat</span>';
                } elseif ($row->status_pengisian == 2) {
                    return '<span class="badge badge-sm bg-gradient-success ms-4">Selesai</span>';
                } else {
                    return '<span class="badge badge-sm bg-gradient-secondary ms-4">Revisi</span>';
                }
            })
            ->addColumn('score', function ($row) {
                return '<span class="text-secondary text-sm font-weight-bold ms-5">' . $row->score . '</span>';
            })
            ->addColumn('actions', function ($row) {
                    if (Auth::guard('admin')->check()) {
                    $hapus = '<i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalCenter' . $row->id . '" title="Hapus Data"></i>';
                    $detail  = '<i class="fa fa-info-circle text-secondary cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id . '" title="Detail Riwayat"></i>';
                    return $hapus . ' ' . $detail;
                }
                $detail  = '<i class="fa fa-info-circle text-secondary cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row->id . '" title="Detail Riwayat"></i>';
                return $detail;
            })
            ->rawColumns(['lembaga', 'dokumen', 'status_pengisian', 'score', 'actions'])
            ->make(true);
    }

    public function getUserDokumensHistory()
    {
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        return Dokumen::with(['lembaga.user'])
            ->where('id_lembaga', $idLembaga)
            ->where(function($query) {
                $query->where('status_pengisian', 2)
                    ->orWhere('status_pengisian', 1);
            });
    }

    public function generateUserHistoryDataTable($historyDokumensUsers)
    {
        return Datatables::eloquent($historyDokumensUsers)
            ->addColumn('dokumen', function ($row) {
                return '
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">' . $row->judul . '</h6>
                        <small class="text-xs text-secondary mt-2">Created : ' . \Carbon\Carbon::parse($row->created_at)->locale('id')->translatedFormat('l, d F Y') . '</small>
                    </div>
                </div>';
            })
            ->addColumn('status_pengisian', function ($row) {
                return '
                <td class="align-middle text-center text-sm">
                    ' . ($row->status_pengisian == 1 ?
                    '<span class="badge badge-sm bg-gradient-danger">Terlambat</span>' :
                    ($row->status_pengisian == 2 && $row->score !== null ?
                    '<span class="badge badge-sm bg-gradient-success">Selesai</span>' : '')) . '
                </td>';
            })
            ->addColumn('score', function ($row) {
                return '
                <td class="align-middle text-center text-sm">
                    ' . (!$row->score ?
                    '<p class="text-xs text-secondary mb-0">-</p>' :
                    '<p class="text-xs text-secondary mb-0">' . $row->score . '</p>') . '
                </td>';

            })
            ->addColumn('tautan', function ($row) {
                return '
                <td class="align-middle text-center text-sm">
                    <a href="' . $row->tautan . '" target="_blank">
                        <i class="fa fa-share-square-o ms-3 text-secondary cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Open Docs"></i>
                    </a>
                </td>';
            })
            ->rawColumns(['dokumen', 'status_pengisian', 'score', 'tautan'])
            ->make(true);
    }
}

