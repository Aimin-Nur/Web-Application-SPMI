<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Lembaga;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.index', compact('admin'));
    }

    public function dokumen (){
        return view('admin.dokumen');
    }

    public function displayUser() {
        $getData = User::get();
        return view('admin.displayUser', compact('getData'));
    }

    public function formDokumen() {
        $getData = Lembaga::get();
        return view('admin.formDokumen', compact('getData'));
    }

    public function addDokumen(Request $request){
        try {
            $send = new Dokumen;
            $send->judul = $request->input('field_judul');
            $send->tautan = $request->input('field_tautan');
            $send->id_lembaga = $request->input('id_lembaga');
            $send->status_pengisian = 0;
            $send->status_docs = 0;
            $send->save();

            return redirect('/dokumen')->with('status', 'success')->with('message', 'Dokumen Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/dokumen')->with('status', 'error')->with('message', 'Gagal Menambahakan Dokumen' . $e->getMessage());
        }
    }

    public function displayRTM(){
        return view('admin.rtm');
    }

    public function addRTM(){
        $getData = Lembaga::get();
        return view('admin.addRTM', compact('getData'));
    }


}
