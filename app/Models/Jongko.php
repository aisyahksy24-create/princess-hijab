<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jongko extends Model
{
    // Izinkan kolom nama_jongko dan alamat diisi data
    protected $fillable = ['nama_jongko', 'alamat'];
}
