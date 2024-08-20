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
use App\Models\Evaluasi;
use App\Models\RTM;
use App\Models\Auditor;
use App\Models\LaporanAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendDokumenEmail;
use App\Jobs\SendTemuanEmail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Mail\SendDocument;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use App\Services\Document;
use App\Services\HistoryDocument;
use App\Services\Temuan;
use App\Services\HistoryTemuan;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $dokumenService;
    protected $historyDocument;
    protected $temuanService;
    protected $historyTemuan;

    public function __construct(Document $dokumenService, HistoryDocument $historyDocument, Temuan $temuanService, HistoryTemuan $historyTemuan)
    {
        $this->dokumenService = $dokumenService;
        $this->historyDocument = $historyDocument;
        $this->temuanService = $temuanService;
        $this->historyTemuan = $historyTemuan;
    }

    public function index()
    {
        $pageTitle = "Dashboard";
        $today = Carbon::today();
        $admin = Auth::guard('admin')->user();
        $lembagaScores = Lembaga::with('evaluasi')->get()->map(function ($lembaga) {
            return [
                'nama_lembaga' => $lembaga->nama_lembaga,
                'total_score' => $lembaga->evaluasi->sum('score')
            ];
        })->sortByDesc('total_score')->values();
        $maxScore = $lembagaScores->max('total_score');

        // Radar Dashboard
        $radar = Lembaga::with('evaluasi')->get()->map(function ($lembaga) {
            return [
                'nama_lembaga' => $lembaga->nama_lembaga,
                'average' => $lembaga->evaluasi->where('status_docs', 2)->count(),
                'poor' => $lembaga->evaluasi->where('status_docs', 1)->count(),
                'good' => $lembaga->evaluasi->where('status_docs', 3)->count(),
                'excellent' => $lembaga->evaluasi->where('status_docs', 4)->count()
            ];
        })->values();

        $countUser = User::count();
        $countLembaga = Lembaga::count();
        $countDocs = Dokumen::count();
        $countTemuan = Evaluasi::count();
        $countLaporan = LaporanAudit::count();
        $countAuditor = Auditor::count();

        return view('admin.index', compact('pageTitle','admin', 'lembagaScores','maxScore','radar','countUser','countLembaga','countDocs','countTemuan','countLaporan','countAuditor'));
    }

    public function dokumenTest(Request $request)
    {
        $dokumensQuery = $this->dokumenService->getDokumens();

        if ($request->ajax()) {
            return$this->dokumenService->generateDataTable($dokumensQuery);
        }

        return view('admin.test');
    }

    public function dokumen(Request $request)
    {
        $pageTitle = "Dokumen Audit";
        $terlambat = Dokumen::where('status_pengisian', 1)->count();
        $ontime = Dokumen::where('status_pengisian', 2)->count();

        if ($request->ajax() && $request->has('history')) {
            return $this->historyDocument->getHistoryDocument();
        }

        if ($request->ajax()) {
            $dokumensQuery = $this->dokumenService->getDokumens();
            return $this->dokumenService->generateDataTable($dokumensQuery);
        }

        $riwayatDocs = Dokumen::where('score', '!=', NULL)->get();
        $dokumens = Dokumen::where('score', NULL)->get();

        return view('admin.dokumen', compact('pageTitle', 'terlambat', 'ontime', 'riwayatDocs', 'dokumens'));
    }


    public function editStatusDocs(Request $request, $id){
        try {
            $request->validate([
                'status' => 'required|in:1,2,3',
            ]);

            $dokumen = Dokumen::findOrFail($id);
            $dokumen->status_docs = $request->input('status');
            $dokumen->status_pengisian = $request->input('status_pengisian');

            $score = $request->input('score', 4);
            $dokumen->score = $score;

            $dokumen->save();

            return redirect('/dokumen')->with('status', 'success')->with('message', 'Status Dokumen Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/dokumen')->with('status', 'error')->with('message', 'Gagal Mengubah Status Dokumen: ' . $e->getMessage());
        }
    }

    public function displayUser() {
        $pageTitle = "Manage User";
        $getData = User::with('lembaga')->get();
        return view('admin.displayUser', compact('pageTitle','getData'));
    }

    public function editUser(Request $request, $id){
        try {
            $request->validate([
                'name' => 'required|unique:users,name',
                'email' => 'required|unique:users,email,' . time(),
            ], [
                'name.unique' => 'Nama Users Sudah Terdaftar',
                'email.unique' => 'Email Users Sudah Terdaftar',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            $user->save();

            return redirect('/manageUser')->with('status', 'success')->with('message', 'Data Akun User Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/manageUser')->with('status', 'error')->with('message', 'Gagal Mengubah Data Akun User: ' . $e->getMessage());
        }
    }


    public function hapusUser($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect('/manageUser')->with('status', 'success')->with('message', 'Akun User Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/manageUser')->with('status', 'error')->with('message', 'Gagal Menghapus Akun User: ' . $e->getMessage());
        }
    }

    public function formDokumen() {
        $pageTitle = "Form Dokumen";
        $getData = Lembaga::has('user')->with('user')->get();
        return view('admin.formDokumen', compact('pageTitle','getData'));
    }

    public function addDokumen(Request $request)
    {
        try {
            $request->validate([
                'field_judul' => 'required|string|max:255',
                'field_tautan' => 'required|string|max:255|url',
                'id_lembaga' => 'required|string|exists:lembaga,id',
                'field_durasi' => 'required|date',
            ]);

            $existingDokumen = Dokumen::where('tautan', $request->input('field_tautan'))->first();
            if ($existingDokumen) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Link Spredsheet yang Anda Masukkan Sudah Tersimpan di dalam Databases.',
                ]);
            }

            $send = new Dokumen;
            $send->judul = $request->input('field_judul');
            $send->tautan = $request->input('field_tautan');
            $send->id_lembaga = $request->input('id_lembaga');
            $send->status_pengisian = 0;
            $send->status_docs = 0;
            $send->deadline = $request->input('field_durasi');
            $send->save();

            $users = User::where('id_lembaga', $request->input('id_lembaga'))->get();
            foreach ($users as $user) {
                Mail::to($user->email)->send(new SendDocument($user->email, $send->judul, $send->deadline));
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Dokumen berhasil ditambahkan dan email notifikasi sudah dikirim.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan dokumen: ' . $e->getMessage(),
            ]);
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

    public function temuanAudit(Request $request)
    {
        $pageTitle = "Temuan Audit";

        if ($request->ajax()) {
            if ($request->has('history') && $request->get('history')) {
                $riwayat = $this->historyTemuan->getRiwayat();
                return $this->historyTemuan->generateDataTable($riwayat);
            } else {
                $evaluasi = $this->temuanService->getTemuans();
                return $this->temuanService->generateDataTable($evaluasi);
            }
        }

        $evaluasi = $this->temuanService->getTemuans();
        $riwayat = $this->historyTemuan->getRiwayat();
        $score = $this->temuanService->getScores();
        $skorPerLembaga = $this->temuanService->getScoresPerLembaga();

        $totalSkor = $score->sum('score');
        $totalTemuan = Evaluasi::count();

        return view('admin.evaluasi', compact('pageTitle', 'evaluasi', 'riwayat', 'skorPerLembaga', 'totalSkor', 'totalTemuan'));
    }



    public function formTemuan() {
        $pageTitle = "Form Temuan Audit";
        $evaluatedDokumenIds = Evaluasi::pluck('id_docs')->toArray();

        $getData = Lembaga::whereHas('dokumen', function ($query) use ($evaluatedDokumenIds) {
                    $query->whereIn('status_pengisian', [1, 2])
                          ->whereNotIn('id', $evaluatedDokumenIds);
                })->with(['dokumen' => function ($query) use ($evaluatedDokumenIds) {
                    $query->whereIn('status_pengisian', [1, 2])
                          ->whereNotIn('id', $evaluatedDokumenIds);
                }])
                ->get();

            return view('admin.formTemuan', compact('pageTitle','getData'));
    }

    public function addTemuan(Request $request)
    {
        try {
            $request->validate([
                'temuan' => 'required|string|max:255',
                'tautan_temuan' => 'required|string|max:255|url',
                'rtk' => 'required|string|max:255',
                'tautan_rtk' => 'required|string|max:255|url',
                'id_lembaga' => 'required|string|exists:lembaga,id',
                'id_docs' => 'required|string|exists:dokumen,id',
                'deadline' => 'required|date',
            ]);

            $existingTautanRTK = Evaluasi::where('tautan_rtk', $request->input('tautan_rtk'))->first();
            $existingTautanTemuan = Evaluasi::where('tautan_temuan', $request->input('tautan_temuan'))->first();

            if ($existingTautanRTK) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tautan dokumen PTK sudah ada.',
                ]);
            } elseif ($existingTautanTemuan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tautan dokumen Temuan & Saran sudah ada.',
                ]);
            }

            $send = new Evaluasi;
            $send->temuan = $request->input('temuan');
            $send->rtk = $request->input('rtk');
            $send->id_lembaga = $request->input('id_lembaga');
            $send->id_docs = $request->input('id_docs');
            $send->status_pengisian = 0;
            $send->status_docs = 0;
            $send->tautan_rtk = $request->input('tautan_rtk');
            $send->tautan_temuan = $request->input('tautan_temuan');
            $send->deadline = $request->input('deadline');
            $send->save();

            $users = User::where('id_lembaga', $request->input('id_lembaga'))->get();
            foreach ($users as $user) {
                Mail::to($user->email)->send(new SendDocument($user->email, $send->temuan, $send->deadline));
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Temuan Audit Berhasil Ditambahkan dan email notifikasi sudah dikirim.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal Menambahkan Temuan Audit : ' . $e->getMessage(),
            ]);
        }
    }



    public function editTemuan(Request $request, $id){
        try {
            $request->validate([
                'score' => 'required|integer|min:0',
            ], [
                'score.required' => 'Angka harus diisi.',
                'score.integer' => 'Score anda tidak valid.',
                'score.min' => 'Score Melebihi Angka Minimum.',
            ]);

            $temuan = Evaluasi::findOrFail($id);
            $temuan->status_docs = $request->input('status');

            $score = $request->input('score', 4);
            $temuan->score = $score;

            $temuan->save();

            return redirect('/temuanAudit')->with('status', 'success')->with('message', 'Status Temuan Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/temuanAudit')->with('status', 'error')->with('message', 'Gagal Mengubah Status Tautan: ' . $e->getMessage());
        }
    }

    public function hapusTemuan($id){
        try {
            $temuan = Evaluasi::findOrFail($id);
            $temuan->delete();

            return redirect('/temuanAudit')->with('status', 'success')->with('message', 'Temuan Audit Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/temuanAudit')->with('status', 'error')->with('message', 'Gagal Menghapus Temuan Audit: ' . $e->getMessage());
        }
    }

    public function displayRTM(){
        $getData = RTM::with(['lembaga.user'])->get();

        $count = RTM::count();
        $getLembaga = Lembaga::whereHas('dokumen', function ($query) {
            $query->where('status_docs', 2);
        })->with('dokumen')->get();

        return view('admin.rtm', compact('getData','count', 'getLembaga'));
    }

    public function addRTM(){
        $getLembaga = Lembaga::whereHas('dokumen', function ($query) {
            $query->where('status_docs', 2);
        })->with('dokumen')->get();
        return view('admin.addRTM', compact('getLembaga'));
    }

    public function postRTM(Request $request){
        try {
            $send = new RTM;
            $send->tgl_rapat = $request->input('selectedDate');
            $send->tempat = $request->input('tempatRapat');
            $send->id_lembaga = $request->input('id_lembaga');
            $send->status = 0;
            $send->save();

            return redirect('/addRTM')->with('status', 'success')->with('message', 'Jadwal RTM Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/addRTM')->with('status', 'error')->with('message', 'Gagal Menambahkan Jadwal RTM: ' . $e->getMessage());
        }
    }

    public function hapusRTM($id){
        try {
            $rtm = RTM::findOrFail($id);
            $rtm->delete();
            return redirect('/RTM')->with('status', 'success')->with('message', 'Jadwal RTM Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/RTM')->with('status', 'error')->with('message', 'Gagal Menghapus Jadwal RTM: ' . $e->getMessage());
        }
    }

    public function editRTM(Request $request, $id) {
        try {
            $rtm = RTM::findOrFail($id);

            $rtm->id_lembaga = $request->input('lembaga');
            $rtm->tgl_rapat = $request->input('tglRapat');
            $rtm->tempat = $request->input('lokasiRapat');
            $rtm->save();

            return redirect('/RTM')->with('status', 'success')->with('message', 'Jadwal RTM Berhasil Diedit.');
        } catch (\Exception $e) {
            return redirect('/RTM')->with('status', 'error')->with('message', 'Gagal Mengedit Jadwal RTM: ' . $e->getMessage());
        }
    }


    public function laporanAudit(){
        $pageTitle = "Laporan";
        $getData = LaporanAudit::get();
        return view('admin.laporanAudit', compact('pageTitle','getData'));
    }

    public function addLaporan(Request $request){
        try {

            $existingLaporan = laporanAudit::where('tautan', $request->input('tautan'))->first();
            if ($existingLaporan) {
                return redirect('/laporan')->with('status', 'error')->with('message', 'Tautan Laporan Audit Sudah Terdaftar.');
            }

            $send = new LaporanAudit;
            $send->judul = $request->input('judul');
            $send->tautan = $request->input('tautan');
            $send->save();

            return redirect('/laporan')->with('status', 'success')->with('message', 'Laporan Audit Berhasil Ditambakan.');
        } catch (\Exception $e) {
            return redirect('/laporan')->with('status', 'error')->with('message', 'Gagal Menambahkan Jadwal Laporan Audit: ' . $e->getMessage());
        }
    }

    public function hapusLaporan($id) {
        try {
            $laporan = laporanAudit::findOrFail($id);
            $laporan->delete();
            return redirect('/laporan')->with('status', 'success')->with('message', 'Laporan Audit Berhasil Dihapus.');
        } catch (\Exception $e) {
            return redirect('/laporan')->with('status', 'error')->with('message', 'Gagal Menghapus Laporan Audit: ' . $e->getMessage());
        }
    }

    public function editLaporan(Request $request, $id){
        try {
            $request->validate([
                'laporan' => 'required|',
                'tautan' => 'required|unique:laporan_audit,tautan',
            ], [
                'tautan.unique' => 'Link Tautan Sudah Terdaftar',
            ]);

            $laporan = laporanAudit::findOrFail($id);
            $laporan->judul = $request->input('laporan');
            $laporan->tautan = $request->input('tautan');

            $laporan->save();

            return redirect('/laporan')->with('status', 'success')->with('message', 'Laporan Audit Berhasil Diubah.');
        } catch (\Exception $e) {
            return redirect('/laporan')->with('status', 'error')->with('message', 'Gagal Mengubah Laporan Audit: ' . $e->getMessage());
        }
    }

    public function auditor(){
        $pageTitle = "Auditor";
        $getData = Auditor::get();
        return view('admin.auditor', compact('pageTitle','getData'));
    }

    public function addAuditor(Request $request){
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'foto' => 'required|image|mimes:jpeg,png,PNG,jpg|max:8096',
            ]);

            $auditor = new Auditor;
            $auditor->nama = $request->input('nama');

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('auditors'), $filename);
                $auditor->foto = $filename;
            }

            $auditor->save();

            return redirect('/auditor')->with('status', 'success')->with('message', 'Berhasil Menambahkan Data Auditor.');
        } catch (\Exception $e) {
            return redirect('/auditor')->with('status', 'error')->with('message', 'Gagal Menambahkan Data Auditor: ' . 'Ukuran File Melebihi 2 MB');
        }
    }

    public function hapusAuditor($id){
        try {
            $auditor = Auditor::findOrFail($id);
            $auditor->delete();

            return redirect('/auditor')->with('status', 'success')->with('message', 'Auditor Berhasil Dihapus.');

        } catch (\Exception $e) {
            return redirect('/auditor')->with('status', 'error')->with('message', 'Gagal Menghapus Auditor: ' . $e->getMessage());
        }
    }

    public function editAuditor(Request $request, $id){
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,PNG,jpg|max:2096',
            ], [
                'nama.required' => 'Nama harus diisi.',
                'nama.string' => 'Nama harus berupa teks.',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
                'foto.image' => 'Foto harus berupa gambar.',
                'foto.mimes' => 'Format foto yang diperbolehkan adalah JPEG, PNG, atau JPG.',
                'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB.',
            ]);

            $auditor = Auditor::findOrFail($id);
            $auditor->nama = $request->input('nama');

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('auditors'), $filename);
                $auditor->foto = $filename;
            }

            $auditor->save();

            return redirect('/auditor')->with('status', 'success')->with('message', 'Auditor Berhasil Diedit.');
        } catch (\Exception $e) {
            return redirect('/auditor')->with('status', 'error')->with('message', 'Auditor Gagal Diedit.' . $e->getMessage());
        }
    }

    public function profile(Request $request, $tab = null){
        $admin = Auth::guard('admin')->user();
        $name = $admin->name;
        $email = $admin->email;
        $id = $admin->id;
        $pageTitle = "Profile";
        $tab = $request->input('tab');

        return view('admin.profile', [
            'name' => $name,
            'email' => $email,
            'pageTitle' => $pageTitle,
            'id' => $id,
            'tab' => $tab,
        ]);
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        try{
            $request->validate([
                'current_password' => ['required', 'string'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $admin = auth()->guard('admin')->user();

            if (!Hash::check($request->current_password, $admin->password)) {
                throw ValidationException::withMessages([
                    'current_password' => __('Password Anda Tidak Sesuai dengan Password Anda Saat ini.'),
                ]);
            }

            $admin->forceFill([
                'password' => Hash::make($request->password),
            ])->save();

                return redirect('/profile/admin')->with('status', 'success')->with('message', 'Password Berhasil Diubah.');
            } catch (\Exception $e) {
                return redirect('/profile/admin')->with('status', 'error')->with('message', 'Gagal Mengubah Password: ' . $e->getMessage());
        }
    }





}
