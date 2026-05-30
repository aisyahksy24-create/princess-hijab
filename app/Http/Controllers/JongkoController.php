<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jongko; // Memanggil Model Jongko

class JongkoController extends Controller
{
    // Fungsi untuk memproses dan menyimpan data jongko baru
    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'nama_jongko' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // 2. Simpan data ke tabel jongkos di database
        Jongko::create([
            'nama_jongko' => $request->nama_jongko,
            'alamat' => $request->alamat,
        ]);

        // 3. Kembalikan ke halaman sebelumnya dengan sinyal sukses
        return redirect()->back()->with('success', 'Jongko baru berhasil didaftarkan!');
    }
}
