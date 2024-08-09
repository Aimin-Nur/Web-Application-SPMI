<div>
    <div class="card-header pb-0 px-3">
        <div class="row">
            <div class="col-8">
                <h5 class="mt-2 ms-2">Informasi Akun User</h5>
            </div>
            <div class="col-3">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here..." wire:model="search">
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
