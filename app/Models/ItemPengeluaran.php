<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPengeluaran extends Model
{
    use HasFactory;

    protected $table = 'item_pengeluarans';

    protected $fillable = [
        'pengeluaran_id',
        'nama',
        'jumlah',
        'tarif',
        'total',
    ];

    /**
     * Relasi ke parent Pengeluaran
     */
    public function pengeluaran()
    {
        return $this->belongsTo(Pengeluaran::class, 'pengeluaran_id');
    }
}
