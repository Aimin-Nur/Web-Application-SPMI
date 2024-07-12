@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-md-12 mb-lg-0 mb-4">
            <div class="card mt-4">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-6 d-flex align-items-center">
                    <h6 class="mb-0">Audior Santuan Penjaminan Mutu Kalla Institute</h6>
                  </div>
                  <div class="col-6 text-end">
                    <a class="btn bg-gradient-dark mb-0" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Auditors</a>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <div class="row">
                      <div class="col-md-12">
                        <div class="card card-body text-center border card-plain border-radius-lg d-flex align-items-center flex-row">
                          <img class="w-3 me-3 mb-0" src="{{ asset('creative')}}/assets/img/no.png" alt="logo">
                          <h6 class="mb-0 text-sm">Ukuran Foto Tidak Boleh Melebihi 4 MB.</h6> ||
                          <h6 class="mb-0 text-sm">Format Foto Hanya Boleh Ekstensi PNG & JPG.</h6>
                        </div>
                      </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 mt-5">
            <div class="row">
                @foreach ($getData as $item)
              <div class="col-lg-6 py-2">
                    <div class="card">
                        <div class="card-header mx-4 p-3 text-center">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('auditors/' . $item->foto) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                        </div>
                        <div class="card-body pt-0 p-3 text-center">
                        <h6 class="text-center mb-0">{{$item->nama}}</h6>
                        <span class="text-xs">{{$item->created_at}}</span>
                        <hr class="horizontal dark my-3">
                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="modal" data-target="#hapusModalCenter{{$item->id}}"><i class="far fa-trash-alt me-2"></i>Delete</a>
                        <a class="btn btn-link text-dark px-3 mb-0" data-toggle="modal" data-target="#editModalCenter{{$item->id}}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                        </div>
                    </div>
              </div>
              @endforeach
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
              <h5>Tambah Data Auditor</h5>
              <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus eligendi deserunt placeat optio nesciunt.</p>
              <form action="/addAuditor" class="mb-4" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control w-100 mr-3" name="nama" placeholder="Fulan bin Fulan, S.T., M.Kom." required>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control w-100 mr-3" name="foto" accept="image/*" required>
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
                   <img src="{{ asset('storage/' . $item->foto) }}" alt="img-fluid" class="img-fluid mb-4 w-60">
               </div>
               <h4>Hapus Auditor</h4>
               <p class="mb-3 text-sm">Tindakan ini akan menghapus Auditor <b> "{{$item->nama}}"</b> secara permanen.</p>
               <form action="/hapusAuditor/superadmin/{{$item->id}}" class="mb-4" method="POST">
                   @csrf
                   @method("DELETE")
                   <div class="row">
                   <div class="col-6 mt-4">
                       <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
                   </div>
                   <div class="col-6 mt-4">
                       <button type="submit" class="btn btn-primary btn-block">Hapus Auditor</button>
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

{{-- Modal hapus --}}
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
              <h5>Edit Data Auditor</h5>
              <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit natus eligendi deserunt placeat optio nesciunt.</p>
              <form action="/editAuditor/superadmin/{{$item->id}}" class="mb-4" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <input type="text" class="form-control w-100 mr-3" name="nama" placeholder="Fulan bin Fulan, S.T., M.Kom." required>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control w-100 mr-3" name="foto" accept="image/*" required>
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

@endforeach

@include('layouts.footer-admin')
@include('layouts.script-admin')
