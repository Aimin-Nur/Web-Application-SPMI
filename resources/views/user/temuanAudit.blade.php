@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{asset('creative')}}/assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
      <span class="mask bg-gradient-primary opacity-6"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
      <div class="row gx-4">
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              Temuan Audit Lembaga
            </h5>
            <p class="mb-0 font-weight-bold text-xs">
              SPMI Kalla Institute
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist" id="pills-tab">
                <li class="nav-item" role="presentation">
                  <a class="nav-link mb-0 px-0 py-1 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(603.000000, 0.000000)">
                              <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                              </path>
                              <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                              <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                    <span class="ms-1">Temuan</span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>document</title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(154.000000, 300.000000)">
                              <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                              <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z">
                              </path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                    <span class="ms-1">Riwayat</span>
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" id="pills-score-tab" data-bs-toggle="pill" data-bs-target="#pills-score" type="button" role="tab" aria-controls="pills-score" aria-selected="false">
                        <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>document</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(154.000000, 300.000000)">
                                            <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                                            <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="ms-1">Score</span>
                    </a>
                </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>

<div class="tab-content" id="pills-tabContent">
    <!-- Existing tabs content -->
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        @if ($evaluasi->isEmpty())
        <div class="container-fluid py-4">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
                        <div class="empty">
                            <div class="img-fluid"><img src="{{asset('creative')}}/assets/img/empty.png" alt="Temuan Kosong" width="300px"></div>
                            <p class="empty-title text-bold">Belum Anda Temuan Audit Bagi Lembaga Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        @livewire('user.temuan-table')
        @endif
    </div>

    <div class="tab-pane" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        @if ($riwayat->isEmpty())
        <div class="container-fluid py-4">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
                        <div class="empty">
                            <div class="img-fluid"><img src="{{asset('creative')}}/assets/img/empty.png" alt="RTM Kosong" width="300px"></div>
                            <p class="empty-title text-bold">Belum Terdapat Riwayat Temuan Audit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        @livewire('user.riwayat-temuan')
        @endif
    </div>

    <div class="tab-pane" id="pills-score" role="tabpanel" aria-labelledby="pills-score-tab">
        @if ($skorPerLembaga->isEmpty())
        <div class="container-fluid py-4">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
                        <div class="empty">
                            <div class="img-fluid"><img src="{{asset('creative')}}/assets/img/empty.png" alt="Tidak Ada Skor" width="300px"></div>
                            <p class="empty-title text-bold">Belum Ada Skor untuk Lembaga Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card h-100 mb-4">
                      <div class="card-header pb-0 px-3">
                        <div class="row">
                          <div class="col-md-6">
                            <h6 class="mb-0">Detail Skor Audit</h6>
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-4 p-3">
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Dokumen Evaluasi Lembaga</h6>
                        <ul class="list-group">
                          <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                              <button class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">-</button>
                              <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">Score Sementara</h6>
                                <span class="text-xs">Skor yang Anda Ajukan Sebelum Audit Lapangan SPMI</span>
                              </div>
                            </div>
                            <div class="d-flex align-items-center text-dark text-gradient text-sm font-weight-bold">
                              {{$totalSkorDocs}} Poin
                            </div>
                          </li>
                          <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Audit Lapangan SPMI</h6>
                          <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex align-items-center">
                                @if ($totalSkorDocs > $totalSkor)
                                    <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                        <i class="fas fa-arrow-down"></i>
                                    </button>
                                @else
                                    <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                @endif
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark text-sm">Score Akhir</h6>
                                    <span class="text-xs">Skor Akhir Hasil Audit Lapangan SPMI</span>
                                </div>
                            </div>
                            @if ($totalSkorDocs > $totalSkor)
                                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                    {{$totalSkor}} Poin
                                </div>
                            @else
                                <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                    {{$totalSkor}} Poin
                                </div>
                            @endif
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

</div>
</div>



    {{-- Modal Send Docs --}}
    @foreach ($evaluasi as $item)
    <div class="modal fade" id="hapusModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"   aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content rounded-0">
          <div class="modal-body bg-3">
          <div class="px-3 to-front">
              <div class="row align-items-center">
              <div class="col text-right">
                  <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true"><span class="icon-close2"></span></span>
                  </a>
              </div>
              </div>
          </div>
          <div class="p-4 to-front">
              <div class="text-center">
              <div class="logo">
                  <img src="{{asset('creative')}}/assets/img/send-docs.jpg" alt="img-fluid" class="img-fluid mb-4 w-60">
              </div>
              <h4>Kirim Temuan Audit</h4>
              <p class="mb-3 text-sm">Pastikan bahwa Anda telah mengisi Temuan Audit dengan lengkap. Admin SPMI dapat secara langsung melihat kelengkapan dokumen Anda saat ini.</p>
              <form action="/sendTemuan/{{$item->id}}" class="mb-4" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="row">
                  <div class="col-6 mt-4">
                      <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                  </div>
                  <div class="col-6 mt-4">
                      <button type="submit" class="btn btn-primary btn-block">Kirim Dokumen</button>
                  </div>
                  </div>
              </form>
              <small class="mb-0 cancel"><small><i>Sistem Penjaminan Mutu Internal Kalla Institute</i></small></small>
              </div>
          </div>
          </div>
      </div>
      </div>
  </div>
    @endforeach

@include('layouts.footer-admin')
@include('layouts.script-admin')
