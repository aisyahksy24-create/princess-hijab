<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Bulanan - Princess Hijab</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            background: #fff;
        }
        /* ===== HEADER ===== */
        .header {
            text-align: center;
            padding: 20px 30px 15px;
            border-bottom: 3px solid #333;
            margin-bottom: 20px;
        }
        .header .company-name {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .header .company-sub {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }
        .header .report-title {
            font-size: 15px;
            font-weight: bold;
            margin-top: 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            text-decoration: underline;
        }
        .header .report-period {
            font-size: 12px;
            margin-top: 5px;
            color: #444;
        }

        /* ===== META INFO ===== */
        .meta-info {
            padding: 0 30px;
            margin-bottom: 20px;
            font-size: 11px;
            color: #555;
        }
        .meta-info table {
            border-collapse: collapse;
        }
        .meta-info td {
            padding: 2px 8px 2px 0;
            border: none;
        }
        .meta-info td:first-child {
            font-weight: bold;
            color: #333;
            min-width: 120px;
        }

        /* ===== SUMMARY CARDS ===== */
        .summary-section {
            padding: 0 30px;
            margin-bottom: 25px;
        }
        .summary-section h3 {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .summary-cards {
            width: 100%;
        }
        .summary-cards td {
            width: 33.33%;
            padding: 0 8px 0 0;
            vertical-align: top;
        }
        .summary-cards td:last-child { padding-right: 0; }
        .card {
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }
        .card-omset { background: #fffde7; border-color: #f0d500; }
        .card-pengeluaran { background: #fce4ec; border-color: #e91e8c; }
        .card-laba { background: #e8f5e9; border-color: #4caf50; }
        .card .card-label {
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 6px;
        }
        .card .card-value {
            font-size: 16px;
            font-weight: bold;
            color: #222;
        }

        /* ===== MONTHLY TABLE ===== */
        .table-section {
            padding: 0 30px;
            margin-bottom: 25px;
        }
        .table-section h3 {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.data-table th {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 8px 10px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
        }
        table.data-table td {
            border: 1px solid #ddd;
            padding: 7px 10px;
            font-size: 11px;
            text-align: center;
        }
        table.data-table td.text-right { text-align: right; }
        table.data-table td.text-left { text-align: left; }
        table.data-table tr:nth-child(even) td { background-color: #fafafa; }
        table.data-table .total-row td {
            background-color: #e8e8e8;
            font-weight: bold;
            border-top: 2px solid #999;
        }
        .laba-positif { color: #2e7d32; }
        .laba-negatif { color: #c62828; }

        /* ===== EXPENSE DETAIL TABLE ===== */
        table.expense-table th {
            background-color: #fce4ec;
        }

        /* ===== FOOTER ===== */
        .footer {
            padding: 15px 30px;
            border-top: 1px solid #ccc;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .footer-left {
            font-size: 10px;
            color: #888;
        }
        .signature-area {
            text-align: center;
            font-size: 11px;
        }
        .signature-line {
            margin-top: 55px;
            border-top: 1px solid #333;
            width: 150px;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    {{-- ===== HEADER ===== --}}
    <div class="header">
        <div class="company-name">Princess Hijab</div>
        <div class="company-sub">Sistem Informasi Manajemen Keuangan UMKM</div>
        <div class="report-title">Laporan Keuangan Bulanan</div>
        <div class="report-period">Periode: {{ $nama_bulan }} {{ $tahun }}</div>
    </div>

    {{-- ===== META INFO ===== --}}
    <div class="meta-info">
        <table>
            <tr>
                <td>Tanggal Cetak</td>
                <td>: {{ $tanggal_cetak }}</td>
            </tr>
            <tr>
                <td>Periode Laporan</td>
                <td>: {{ $nama_bulan }} {{ $tahun }}</td>
            </tr>
        </table>
    </div>

    {{-- ===== RINGKASAN KEUANGAN ===== --}}
    <div class="summary-section">
        <h3>Ringkasan Keuangan</h3>
        <table class="summary-cards">
            <tr>
                <td>
                    <div class="card card-omset">
                        <div class="card-label">Total Omset</div>
                        <div class="card-value">Rp {{ number_format($total_omset, 0, ',', '.') }}</div>
                    </div>
                </td>
                <td>
                    <div class="card card-pengeluaran">
                        <div class="card-label">Total Pengeluaran</div>
                        <div class="card-value">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</div>
                    </div>
                </td>
                <td>
                    <div class="card card-laba">
                        <div class="card-label">Laba Bersih</div>
                        <div class="card-value {{ $laba_bersih >= 0 ? 'laba-positif' : 'laba-negatif' }}">
                            Rp {{ number_format($laba_bersih, 0, ',', '.') }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- ===== REKAP OMSET PER JONGKO ===== --}}
    <div class="table-section">
        <h3>Rekap Omset per Lokasi Jongko</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Nama Jongko</th>
                    <th>Total Omset</th>
                    <th>% Kontribusi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($omset_per_jongko as $i => $jongko)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="text-left">{{ $jongko['nama_jongko'] }}</td>
                    <td class="text-right">Rp {{ number_format($jongko['total_omset'], 0, ',', '.') }}</td>
                    <td>
                        {{ $total_omset > 0 ? number_format(($jongko['total_omset'] / $total_omset) * 100, 1) : '0.0' }}%
                    </td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="2" class="text-right">TOTAL OMSET</td>
                    <td class="text-right">Rp {{ number_format($total_omset, 0, ',', '.') }}</td>
                    <td>100%</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- ===== DETAIL PENGELUARAN ===== --}}
    <div class="table-section">
        <h3>Rincian Pengeluaran Aktif (Terakumulasi Bulan Ini)</h3>
        <table class="data-table expense-table">
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th>Nama Pengeluaran</th>
                    <th>Kategori</th>
                    <th>Periode</th>
                    <th>Nominal Asli</th>
                    <th>Beban Harian</th>
                    <th>Hari Berjalan</th>
                    <th>Beban Terakumulasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detail_pengeluaran as $i => $pen)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td class="text-left">{{ $pen['nama'] }}</td>
                    <td>{{ $pen['kategori'] }}</td>
                    <td>{{ ucfirst($pen['periode']) }}</td>
                    <td class="text-right">Rp {{ number_format($pen['nominal'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($pen['beban_harian'], 0, ',', '.') }}</td>
                    <td>{{ $pen['hari_berjalan'] }} hari</td>
                    <td class="text-right">Rp {{ number_format($pen['beban_terakumulasi'], 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">Tidak ada pengeluaran aktif pada periode ini.</td>
                </tr>
                @endforelse
                <tr class="total-row">
                    <td colspan="7" class="text-right">TOTAL PENGELUARAN TERAKUMULASI</td>
                    <td class="text-right">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- ===== FOOTER ===== --}}
    <div class="footer">
        <div class="footer-left">
            Dicetak otomatis oleh Sistem Aplikasi Princess Hijab.<br>
            Dokumen ini bersifat internal dan rahasia.
        </div>
        <div class="signature-area">
            <div>Mengetahui,</div>
            <div class="signature-line">Pemilik Usaha</div>
        </div>
    </div>

</body>
</html>
