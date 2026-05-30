<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // Tentukan nama tabelnya secara eksplisit agar aman
    protected $table = 'pegawais';

    // Izinkan semua kolom ini diisi data secara massal dari form pendaftaran
    protected $fillable = [
        'nama_pegawai', 
        'alamat', 
        'no_telp', 
        'username', 
        'password',
        'role'
    ];
}