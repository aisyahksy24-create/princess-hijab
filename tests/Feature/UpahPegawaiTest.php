<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pegawai;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpahPegawaiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can access upah-pegawai page and API.
     */
    public function test_admin_can_access_upah_details_and_api(): void
    {
        // 1. Create a non-admin employee
        $pegawai = Pegawai::create([
            'nama_pegawai' => 'Test Employee',
            'alamat' => 'Address Test',
            'no_telp' => '08123456789',
            'username' => 'test_employee',
            'password' => bcrypt('password123'),
            'role' => 'pegawai'
        ]);

        // 2. Access as admin via session
        $response = $this->withSession([
            'login' => true,
            'role' => 'admin',
            'nama_pegawai' => 'Owner Admin'
        ])->get('/upah-pegawai');

        $response->assertStatus(200);

        // 3. Test API returns correct data
        $apiResponse = $this->withSession([
            'login' => true,
            'role' => 'admin',
            'nama_pegawai' => 'Owner Admin'
        ])->get('/api/ambil-upah');

        $apiResponse->assertStatus(200)
            ->assertJsonFragment([
                'nama' => 'Test Employee',
                'upah' => 50000,
                'upah_bersih' => 50000
            ]);

        // 4. Test PDF download structure
        $pdfResponse = $this->withSession([
            'login' => true,
            'role' => 'admin',
            'nama_pegawai' => 'Owner Admin'
        ])->get('/cetak-upah-pegawai');

        $pdfResponse->assertStatus(200);
        $this->assertStringContainsString('attachment; filename=Laporan_Gaji_Pegawai_Princess_Hijab_', $pdfResponse->headers->get('Content-Disposition'));
    }
}
