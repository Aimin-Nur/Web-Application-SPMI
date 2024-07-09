@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card mt-4">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Lembaga Kalla Institute</h6>
                  </div>
                  <div class="col-6 text-end">
                    <button type="button" class="btn bg-gradient-dark mb-0" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Lembaga</button>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <div class="row">
                @foreach ($getData as $item)
                    <div class="col-md-6 mb-md-0 mb-4 p-2">
                        <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                            <h6 class="mb-0 text-sm">{{$item->nama_lembaga}}
                                <br>
                                <span class="text-xs">26 March 2020, at 13:45 PM</span>
                            </h6>
                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-toggle="modal" data-target="#editModalCenter{{$item->id}}"  title="Edit Data"></i>
                            <i class="far fa-trash-alt ms-2 text-danger cursor-pointer" data-toggle="modal" data-target="#hapusModalCenter{{$item->id}}"  title="Hapus Data"></i>
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
</div>


    <!-- Modal Tambah Lembaga -->
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

{{-- Modal Hapus Lembaga --}}
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
               <h4>Hapus Lembaga</h4>
               <p class="mb-3 text-sm">Tindakan ini akan menghapus Lembaga <b> "{{$item->nama_lembaga}}"</b> secara permanen.</p>
               <form action="/hapusLembaga/{{$item->id}}" class="mb-4" method="POST">
                   @csrf
                   @method("DELETE")
                   <div class="row">
                   <div class="col-6 mt-4">
                       <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                   </div>
                   <div class="col-6 mt-4">
                       <button type="submit" class="btn btn-primary btn-block">Hapus Lembaga</button>
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

{{-- Modal Hapus Lembaga Validation --}}
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
               <h4>Hapus Lembaga</h4>
               <p class="mb-3 text-sm">Lembaga <b> "{{$item->nama_lembaga}}"</b> telah melakukan pengiriman dokumen-dokumen Audit, Silahkan Menghapus Akun User yang berkaitan dengan Lembaga tersebut.</p>
                <div class="row">
                   <div class="col-12 mt-4">
                       <a href="/user"><button class="btn btn-primary btn-block">Hapus Akun User</button></a>
                   </div>
                </div>
               <small class="mb-0 cancel"><small><i>Sistem Penjaminan Mutu Internal Kalla Institute</i></small></small>
               </div>
           </div>
           </div>
       </div>
       </div>
</div>
@endforeach

{{-- Modal Edit Docs --}}
@foreach ($getData as $item)
<div class="modal fade" id="editModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"   aria-hidden="true">
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
            <h4>Edit Data Lembaga</h4>
            <p class="mb-3 text-sm">Sesuaikan Data Lembaga yang ingin Anda Edit.</p>
            <form action="/editLembaga/{{$item->id}}" class="mb-4" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="col">
                        <input type="text" value="{{$item->nama_lembaga}}" class="form-control" name="nama_lembaga">
                    </div>
                </div>
                <div class="row">
                <div class="col-6 mt-4">
                    <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                </div>
                <div class="col-6 mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Edit Data</button>
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
