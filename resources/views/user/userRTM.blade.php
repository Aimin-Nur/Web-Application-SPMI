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
                    Saat ini SPMI Kalla Institut Belum Menjadwalkan Rapat Tinjaun Manajemen Lembaga Anda.
                  </p>
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
              <h6>Jadwal Rapat Tinjauan Manajemen</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jadwal Rapat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lokasi</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Spotify</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$2,500</p>
                      </td>
                      {{-- <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td> --}}
                      {{-- <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">60%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td> --}}
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

@include('layouts.footer-admin')
@include('layouts.script-admin')
