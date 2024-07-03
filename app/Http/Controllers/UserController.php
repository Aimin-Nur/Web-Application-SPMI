<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Lembaga;
use App\Models\User;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index (){
        $user = Auth::user();
        if (!$user) {
            return redirect('/login')->withErrors(['message' => 'User not authenticated']);
        }

        logger()->info('User data on dashboard:', ['user' => $user]);

        $nama = $user->name;
        return view('user.index', compact('nama'));
    }

    public function dokumenUser() {
        $user = Auth::user();
        $idLembaga = $user->id_lembaga;

        $dokumens = Dokumen::where('id_lembaga', $idLembaga)
                    ->where(function($query) {
                        $query->where('status_pengisian', 0)
                            ->orWhere('status_pengisian', 3);
                    })
                    ->where('deadline', '!=',0)
                    ->get();


        $finishDocs = Dokumen::where('id_lembaga', $idLembaga)->where('status_pengisian', 2)->get();

        $cekDokumens = Dokumen::where('id_lembaga', $idLembaga)->where(function($query) {
            $query->where('status_pengisian', 0)
                ->orWhere('status_pengisian', 3);
        })
        ->count();

        return view('user.dokumen', compact('dokumens', 'finishDocs', 'cekDokumens'));
    }

    public function sendDocs($id){
        try {
            $docs = Dokumen::findOrFail($id);

            $docs->status_pengisian = 2;
            $docs->save();

            return redirect('/dokumenUser')->with('status', 'success')->with('message', 'Dokumen Berhasil Dikirim.');
        } catch (\Exception $e) {
            return redirect('/dokumenUser')->with('status', 'error')->with('message', 'Gagal Mengedit Jadwal RTM: ' . $e->getMessage());
        }
    }

    public function jadwalRTM() {
        return view('user.userRTM');
    }

    public function profileUser() {
        return view('user.profileUser');
    }


}
