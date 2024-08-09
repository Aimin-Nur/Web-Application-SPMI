<?php

namespace App\Http\Livewire\admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dokumen;
use App\Models\Evaluasi;
use App\Models\Lembaga;
use App\Models\User;
use App\Models\Admin;
use App\Models\Superadmin;
use Illuminate\Pagination\Paginator;


class RiwayatTemuan extends Component
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
        $riwayat = Evaluasi::with(['lembaga.user'])
            ->where(function($query) {
                $query->where('status_pengisian', 2)
                ->orwhere('status_pengisian', 1)
                    ->where('score', '!=', NULL)
                    ->where('tgl_pengumpulan', '!=', NULL)
                      ->where(function($query) {
                          $query->where('temuan', 'like', '%' . $this->search . '%')
                                ->orWhereHas('lembaga', function($query) {
                                    $query->where('nama_lembaga', 'like', '%' . $this->search . '%');
                                });
                      });
            })
            ->paginate(10);

        return view('livewire.admin.riwayat-temuan', [
            'riwayat' => $riwayat
        ]);
    }
}

