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
              Daftar Dokumen
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
                    <span class="ms-1">Dokumen</span>
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
                    <span class="ms-1">Status Dokumen</span>
                  </a>
                </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</div>

  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        @if ($cekDokumens == 0)
        <div class="container-fluid py-4">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
                        <div class="empty">
                          <div class="img-fluid"><img src="{{asset('creative')}}/assets/img/empty.png" alt="RTM Kosong" width="300px">
                          </div>
                          <p class="empty-title text-bold">Belum Ada Dokumen yang menunggu untuk dilengkapi</p>
                          <p class="empty-subtitle text-secondary">
                            Cek Secara Berkala Alamat Email Anda Untuk Melihat Notifikasi Pengiriman Dokumen Oleh Admin SPMI.
                          </p>
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
                        <div class="card-header col-lg-12 pb-0">
                            <div class="row mb-3">
                                <div class="col-4">
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="container">
                                <div class="table-responsive p-0">
                                    <table id="documentTable" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dokumen</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Link Docs</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deadline Pengerjaan</th>
                                                <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="tab-pane" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                  <div class="card mb-4">
                    <div class="card-header col-lg-12 pb-0">
                        <div class="row mb-3">
                            <div class="col-8">
                               <h6>Riwayat Dokumen Lembaga</h6>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container">
                            <div class="table-responsive p-0">
                                <table id="historyTable" class="table align-items-center mb-0 w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dokumen</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proses</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Score</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tautan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
           </div>
        </div>
    </div>
    </div>

  </div>


{{-- Modal Send Docs --}}
@foreach ($dokumens as $item)
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
                <h4>Kirim Dokumen</h4>
                <p class="mb-3 text-sm">Pastikan bahwa Anda telah mengisi dokumen dengan lengkap. Admin SPMI dapat secara langsung melihat kelengkapan dokumen Anda saat ini.</p>
                <form action="/sendDocs/{{$item->id}}" class="mb-4" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <label for="score">Score</label>
                            <input type="number" class="form-control" name="score" placeholder="1 - 276" /required>
                            <small class="mb-0 cancel"><small><i>Score yang Anda Klaim Akan divalidasi Oleh Admin SPMI</i></small></small>
                        </div>
                    <div class="col-6 mt-4">
                        <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                    </div>
                    <div class="col-6 mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Kirim Dokumen</button>
                    </div>
                    </div>
                </form>
                <small class="mb-0 cancel"><small>Sistem Penjaminan Mutu Internal Kalla Institute</small></small>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endforeach


<script>
$(document).ready(function() {
    $('#documentTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dokumen-user') }}",
        type: 'GET',
        columns: [
            { data: 'dokumen', name: 'judul', orderable: true, searchable: true },
            { data: 'tautan', name: 'tautan', orderable: false, searchable: false, className: 'text-center' },
            { data: 'deadline', name: 'deadline', orderable: true, searchable: false, className: 'text-center' },
            { data: 'actions', name: '', orderable: false, searchable: false, className: 'text-center' }
        ],
    });
});
</script>

<script>
    $(document).ready(function() {
        var table = $('#historyTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('dokumen-user') }}",
                data: {
                    history: true
                }
            },
            type : 'GET',
            columns: [
                { data: 'dokumen', name: 'judul', orderable: true, searchable: true},
                { data: 'status_pengisian', name: 'status_pengisian', orderable: false, searchable: false, className: 'text-center' },
                { data: 'score', name: 'score', orderable: true, searchable: false, className: 'text-center' },
                { data: 'tautan', name: 'tautan', orderable: false, searchable: false, className: 'text-center'}
            ]
        });
        table.columns.adjust().draw();
    });
</script>
@include('layouts.footer-admin')
@include('layouts.script-admin')
