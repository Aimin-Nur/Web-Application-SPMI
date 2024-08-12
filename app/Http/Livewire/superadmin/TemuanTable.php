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
use Illuminate\Pagination\Paginator;


class TemuanTable extends Component
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
        $evaluasi = Evaluasi::with(['lembaga.user'])
            ->where(function($query) {
                $query->where('score', NULL);
            })
            ->where(function($query) {
                $query->where('temuan', 'like', '%' . $this->search . '%')
                      ->orWhereHas('lembaga', function($query) {
                          $query->where('nama_lembaga', 'like', '%' . $this->search . '%');
                      });
            })
            ->paginate(10);

        return view('livewire.superadmin.temuan-table', [
            'evaluasi' => $evaluasi
        ]);
    }
}

