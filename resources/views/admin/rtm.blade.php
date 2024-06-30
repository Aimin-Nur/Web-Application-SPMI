@include('layouts.header-admin')
@include('layouts.navbar-admin')

@if ($count > 0 )
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Penjawal Rapat Tinjaun Manajemen</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lembaga</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Rapat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lokasi Rapat</th>
                                {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Rapat</th> --}}
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getData as $item)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$item->lembaga->nama_lembaga}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$item->lembaga->user->name}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-sm mb-0">{{$item->tgl_rapat}}</span>

                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{$item->tempat}}
                                </td>
                                {{-- <td class="align-middle text-center text-sm">

                                </td> --}}
                                <td class="align-middle">
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
</div>
@else
<div class="container-fluid py-4">
    <div class="page-body">
        <div class="row">
            <div class="col-lg-12 d-flex flex-column justify-content-center text-center">
                <div class="empty">
                  <div class="img-fluid"><img src="{{asset('creative')}}/assets/img/empty.png" alt="RTM Kosong" width="400px">
                  </div>
                  <p class="empty-title text-bold">Tidak Ada Jadwal Rapat Tinjauan Manajemen</p>
                  <p class="empty-subtitle text-secondary">
                    Try adjusting your search or filter to find what you're looking for.
                  </p>
                  <div class="empty-action">
                    <a href="/addRTM" class="btn btn-primary">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;
                      Tambahkan Jadwal RTM
                    </a>
                  </div>
                </div>
              </div>
        </div>
    </div>

</div>
@endif



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
           <h4>Hapus Dokumen</h4>
           <p class="mb-3 text-sm">Tindakan ini akan menghapus penjadwalan RTM lembaga <b> "{{$item->lembaga->nama_lembaga}}"</b> secara permanen.</p>
           <form action="/hapusRTM/{{$item->id}}" class="mb-4" method="post">
               @csrf
               @method('DELETE')
               <div class="row">
               <div class="col-6 mt-4">
                   <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
               </div>
               <div class="col-6 mt-4">
                   <button type="submit" class="btn btn-primary btn-block">Hapus</button>
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

 {{-- Modal Edit --}}
 @foreach ($getData as $item)
 <div class="modal fade" id="exampleModalCenter{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"   aria-hidden="true">
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
           <h4>Edit Jadwal RTM</h4>
           <p class="mb-3 text-sm">Lembaga telah melakukan pengisian kelngkapan dokumen yang telah Anda berikan pada tanggal : {{$item->updated_at}}</p>
           <form action="/editRTM/{{$item->id}}" class="mb-4" method="post">
               @csrf
               @method('PUT')
               <div class="form-group">
                   <select class="form-select" name="lembaga">
                        @foreach ($getLembaga as $item)
                        <option value="{{ $item->id }}" {{ $item->id_lembaga == $item->id ? 'selected' : '' }}>{{ $item->nama_lembaga }}</option>
                        @endforeach
                   </select>
                    <div class="col">
                        <input type="date" value="{{$item->tgl_rapat}}" class="form-control" name="tglRapat">
                    </div>
                    <div class="col">
                      <input type="text" value="{{$item->tempat}}" class="form-control" name="lokasiRapat">
                    </div>
               </div>
               <div class="row">
               <div class="col-6 mt-4">
                   <button class="btn btn-secondary btn-block" data-dismiss="modal">Batalkan</button>
               </div>
               <div class="col-6 mt-4">
                   <button type="submit" class="btn btn-primary btn-block">Edit Jadwal</button>
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
