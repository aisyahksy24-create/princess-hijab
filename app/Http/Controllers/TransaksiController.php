<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Pegawai;
use App\Models\Jongko;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // Ambil semua data produk dari cache untuk dikirim ke view blade (Temuan #15)
        $data_produk = Cache::rememberForever('cache_all_produk', function () {
            return Produk::all();
        });

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

        try {
            // Hitung total harga hasil tawar-menawar (Jumlah x Harga Satuan)
            $total_harga = $request->jumlah_terjual * $request->harga_satuan;

            // Simpan data ke tabel transaksi beserta pegawai_id pencatatnya (Temuan #7)
            Transaksi::create([
                'produk_id'      => $request->produk_id,
                'jongko_id'      => session('jongko_aktif_id'), // Diambil dari session jongko aktif tempat bekerja
                'pegawai_id'     => session('id_pegawai'),       // Diambil dari session pegawai yang sedang login
                'jumlah_terjual' => $request->jumlah_terjual,
                'total_harga'    => $total_harga,               // Nilai riil bulat rupiah
            ]);

            return redirect()->back()->with('success', 'Transaksi penjualan berhasil dicatat!');
        } catch (\Exception $e) {
            // Memberikan error handling ramah pengguna (Temuan #17)
            return redirect()->back()->withInput()->with('error', 'Gagal mencatat transaksi: Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    /**
     * 3. Halaman Rekap Omset (Untuk Sisi Admin via Web View)
     */
    public function rekapAdmin()
    {
        return $this->dashboardAdmin();
    }

    /**
     * 5. Menampilkan Halaman Dashboard Admin dengan Omset Bulan Ini & Akumulasi Kas
     */
    /**
     * Helper: Konversi tanggal WIB (string) ke range UTC [start, end]
     */
    private static function utcRangeForDate(string $dateStr): array
    {
        $tz    = 'Asia/Jakarta';
        $start = \Carbon\Carbon::parse($dateStr . ' 00:00:00', $tz)->utc()->toDateTimeString();
        $end   = \Carbon\Carbon::parse($dateStr . ' 23:59:59', $tz)->utc()->toDateTimeString();
        return [$start, $end];
    }

    /**
     * Helper: Konversi bulan WIB (year, month) ke range UTC [start, end]
     */
    private static function utcRangeForMonth(int $year, int $month): array
    {
        $tz    = 'Asia/Jakarta';
        $start = \Carbon\Carbon::createFromDate($year, $month, 1, $tz)->startOfMonth()->utc()->toDateTimeString();
        $end   = \Carbon\Carbon::createFromDate($year, $month, 1, $tz)->endOfMonth()->utc()->toDateTimeString();
        return [$start, $end];
    }

    public function dashboardAdmin()
    {
        // 1. Omset Bulan Ini (pakai bulan WIB agar konsisten dengan tampilan)
        $nowWib = now('Asia/Jakarta');
        [$mStart, $mEnd] = self::utcRangeForMonth($nowWib->year, $nowWib->month);
        $omset_bulan_ini = Transaksi::whereBetween('created_at', [$mStart, $mEnd])
            ->sum('total_harga') ?? 0;

        // 2. Pengeluaran Bulan Ini (Akumulasi pengeluaran operasional bulan berjalan)
        $pengeluaran_bulan_ini = self::hitungPengeluaranBulanIni($nowWib->year, $nowWib->month);

        // 3. Laba Bulan Ini
        $laba_bulan_ini = $omset_bulan_ini - $pengeluaran_bulan_ini;

        // 4. Saldo Kas Usaha: Total Penerimaan dikurangi beban pengeluaran
        //    yang sudah berjalan (bukan sum total kolom mentah, tapi akumulasi
        //    harian × hari berjalan sejak tanggal_mulai masing-masing pengeluaran)
        $saldo_awal = 0; // Saldo Awal dihapus
        
        $total_penerimaan = Transaksi::sum('total_harga') ?? 0;
        $total_pengeluaran = self::hitungTotalPengeluaranAkumulasi();
        $saldo_kas_usaha = $saldo_awal + $total_penerimaan - $total_pengeluaran;

        // New calculations for Syariah management
        $target_dana_darurat = 3 * $pengeluaran_bulan_ini; // 3 months of expenses
        $prive_maks = $saldo_kas_usaha - $target_dana_darurat;
        if ($prive_maks < 0) {
            $prive_maks = 0;
        }

        return view('dashboard-admin', compact(
            'omset_bulan_ini', 
            'pengeluaran_bulan_ini', 
            'laba_bulan_ini', 
            'saldo_kas_usaha',
            'target_dana_darurat',
            'prive_maks'
        ));

    }

    /**
     * 6. Menampilkan Halaman Rekap Omset Bulanan & Harian per Jongko
     */
    public function rekapOmset(Request $request)
    {
        // Gunakan tanggal WIB (Asia/Jakarta) sebagai default untuk date picker
        $nowWib = now('Asia/Jakarta');
        $tanggal_pilihan = $request->input('tanggal', $nowWib->toDateString());
        $bulan_pilihan   = $request->input('bulan', $nowWib->format('m'));
        $tahun_pilihan   = $request->input('tahun', $nowWib->format('Y'));

        // Ambil data semua jongko dari Cache (Temuan #15)
        $all_jongko = Cache::rememberForever('cache_all_jongko', function () {
            return Jongko::all();
        });

        // A. Hitung Omset Harian per Jongko
        [$dayStart, $dayEnd] = self::utcRangeForDate($tanggal_pilihan);
        $omset_harian = $all_jongko->map(function($jongko) use ($dayStart, $dayEnd) {
            $total = Transaksi::where('jongko_id', $jongko->id)
                        ->whereBetween('created_at', [$dayStart, $dayEnd])
                        ->sum('total_harga') ?? 0;
            return [
                'nama_jongko'  => $jongko->nama_jongko,
                'total_omset'  => $total
            ];
        });

        // B. Hitung Omset Bulanan per Jongko
        [$bStart, $bEnd] = self::utcRangeForMonth((int)$tahun_pilihan, (int)$bulan_pilihan);
        $omset_bulanan = $all_jongko->map(function($jongko) use ($bStart, $bEnd) {
            $total = Transaksi::where('jongko_id', $jongko->id)
                        ->whereBetween('created_at', [$bStart, $bEnd])
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



    public function alokasiDana(Request $request)
    {
        // 1. Ambil Laba Bulan Ini
        [$mStart, $mEnd] = self::utcRangeForMonth(now()->year, now()->month);
        $omset_bulan_ini = Transaksi::whereBetween('created_at', [$mStart, $mEnd])
            ->sum('total_harga') ?? 0;

        $pengeluaran_bulan_ini = self::hitungPengeluaranBulanIni(now()->year, now()->month);

        $laba_bulan_ini = $omset_bulan_ini - $pengeluaran_bulan_ini;

        // 2. Ambil persentase alokasi dari Cache (jika tidak ada, gunakan default)
        $persentase = Cache::rememberForever('cache_alokasi_persentase', function() {
            return [
                'operasional' => 40,
                'darurat' => 10,
                'pengembangan' => 20,
                'pemilik' => 30
            ];
        });

        return view('alokasi-dana', compact('laba_bulan_ini', 'persentase'));
    }

    /**
     * 10. Menyimpan persentase alokasi dana baru ke dalam Cache
     */
    public function updateAlokasiDana(Request $request)
    {
        $request->validate([
            'operasional' => 'required|integer|min:0|max:100',
            'darurat' => 'required|integer|min:0|max:100',
            'pengembangan' => 'required|integer|min:0|max:100',
            'pemilik' => 'required|integer|min:0|max:100',
        ]);

        $total = $request->operasional + $request->darurat + $request->pengembangan + $request->pemilik;
        if ($total !== 100) {
            return redirect()->back()->withInput()->with('error', 'Total persentase alokasi harus tepat 100%! Saat ini: ' . $total . '%');
        }

        Cache::forever('cache_alokasi_persentase', [
            'operasional' => (int) $request->operasional,
            'darurat' => (int) $request->darurat,
            'pengembangan' => (int) $request->pengembangan,
            'pemilik' => (int) $request->pemilik,
        ]);

        return redirect()->back()->with('sukses', 'Rekomendasi alokasi dana syariah berhasil diperbarui!');
    }

    /**
     * 8. Halaman UI Cetak Laporan Bulanan
     */
    public function cetakLaporanBulanan()
    {
        return view('cetak-laporan');
    }

    /**
     * 9. API Preview data laporan (AJAX)
     */
    public function previewLaporanApi(Request $request)
    {
        $bulan = $request->query('bulan', now()->format('Y-m')); // format: YYYY-MM
        $parts = explode('-', $bulan);
        if (count($parts) !== 2) {
            return response()->json(['error' => 'Format bulan tidak valid'], 422);
        }
        $year  = (int) $parts[0];
        $month = (int) $parts[1];

        [$pStart, $pEnd] = self::utcRangeForMonth($year, $month);
        $omset       = \App\Models\Transaksi::whereBetween('created_at', [$pStart, $pEnd])
                           ->sum('total_harga') ?? 0;
        $pengeluaran = self::hitungPengeluaranBulanIni($year, $month);
        $laba        = $omset - $pengeluaran;

        return response()->json([
            'omset'       => $omset,
            'pengeluaran' => $pengeluaran,
            'laba'        => $laba,
        ]);
    }

    /**
     * 10. Download PDF Laporan Keuangan Bulanan
     */
    public function downloadLaporanBulananPdf(Request $request)
    {
        $bulan = $request->query('bulan', now()->format('Y-m'));
        $parts = explode('-', $bulan);
        if (count($parts) !== 2) {
            abort(422, 'Format bulan tidak valid');
        }
        $year  = (int) $parts[0];
        $month = (int) $parts[1];

        // Nama bulan Indonesia
        $namaBulanArr = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $nama_bulan = $namaBulanArr[$month] ?? 'Bulan';

        // --- OMSET total & per jongko ---
        $all_jongko  = Jongko::orderBy('id', 'asc')->get();
        [$lStart, $lEnd] = self::utcRangeForMonth($year, $month);
        $omset_per_jongko = $all_jongko->map(function ($jongko) use ($lStart, $lEnd) {
            $total = \App\Models\Transaksi::where('jongko_id', $jongko->id)
                ->whereBetween('created_at', [$lStart, $lEnd])
                ->sum('total_harga') ?? 0;
            return [
                'nama_jongko' => $jongko->nama_jongko,
                'total_omset' => $total,
            ];
        })->toArray();

        $total_omset = array_sum(array_column($omset_per_jongko, 'total_omset'));

        // --- PENGELUARAN detail dengan logika running month ---
        $startOfMonth    = \Carbon\Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth      = \Carbon\Carbon::create($year, $month, 1)->endOfMonth();
        $today           = \Carbon\Carbon::today();
        $endCalculation  = $endOfMonth->isAfter($today) ? $today : $endOfMonth;

        $pengeluarans    = \App\Models\Pengeluaran::with('items')
                           ->where('tanggal_mulai', '<=', $endCalculation->toDateString())
                           ->get();

        $detail_pengeluaran = [];
        $total_pengeluaran  = 0;

        foreach ($pengeluarans as $p) {
            $tanggal_mulai = \Carbon\Carbon::parse($p->tanggal_mulai);
            $nominal       = $p->total;

            // Hitung beban harian
            switch ($p->periode) {
                case 'harian':
                    $beban_harian = $nominal;
                    break;
                case 'mingguan':
                    $beban_harian = $nominal / 7;
                    break;
                case 'bulanan':
                    $beban_harian = $nominal / 30;
                    break;
                case 'tahunan':
                    $beban_harian = $nominal / 365;
                    break;
                default:
                    $beban_harian = $nominal;
            }

            // Hitung rentang hari aktif bulan ini
            $calcStart = $tanggal_mulai->isAfter($startOfMonth) ? $tanggal_mulai : $startOfMonth;
            $calcEnd   = $endCalculation;

            if ($calcStart->isAfter($calcEnd)) {
                continue;
            }

            $hari_berjalan    = $calcStart->diffInDays($calcEnd) + 1;
            $beban_terakumulasi = $beban_harian * $hari_berjalan;
            $total_pengeluaran += $beban_terakumulasi;

            // Nama pengeluaran dari item pertama atau kategori
            $nama_pengeluaran = $p->items->first()?->nama ?? $p->kategori;

            $detail_pengeluaran[] = [
                'nama'               => $nama_pengeluaran,
                'kategori'           => ucfirst($p->kategori),
                'periode'            => $p->periode,
                'nominal'            => $nominal,
                'beban_harian'       => $beban_harian,
                'hari_berjalan'      => $hari_berjalan,
                'beban_terakumulasi' => $beban_terakumulasi,
            ];
        }

        $total_pengeluaran = (int) round($total_pengeluaran);
        $laba_bersih       = $total_omset - $total_pengeluaran;

        $data = [
            'nama_bulan'         => $nama_bulan,
            'tahun'              => $year,
            'tanggal_cetak'      => now()->isoFormat('D MMMM Y'),
            'total_omset'        => $total_omset,
            'total_pengeluaran'  => $total_pengeluaran,
            'laba_bersih'        => $laba_bersih,
            'omset_per_jongko'   => $omset_per_jongko,
            'detail_pengeluaran' => $detail_pengeluaran,
        ];

        $pdf = Pdf::loadView('exports.laporan_bulanan_pdf', $data);
        $pdf->setPaper('a4', 'portrait');

        $filename = 'Laporan_Keuangan_' . $nama_bulan . '_' . $year . '_PrincessHijab.pdf';
        return $pdf->download($filename);
    }

    /**
     * Helper to calculate the accumulated running month expense.
     */
    public static function hitungPengeluaranBulanIni($year, $month)
    {
        $tz           = 'Asia/Jakarta';
        $startOfMonth = \Carbon\Carbon::create($year, $month, 1, 0, 0, 0, $tz)->startOfMonth();
        $endOfMonth   = \Carbon\Carbon::create($year, $month, 1, 0, 0, 0, $tz)->endOfMonth();
        $today        = \Carbon\Carbon::today($tz);

        // If the calculation month is in the future relative to today, return 0
        if ($startOfMonth->isAfter($today)) {
            return 0;
        }

        // Limit the end calculation date to today for the running month, or end of month for past months
        $endCalculation = $endOfMonth->isAfter($today) ? $today : $endOfMonth;

        $pengeluarans = \App\Models\Pengeluaran::where('tanggal_mulai', '<=', $endCalculation->toDateString())->get();

        $total_beban = 0;
        foreach ($pengeluarans as $p) {
            // Parse tanggal_mulai dengan timezone WIB agar diffInDays konsisten
            $tanggal_mulai = \Carbon\Carbon::parse($p->tanggal_mulai, $tz)->startOfDay();

            // Calculate daily rate based on period
            $nominal = $p->total;
            switch ($p->periode) {
                case 'harian':
                    $beban_harian = $nominal;
                    break;
                case 'mingguan':
                    $beban_harian = $nominal / 7;
                    break;
                case 'bulanan':
                    $beban_harian = $nominal / 30;
                    break;
                case 'tahunan':
                    $beban_harian = $nominal / 365;
                    break;
                default:
                    $beban_harian = $nominal;
            }

            // Determine calculation start date: later of $startOfMonth and $tanggal_mulai
            $calcStart = $tanggal_mulai->isAfter($startOfMonth) ? $tanggal_mulai : $startOfMonth->copy();

            // Determine calculation end date
            $calcEnd = $endCalculation->copy()->startOfDay();

            if ($calcStart->isAfter($calcEnd)) {
                continue;
            }

            // Number of days in the calculation range (inclusive)
            $jumlah_hari_berjalan = $calcStart->diffInDays($calcEnd) + 1;

            $total_beban += $beban_harian * $jumlah_hari_berjalan;
        }

        return (int) round($total_beban);
    }

    /**
     * Helper: Hitung total akumulasi pengeluaran dari tanggal_mulai
     * masing-masing pengeluaran sampai hari ini (WIB).
     * Logika sama dengan hitungPengeluaranBulanIni() tapi tanpa batas bulan.
     */
    public static function hitungTotalPengeluaranAkumulasi(): int
    {
        $today = \Carbon\Carbon::today('Asia/Jakarta');
        $pengeluarans = \App\Models\Pengeluaran::all();

        $total_beban = 0;
        foreach ($pengeluarans as $p) {
            $tanggal_mulai = \Carbon\Carbon::parse($p->tanggal_mulai, 'Asia/Jakarta');

            // Pengeluaran yang belum mulai berjalan, lewati
            if ($tanggal_mulai->isAfter($today)) {
                continue;
            }

            // Hitung beban harian berdasarkan periode
            $nominal = $p->total;
            switch ($p->periode) {
                case 'harian':
                    $beban_harian = $nominal;
                    break;
                case 'mingguan':
                    $beban_harian = $nominal / 7;
                    break;
                case 'bulanan':
                    $beban_harian = $nominal / 30;
                    break;
                case 'tahunan':
                    $beban_harian = $nominal / 365;
                    break;
                default:
                    $beban_harian = $nominal;
            }

            // Jumlah hari yang sudah berjalan (inklusif sejak tanggal_mulai)
            $hari_berjalan = $tanggal_mulai->diffInDays($today) + 1;

            $total_beban += $beban_harian * $hari_berjalan;
        }

        return (int) round($total_beban);
    }
}