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

        $dokumens = Dokumen::where('id_lembaga', $idLembaga)->get();
        $finishDocs = Dokumen::where('id_lembaga', $idLembaga)->where('status_pengisian', 1)->get();

        return view('user.dokumen', compact('dokumens', 'finishDocs'));
    }

    public function jadwalRTM() {
        return view('user.userRTM');
    }

    public function profileUser() {
        return view('user.profileUser');
    }


}
