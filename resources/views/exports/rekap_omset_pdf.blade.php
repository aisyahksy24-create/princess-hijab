<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rekap Omset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            font-size: 20px;
            letter-spacing: 1px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
        }
        .meta-info {
            margin-bottom: 15px;
            font-style: italic;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            padding: 8px;
            font-weight: bold;
            text-align: center;
        }
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .total-row {
            font-weight: bold;
            background-color: #eaf2ff;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>PRINCESS HIJAB</h2>
        <p>Sistem Informasi Manajemen Aplikasi Kelola Toko & UMKM</p>
    </div>

    <div class="meta-info">
        <strong>Perihal:</strong> Laporan Rekap Omset Bulanan<br>
        <strong>Tanggal Cetak:</strong> {{ $tanggal }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Lokasi Jongko</th>
                <th>Produk Terjual</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data_transaksi as $index => $trx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>TRX-{{ $trx->id }}</td>
                    <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $trx->jongko->nama_jongko ?? 'Jongko Umum' }}</td>
                    <td>{{ $trx->produk->nama_produk ?? 'Produk Terhapus' }}</td>
                    <td>{{ $trx->jumlah_terjual }} pcs</td>
                    <td class="text-right">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            
            <tr class="total-row">
                <td colspan="6" class="text-right">TOTAL OMSET KESELURUHAN:</td>
                <td class="text-right">Rp {{ number_format($total_omset, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak otomatis oleh Sistem Aplikasi Princess Hijab.</p>
    </div>

</body>
</html>