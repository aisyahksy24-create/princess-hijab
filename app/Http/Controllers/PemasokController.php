<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasok; // Memanggil Model Pemasok

class PemasokController extends Controller
{
    // Fungsi untuk memproses dan menyimpan data pemasok baru
    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'nama_pemasok' => 'required|string',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // 2. Simpan data ke tabel pemasoks di database
        Pemasok::create([
            'nama_pemasok' => $request->nama_pemasok,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        // 3. Kembalikan ke halaman sebelumnya dengan sinyal sukses
        return redirect()->back()->with('success', 'Pemasok baru berhasil didaftarkan!');
    }
}