<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pengeluaran;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PengeluaranTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can access pengeluaran list.
     */
    public function test_admin_can_access_pengeluaran_list(): void
    {
        $response = $this->withSession([
            'login' => true,
            'role' => 'admin',
            'nama_pegawai' => 'Owner Admin'
        ])->get('/pengeluaran');

        $response->assertStatus(200);
    }

    /**
     * Test admin can store new expense.
     */
    public function test_admin_can_store_expense(): void
    {
        $items = [
            [
                'nama' => 'Item A',
                'jumlah' => 2,
                'tarif' => 50000,
            ],
            [
                'nama' => 'Item B',
                'jumlah' => 1,
                'tarif' => 30000,
            ]
        ];

        $response = $this->withSession([
            'login' => true,
            'role' => 'admin',
            'nama_pegawai' => 'Owner Admin'
        ])->post('/pengeluaran/store', [
            'nomor_pengeluaran' => 'EXP-1',
            'tanggal' => '2026-06-05',
            'kategori' => 'Belanja Stok',
            'items' => json_encode($items)
        ]);

        $response->assertRedirect('/pengeluaran');
        
        $this->assertDatabaseHas('pengeluarans', [
            'nomor_pengeluaran' => 'EXP-1',
            'kategori' => 'Belanja Stok',
            'total' => 130000
        ]);

        $this->assertDatabaseHas('item_pengeluarans', [
            'nama' => 'Item A',
            'jumlah' => 2,
            'tarif' => 50000,
            'total' => 100000
        ]);
    }
}
