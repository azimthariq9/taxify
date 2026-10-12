<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BillingController;
use App\Http\Controllers\Api\BillingMandiriController;
use App\Http\Controllers\Api\EfakturController;
use App\Http\Controllers\Api\EfakturDokumenController;
use App\Http\Controllers\Api\EfakturReturController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\KelasPraktikumController;
use App\Http\Controllers\Api\KelasPraktikumFileController;
use App\Http\Controllers\Api\KelasUserController;
use App\Http\Controllers\Api\KodeBillingController;
use App\Http\Controllers\Api\MasterAkunController;
use App\Http\Controllers\Api\MasterPemotongController;
use App\Http\Controllers\Api\MasterSoalController;
use App\Http\Controllers\Api\PembayaranController;
use App\Http\Controllers\Api\PengumpulanController;
use App\Http\Controllers\Api\PraktikumController;
use App\Http\Controllers\Api\PraktikumMandiriController;
use App\Http\Controllers\Api\SptA1Controller;
use App\Http\Controllers\Api\SptBpbptController;
use App\Http\Controllers\Api\SptBpsptController;
use App\Http\Controllers\Api\SptDilaporkanController;
use App\Http\Controllers\Api\SptEditController;
use App\Http\Controllers\Api\SptKonsepController;
use App\Http\Controllers\Api\SptMenungguController;
use App\Http\Controllers\Api\SptWplnController;
use App\Http\Controllers\Api\SoalPraktikumController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Taxify V2 REST API
|--------------------------------------------------------------------------
| Prefix otomatis: /api
| Autentikasi: Bearer token (Laravel Sanctum)
|--------------------------------------------------------------------------
*/

// Health check API dan koneksi database
Route::get('/health', function () {
    try {
        $connection = config('database.default');
        $databaseName = config("database.connections.{$connection}.database");

        // Nama database aktif, disesuaikan dengan driver yang dipakai
        if (DB::getDriverName() === 'pgsql') {
            $databaseName = DB::selectOne('SELECT current_database() AS name')->name;
        } elseif (DB::getDriverName() === 'mysql') {
            $databaseName = DB::selectOne('SELECT DATABASE() AS name')->name ?? $databaseName;
        }

        DB::select('SELECT 1');

        return response()->json([
            'status' => 'success',
            'application' => 'Taxify V2',
            'driver' => DB::getDriverName(),
            'database' => $databaseName,
            'message' => 'API dan database terhubung',
        ]);
    } catch (\Throwable $e) {
        report($e);

        return response()->json([
            'status' => 'error',
            'message' => 'Koneksi database gagal',
        ], 503);
    }
});

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Resource (memerlukan token)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Pengguna & master
    Route::apiResource('users', UserController::class);
    Route::apiResource('master-akun', MasterAkunController::class);
    Route::apiResource('master-pemotong', MasterPemotongController::class);
    Route::apiResource('master-soal', MasterSoalController::class);
    Route::apiResource('praktikum-mandiri', PraktikumMandiriController::class);

    // Kelas & praktikum
    Route::apiResource('kelas', KelasController::class);
    Route::apiResource('kelas-user', KelasUserController::class);
    Route::apiResource('kelas-praktikum', KelasPraktikumController::class);
    Route::apiResource('kelas-praktikum-files', KelasPraktikumFileController::class);
    Route::apiResource('praktikum', PraktikumController::class);
    Route::apiResource('soal-praktikum', SoalPraktikumController::class);
    Route::apiResource('pengumpulan', PengumpulanController::class);

    // SPT
    Route::apiResource('spt-konsep', SptKonsepController::class);
    Route::apiResource('spt-menunggu', SptMenungguController::class);
    Route::apiResource('spt-edit', SptEditController::class);
    Route::apiResource('spt-dilaporkan', SptDilaporkanController::class);
    Route::apiResource('spt-a1', SptA1Controller::class);
    Route::apiResource('spt-bpbpt', SptBpbptController::class);
    Route::apiResource('spt-bpspt', SptBpsptController::class);
    Route::apiResource('spt-wpln', SptWplnController::class);

    // Billing & pembayaran
    Route::apiResource('billing', BillingController::class);
    Route::apiResource('billing-mandiri', BillingMandiriController::class);
    Route::apiResource('pembayaran', PembayaranController::class);
    Route::apiResource('kode-billing', KodeBillingController::class);

    // E-Faktur
    Route::apiResource('efaktur', EfakturController::class);
    Route::apiResource('efaktur-dokumen', EfakturDokumenController::class);
    Route::apiResource('efaktur-retur', EfakturReturController::class);
});

// Contoh endpoint terproteksi (tetap dipertahankan)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
