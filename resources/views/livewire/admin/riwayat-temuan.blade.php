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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lembaga</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Temuan & Saran</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">RTK</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pengisian</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Dokumen</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Skor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->lembaga->nama_lembaga}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$item->lembaga->user->name}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->temuan}}</h6>
                                                        <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="{{$item->tautan_temuan}}" target="_blank"><i class="fa fa-external-link text-success" aria-hidden="true"></i></a></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->rtk}}</h6>
                                                    <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="{{$item->tautan_rtk}}" target="_blank"><i class="fa fa-external-link text-success" aria-hidden="true"></i></a></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($item->status_pengisian == 2)
                                                <small class="badge badge-sm bg-gradient-success">Selesai</small>
                                            @else
                                                <small class="badge badge-sm bg-gradient-danger">Terlambat</small>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            @if ($item->status_docs == 1)
                                                <span class="badge badge-sm bg-gradient-danger">Poor</span>
                                            @elseif ($item->status_docs == 2)
                                                <span class="badge badge-sm bg-gradient-warning">Average</span>
                                            @elseif ($item->status_docs == 3)
                                                <span class="badge badge-sm bg-gradient-info">Good</span>
                                                @elseif ($item->status_docs == 4)
                                                <span class="badge badge-sm bg-gradient-success">Excellent</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$item->score}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <i class="far fa-trash-alt ms-2 text-danger cursor-pointer me-2" data-toggle="modal" data-target="#hapusModalCenter{{$item->id}}" title="Hapus Data"></i>
                                            <i class="fa fa-info-circle text-secondary cursor-pointer" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}" title="Detail Riwayat"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


