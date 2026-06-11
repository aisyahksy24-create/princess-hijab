<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Rekap Omset per Pegawai - Princess Hijab</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            background: #fff;
        }

        /* ===== HEADER ===== */
        .header {
            text-align: center;
            padding: 15px 20px 12px;
            border-bottom: 3px solid #333;
            margin-bottom: 16px;
        }
        .header .company-name {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .header .company-sub {
            font-size: 9px;
            color: #666;
            margin-top: 3px;
        }
        .header .report-title {
            font-size: 13px;
            font-weight: bold;
            margin-top: 10px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            text-decoration: underline;
        }

        /* ===== META INFO ===== */
        .meta-info {
            padding: 0 20px;
            margin-bottom: 16px;
            font-size: 10px;
            color: #555;
        }
        .meta-info table { border-collapse: collapse; }
        .meta-info td { padding: 2px 6px 2px 0; border: none; }
        .meta-info td:first-child {
            font-weight: bold;
            color: #333;
            min-width: 110px;
        }

        /* ===== SUMMARY ===== */
        .summary-box {
            margin: 0 20px 18px;
            background: #f0f7ff;
            border: 1.5px solid #4a90d9;
            border-radius: 5px;
            padding: 10px 16px;
            display: inline-block;
            width: calc(100% - 40px);
        }
        .summary-box .summary-title {
            font-size: 10px;
            font-weight: bold;
            color: #1a5fa8;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .summary-grid { width: 100%; border-collapse: collapse; }
        .summary-grid td {
            width: 25%;
            padding: 0 10px 0 0;
            vertical-align: top;
            border: none;
        }
        .summary-item-label {
            font-size: 9px;
            color: #666;
            font-weight: bold;
            text-transform: uppercase;
        }
        .summary-item-value {
            font-size: 13px;
            font-weight: bold;
            color: #222;
            margin-top: 2px;
        }

        /* ===== PEGAWAI GROUP ===== */
        .pegawai-section {
            padding: 0 20px;
            margin-bottom: 20px;
        }
        .pegawai-heading {
            background: #2c3e50;
            color: #fff;
            padding: 7px 12px;
            font-size: 11px;
            font-weight: bold;
            border-radius: 4px 4px 0 0;
            letter-spacing: 0.3px;
        }
        .pegawai-heading .pg-id {
            background: #f39c12;
            color: #fff;
            padding: 1px 7px;
            border-radius: 3px;
            margin-right: 6px;
            font-size: 10px;
        }

        /* ===== DATA TABLE ===== */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        table.data-table th {
            background-color: #ecf0f1;
            border: 1px solid #bdc3c7;
            padding: 6px 8px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            color: #2c3e50;
        }
        table.data-table td {
            border: 1px solid #dde1e5;
            padding: 5px 8px;
            font-size: 10px;
            text-align: center;
            vertical-align: middle;
        }
        table.data-table td.text-left  { text-align: left; }
        table.data-table td.text-right { text-align: right; }
        table.data-table tr:nth-child(even) td { background-color: #fafbfc; }

        /* Subtotal row */
        .subtotal-row td {
            background-color: #e8f4fd !important;
            font-weight: bold;
            border-top: 2px solid #4a90d9;
            font-size: 10px;
            color: #1a5fa8;
        }

        /* Grand total row */
        .grand-total-section {
            padding: 0 20px;
            margin-bottom: 20px;
        }
        .grand-total-box {
            background: #2c3e50;
            color: #fff;
            padding: 12px 18px;
            border-radius: 5px;
            display: table;
            width: 100%;
        }
        .grand-total-label {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: table-cell;
            vertical-align: middle;
        }
        .grand-total-value {
            font-size: 16px;
            font-weight: bold;
            color: #f1c40f;
            display: table-cell;
            text-align: right;
            vertical-align: middle;
        }

        /* ===== FOOTER ===== */
        .footer {
            padding: 12px 20px;
            border-top: 1px solid #ccc;
            margin-top: 20px;
            font-size: 9px;
            color: #888;
        }

        /* Page break hint */
        .page-break-before { page-break-before: always; }
    </style>
</head>
<body>

    {{-- ===== HEADER ===== --}}
    <div class="header">
        <div class="company-name">Princess Hijab</div>
        <div class="company-sub">Sistem Informasi Manajemen Keuangan UMKM</div>
        <div class="report-title">Laporan Rekap Omset per Pegawai</div>
    </div>

    {{-- ===== META INFO ===== --}}
    <div class="meta-info">
        <table>
            <tr>
                <td>Tanggal Cetak</td>
                <td>: {{ $tanggal }}</td>
            </tr>
            <tr>
                <td>Total Pegawai</td>
                <td>: {{ count($data_per_pegawai) }} pegawai</td>
            </tr>
            <tr>
                <td>Total Transaksi</td>
                <td>: {{ array_sum(array_map(fn($p) => count($p['transaksis']), $data_per_pegawai)) }} transaksi</td>
            </tr>
        </table>
    </div>

    {{-- ===== RINGKASAN ===== --}}
    <div class="summary-box">
        <div class="summary-title">Ringkasan Keseluruhan</div>
        <table class="summary-grid">
            <tr>
                @foreach($data_per_pegawai as $pg)
                <td>
                    <div class="summary-item-label">{{ $pg['nama_pegawai'] }}</div>
                    <div class="summary-item-value">Rp {{ number_format($pg['subtotal'], 0, ',', '.') }}</div>
                </td>
                @endforeach
            </tr>
        </table>
    </div>

    {{-- ===== TRANSAKSI PER PEGAWAI ===== --}}
    @foreach($data_per_pegawai as $loopIdx => $pg)

    {{-- Page break ab pegawai ke-2 dan seterusnya --}}
    @if($loopIdx > 0)
    <div style="margin-bottom: 10px;"></div>
    @endif

    <div class="pegawai-section">
        {{-- Heading Pegawai --}}
        <div class="pegawai-heading">
            <span class="pg-id">ID: {{ $pg['id_pegawai'] }}</span>
            {{ $pg['nama_pegawai'] }}
        </div>

        {{-- Tabel Transaksi --}}
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 28px;">No</th>
                    <th style="width: 80px;">ID Transaksi</th>
                    <th style="width: 110px;">Waktu (WIB)</th>
                    <th>Produk</th>
                    <th style="width: 55px;">Ukuran</th>
                    <th style="width: 55px;">Jenis</th>
                    <th style="width: 80px;">Lokasi</th>
                    <th style="width: 45px;">Jumlah</th>
                    <th style="width: 95px;">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pg['transaksis'] as $i => $trx)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>TRX-{{ $trx->id }}</td>
                    <td>{{ $trx->waktu_wib }}</td>
                    <td class="text-left">{{ $trx->produk->nama_produk ?? 'Produk Terhapus' }}</td>
                    <td>{{ $trx->produk->ukuran ?? '-' }}</td>
                    <td>{{ $trx->produk->jenis ?? '-' }}</td>
                    <td>{{ $trx->jongko->nama_jongko ?? '-' }}</td>
                    <td>{{ $trx->jumlah_terjual }} pcs</td>
                    <td class="text-right">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach

                {{-- Subtotal per pegawai --}}
                <tr class="subtotal-row">
                    <td colspan="8" class="text-right">
                        SUBTOTAL OMSET — {{ $pg['nama_pegawai'] }}:
                    </td>
                    <td class="text-right">Rp {{ number_format($pg['subtotal'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @endforeach

    {{-- ===== GRAND TOTAL ===== --}}
    <div class="grand-total-section">
        <div class="grand-total-box">
            <div class="grand-total-label">🏆 Grand Total Omset Keseluruhan</div>
            <div class="grand-total-value">Rp {{ number_format($grand_total, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- ===== FOOTER ===== --}}
    <div class="footer">
        Dicetak otomatis oleh Sistem Aplikasi Princess Hijab. Dokumen ini bersifat internal dan rahasia.
        &nbsp;&nbsp;|&nbsp;&nbsp; Waktu transaksi menggunakan timezone WIB (Asia/Jakarta).
    </div>

</body>
</html>