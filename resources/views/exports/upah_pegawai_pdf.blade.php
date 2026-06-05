<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penggajian Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 22px;
            color: #4A4A4A;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #777;
            font-size: 11px;
        }
        .meta-info {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 10px 8px;
            font-weight: bold;
            text-align: center;
            color: #495057;
        }
        table td {
            border: 1px solid #dee2e6;
            padding: 10px 8px;
            text-align: center;
        }
        .total-row {
            font-weight: bold;
            background-color: #e6f2ff; /* Warna soft blue pembeda untuk total gaji */
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 60px;
            text-align: right;
            font-size: 11px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>PRINCESS HIJAB</h2>
        <p>Laporan Penggajian & Upah Harian Pegawai</p>
    </div>

    <div class="meta-info">
        <strong>Perihal:</strong> Slip Rekapitulasi Gaji Harian Pegawai<br>
        <strong>Tanggal Cetak:</strong> {{ $tanggal }}
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 10%">No</th>
                <th style="width: 30%">Nama Pegawai</th>
                <th style="width: 25%">Lokasi Jongko</th>
                <th style="width: 15%">Unit Terjual</th>
                <th style="width: 20%">Total Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @foreach($upah_data as $index => $upah)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left; font-weight: bold;">{{ $upah['nama_pegawai'] }}</td>
                    <td>{{ $upah['nama_jongko'] }}</td>
                    <td>{{ $upah['unit_terjual'] }} pcs</td>
                    <td class="text-right" style="font-weight: bold; color: #2e7d32;">
                        Rp {{ number_format($upah['upah_bersih'], 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            
            <tr class="total-row">
                <td colspan="4" class="text-right">TOTAL DANA YANG HARUS DIKELUARKAN:</td>
                <td class="text-right" style="color: #d32f2f;">Rp {{ number_format($total_pengeluaran_gaji, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak otomatis secara sah oleh Aplikasi Rekapitulasi Princess Hijab.</p>
    </div>

</body>
</html>