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
@livewire('superadmin.laporan-table')
@endif









@include('layouts.footer-admin')
@include('layouts.script-admin')
