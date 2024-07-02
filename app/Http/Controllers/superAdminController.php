<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\Lembaga;
use App\Models\User;
use App\Models\Dokumen;
use App\Models\RTM;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class superAdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth:superadmin');
    }

    public function index (){
        return view('superadmin/index');
    }

    public function lembaga (){
        $getData = Lembaga::get();
        return view('superadmin.lembaga', compact('getData'));
    }

    public function addLembaga(Request $request){
        try {
            $send = new Lembaga;
            $send->nama_lembaga = $request->input('filed_lembaga');
            $send->save();

            return redirect('/lembaga')->with('status', 'success')->with('message', 'Data Lemabaga Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/lembaga')->with('status', 'error')->with('message', 'Gagal Menambahakan Data Lembaga' . $e->getMessage());
        }
    }

    public function hapusLembaga($id){
        try {
            $dokumen = Lembaga::findOrFail($id);
            $dokumen->delete();
            return redirect('/lembaga')->with('status', 'success')->with('message', 'Lembaga Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/lembaga')->with('status', 'error')->with('message', 'Gagal Menghapus Lembaga: ' . $e->getMessage());
        }
    }

    public function editLembaga(Request $request, $id){
        try {
            $request->validate([
                'nama_lembaga' => 'required',
            ]);

            $lembaga = Lembaga::findOrFail($id);

            $lembaga->nama_lembaga = $request->input('nama_lembaga');
            $lembaga->save();

            return redirect('/lembaga')->with('status', 'success')->with('message', 'Data Lembaga Berhasil Diedit.');
        } catch (\Exception $e) {
            return redirect('/lembaga')->with('status', 'error')->with('message', 'Gagal Mengubah Status Dokumen: ' . $e->getMessage());
        }
    }

    public function displayUser(){
        $getData = User::with('lembaga')->get();
        return view('superadmin.user', compact('getData'));
    }


}
