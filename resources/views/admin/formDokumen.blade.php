@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    <div class="col-lg-12">
        <form class="card" action="/sendDokumen" method="post">
            @csrf
          <div class="card-header">
            <h5 class="card-title">Data Dokumen</h5>
          </div>
          <div class="card-body">
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Lembaga/Biro</label>
                <div class="col">
                  <select class="form-select" name="id_lembaga">
                      <option>Pilih Lembaga</option>
                      @foreach ($getData as $item)
                          <option value="{{$item->id}}">{{$item->nama_lembaga}}</option>
                      @endforeach
                  </select>
                  <small class="form-hint">
                      Pilih lembaga atau instansi yang sesuai dengan dokumen yang Anda tambahkan.
                  </small>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Dokumen</label>
                <div class="col">
                  <select class="form-select" name="id_lembaga">
                      <option>Pilih Dokumen</option>
                      @foreach ($getData as $item)
                          <option value="{{$item->id}}">{{$item->nama_lembaga}}</option>
                      @endforeach
                  </select>
                  <small class="form-hint">
                      Hanya Dokumen Berstatus "Minor" & "Major" yang dapat dipilih.
                  </small>
                </div>
            </div>
            <div class="mb-3 row">
              <label class="col-3 col-form-label required">Temuan & Saran</label>
              <div class="col">
                <input type="text" class="form-control" name="field_temuan" aria-describedby="emailHelp" placeholder="Sistem Informasi Akademik">
                <small class="form-hint">We'll never share your email with anyone else.</small>
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-3 col-form-label required">Tautan Temuan & Saran</label>
              <div class="col">
                <input name="tautan_temuan" type="text" class="form-control" placeholder="https://docs.google.com/spreadsheets/d/1cvO-luocDUgA9vBxjvKtd76ZSWY9WDeIvwAHj0CmQAA/edit?gid=0#gid=0">
                <small class="form-hint">
                  Masukkan Link Spredsheet Dokumen Anda. Pastikan Dokumen Dapat Diakses Oleh Orang Lain
                </small>
              </div>
            </div>
            <div class="mb-3 row">
                <label class="col-3 col-form-label required">RTK</label>
                <div class="col">
                  <input type="text" class="form-control" name="field_rtk" aria-describedby="emailHelp" placeholder="Sistem Informasi Akademik">
                  <small class="form-hint">We'll never share your email with anyone else.</small>
                </div>
              </div>
              <div class="mb-3 row">
                <label class="col-3 col-form-label required">Tautan RTK</label>
                <div class="col">
                  <input name="tautan_rtk" type="text" class="form-control" placeholder="https://docs.google.com/spreadsheets/d/1cvO-luocDUgA9vBxjvKtd76ZSWY9WDeIvwAHj0CmQAA/edit?gid=0#gid=0">
                  <small class="form-hint">
                    Masukkan Link Spredsheet Dokumen Anda. Pastikan Dokumen Dapat Diakses Oleh Orang Lain
                  </small>
                </div>
              </div>
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Durasi Pengerjaan</label>
                <div class="col">
                  <input class="form-control" type="date" name="field_durasi" placeholder="3 Hari">
                  <small class="form-hint">
                      Tentukan Durasi Pengerjaan Dokumen Lembaga.
                  </small>
                </div>
              </div>

          </div>
          <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
</div>



@include('layouts.footer-admin')
@include('layouts.script-admin')
