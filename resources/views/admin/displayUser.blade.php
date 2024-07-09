@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    @if ($getData->isEmpty())
    <div class="row">
        <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
            <div class="empty">
              <div class="img-fluid"><img src="{{asset('creative')}}/assets/img/empty.png" alt="Data Kosong" width="400px">
              </div>
              <p class="empty-title text-bold">Belum Ada Data User Terdaftar</p>
              <p class="empty-subtitle text-secondary">
                Anda Dapat Melakukan Registrasi Akun User Sesuai Lembaga Yang Terdaftar.
              </p>
              <div class="empty-action">
                <a href="/register" class="btn btn-primary">
                    <i class="fas fa-plus"></i>&nbsp;&nbsp;
                  Tambahkan User
                </a>
              </div>
            </div>
          </div>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Kelola User</h6>
                    </div>
                    <div class="col-6 text-end">
                      <a href="/register" class="btn bg-gradient-dark mb-0"><i class="fas fa-plus"></i>&nbsp;&nbsp;Registrasi Akun User</a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                @foreach ($getData as $item)
                    <div class="col-md-6 mb-md-0 mb-4 p-2">
                        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                            <h6 class="mb-0 text-sm">{{ $item->name }}
                                <br>
                                <span class="text-xs">26 March 2020, at 13:45 PM</span>
                            </h6>
                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-toggle="modal" data-target="#exampleModalCenter{{ $item->id }}" title="Edit Status"></i>
                            @php
                                $idLembaga = $item->id_lembaga;
                                $cekDocUser = \App\Models\Dokumen::where('id_lembaga', $idLembaga)->count();
                            @endphp
                            @if ($cekDocUser > 0)
                                <i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalValidation{{ $item->id }}" title="Hapus Data"></i>
                            @else
                                <i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalCenter{{ $item->id }}" title="Hapus Data"></i>
                            @endif
                        </div>
                    </div>
                @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
</div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"   aria-hidden="true">
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
                    <img src="{{asset('creative')}}/assets/img/logo-ct-dark.png" alt="img-fluid" class="img-fluid mb-4 w-60">
                  </div>
                  <h4>Tambah Data Lembaga</h4>
                  <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus eligendi deserunt placeat optio nesciunt.</p>
                  <form action="/addLembaga" class="mb-4" method="POST">
                    @csrf
                    <div class="form-group">
                      <input type="text" class="form-control w-100 mr-3" name="filed_lembaga" placeholder="exp: Information Comunication Technology (ICT)">
                    </div>
                    <div class="row">
                      <div class="col-6 mt-4">
                        <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                      </div>
                      <div class="col-6 mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Tambah</button>
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
                        <h4>Edit Akun Pengguna</h4>
                        <p class="mb-3 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam commodi cum similique.</p>
                        <form action="/editUser/{{$item->id}}" class="mb-4" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" placeholder="{{$item->name}}">
                            </div>
                             <div class="deadline-form">
                                 <div class="form-group">
                                     <label for="score">Email</label>
                                     <input type="text" class="form-control" name="email" placeholder="{{$item->email}}">
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

{{-- Modal Hapus Jika User Belum memiliki Dokumen --}}
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
            <h4>Hapus Akun User</h4>
            <p class="mb-3 text-sm">Tindakan ini akan menghapus Akun Pengguna <b> "{{$item->name}}"</b> secara permanen.</p>
            <form action="/hapusUser/{{$item->id}}" class="mb-4" method="POST">
                @csrf
                @method('DELETE')
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

{{-- Modal Hapus --}}
@foreach ($getData as $item)
<div class="modal fade" id="hapusModalValidation{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"   aria-hidden="true">
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
            <h4>Tidak Dapat Menghapus Akun User</h4>
            <p class="mb-3 text-sm">Tidak Dapat Menghapus Akun Karena User <b> "{{$item->name}}"</b> telah melakukan pengiriman Dokumen. Silahkan Hubungi Superadmin untuk menghapus Akun User ini</p>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary btn-block" data-dismiss="modal">Oke, Saya Mengerti</button>
            </div>
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
