<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pegawai;

class PegawaiTest extends TestCase
{
    /**
     * Test hitungUpah returns flat 50,000 and 0 bonus.
     */
    public function test_hitung_upah_returns_flat_wage(): void
    {
        // 0 sales
        $upah1 = Pegawai::hitungUpah(0);
        $this->assertEquals(50000, $upah1['pokok']);
        $this->assertEquals(0, $upah1['bonus']);
        $this->assertEquals(50000, $upah1['bersih']);

        // 1,000,000 sales
        $upah2 = Pegawai::hitungUpah(1000000);
        $this->assertEquals(50000, $upah2['pokok']);
        $this->assertEquals(0, $upah2['bonus']);
        $this->assertEquals(50000, $upah2['bersih']);
    }
}
