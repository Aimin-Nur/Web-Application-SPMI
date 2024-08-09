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
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        $riwayat = Evaluasi::where('id_lembaga', $idLembaga)
                    ->where(function($query) use ($idLembaga) {
                        $query->where('status_pengisian', 1)
                            ->orWhere('status_pengisian', 2)
                            // ->whereNotNull('score')
                            ->where('id_lembaga', $idLembaga);
                    })
                    ->where(function($query) {
                        $query->where('temuan', 'like', '%' . $this->search . '%');
                    })
                    ->paginate(10);

        return view('livewire.user.riwayat-temuan-table', [
            'riwayat' => $riwayat
        ]);
    }
}

