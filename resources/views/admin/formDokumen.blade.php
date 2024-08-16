@include('layouts.header-admin')
@include('layouts.navbar-admin')


<div class="container-fluid py-4">
    <div class="col-lg-12">
        <form class="card" action="/sendDokumen" method="post" id="form">
            @csrf
            <div class="card-header">
                <h5 class="card-title">Data Dokumen</h5>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Nama Dokumen</label>
                    <div class="col">
                        <input type="text" class="form-control" name="field_judul" placeholder="Sistem Informasi Akademik" required>
                        <small class="form-hint">Masukkan Dokumen Audit</small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-3 col-form-label required">Tautan Dokumen</label>
                    <div class="col">
                        <input name="field_tautan" type="text" class="form-control" placeholder="https://docs.google.com/spreadsheets/d/..." required>
                        <small class="form-hint">Masukkan Link Spredsheet Dokumen Anda. Pastikan Dokumen Dapat Diakses Oleh Orang Lain</small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-3 col-form-label">Lembaga/Biro</label>
                    <div class="col">
                        <select class="form-select" name="id_lembaga" required>
                            <option value="">Pilih Lembaga</option>
                            @foreach ($getData as $item)
                                <option value="{{$item->id}}">{{$item->nama_lembaga}} - {{$item->user->name}}</option>
                            @endforeach
                        </select>
                        <small class="form-hint">Pilih lembaga atau instansi yang sesuai dengan dokumen yang Anda tambahkan.</small>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-3 col-form-label">Durasi Pengerjaan</label>
                    <div class="col">
                        <input class="form-control" type="date" name="field_durasi" required>
                        <small class="form-hint">Tentukan Durasi Pengerjaan Dokumen Lembaga.</small>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" id="submitTemuan" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>


<!-- Progress Modal -->
<div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="progressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Info</h5>
            </div>
            <div class="modal-body text-center">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-primary " role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <p class="mt-3">Sedang memproses, harap tunggu...</p>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
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
                            <img src="{{asset('creative')}}/assets/img/send.png" alt="img-fluid" class="img-fluid mb-4 w-60">
                        </div>
                        <h5 class="modal-title" id="resultModalLabel">Dokumen Berhasil Disimpan</h5>
                        <p id="resultMessageSuccess" class="mt-3 text-sm fw-bold text-dark"><b></b></p>
                        <div class="col-12 mt-4">
                            <button type="button" aria-label="Close" class="btn btn-primary btn-block"><a href="/dokumen" class="text-white">Close</a></button>
                        </div>
                        <small class="mb-0 cancel text-center"><small><i>Sistem Penjaminan Mutu Internal Kalla Institute</i></small></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Fail Modal -->
<div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
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
                            <img src="{{asset('creative')}}/assets/img/unsend.png" alt="img-fluid" class="img-fluid mb-4 w-60">
                        </div>
                        <h5 class="modal-title" id="resultModalLabel">Gagal Menyimpan Dokumen Audit</h5>
                        <p id="resultMessageFail" class="mt-3 text-sm fw-bold text-dark"><b></b></p>
                        <div class="col-12 mt-4">
                            <button type="button" aria-label="Close" class="btn btn-primary btn-block"><a href="/dokumen" class="text-white">Oke, Saya Mengerti</a></button>
                        </div>
                        <small class="mb-0 cancel text-center"><small><i>Sistem Penjaminan Mutu Internal Kalla Institute</i></small></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const progressModal = new bootstrap.Modal(document.getElementById('progressModal'), {
            backdrop: 'static',
            keyboard: false
        });

        const formData = new FormData(form);

        progressModal.show();
        const $progressBar = document.querySelector('.progress-bar');
        $progressBar.classList.add('progress-bar-striped', 'progress-bar-animated');

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Koneksi Internet Lemah, Silahkan Coba Lagi beberapa saat kemudian.');
            }
            return response.json();
        })
        .then(data => {
            $progressBar.classList.remove('progress-bar-striped', 'progress-bar-animated');

            if (data.status === 'success') {
                let currentWidth = 0;
                const progressInterval = setInterval(function() {
                    if (currentWidth >= 100) {
                        clearInterval(progressInterval);
                        progressModal.hide();

                        const successModal = new bootstrap.Modal(document.getElementById('successModal'), {
                            backdrop: 'static',
                            keyboard: false
                        });

                        document.getElementById('resultMessageSuccess').textContent = data.message;
                        successModal.show();
                    } else {
                        currentWidth += 20;
                        $progressBar.style.width = currentWidth + '%';
                        $progressBar.textContent = currentWidth + '%';
                    }
                }, 500);
            } else {
                const failModal = new bootstrap.Modal(document.getElementById('failModal'), {
                    backdrop: 'static',
                    keyboard: false
                });

                document.getElementById('resultMessageFail').textContent = data.message || 'An error occurred';
                failModal.show();
            }
        })
        .catch(error => {
            const failModal = new bootstrap.Modal(document.getElementById('failModal'), {
                backdrop: 'static',
                keyboard: false
            });

            document.getElementById('resultMessageFail').textContent = 'An error occurred: ' + error.message;
            failModal.show();
        });
    });
});
</script>

@include('layouts.footer-admin')
@include('layouts.script-admin')
