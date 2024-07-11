<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\superAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Auth User
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Auth User
Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('/dashboardUser', [UserController::class, 'index']);
    Route::get('/dokumenUser', [UserController::class, 'dokumenUser']);
    Route::get('/temuan', [UserController::class, 'temuanAudit']);
    Route::get('/profile', [UserController::class, 'profileUser']);
    Route::put('/sendDocs/{id}', [UserController::class, 'sendDocs']);
    Route::put('/sendTemuan/{id}', [UserController::class, 'sendTemuan']);
    Route::post('/user/logout', [AuthenticatedSessionController::class, 'destroy'])->name('user.logout');
});


// Auth Admin
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::get('/manageUser', [AdminController::class, 'displayUser']);
    Route::put('/editUser/{id}', [AdminController::class, 'editUser']);
    Route::delete('/hapusUser/{id}', [AdminController::class, 'hapusUser']);

    Route::get('/dokumen', [AdminController::class, 'dokumen']);
    Route::get('/addDokumen', [AdminController::class, 'formDokumen']);
    Route::post('/sendDokumen', [AdminController::class, 'addDokumen']);
    Route::put('/editStatus/{id}', [AdminController::class, 'editStatusDocs']);
    Route::delete('/hapusDocs/{id}', [AdminController::class, 'hapusDokumen']);

    Route::get('/temuanAudit', [AdminController::class, 'temuanAudit']);
    Route::get('/addTemuan', [AdminController::class, 'formTemuan']);
    Route::post('/sendTemuan', [AdminController::class, 'addTemuan']);
    Route::delete('/hapusTemuan/{id}', [AdminController::class, 'hapusTemuan']);
    Route::put('/editTemuan/{id}', [AdminController::class, 'editTemuan']);

    Route::get('/RTM', [AdminController::class, 'displayRTM']);
    Route::get('/addRTM', [AdminController::class, 'addRTM']);
    Route::post('/postRTM', [AdminController::class, 'postRTM']);
    Route::DELETE('/hapusRTM/{id}', [AdminController::class, 'hapusRTM']);
    Route::put('/editRTM/{id}', [AdminController::class, 'editRTM']);

    Route::get('/laporan', [AdminController::class, 'laporanAudit']);
    Route::post('/addLaporan', [AdminController::class, 'addLaporan']);
    Route::DELETE('/hapusLaporan/{id}', [AdminController::class, 'hapusLaporan']);
    Route::put('/editLaporan/{id}', [AdminController::class, 'editLaporan']);

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});

// Auth SuperAdmin
Route::middleware(['auth:superadmin', 'verified'])->group(function () {
    Route::get('/dashboardSuperAdmin', [superAdminController::class, 'index']);
    Route::get('/lembaga', [superAdminController::class, 'lembaga']);
    Route::post('/addLembaga', [superAdminController::class, 'addLembaga']);
    Route::DELETE('/hapusLembaga/{id}', [superAdminController::class, 'hapusLembaga']);
    Route::put('/editLembaga/{id}', [superAdminController::class, 'editLembaga']);
    Route::get('/user', [superAdminController::class, 'displayUser']);
    Route::put('/editUser/superadmin/{id}', [superAdminController::class, 'editUser']);
    Route::post('/superadmin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('superadmin.logout');
    Route::get('/dokumen/superadmin', [superAdminController::class, 'dokumen']);
    Route::get('/temuan/superadmin', [superAdminController::class, 'temuanAudit']);
    Route::get('/laporanAudit/superadmin', [superAdminController::class, 'laporanAudit']);
    Route::DELETE('/hapususer/superadmin/{id}', [superAdminController::class, 'deleteUser']);
    Route::DELETE('/hapususer/dokumen/superadmin/{id}', [superAdminController::class, 'deleteUserAndDocuments']);
    Route::get('/manageAdmin/superadmin', [superAdminController::class, 'displayAdmin']);
    Route::post('/regisAdmin', [superAdminController::class, 'registrasiAdmin']);
    Route::put('/editAdmin/{id}', [superAdminController::class, 'editAdmin']);
    Route::DELETE('/hapusAdmin/superadmin/{id}', [superAdminController::class, 'hapusAdmin']);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
