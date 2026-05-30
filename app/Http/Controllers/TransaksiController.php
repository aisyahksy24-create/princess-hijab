<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // <-- 1. WAJIB IMPORT INI DI ATAS

class TransaksiController extends Controller
{
    /**
     * 1. Menampilkan halaman form catat transaksi penjualan pegawai
     */
    public function create()
    {
        // Pengaman: Pastikan pegawai sudah memilih lokasi kerja (jongko) terlebih dahulu
        if (!session()->has('jongko_aktif_id')) {
            return redirect('/pilih-jongko')->with('error', 'Silakan pilih jongko tempat bekerja terlebih dahulu!');
        }

        // Ambil semua data produk dari database untuk dikirim ke view blade
        $data_produk = Produk::all();

        // Membuka file resources/views/catat-transaksi.blade.php sambil membawa data produk
        return view('catat-transaksi', compact('data_produk'));
    }

    /**
     * 2. Memproses dan menyimpan data transaksi penjualan ke database
     */
    public function store(Request $request)
    {
        // Validasi inputan dari form pegawai demi keamanan database
        $request->validate([
            'produk_id'      => 'required|exists:produks,id',
            'jumlah_terjual' => 'required|integer|min:1',
            'harga_satuan'   => 'required|integer|min:0',
        ]);

        // Hitung total harga hasil tawar-menawar (Jumlah x Harga Satuan)
        $total_harga = $request->jumlah_terjual * $request->harga_satuan;

        // KUNCI AMAN: Simpan data ke tabel transaksi TANPA pegawai_id agar database tidak menolak/error
        Transaksi::create([
            'produk_id'      => $request->produk_id,
            'jongko_id'      => session('jongko_aktif_id'), // Diambil dari session jongko aktif tempat bekerja
            'jumlah_terjual' => $request->jumlah_terjual,
            'total_harga'    => $total_harga,               // Nilai riil bulat rupiah
        ]);

        return redirect()->back()->with('success', 'Transaksi penjualan berhasil dicatat!');
    }

    /**
     * 3. Halaman Rekap Omset & Pengupahan (Untuk Sisi Admin via Web View)
     */
    public function rekapAdmin()
    {
        $tanggal_ini = now()->toDateString();
        return $this->dashboardAdmin();
    }

    /**
     * 4. API Penyuplai Data Upah & Penjualan (Dipanggil oleh JavaScript / AJAX di halaman upah)
     * KUNCI FIX: Membagi omset jongko secara otomatis berdasarkan urutan pegawai aktif harian
     */
    public function apiAmbilUpah()
    {
        $hari_ini = now()->toDateString();

        // 1. Ambil semua pegawai biasa (bukan admin) urut berdasarkan ID asli database
        $pegawais = Pegawai::where('role', '!=', 'admin')->orderBy('id', 'asc')->get();

        // 2. Ambil semua jongko yang tersedia di database asli kamu
        $all_jongko = DB::table('jongkos')->orderBy('id', 'asc')->get();

        $upah_data = [];
        $total_yang_dibayarkan = 0;

        // 3. Distribusikan transaksi harian per jongko kepada masing-masing pegawai secara adil
        foreach ($pegawais as $index => $pegawai) {
            
            $unit_terjual = 0;
            $total_penjualan = 0;
            $nama_jongko = '-';

            // Logika Distribusi Otomatis: Pegawai ke-1 memegang Jongko ke-1, Pegawai ke-2 memegang Jongko ke-2, dst.
            if (isset($all_jongko[$index])) {
                $jongko_aktif = $all_jongko[$index];
                $nama_jongko = $jongko_aktif->nama_jongko;

                // Hitung total transaksi harian khusus di jongko yang dipegang pegawai ini
                $transaksi_jongko = Transaksi::where('jongko_id', $jongko_aktif->id)
                    ->whereDate('created_at', $hari_ini)
                    ->get();

                $unit_terjual = $transaksi_jongko->sum('jumlah_terjual') ?? 0;
                $total_penjualan = $transaksi_jongko->sum('total_harga') ?? 0;
            }

            // 🔥 RUMUS PINNTAR SINKRON 10%: Pokok Rp 50.000 + Bonus 10% (0.10) dari penjualan riil jongko tersebut
            $upah_pokok = 50000;
            $bonus = $total_penjualan * 0.10; 
            $upah_bersih = $upah_pokok + $bonus;

            // Dikirim lengkap agar JavaScript di halaman web kamu langsung mendeteksi datanya
            $upah_data[] = [
                'nama'            => $pegawai->nama_pegawai,
                'nama_pegawai'    => $pegawai->nama_pegawai,
                'jongko'          => $nama_jongko,
                'unit'            => $unit_terjual,
                'unit_terjual'    => $unit_terjual,
                'penjualan'       => $total_penjualan,
                'total_penjualan' => $total_penjualan,
                'upah'            => $upah_bersih,
                'upah_bersih'     => $upah_bersih
            ];

            $total_yang_dibayarkan += $upah_bersih;
        }

        return response()->json([
            'upah_data' => $upah_data,
            'total_yang_dibayarkan' => $total_yang_dibayarkan
        ]);
    }

