<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Produk;
use App\Models\Pemasok;
use App\Models\Jongko;

class PegawaiController extends Controller
{
    // Method untuk menampilkan halaman pendataan (Admin)
    public function index()
    {
        $data_pegawai = Pegawai::all();
        $data_produk  = Produk::all();
        $data_pemasok = Pemasok::all();
        $data_jongko  = Jongko::all();

        return view('pendataan', compact('data_pegawai', 'data_produk', 'data_pemasok', 'data_jongko'));
    }

    // Method proses simpan pegawai baru (Daftar) - FIXED LENGTH & EXTRA FIELDS
    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'username'     => 'required|string|unique:pegawais,username',
            'password'     => 'required|string|min:4', // Disamakan menjadi minimal 4 karakter sesuai HTML
        ]);

        Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'alamat'       => $request->alamat, // Mengamankan data alamat
            'no_telp'      => $request->no_telp, // Mengamankan data nomor telepon
            'username'     => $request->username,
            'password'     => bcrypt($request->password), 
            'role'         => 'pegawai', 
        ]);

        return redirect('/login')->with('sukses', 'Pendaftaran berhasil! Silakan login.');
    }

    // Method proses login
    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $pegawai = Pegawai::where('username', $credentials['username'])->first();

        if ($pegawai && password_verify($credentials['password'], $pegawai->password)) {
            // Set session login
            session([
                'login'        => true,
                'id_pegawai'   => $pegawai->id,
                'nama_pegawai' => $pegawai->nama_pegawai,
                'role'         => $pegawai->role
            ]);

            if ($pegawai->role === 'admin') {
                return redirect('/dashboard-admin');
            }
            return redirect('/pilih-jongko');
        }

        return redirect('/login')->with('gagal', 'Username atau password salah!');
    }

    // Method proses logout
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }

    // ==========================================
    // FITUR FITUR PENGHAPUSAN DATA (CRUD DELETE)
    // ==========================================
    
    public function hapusPegawai($id)
    {
        Pegawai::destroy($id);
        return redirect('/pendataan')->with('sukses', 'Data pegawai berhasil dihapus!');
    }

    public function hapusProduk($id)
    {
        Produk::destroy($id);
        return redirect('/pendataan')->with('sukses', 'Data produk berhasil dihapus!');
    }

    public function hapusPemasok($id)
    {
        Pemasok::destroy($id);
        return redirect('/pendataan')->with('sukses', 'Data pemasok berhasil dihapus!');
    }

    public function hapusJongko($id)
    {
        Jongko::destroy($id);
        return redirect('/pendataan')->with('sukses', 'Data jongko berhasil dihapus!');
    }
}