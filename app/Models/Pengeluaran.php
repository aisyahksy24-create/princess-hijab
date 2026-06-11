<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluarans';

    protected $fillable = [
        'nomor_pengeluaran',
        'tanggal',
        'kategori',
        'total',
        'periode',
        'tanggal_mulai',
    ];

    /**
     * Relasi ke detail item pengeluaran
     */
    public function items()
    {
        return $this->hasMany(ItemPengeluaran::class, 'pengeluaran_id');
    }
}
