<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Auditor;
use App\Models\LaporanAudit;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auditor/spmi', function (Request $request) {
    $auditors = Auditor::all();

    return response()->json([
        'message' => 'Data auditor berhasil diambil.',
        'data' => $auditors,
    ]);
});

Route::get('/laporan/spmi', function (Request $request) {
    $laporan = LaporanAudit::all();

    return response()->json([
        'message' => 'Laporan Audit berhasil diambil.',
        'data' => $laporan,
    ]);
});
