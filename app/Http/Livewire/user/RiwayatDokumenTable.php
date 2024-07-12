<?php

namespace App\Http\Livewire\user;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Dokumen;
use App\Models\Evaluasi;
use App\Models\Lembaga;
use App\Models\User;
use App\Models\Admin;
use App\Models\Superadmin;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class RiwayatDokumenTable extends Component
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
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        $finishDocs = Dokumen::where('id_lembaga', $idLembaga)
                    ->where(function($query) {
                        $query->where('status_pengisian', 2)
                            ->orWhere('status_pengisian', 1);
                    })
                    ->where(function($query) {
                        $query->where('judul', 'like', '%' . $this->search . '%');
                    })
                    ->paginate(10);

        return view('livewire.user.riwayat-dokumen-table', [
            'finishDocs' => $finishDocs
        ]);
    }
    }