    /**
     * 5. Menampilkan Halaman Dashboard Admin dengan Omset Hari Ini Riil (SINKRON DENGAN UPPAH)
     */
    public function dashboardAdmin()
    {
        $hari_ini = now()->toDateString();

        // Hitung total omset penjualan riil dari seluruh transaksi toko khusus hari ini
        $omset_hari_ini = Transaksi::whereDate('created_at', $hari_ini)->sum('total_harga') ?? 0;

        $all_jongko = DB::table('jongkos')->orderBy('id', 'asc')->get();

        // Ambil rekap data per pegawai hari ini agar sinkron total dengan tabel pengupahan bawah
        $rekap_data = Pegawai::where('role', '!=', 'admin')->orderBy('id', 'asc')->get()->map(function($pegawai, $index) use ($hari_ini, $all_jongko) {
            
            $total_jualan = 0;
            $nama_jongko = '-';
            
            if (isset($all_jongko[$index])) {
                $jongko_aktif = $all_jongko[$index];
                $nama_jongko = $jongko_aktif->nama_jongko;
                
                // Menghitung total jualan di jongko tersebut khusus hari ini
                $total_jualan = Transaksi::where('jongko_id', $jongko_aktif->id)
                                         ->whereDate('created_at', $hari_ini)
                                         ->sum('total_harga') ?? 0;
            }

            // RUMUS FIX 10%: Pokok Rp 50.000 + Bonus 10% (0.10)
            $pegawai->nama_pegawai = $pegawai->nama_pegawai;
            $pegawai->nama_jongko = $nama_jongko;
            $pegawai->total_penjualan = $total_jualan;
            $pegawai->total_upah = 50000 + ($total_jualan * 0.10); 
            return $pegawai;
        });

        return view('dashboard-admin', compact('omset_hari_ini', 'rekap_data'));
    }

    /**
     * 6. Menampilkan Halaman Rekap Omset Bulanan & Harian per Jongko
     */
    public function rekapOmset(Request $request)
    {
        $tanggal_pilihan = $request->input('tanggal', now()->toDateString());
        $bulan_pilihan   = $request->input('bulan', now()->format('m'));
        $tahun_pilihan   = $request->input('tahun', now()->format('Y'));

        // Ambil data semua jongko asli dari DB
        $all_jongko = DB::table('jongkos')->get();

        // A. Hitung Omset Harian per Jongko
        $omset_harian = $all_jongko->map(function($jongko) use ($tanggal_pilihan) {
            $total = Transaksi::where('jongko_id', $jongko->id)
                        ->whereDate('created_at', $tanggal_pilihan)
                        ->sum('total_harga') ?? 0;
            return [
                'nama_jongko'  => $jongko->nama_jongko,
                'total_omset'  => $total
            ];
        });

        // B. Hitung Omset Bulanan per Jongko
        $omset_bulanan = $all_jongko->map(function($jongko) use ($bulan_pilihan, $tahun_pilihan) {
            $total = Transaksi::where('jongko_id', $jongko->id)
                        ->whereMonth('created_at', $bulan_pilihan)
                        ->whereYear('created_at', $tahun_pilihan)
                        ->sum('total_harga') ?? 0;
            return [
                'nama_jongko'  => $jongko->nama_jongko,
                'total_omset'  => $total
            ];
        });

        return view('rekap-omset', compact('omset_harian', 'omset_bulanan', 'tanggal_pilihan'));
    }

