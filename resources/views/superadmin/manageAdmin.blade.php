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
                  <div class="col-6 text-end">
                    <button type="button" class="btn bg-gradient-dark mb-0" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Admin</button>
                  </div>
                </div>
              </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Admin</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat Emal</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                    <th class="text-center opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($getData as $item)
                    <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">{{$item->email}}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-primary">{{$item->created_at}}</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer" data-toggle="modal" data-target="#editModalCenter{{$item->id}}"  title="Edit Data"></i>
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



<!-- Modal Tambah Admin -->
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
              <h4>Tambah Admin</h4>
              <p class="mb-4">Kata sandi Admin pada saat pendaftaran akun sesuai dengan alamat email yang Anda daftarkan.</p>
              <form action="/regisAdmin" class="mb-4" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Nama Admin</label>
                  <input type="text" class="form-control w-100 mr-3" name="name" placeholder="Fulan Bin Fulan, S.Kom., M.Kom." /required>
                </div>
                <div class="form-group">
                    <label for="">Email Admin</label>
                  <input type="text" class="form-control w-100 mr-3" name="email" placeholder="fulan@kallainstitute.ac.id" /required>
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



{{-- Modal Edit Admin --}}
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
            <h4>Edit Data Admin</h4>
            <p class="mb-3 text-sm">Sesuaikan Data Admin yang ingin Anda Edit.</p>
            <form action="/editAdmin/{{$item->id}}" class="mb-4" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama Admin</label>
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

{{-- Modal Hapus Admin --}}
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
               <h4>Hapus Admin</h4>
               <p class="mb-3 text-sm">Tindakan ini akan menghapus Admin <b> "{{$item->name}}"</b> secara permanen.</p>
               <form action="/hapusAdmin/superadmin/{{$item->id}}" class="mb-4" method="POST">
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



@include('layouts.footer-admin')
@include('layouts.script-admin')
