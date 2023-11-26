<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ValuePenelitianController;
use App\Http\Controllers\Api\ValuePengabdianController;
use App\Http\Controllers\Api\BentukDanaController;
use App\Http\Controllers\Api\LaporanKemajuanController;
use App\Http\Controllers\Api\LaporanAkhirController;
use App\Http\Controllers\Api\BidangFokusController;
use App\Http\Controllers\Api\DanaController;
use App\Http\Controllers\Api\PublishcationController;
use App\Http\Controllers\Api\DataPenilaianController;
use App\Http\Controllers\Api\DataPenjadwalanController;
use App\Http\Controllers\Api\DiagramPenelitianController;
use App\Http\Controllers\Api\DiagramPengabdianController;
use App\Http\Controllers\Api\DosenController;
use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\JenisPublikasiController;
use App\Http\Controllers\Api\KriteriaPenilaianController;
use App\Http\Controllers\Api\KriteriaPenunjangController;
use App\Http\Controllers\Api\PenelitianController;
use App\Http\Controllers\Api\PengabdianController;
use App\Http\Controllers\Api\PenunjangController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SumberDanaController;
use App\Models\DataPenilaian;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user-role', function (Request $request) {
    return $request->user()->role;
});

Route::prefix('role')->group(function () {
    Route::post('create', [RoleController::class, 'addRole']);
});

Route::prefix('user')->group(function () {
    Route::post('create', [AuthController::class, 'addUser']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::put('update/{id}', [AuthController::class, 'updateUser']);
    Route::delete('delete/{id}', [AuthController::class, 'deleteUser']);

});
Route::get('/verify', [AuthController::class, 'verify']);


Route::apiResource('/users', App\Http\Controllers\Api\DosenController::class);
//Dosen

Route::get('/anggotadosen/{id}', [DosenController::class, 'show']);
Route::apiResource('/reviewer', App\Http\Controllers\Api\ReviewerController::class);
Route::apiResource('/user', App\Http\Controllers\Api\AuthController::class);
Route::apiResource('/userprofile', App\Http\Controllers\Api\ProfileController::class);

//Mahasiswa
Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);


// LPPM
//Master Data bidangfokus
Route::apiResource('/bidangfokus', App\Http\Controllers\Api\BidangFokusController::class);
Route::get('/bidangfokus', [BidangFokusController::class, 'index']);
Route::post('/bidangfokus', [BidangFokusController::class, 'store']);
Route::put('/bidangfokus/{id}', [BidangFokusController::class, 'update']);
Route::delete('bidangfokus/{id}', [BidangFokusController::class, 'destroy']);

//Master Data dana
Route::apiResource('/bentukdana', App\Http\Controllers\Api\BentukDanaController::class);
Route::get('/bentukdana', [BentukDanaController::class, 'index']);
Route::post('/bentukdana', [BentukDanaController::class, 'store']);
Route::put('/bentukdana/{id}', [BentukDanaController::class, 'update']);
Route::delete('/bentukdana/{id}', [BentukDanaController::class, 'destroy']);
Route::apiResource('/sumberdana', App\Http\Controllers\Api\SumberDanaController::class);
Route::get('/sumberdana', [SumberDanaController::class, 'index']);
Route::post('/sumberdana', [SumberDanaController::class, 'store']);
Route::put('/sumberdana/{id}', [SumberDanaController::class, 'update']);
Route::delete('/sumberdana/{id}', [SumberDanaController::class, 'destroy']);

//Master Data publikasi
Route::apiResource('/jenispublikasi', App\Http\Controllers\Api\JenisPublikasiController::class);
Route::get('/jenispublikasi', [JenisPublikasiController::class, 'index']);
Route::post('/jenispublikasi', [JenisPublikasiController::class, 'store']);
Route::put('/jenispublikasi', [JenisPublikasiController::class, 'update']);
Route::delete('/jenispublikasi', [JenisPublikasiController::class, 'destroy']);

//Master Data penilaian
Route::apiResource('/indikatorpenilaian', App\Http\Controllers\Api\IndikatorPenilaianController::class);
Route::apiResource('/rubrikpenilaian', App\Http\Controllers\Api\RubrikPenilaianController::class);

//Penjadwalan
Route::apiResource('/penjadwalan', App\Http\Controllers\Api\DataPenjadwalanController::class);
Route::get('/penjadwalan', [DataPenjadwalanController::class, 'index']);
Route::post('/penjadwalan', [DataPenjadwalanController::class, 'store']);
Route::put('/penjadwalan/{id}', [DataPenjadwalanController::class, 'update']);
Route::delete('/penjadwalan/{id}', [DataPenjadwalanController::class, 'destroy']);

//kriteria penilaian
Route::get('/kriteria-penilaian', [KriteriaPenilaianController::class, 'index']);
Route::post('/kriteria-penilaian', [KriteriaPenilaianController::class, 'store']);
Route::get('/kriteria-penilaian/{id}', [KriteriaPenilaianController::class, 'show']);
Route::put('/kriteria-penilaian/{id}', [KriteriaPenilaianController::class, 'update']);
Route::delete('/kriteria-penilaian/{id}', [KriteriaPenilaianController::class, 'destroy']);
Route::get('/nilai-pengabdian', [KriteriaPenilaianController::class, 'getValuePengabdian']);


