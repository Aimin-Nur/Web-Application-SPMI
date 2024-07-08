<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header col-lg-12 pb-0">
                        <div class="row mb-3">
                            <div class="col-8">
                                <a class="float-star btn-md btn bg-gradient-dark mb-0" href="/addDokumen"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Dokumen</a>
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokumen</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pengisian</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tenggat Pengerjaan</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dokumens as $item)
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
                                                    <h6 class="mb-0 text-sm">{{$item->judul}}</h6>
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
                                            @else
                                                <small class="badge badge-sm bg-gradient-danger">Pending</small>
                                            @endif
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
                                        <td class="align-middle">
                                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}" title="Edit Status"></i>
                                            <i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalCenter{{$item->id}}"  title="Hapus Data"></i>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container py-2 ms-auto mt-2 me-5">
                                {{ $dokumens->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

