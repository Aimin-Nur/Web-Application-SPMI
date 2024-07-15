<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header col-lg-12 pb-0">
                        <div class="row mb-3">
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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tenggat Pengerjaan</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evaluasi as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->temuan}}</h6>
                                                        <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="{{$item->tautan}}" target="_blank"><i class="fa fa-external-link text-success" aria-hidden="true" href=""></i></a></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->rtk}}</h6>
                                                    <small class="text-xs text-secondary mt-2">Link Dokumen : <a href="{{$item->tautan}}" target="_blank"><i class="fa fa-external-link text-success" aria-hidden="true"></i></small></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <small class="text-secondary text-xs font-weight-bold">{{$item->created_at}}</small>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($item->deadline != 0)
                                                <span class="text-secondary text-xs font-weight-bold">{{$item->deadline}}</span>
                                            @else
                                                <span class="text-secondary text-xs font-weight-bold">-</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a class="btn text-xs btn-sm bg-gradient-primary mt-3" data-toggle="modal" data-target="#hapusModalCenter{{$item->id}}">Send Docs</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container py-2 ms-auto mt-2 me-5">
                                {{ $evaluasi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>