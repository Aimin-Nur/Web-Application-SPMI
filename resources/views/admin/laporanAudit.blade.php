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
                <p class="empty-title text-bold">Tidak Ada Data Laporan Audit</p>
                <p class="empty-subtitle text-secondary">
                    Try adjusting your search or filter to find what you're looking for.
                  </p>
                <div class="empty-action">
                    <a href="/addLaporan" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;
                    Tambah Laporan Audit
                    </a>
                </div>
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
                  <div class="col-4 d-flex align-items-center">
                    <h6 class="mb-0">Laporan Audit</h6>
                  </div>
                  <div class="col-8 text-end">
                    <a class="btn bg-gradient-dark mb-0" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>&nbsp;&nbsp; Tambah Laporan Audit</a>
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
                        <td class="align-middle text-center">
                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}" title="Edit Status"></i>
                            <i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalCenter{{$item->id}}"  title="Hapus Data"></i>
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

{{-- Modal Edit --}}
@foreach ($getData as $item)
<div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <h4>Edit Laporan Audit</h4>
                        <p class="mb-3 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam commodi cum similique.</p>
                        <form action="/editLaporan/{{$item->id}}" class="mb-4" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Judul Laporan</label>
                                <input type="text" class="form-control" name="laporan" value="{{$item->judul}}" /required>
                            </div>
                             <div class="deadline-form">
                                 <div class="form-group">
                                     <label for="score">Tautan Laporan</label>
                                     <input type="url" class="form-control" name="tautan" value="{{$item->tautan}}" /required>
                                 </div>
                             </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                                </div>
                                <div class="col-6 mt-4">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan Laporam</button>
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

{{-- Modal Hapus --}}
@foreach ($getData as $item)
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
                <img src="{{asset('creative')}}/assets/img/hapus-docs.jpg" alt="img-fluid" class="img-fluid mb-4 w-60">
            </div>
            <h4>Hapus Laporan Audit</h4>
            <p class="mb-3 text-sm">Tindakan ini akan menghapus Laporan Audit <b> "{{$item->judul}}"</b> secara permanen.</p>
            <form action="/hapusLaporan/{{$item->id}}" class="mb-4" method="POST">
                @csrf
                @method('DeLETe')
                <div class="row">
                <div class="col-6 mt-4">
                    <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                </div>
                <div class="col-6 mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Hapus Dokumen</button>
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


{{-- Modal Add --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <h4>Tambah Laporan Audit</h4>
                        <p class="mb-3 text-sm">Laporan Audit yang Anda Tambahkan Dapat Diakses Secara Terbuka Oleh Orang Lain.</p>
                        <form action="/addLaporan" class="mb-4" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="judul" id="judulLaporanInput" placeholder="Masukkan Judul Laporan Audit" /required>
                            </div>

                            <div class="form-group">
                                <input type="url" class="form-control score-input" name="tautan" id="scoreInput" placeholder="Link Tautan Laporan" /required>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                                </div>
                                <div class="col-6 mt-4">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan Laporan</button>
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


 <script>
   document.addEventListener('DOMContentLoaded', function() {
    const judulLaporanInput = document.getElementById('judulLaporanInput');
    const scoreInput = document.getElementById('scoreInput');
    const deadlineForm = document.querySelector('.deadline-form');

    function showScoreInput() {
        scoreInput.style.display = 'block';
        deadlineForm.style.display = 'none';
    }

    judulLaporanInput.addEventListener('input', function() {
        showScoreInput();
    });

    function resetScoreInput() {
        scoreInput.style.display = 'none';
        scoreInput.value = '';
    }
    resetScoreInput();
});
</script>



@include('layouts.footer-admin')
@include('layouts.script-admin')
