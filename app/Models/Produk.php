<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // Baris di bawah ini berfungsi untuk mengizinkan kolom-kolom ini diisi data lewat form
    protected $fillable = ['nama_produk', 'ukuran', 'jenis'];
}