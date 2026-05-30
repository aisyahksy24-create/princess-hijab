<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Pemasok;
use App\Models\Jongko; 
use App\Models\Pegawai;

class ProdukController extends Controller
{
    // Fungsi utama untuk menampilkan semua data ke halaman pendataan
   public function index()
    {
        // Tarik semua data dari masing-masing tabel di database
        $data_produk = Produk::all();
        $data_pemasok = Pemasok::all();
        $data_jongko = Jongko::all();
        $data_pegawai = Pegawai::all(); // <-- TAMBAHKAN BARIS INI

        // Oper semua variabel data ke halaman pendataan.blade.php
        return view('pendataan', compact('data_produk', 'data_pemasok', 'data_jongko', 'data_pegawai')); // <-- TAMBAHKAN $data_pegawai DI SINI
    }

    // Fungsi simpan produk
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string',
            'jenis' => 'required|string',
            'ukuran' => 'required|string',
        ]);

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'jenis' => $request->jenis,
            'ukuran' => $request->ukuran,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }
}