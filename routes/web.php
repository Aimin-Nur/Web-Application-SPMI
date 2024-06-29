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
    Route::get('/dashboard', [UserController::class, 'index']);
    Route::post('/user/logout', [AuthenticatedSessionController::class, 'destroy'])->name('user.logout');
});


// Auth Admin
Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/dokumen', [AdminController::class, 'dokumen']);
    Route::get('/manageUser', [AdminController::class, 'displayUser']);
    Route::get('/addDokumen', [AdminController::class, 'formDokumen']);
    Route::post('/sendDokumen', [AdminController::class, 'addDokumen']);
    Route::post('/editStatus/{id}', [AdminController::class, 'editStatusDocs']);
    Route::post('/hapusDocs/{id}', [AdminController::class, 'hapusDokumen']);
    Route::get('/RTM', [AdminController::class, 'displayRTM']);
    Route::get('/addRTM', [AdminController::class, 'addRTM']);
    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});

// Auth SuperAdmin
Route::middleware(['auth:superadmin', 'verified'])->group(function () {
    Route::get('/superAdmin', [superAdminController::class, 'index']);
    Route::get('/superAdmin', [superAdminController::class, 'index']);
    Route::get('/lembaga', [superAdminController::class, 'lembaga']);
    Route::post('/addLembaga', [superAdminController::class, 'addLembaga']);
    Route::post('/superadmin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('superadmin.logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
