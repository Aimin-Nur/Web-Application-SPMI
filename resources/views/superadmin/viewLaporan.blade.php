@include('layouts.header-admin')
@include('layouts.navbar-admin')

@if ($getData->isEmpty())
<div class="container-fluid py-4 mb-auto">
    <div class="page-body">
        <div class="row">
            <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
                <div class="empty">
                <div class="img-fluid"><img src="{{asset('creative')}}/assets/img/empty.png" alt="RTM Kosong" width="420px">
                </div>
                <p class="empty-title text-bold">Belum Ada Data Laporan Audit</p>
                <p class="empty-subtitle text-secondary">
                    Try adjusting your search or filter to find what you're looking for.
                  </p>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 p-3 mb-4">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Laporan Audit</h6>
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
                                <a href="{{$item->tautan}}" target="_blank">
                                    <i class="fa fa-external-link text-center" aria-hidden="true"></i>
                                </a>
                            </small>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-primary">{{$item->created_at}}</span>
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
@endif









@include('layouts.footer-admin')
@include('layouts.script-admin')