    /**
     * 7. FUNGSI BARU: Mengolah dan Mengunduh PDF Laporan Rekap Omset
     */
    public function cetakPdfOmset(Request $request)
    {
        // Ambil data transaksi beserta relasi produk dan jongko
        $data_transaksi = Transaksi::with(['produk', 'jongko'])->orderBy('created_at', 'desc')->get();

        // Hitung total nilai rupiah omset terkumpul
        $total_omset = $data_transaksi->sum('total_harga');

        $data = [
            'title'           => 'LAPORAN REKAP OMSET - PRINCESS HIJAB',
            'tanggal'         => date('d F Y'),
            'data_transaksi'  => $data_transaksi,
            'total_omset'     => $total_omset
        ];

        // Memuat susunan halaman blade khusus PDF
        $pdf = Pdf::loadView('exports.rekap_omset_pdf', $data);
        
        // Mengatur orientasi kertas cetak
        $pdf->setPaper('a4', 'portrait');

        // Mengunduh langsung berkas dokumen PDF-nya
        return $pdf->download('Laporan_Rekap_Omset_Princess_Hijab_' . date('Ymd') . '.pdf');
    }
    /**
     * 8. FUNGSI BARU: Mengolah dan Mengunduh PDF Laporan Pengupahan Pegawai
     */
    public function cetakPdfUpah(Request $request)
    {
        $hari_ini = now()->toDateString();

        // 1. Ambil semua pegawai biasa (bukan admin)
        $pegawais = Pegawai::where('role', '!=', 'admin')->orderBy('id', 'asc')->get();

        // 2. Ambil semua jongko untuk pemetaan distribusi
        $all_jongko = DB::table('jongkos')->orderBy('id', 'asc')->get();

        $upah_data = [];
        $total_pengeluaran_gaji = 0;

        // 3. Hitung rumus upah 10% (persis seperti logika halaman web kamu)
        foreach ($pegawais as $index => $pegawai) {
            $unit_terjual = 0;
            $total_penjualan = 0;
            $nama_jongko = '-';

            if (isset($all_jongko[$index])) {
                $jongko_aktif = $all_jongko[$index];
                $nama_jongko = $jongko_aktif->nama_jongko;

                $transaksi_jongko = Transaksi::where('jongko_id', $jongko_aktif->id)
                    ->whereDate('created_at', $hari_ini)
                    ->get();

                $unit_terjual = $transaksi_jongko->sum('jumlah_terjual') ?? 0;
                $total_penjualan = $transaksi_jongko->sum('total_harga') ?? 0;
            }

            $upah_pokok = 50000;
            $bonus = $total_penjualan * 0.10; 
            $upah_bersih = $upah_pokok + $bonus;

            $upah_data[] = [
                'nama_pegawai' => $pegawai->nama_pegawai,
                'nama_jongko'  => $nama_jongko,
                'unit_terjual' => $unit_terjual,
                'total_jualan' => $total_penjualan,
                'bonus_10'     => $bonus,
                'upah_bersih'  => $upah_bersih
            ];

            $total_pengeluaran_gaji += $upah_bersih;
        }

        // 4. Siapkan data untuk template PDF
        $data = [
            'title'                  => 'LAPORAN PENGGAJIAN PEGAWAI - PRINCESS HIJAB',
            'tanggal'                => date('d F Y'),
            'upah_data'              => $upah_data,
            'total_pengeluaran_gaji' => $total_pengeluaran_gaji
        ];

        // 5. Load view cetak upah
        $pdf = Pdf::loadView('exports.upah_pegawai_pdf', $data);
        $pdf->setPaper('a4', 'portrait');

        // 6. Download otomatis file PDF-nya
        return $pdf->download('Laporan_Gaji_Pegawai_Princess_Hijab_' . date('Ymd') . '.pdf');
    }
}