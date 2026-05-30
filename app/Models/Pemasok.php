<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    // Tambahkan baris ini agar kolomnya aman saat diinput data
    protected $fillable = ['nama_pemasok', 'no_telp', 'alamat'];
}