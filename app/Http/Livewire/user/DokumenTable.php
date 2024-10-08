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

        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        $dokumens = Dokumen::where('id_lembaga', $idLembaga)
                    ->where(function($query) {
                        $query->where('status_pengisian', 0)
                            ->orWhere('status_pengisian', 3);
                    })
                    ->where(function($query) {
                        $query->where('judul', 'like', '%' . $this->search . '%');
                    })
                    ->paginate(10);

        return view('livewire.user.dokumen-table', [
            'dokumens' => $dokumens
        ]);
    }
}