//Validasi
Route::apiResource('/validasipenilaian', App\Http\Controllers\Api\ValidasiPenilaianController::class);

//HRD
//kriteria penunjang
Route::apiResource('/kriteriapenunjang', App\Http\Controllers\Api\KriteriaPenunjangController::class);
Route::get('/kriteriapenunjang', [KriteriaPenunjangController::class, 'index']);
Route::post('/kriteriapenunjang', [KriteriaPenunjangController::class, 'store']);
Route::put('/kriteriapenunjang', [KriteriaPenunjangController::class, 'update']);
Route::delete('/kriteriapenunjang', [KriteriaPenunjangController::class, 'destroy']);




//Dosen
//penelitian
Route::apiResource('/penelitian', App\Http\Controllers\Api\PenelitianController::class);
Route::post('/penelitian', [PenelitianController::class, 'store']);
Route::post('/dana', [PenelitianController::class, 'storeDana']);
Route::get('/penelitian/{id}', [PenelitianController::class, 'show']);
Route::get('/penelitian', [PenelitianController::class, 'index']);
Route::post('/penelitian/{id}', [PenelitianController::class, 'update']);
Route::delete('/penelitian', [PenelitianController::class, 'destroy']);
Route::post('penelitian/{id}/kemajuan', [PenelitianController::class, 'storeLaporanKemajuan']);
Route::put('penelitian/{id}/kemajuan', [PenelitianController::class, 'updateLaporanKemajuan']);
Route::post('penelitian/{id}/akhir', [PenelitianController::class, 'storeLaporanAkhir']);
Route::put('penelitian/{id}/akhir', [PenelitianController::class, 'updateLaporanAkhir']);
Route::post('kontrak-penelitian/{id}', [PenelitianController::class, 'storeKontrak']);
Route::put('penelitian/{id}/kontrak', [PenelitianController::class, 'updateKontrak']);
Route::put('/addreviewer-penelitian/{id}', [PenelitianController::class, 'updateReviewer']);
Route::get('/showpenilaian-penelitian/{id}', [PenelitianController::class, 'showPenilaianProposal']);
Route::get('/showpenilaian-penelitian-kemajuan/{id}', [PenelitianController::class, 'showPenilaianKemajuan']);
Route::get('/showpenilaian-penelitian-akhir/{id}', [PenelitianController::class, 'showPenilaianAkhir']);
Route::get('/get-nilai-penelitian', [PenelitianController::class, 'getValueProposal']);
Route::get('/get-nilai-kemajuan', [PenelitianController::class, 'getValueKemajuan']);
Route::get('/get-nilai-publikasi', [PenelitianController::class, 'getValuePublikasi']);
Route::get('/get-kemajuan-akhir', [PenelitianController::class, 'getValueKemajuanAkhir']);
Route::get('/get-kemajuan-akhir/{id}', [PenelitianController::class, 'showValueKemajuanAkhir']);
Route::get('/get-nilai-kemajuan/{id}', [PenelitianController::class, 'showValueKemajuan']);
Route::get('/get-nilai-akhir', [PenelitianController::class, 'getValueAkhir']);
Route::get('/get-nilai-akhir/{id}', [PenelitianController::class, 'showValueAkhir']);
Route::get('/show-nilai-penelitian/{id}', [PenelitianController::class, 'showValue']);
Route::post('/update-status-penelitian/{id}', [PenelitianController::class, 'updateStatus']);


//pengabdian
Route::apiResource('/pengabdian', App\Http\Controllers\Api\PengabdianController::class);
Route::post('/pengabdian', [PengabdianController::class, 'store']);
Route::get('/pengabdian', [PengabdianController::class, 'index']);
Route::get('/pengabdian/{id}', [PengabdianController::class, 'show']);
Route::post('/pengabdian/{id}', [PengabdianController::class, 'update']);
Route::delete('/pengabdian', [PengabdianController::class, 'destroy']);
Route::post('pengabdian/{id}/kemajuan', [PengabdianController::class, 'storeLaporanKemajuan']);
Route::put('pengabdian/{id}/kemajuan', [PengabdianController::class, 'updateLaporanKemajuan']);
Route::post('pengabdian/{id}/akhir', [PengabdianController::class, 'storeLaporanAkhir']);
Route::put('pengabdian/{id}/akhir', [PengabdianController::class, 'updateLaporanAkhir']);
Route::post('/kontrak-pengabdian/{id}', [PengabdianController::class, 'storeKontrak']);
Route::put('pengabdian/{id}/kontrak', [PengabdianController::class, 'updateKontrak']);
Route::put('/addreviewer/{id}', [PengabdianController::class, 'updateReviewer']);
Route::get('/showpenilaian-pengabdian/{id}', [PengabdianController::class, 'showPenilaian']);
Route::get('/get-value-pengabdian', [PengabdianController::class, 'getValueProposal']);
Route::get('/get-value-kemajuan', [PengabdianController::class, 'getValueKemajuan']);
Route::get('/get-value-akhir', [PengabdianController::class, 'getValueAkhir']);
Route::get('/get-value-publikasi', [PengabdianController::class, 'getValuePublikasi']);
Route::get('/get-akhir-kemajuan', [PengabdianController::class, 'getValueKemajuanAkhir']);
Route::get('/get-akhir-kemajuan/{id}', [PengabdianController::class, 'showValueKemajuanAkhir']);
Route::get('/show-nilai-pengabdian/{id}', [PengabdianController::class, 'showValue']);
Route::get('/show-value-proposal/{id}', [PengabdianController::class, 'showValueProposal']);
Route::get('/show-value-kemajuan/{id}', [PengabdianController::class, 'showValueKemajuan']);
Route::get('/show-value-akhir/{id}', [PengabdianController::class, 'showValueAkhir']);
Route::post('/update-status-pengabdian/{id}', [PengabdianController::class, 'updateStatus']);

