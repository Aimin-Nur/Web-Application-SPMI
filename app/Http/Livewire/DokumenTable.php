<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dokumen;
use App\Models\Evaluasi;
use App\Models\Lembaga;
use App\Models\User;
use App\Models\Admin;
use App\Models\Superadmin;
use Illuminate\Pagination\Paginator;


class DokumenTable extends Component
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
        $dokumens = Dokumen::with(['lembaga.user'])
            ->where(function($query) {
                $query->where('status_pengisian', 2)
                    ->orWhere('status_pengisian', 0);
            })
            ->where('score', NULL)
            ->where(function($query) {
                $query->where('judul', 'like', '%' . $this->search . '%')
                      ->orWhereHas('lembaga', function($query) {
                          $query->where('nama_lembaga', 'like', '%' . $this->search . '%');
                      });
            })
            ->paginate(5);

        return view('livewire.dokumen-table', [
            'dokumens' => $dokumens
        ]);
    }
}

