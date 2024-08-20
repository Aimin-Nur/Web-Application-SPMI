@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12 mt-4">
          <div class="card">
         @livewire('superadmin.manage-user')
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
                                <input type="text" class="form-control" name="name" placeholder="{{$item->name}}" /required>
                            </div>
                             <div class="deadline-form">
                                 <div class="form-group">
                                     <label for="score">Email User</label>
                                     <input type="text" class="form-control" name="email" placeholder="{{$item->email}}" /required>
                                 </div>
                             </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                                </div>
                                <div class="col-6 mt-4">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
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
