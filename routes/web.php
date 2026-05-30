<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

// Import Controller
use App\Http\Controllers\SessionKerjaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\JongkoController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TransaksiController;

// Import Model yang digunakan
use App\Models\Jongko;
use App\Models\Pegawai;

// ==========================================
// 1. HALAMAN UTAMA & AUTENTIKASI
// ==========================================
Route::get('/', function () {
    return view('welcome');
});
Route::get('/daftar', function () {
    return view('daftar');
});
Route::get('/login', function () {
    return view('login');
});

Route::post('/store-pegawai', [PegawaiController::class, 'store']); 
Route::post('/login-proses', [PegawaiController::class, 'loginProses']);
Route::get('/logout', [PegawaiController::class, 'logout']);


// ==========================================
// 2. DASHBOARD & HALAMAN UTAMA ADMIN (PEMILIK)
// ==========================================
Route::get('/dashboard-admin', [TransaksiController::class, 'dashboardAdmin']);

Route::get('/rekap-omset', function () {
    return view('rekap-omset');
});

// Route Cetak PDF Rekap Omset
Route::get('/cetak-rekap-omset', [TransaksiController::class, 'cetakPdfOmset']);

// Route Halaman Upah Pegawai (Sudah diperbaiki penutupnya)
Route::get('/upah-pegawai', function () {
    return view('upah-pegawai');
});

// Route Cetak PDF Penggajian Pegawai (Sudah berdiri sendiri di luar)
Route::get('/cetak-upah-pegawai', [TransaksiController::class, 'cetakPdfUpah']);


// ==========================================
// 3. ROUTE FITUR PENDATAAN ADMIN
// ==========================================
Route::get('/pendataan', [PegawaiController::class, 'index'])->name('pendataan'); 

Route::post('/store-produk', [ProdukController::class, 'store']);
Route::post('/store-pemasok', [PemasokController::class, 'store']);
Route::post('/store-jongko', [JongkoController::class, 'store']);

// Route Hapus Data
Route::get('/hapus-pegawai/{id}', [PegawaiController::class, 'hapusPegawai']);
Route::get('/hapus-produk/{id}', [PegawaiController::class, 'hapusProduk']);
Route::get('/hapus-pemasok/{id}', [PegawaiController::class, 'hapusPemasok']);
Route::get('/hapus-jongko/{id}', [PegawaiController::class, 'hapusJongko']);

// ==========================================
// 4. ROUTE SESI KERJA PEGAWAI (PILIH JONGKO)
// ==========================================
Route::get('/pilih-jongko', [SessionKerjaController::class, 'index']);
Route::post('/set-jongko-kerja', [SessionKerjaController::class, 'simpanJongko']);


// ==========================================
// 5. ROUTE INPUT PENJUALAN & TRANSAKSI PEGAWAI
// ==========================================
Route::get('/dashboard-pegawai', function () {
    return view('dashboard-pegawai');
});
Route::get('/catat-transaksi', function () {
    return view('catat-transaksi');
});

// Halaman input dan simpan data transaksi
Route::get('/input-penjualan', [TransaksiController::class, 'create']);
Route::post('/store-transaksi', [TransaksiController::class, 'store']);


// ==========================================
// 6. API UNTUK AMBIL REKAP OMSET (SINKRON PAKAI JONGKO_ID)
// ==========================================
Route::get('/api/ambil-rekap', function (Request $request) {
    $mode = $request->query('mode'); 
    $waktu = $request->query('waktu'); 

    $all_jongko = Jongko::orderBy('id', 'asc')->get();
    $jongko_data = [];
    $total_keseluruhan = 0;

    foreach ($all_jongko as $jongko) {
        $query = DB::table('transaksis')->where('jongko_id', $jongko->id);

        if ($mode === 'hari') {
            $query->whereRaw('DATE(created_at) = ?', [$waktu]);
        } else {
            $query->whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$waktu]);
        }

        $total_omset = $query->sum('total_harga') ?? 0;

        $jongko_data[] = [
            'nama_jongko' => $jongko->nama_jongko,
            'total_omset' => $total_omset
        ];

        $total_keseluruhan += $total_omset;
    }

    return response()->json([
        'jongko_data' => $jongko_data,
        'total_keseluruhan' => $total_keseluruhan
    ]);
});


// ==========================================
// 7. API UNTUK AMBIL UPAH PEGAWAI (SUDAH OTOMATIS HITUNG 10%)
// ==========================================
Route::get('/api/ambil-upah', [TransaksiController::class, 'apiAmbilUpah']);