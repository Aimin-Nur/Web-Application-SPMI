<!DOCTYPE html><html lang="en"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><link rel="apple-touch-icon" sizes="76x76" href="{{asset('creative')}}/assets/img/apple-icon.png"><link rel="icon" type="image/png" href="{{asset('creative')}}/assets/img/favicon.png"><title>SPMI - Kalla Institute</title><!-- Load CSS Soft UI Dashboard --><link id="pagestyle" href="{{asset('creative')}}/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" /><!-- DataTables CSS --><link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" /></head><body><div class="container"><div class="card"><div class="card-body px-0 pt-0 pb-2"><div class="table-responsive p-0"><table id="dokumenTable" class="table align-items-center mb-0"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lembaga</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokumen</th><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pengisian</th><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tenggat Pengerjaan</th><th class="text-secondary opacity-7"></th></tr></thead></table></div></div></div></div><!-- Load jQuery and DataTables JS --><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script><script>
    $(document).ready(function() {
        $('#dokumenTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('dokumenTest') }}',
            columns: [
                { data: 'lembaga', name: 'lembaga' },
                { data: 'dokumen', name: 'dokumen' },
                { data: 'status', name: 'status' },
                { data: 'created', name: 'created' },
                { data: 'deadline', name: 'deadline' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
            ]
        });
    });
</script></body></html>

<!DOCTYPE html><html lang="en"><head><meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><link rel="apple-touch-icon" sizes="76x76" href="{{asset('creative')}}/assets/img/apple-icon.png"><link rel="icon" type="image/png" href="{{asset('creative')}}/assets/img/favicon.png"><title>SPMI - Kalla Institute</title><!-- Load CSS Soft UI Dashboard --><link id="pagestyle" href="{{asset('creative')}}/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" /><!-- DataTables CSS --><link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" /></head><body><div class="container"><div class="card"><div class="card-body px-0 pt-0 pb-2"><div class="table-responsive p-0"><table id="dokumenTable" class="table align-items-center mb-0"><thead><tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lembaga</th><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dokumen</th><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Pengisian</th><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created</th><th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tenggat Pengerjaan</th><th class="text-secondary opacity-7"></th></tr></thead></table></div></div></div></div><!-- Load jQuery and DataTables JS --><script src="https://code.jquery.com/jquery-3.6.0.min.js"></script><script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script><script>
        $(document).ready(function() {
            $('#dokumenTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dokumen') }}',
                columns: [
                    { data: 'lembaga', name: 'lembaga' },
                    { data: 'dokumen', name: 'dokumen' },
                    { data: 'status', name: 'status' },
                    { data: 'created', name: 'created' },
                    { data: 'deadline', name: 'deadline' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ],
                // Apply custom class to the table for styling"createdRow": function(row, data, dataIndex, cellIndex, rowIndex) {
                    $(row).addClass('text-sm');
                }
            });
        });
    </script></body></html>
