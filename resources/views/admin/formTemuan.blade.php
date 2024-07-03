@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    <div class="col-lg-12">
        <form class="card" action="/sendTemuan" method="post">
            @csrf
          <div class="card-header">
            <h5 class="card-title">Data Dokumen</h5>
          </div>
          <div class="card-body">
            <div class="mb-3 row">
                <label class="col-3 col-form-label">Lembaga/Biro</label>
                <div class="col">
                    <select class="form-select" name="id_lembaga" id="lembagaSelect">
                        <option value="">Pilih Lembaga</option>
                        @foreach ($getData as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_lembaga }}</option>
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
                    <select class="form-select" name="id_docs" id="dokumenSelect">
                        <option value="">Pilih Dokumen</option>
                    </select>
                    <small class="form-hint">
                        Hanya Dokumen Berstatus "Minor" & "Mayor" yang dapat dipilih.
                    </small>
                </div>
            </div>
            <div class="mb-3 row">
              <label class="col-3 col-form-label required">Temuan & Saran</label>
              <div class="col">
                <input type="text" class="form-control" name="temuan" aria-describedby="emailHelp" placeholder="Sistem Informasi Akademik">
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
                  <input type="text" class="form-control" name="rtk" placeholder="Sistem Informasi Akademik">
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
                <label class="col-3 col-form-label">Deadline Pengerjaan</label>
                <div class="col">
                  <input class="form-control" type="date" name="deadline" placeholder="3 Hari">
                  <small class="form-hint">
                      Tentukan Tanggal Deadline Pengerjaan Dokumen Lembaga.
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lembagaSelect = document.getElementById('lembagaSelect');
        const dokumenSelect = document.getElementById('dokumenSelect');
        const lembagaData = JSON.parse('{!! $getData !!}'); // Parse JSON data

        lembagaSelect.addEventListener('change', function() {
            const selectedLembagaId = this.value;
            dokumenSelect.innerHTML = '<option value="">Pilih Dokumen</option>'; // Clear dokumen options

            if (selectedLembagaId) {
                const selectedLembaga = lembagaData.find(lembaga => lembaga.id == selectedLembagaId);

                if (selectedLembaga && selectedLembaga.dokumen.length > 0) {
                    selectedLembaga.dokumen.forEach(dokumen => {
                        const option = document.createElement('option');
                        option.value = dokumen.id;
                        option.textContent = dokumen.judul; // Assuming the dokumen model has a 'judul' attribute
                        dokumenSelect.appendChild(option);
                    });
                }
            }
        });
    });
</script>


@include('layouts.footer-admin')
@include('layouts.script-admin')
