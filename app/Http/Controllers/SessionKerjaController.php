<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jongko; // Memanggil data Jongko dari database

class SessionKerjaController extends Controller
{
    // 1. Menampilkan halaman pilih jongko
    public function index()
    {
        // Ambil semua data jongko dari database
        $data_jongko = Jongko::all();
        
        return view('pilih-jongko', compact('data_jongko'));
    }

    // 2. Menyimpan jongko yang dipilih pegawai ke dalam Session
    public function simpanJongko(Request $request)
    {
        $request->validate([
            'jongko_id' => 'required|exists:jongkos,id'
        ]);

        // Simpan ID Jongko ke dalam session dengan kunci 'jongko_aktif_id'
        session(['jongko_aktif_id' => $request->jongko_id]);

        // Cari tahu nama jongko yang dipilih untuk keperluan display/notifikasi jika butuh
        $jongko = Jongko::find($request->jongko_id);
        session(['nama_jongko_aktif' => $jongko->nama_jongko]);

        // Alihkan pegawai ke halaman input penjualan (sementara kita arahkan ke dashboard/halaman transaksi)
        return redirect('/input-penjualan')->with('success', 'Selamat bekerja di ' . $jongko->nama_jongko);
    }
}