//laporankemajuan
Route::post('/laporankemajuan', [LaporanKemajuanController::class, 'store']);
Route::get('/laporankemajuan/{penelitian_id}', [LaporanKemajuanController::class, 'showKemajuanPenelitian']);
Route::get('/laporankemajuanPengabdian/{pengabdian_id}', [LaporanKemajuanController::class, 'showKemajuanPengabdian']);
Route::post('/update-status-kemajuan/{id}', [LaporanKemajuanController::class, 'updateStatusKemajuan']);
Route::post('/laporankemajuan-pengabdian', [LaporanKemajuanController::class, 'storeKemajuanPengabdian']);

//laporanakhir
Route::post('/laporanakhir', [LaporanAkhirController::class, 'store']);
Route::get('/laporanakhir/{penelitian_id}', [LaporanAkhirController::class, 'showAkhirPenelitian']);
Route::get('/laporanakhirPengabdian/{pengabdian_id}', [LaporanAkhirController::class, 'showAkhirPengabdian']);
Route::post('/update-status-akhir/{id}', [LaporanAkhirController::class, 'updateStatusAkhir']);
Route::post('/laporanakhir-pengabdian', [LaporanAkhirController::class, 'storeAkhirPengabdian']);

//publikasi
Route::post('/publikasi', [PublishcationController::class, 'store']);

//penunjang
Route::apiResource('/penunjang', App\Http\Controllers\Api\PenunjangController::class);
Route::get('/penunjang', [PenunjangController::class, 'index']);
Route::post('/penunjang', [PenunjangController::class, 'store']);
Route::put('/penunjang', [PenunjangController::class, 'update']);
Route::delete('/penunjang', [PenunjangController::class, 'destroy']);

//Data Penilaian
Route::get('/data-penilaian', [DataPenilaianController::class, 'index']);
Route::get('/value-penelitian', [DataPenilaianController::class, 'getValuePenelitian']);
Route::get('/value-pengabdian', [DataPenilaianController::class, 'getValuePengabdian']);

Route::get('/value-penelitian/{penelitian_id}', [DataPenilaianController::class, 'showValuePenelitian']);
Route::get('/value-pengabdian/{pengabdian_id}', [DataPenilaianController::class, 'showValuePengabdian']);

Route::post('/add-data-penilaian', [DataPenilaianController::class, 'storePenilaianPenelitian']);
Route::post('/add-nilai-pengabdian', [DataPenilaianController::class, 'storePenilaianPengabdian']);
Route::post('/data-penilaian-penelitian', [DataPenilaianController::class, 'storePenelitian']);
Route::post('/data-penilaian-pengabdian', [DataPenilaianController::class, 'storePengabdian']);
Route::post('/data-penilaian-kemajuan-penelitian', [DataPenilaianController::class, 'storeKemajuanPenelitian']);
Route::post('/data-penilaian-kemajuan-pengabdian', [DataPenilaianController::class, 'storeKemajuanPengabdian']);
Route::post('/data-penilaian-akhir-penelitian', [DataPenilaianController::class, 'storeAkhirPenelitian']);
Route::post('/data-penilaian-akhir-pengabdian', [DataPenilaianController::class, 'storeAkhirPengabdian']);
Route::put('/data-penilaian/{id}', [DataPenilaianController::class, 'update']);
Route::delete('/data-penilaian/{id}', [DataPenilaianController::class, 'destroy']);

//Value
Route::post('/penelitian-value', [ValuePenelitianController::class, 'store']);
Route::post('/pengabdian-value', [ValuePengabdianController::class, 'store']);

//diagram
Route::post('/penelitian-diagram', [DiagramPenelitianController::class, 'countPenelitian']);
Route::get('/pengabdian-diagram', [DiagramPengabdianController::class, 'countPengabdian']);

