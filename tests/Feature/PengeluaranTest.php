<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Jongko;
use App\Models\Pegawai;
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
            'periode' => 'harian',
            'tanggal_mulai' => '2026-06-05',
            'items' => json_encode($items)
        ]);

        $response->assertRedirect('/pengeluaran');
        
        $this->assertDatabaseHas('pengeluarans', [
            'nomor_pengeluaran' => 'EXP-1',
            'kategori' => 'Belanja Stok',
            'total' => 130000,
            'periode' => 'harian',
            'tanggal_mulai' => '2026-06-05',
        ]);

        $this->assertDatabaseHas('item_pengeluarans', [
            'nama' => 'Item A',
            'jumlah' => 2,
            'tarif' => 50000,
            'total' => 100000
        ]);
    }

    /**
     * Test running month calculations in dashboard.
     */
    public function test_dashboard_running_month_calculations(): void
    {
        // 1. Create monthly expense of 300,000 starting 9 days ago.
        // Daily rate = 300,000 / 30 = 10,000.
        // Today is June 10, 2026 (mocked or actual now()).
        // Let's create an expense starting 4 days ago.
        $startDate = now()->subDays(4)->toDateString(); // e.g. June 6 if today is June 10
        
        $pengeluaran = Pengeluaran::create([
            'nomor_pengeluaran' => 'EXP-2',
            'tanggal' => $startDate,
            'kategori' => 'Listrik',
            'total' => 300000,
            'periode' => 'bulanan',
            'tanggal_mulai' => $startDate
        ]);

        // 5 days elapsed (subDays(4) to today: today, subDays(1), subDays(2), subDays(3), subDays(4) = 5 days inclusive)
        $expectedBeban = (300000 / 30) * 5; // 50,000

        $response = $this->withSession([
            'login' => true,
            'role' => 'admin',
            'nama_pegawai' => 'Owner Admin'
        ])->get('/dashboard-admin');

        $response->assertStatus(200);
        $response->assertViewHas('pengeluaran_bulan_ini', $expectedBeban);
    }
}
