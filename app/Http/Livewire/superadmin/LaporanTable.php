<?php

namespace App\Http\Livewire\superadmin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dokumen;
use App\Models\Evaluasi;
use App\Models\Lembaga;
use App\Models\User;
use App\Models\Admin;
use App\Models\Superadmin;
use App\Models\LaporanAudit;
use Illuminate\Pagination\Paginator;


class LaporanTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $getData = LaporanAudit::where(function($query) {
            $query->where('judul', 'like', '%' . $this->search . '%');
        })
        ->paginate(10);

        return view('livewire.superadmin.laporan-table', [
            'getData' => $getData
        ]);
    }
}

