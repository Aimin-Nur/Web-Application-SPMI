@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    <div class="page-body">
        <div class="row">
            <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
                <div class="empty">
                  <div class="img-fluid"><img src="{{asset('creative')}}/assets/img/empty.png" alt="RTM Kosong" width="400px">
                  </div>
                  <p class="empty-title text-bold">Tidak Ada Jadwal Rapat Tinjauan Manajemen</p>
                  <p class="empty-subtitle text-secondary">
                    Try adjusting your search or filter to find what you're looking for.
                  </p>
                  <div class="empty-action">
                    <a href="/addRTM" class="btn btn-primary">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;
                      Tambahkan Jadwal RTM
                    </a>
                  </div>
                </div>
              </div>
        </div>
    </div>

</div>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Staus Dokumen Lembaga</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lembaga</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokumen</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pengisian</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Dokumen</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Durasi Revisi</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($rtm as $item) --}}
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm"></h6>
                                            <p class="text-xs text-secondary mb-0"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="">
                                    <span class="text-xs font-weight-bold mb-0"></span>
                                    <p class="text-xs text-secondary mb-0">Diselesaikan oleh lembaga :</p>
                                </td>
                                <td class="align-middle text-center text-sm">

                                </td>
                                <td class="align-middle text-center text-sm">

                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold"> Hari</span>
                                </td>
                                <td class="align-middle">
                                    <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Status"></i>
                                    <i class="fa fa-share-square-o ms-2 text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Open Docs"></i>
                                    <i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data"></i>
                                </td>
                            </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
   </div>
</div>

@include('layouts.footer-admin')
@include('layouts.script-admin')
