<div>
    <div class="container-fluid py-4">
        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3 mb-4">
                    <div class="row">
                      <div class="col-4 d-flex align-items-center">
                        <h6 class="mb-0">Laporan Audit</h6>
                      </div>
                      <div class="col-4 text-end">
                        <a class="btn bg-gradient-dark mb-0" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>&nbsp;&nbsp;</a>
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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Laporan</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tautan Laporan</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                        <th class="text-secondary opacity-7"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($getData as $item)
                        <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">{{$item->judul}}</h6>
                                </div>
                              </div>
                            </td>
                            <td>
                                <small class="text-center ms-5">
                                    <i class="fa fa-external-link text-center" aria-hidden="true" href="{{$item->tautan}}"></i>
                                </small>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <span class="badge badge-sm bg-gradient-primary">{{$item->created_at}}</span>
                            </td>
                            <td class="align-middle text-center">
                                <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}" title="Edit Status"></i>
                                <i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalCenter{{$item->id}}"  title="Hapus Data"></i>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                  <div class="container py-2 ms-auto mt-2 me-5">
                    {{ $getData->links() }}
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>