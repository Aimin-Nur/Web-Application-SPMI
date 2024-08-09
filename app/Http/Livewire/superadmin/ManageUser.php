<?php

namespace App\Http\Livewire\superadmin;

use Livewire\Component;
use App\Models\User;

class ManageUser extends Component
{
    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        // Tidak perlu resetPage karena tidak menggunakan paginasi
    }

    public function render()
    {
        $getData = User::with('lembaga')
                ->where(function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhereHas('lembaga', function($query) {
                            $query->where('nama_lembaga', 'like', '%' . $this->search . '%');
                        });
                })
                ->get(); // Menggunakan get() untuk mengambil semua data tanpa paginasi

        return view('livewire.superadmin.manage-user', [
            'getData' => $getData
        ]);
    }
}
