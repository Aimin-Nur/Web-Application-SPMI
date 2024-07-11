@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-8">
                        <h5 class="mt-2 ms-2">Informasi Akun User</h5>
                    </div>
                    <div class="col-3">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Type here...">
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="empty-action">
                            <a href="/register" class="btn btn-xs btn-primary">
                                <i class="fas fa-plus"></i>&nbsp;&nbsp;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">
                @foreach ($getData as $item )
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                      <h6 class="mb-3 text-sm">{{$item->name}}</h6>
                      <span class="mb-2 text-xs">Lembaga/Biro : <span class="text-dark font-weight-bold ms-sm-2">{{$item->lembaga->nama_lembaga}}</span></span>
                      <span class="mb-2 text-xs">Email Address : <span class="text-dark ms-sm-2 font-weight-bold">{{$item->email}}</span></span>
                      <span class="text-xs">Created At : <span class="text-dark ms-sm-2 font-weight-bold">{{$item->created_at}}</span></span>
                    </div>
                    <div class="ms-auto text-end">
                        <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-toggle="modal" data-target="#exampleModalCenter{{$item->id}}" title="Edit Status"></i>
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
                </li>
                @endforeach
              </ul>
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
                        <form action="/editUser/superadmin/{{$item->id}}" class="mb-4" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Nama User</label>
                                <input type="text" class="form-control" name="name" placeholder="{{$item->name}}">
                            </div>
                             <div class="deadline-form">
                                 <div class="form-group">
                                     <label for="score">Email User</label>
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
            <h4>Hapus Akun User</h4>
            <p class="mb-3 text-sm">Tindakan ini akan menghapus Akun User <b> "{{$item->name}}"</b> secara permanen.</p>
            <form action="/hapusUser/{{$item->id}}" class="mb-4" method="POST">
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

{{-- Modal Hapus Jika Dokumen User sudah ada --}}
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
                <img src="{{asset('creative')}}/assets/img/all-del.jpg" alt="img-fluid" class="img-fluid mb-4 w-60">
            </div>
            <h4>Hapus Akun User</h4>
            <p class="mb-3 text-sm">Akun User <b> "{{$item->name}}"</b> telah melakukan pengiriman dokumen kepada Admin SPMI. TIndakan ini akan menghapus Akun User beserta dengan dokumen-doumen yang dimiliki oleh users.</p>
            <form action="/hapususer/dokumen/superadmin/{{$item->id}}" class="mb-4" method="POST">
                @csrf
                @method('DELETE')
                <div class="row">
                <div class="col-6 mt-4">
                    <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                </div>
                <div class="col-6 mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Hapus Akun</button>
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
