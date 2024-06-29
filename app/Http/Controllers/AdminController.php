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
        $dokumens = Dokumen::with(['lembaga.user'])->get();
        $validDocs = Dokumen::with(['lembaga.user'])->where('status_docs', 1)->orWhere('status_docs', 2)->get();
        
        return view('admin.dokumen', compact('dokumens', 'validDocs'));
    }

    public function editStatusDocs(Request $request, $id){
        try {
            $request->validate([
                'status' => 'required|string',
            ]);

            $dokumen = Dokumen::findOrFail($id);

            $dokumen->status_docs = $request->input('status');
            $dokumen->save();

            return redirect('/dokumen')->with('status', 'success')->with('message', 'Status Dokumen Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/dokumen')->with('status', 'error')->with('message', 'Gagal Mengubah Status Dokumen: ' . $e->getMessage());
        }
    }

    public function displayUser() {
        $getData = User::get();
        $cekData = User::count();
        return view('admin.displayUser', compact('getData','cekData'));
    }

    public function formDokumen() {
        $getData = Lembaga::get();
        return view('admin.formDokumen', compact('getData'));
    }

    public function addDokumen(Request $request){
        try {
            $request->validate([
                'field_judul' => 'required|string|max:255',
                'field_tautan' => 'required|string|max:255|url',
                'id_lembaga' => 'required|string|exists:lembaga,id',
            ]);
            $existingDokumen = Dokumen::where('tautan', $request->input('field_tautan'))->first();
            if ($existingDokumen) {
                return redirect('/dokumen')->with('status', 'error')->with('message', 'Tautan dokumen sudah ada.');
            }

            $send = new Dokumen;
            $send->judul = $request->input('field_judul');
            $send->tautan = $request->input('field_tautan');
            $send->id_lembaga = $request->input('id_lembaga');
            $send->status_pengisian = 0;
            $send->status_docs = 0;
            $send->deadline = $request->input('field_durasi');
            $send->save();

            return redirect('/dokumen')->with('status', 'success')->with('message', 'Dokumen Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/dokumen')->with('status', 'error')->with('message', 'Gagal Menambahkan Dokumen: ' . $e->getMessage());
        }
    }

    public function hapusDokumen($id){
            try {
                $dokumen = Dokumen::findOrFail($id);
                $dokumen->delete();
                return redirect('/dokumen')->with('status', 'success')->with('message', 'Dokumen Berhasil Dihapus.');
            } catch (\Exception $e) {
                return redirect('/dokumen')->with('status', 'error')->with('message', 'Gagal Menghapus Dokumen: ' . $e->getMessage());
            }
        }


    public function displayRTM(){
        return view('admin.rtm');
    }

    public function addRTM(){
        $getLembaga = Lembaga::whereHas('dokumen', function ($query) {
            $query->where('status_docs', 1);
        })->with('dokumen')->get();
        return view('admin.addRTM', compact('getLembaga'));
    }



}
