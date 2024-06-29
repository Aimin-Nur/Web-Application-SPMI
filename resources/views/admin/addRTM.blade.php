@include('layouts.header-admin')
@include('layouts.navbar-admin')

<div class="container-fluid py-4">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3 d-none d-md-block">
                        <div class="card">
                            <div class="card-body text-center">
                                <h6 class="card-title mb-4">Jadwal Rapat</h6>
                                <img src="{{asset('creative')}}/assets/img/kosong-jadwal.png" class="img-fluid navbar-brand">
                                <small class="">Belum Ada Jadwal</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div id='calendar'></div>
                            </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal Tambah Jadwal -->
 <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal RTM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="eventForm" method="post" action="/addRTM">
                    <input type="hidden" id="selectedDate" name="selectedDate">
                    <div class="mb-3">
                        <label for="jenisLembaga" class="form-label">Jenis Lembaga</label>
                        <select class="form-select" name="id_lembaga">
                            <option>Pilih Lembaga</option>
                            @foreach ($getLembaga as $item)
                                <option value="{{$item->id}}">{{$item->nama_lembaga}}</option>
                            @endforeach
                        </select>
                        <small style="font-size: 12px">
                            Hanya lembaga yang memiliki dokumen Major yang dapat melakukan Rapat Tinjauan Manajemen (RTM).
                        </small>
                    </div>
                    <div class="mb-3">
                        <label for="jamRapat" class="form-label">Jam Rapat</label>
                        <input type="time" class="form-control" id="jamRapat" /required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasiRapat" class="form-label" >Lokasi Rapat</label>
                        <input type="text" class="form-control" id="lokasiRapat" placeholder="Ruang Rapat Lt.6" /required>
                    </div>
                    <small class="align-items-center">
                        <i>Notifikasi Email secara otomatis terkirim kepada Lembaga yang terkait.</i>
                    </small>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEvent">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gagal Tambah Jadwal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Peringatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
               <b>Tidak dapat menambahkan jadwal karena tanggal ini sudah lewat.</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            dateClick: function(info) {
                var today = new Date();
                today.setHours(0, 0, 0, 0);

                var selectedDate = new Date(info.dateStr);

                if (selectedDate < today) {
                    $('#alertModal').modal('show');
                } else {
                    document.getElementById('selectedDate').value = info.dateStr;

                    $('#eventModal').modal('show');
                    document.getElementById('saveEvent').onclick = function() {
                        var jenisLembaga = document.querySelector('select[name="id_lembaga"]').value;
                        var jamRapat = document.getElementById('jamRapat').value;
                        var lokasiRapat = document.getElementById('lokasiRapat').value;

                        if (jenisLembaga && jamRapat && lokasiRapat) {
                            var event = {
                                title: jenisLembaga,
                                start: info.dateStr + 'T' + jamRapat,
                                description: lokasiRapat
                            };
                            calendar.addEvent(event);
                            $('#eventModal').modal('hide');
                        } else {
                            alert('Please fill all the fields');
                        }
                    };
                }
            }
        });
        calendar.render();
    });
</script>






@include('layouts.footer-admin')
@include('layouts.script-admin')
