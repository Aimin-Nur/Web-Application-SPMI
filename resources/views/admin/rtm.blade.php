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

@include('layouts.footer-admin')
@include('layouts.script-admin')
