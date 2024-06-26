<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Lembaga;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class superAdminController extends Controller
{
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


}
