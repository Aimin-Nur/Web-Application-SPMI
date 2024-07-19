<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header col-lg-12 pb-0">
                        <div class="row mb-3">
                            <div class="col-8">
                               <h6>Riwayat Temuan Audit</h6>
                            </div>
                            <div class="col-4">
                                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                    <div class="input-group">
                                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" placeholder="Type here..." wire:model="search">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Temuan & Saran</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">RTK</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pengisian</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Dokumen</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tenggat Pengerjaan</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->temuan}}</h6>
                                                    @if ($item->status_pengisian == 2)
                                                        <small class="text-xs text-secondary mt-2">Link Dokumen : <i class="fa fa-external-link text-success" aria-hidden="true" href="{{$item->tautan}}"></i></small>
                                                    @else
                                                        <small class="text-xs text-secondary mt-2">Link Dokumen : <i class="fa fa-external-link" aria-hidden="true" href="{{$item->tautan}}"></i></small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->rtk}}</h6>
                                                    @if ($item->status_pengisian == 2)
                                                    <small class="text-xs text-secondary mt-2">Link Dokumen : <i class="fa fa-external-link text-success" aria-hidden="true" href="{{$item->tautan}}"></i></small>
                                                @else
                                                    <small class="text-xs text-secondary mt-2">Link Dokumen : <i class="fa fa-external-link" aria-hidden="true" href="{{$item->tautan}}"></i></small>
                                                @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($item->status_pengisian == 2)
                                                <small class="badge badge-sm bg-gradient-success">Selesai</small>
                                            @elseif ($item->status_pengisian == 1)
                                                <small class="badge badge-sm bg-gradient-danger">Terlambat</small>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($item->status_docs == 1)
                                                <span class="badge badge-sm bg-gradient-primary">Minor</span>
                                            @elseif ($item->status_docs == 2)
                                                <span class="badge badge-sm bg-gradient-danger">Mayor</span>
                                            @elseif ($item->status_docs == 3)
                                                <span class="badge badge-sm bg-gradient-success">Close</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-secondary">Pemeriksaan</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <small class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('l, d F Y') }}</small>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($item->deadline != 0)
                                                <span class="text-secondary text-xs font-weight-bold">{{ \Carbon\Carbon::parse($item->deadline)->locale('id')->translatedFormat('l, d F Y') }}</span>
                                            @else
                                                <span class="text-secondary text-xs font-weight-bold">-</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item->score}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container py-2 ms-auto mt-2 me-5">
                                {{ $riwayat->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
