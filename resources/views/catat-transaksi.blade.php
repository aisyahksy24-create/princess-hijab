<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Catat Transaksi - Princess Hijab</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap" rel="stylesheet">

    <style>
        * {
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }
        
        html, body {
            margin: 0px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5; 
        }
        
        a {
            text-decoration: none;
        }

        .android-compact {
            background-color: #ffffff;
            overflow: hidden;
            width: 412px;
            height: 917px;
            position: relative;
            border: 1px solid #000000;
            box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
        }

        .android-compact .bg-gradient-top {
            position: absolute;
            top: -83px;
            left: -21px;
            width: 465px;
            height: 386px;
            border-radius: 50%;
            background: linear-gradient(208deg, #fdf6c8 25%, #ffffff 82%);
            z-index: 1;
        }
        
        .android-compact .bg-gradient-bottom {
            position: absolute;
            top: 535px;
            left: 0;
            width: 424px;
            height: 382px;
            background: linear-gradient(180deg, #ffffff 0%, #f5b9db 100%);
            z-index: 1;
        }

        .android-compact .header-card {
            position: absolute;
            width: 354px; 
            top: 36px;
            left: 31px;
            height: 74px;
            border-radius: 40px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            background: linear-gradient(180deg, #ffffff 0%, #f5b9db 73%);
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
        }
        
        .header-title {
            font-family: "Montserrat Alternates", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 23px;
        }
        
        .header-icon-container {
            width: 38px;
            height: 38px;
            background-color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.15);
        }
        
        .header-icon {
            font-size: 18px;
            color: #000000;
        }

        .form-container {
            position: absolute;
            top: 150px;
            left: 42px;
            width: 327px;
            height: 600px;
            background-color: rgba(193, 214, 243, 0.48); 
            border-radius: 30px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            z-index: 2;
            padding: 25px 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }
        
        .form-group label {
            font-family: "Montserrat Alternates", sans-serif;
            font-weight: 600;
            font-size: 16px;
            color: #000000;
            width: 90px;
        }
        
        .form-control {
            width: 185px;
            height: 38px;
            background-color: #ffffff;
            border: 1px solid #000000;
            border-radius: 15px;
            padding: 0 15px;
            font-family: "Montserrat Alternates", sans-serif;
            font-size: 14px;
            outline: none;
        }
        
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'><path d='M0 3l5 5 5-5z' fill='%23000'/></svg>");
            background-repeat: no-repeat;
            background-position: right 15px center;
        }

        .total-box {
            background-color: #fdf6c8;
            border: 1px solid #000000;
            border-radius: 15px;
            height: 45px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            margin-top: 15px;
        }
        
        .total-box span {
            font-family: "Montserrat Alternates", sans-serif;
            font-weight: 600;
            font-size: 16px;
            color: #000000;
        }

        .action-container {
            position: absolute;
            bottom: 50px;
            left: 42px;
            width: 327px;
            display: flex;
            justify-content: space-between;
            z-index: 3;
        }
        
        .btn-action {
            width: 145px;
            height: 50px;
            background-color: #c1d6f3;
            border: 1px solid #000000;
            border-radius: 20px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            font-family: "Montserrat Alternates", sans-serif;
            font-weight: 600;
            font-size: 18px;
            color: #000000;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .btn-action:hover {
            transform: scale(1.05);
        }

        .ellipse-base {
            position: absolute;
            border-radius: 50%;
            z-index: 2; 
        }
        .ellipse-1 { top: 780px; left: -20px; width: 70px; height: 65px; background-color: #f5b9db; }
        .ellipse-2 { top: 830px; left: 280px; width: 58px; height: 53px; background-color: #d6fccd; }
        .ellipse-3 { top: 840px; left: 100px; width: 100px; height: 90px; background-color: #fdf6c8; }
        .ellipse-4 { top: 730px; left: 340px; width: 80px; height: 80px; background-color: #c1d6f3; }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 8px;
            border-radius: 10px;
            font-size: 12px;
            text-align: center;
            margin-bottom: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="android-compact">
        <div class="bg-gradient-top"></div>
        <div class="bg-gradient-bottom"></div>

        <div class="header-card">
            <span class="header-title">Catat Transaksi</span>
            <div class="header-icon-container">
                <i class="fa-solid fa-heart header-icon"></i>
            </div>
        </div>

        <div class="form-container">
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div style="font-size: 13px; font-weight: 600; text-align: center; margin-bottom: 15px; color: #333;">
                📍 Lokasi Kerja: <span style="color: #ff477e;">{{ session('nama_jongko_aktif') }}</span>
            </div>

            <form id="form-transaksi" action="{{ url('/store-transaksi') }}" method="POST" style="display: flex; flex-direction: column;">
                @csrf
                
                <input type="hidden" name="produk_id" id="produk_id_hidden" required>
                
                <div class="form-group">
                    <label>Tanggal:</label>
                    <input type="text" class="form-control" value="{{ date('Y-m-d') }}" readonly style="background-color: #e9ecef; color: #495057;">
                </div>

                <div class="form-group">
                    <label>Produk:</label>
                    <select id="select_nama_produk" class="form-control" onchange="updateKombinasiProduk()" required>
                        <option value="">Pilih Produk</option>
                        @foreach($data_produk->unique('nama_produk') as $p)
                            <option value="{{ $p->nama_produk }}">{{ $p->nama_produk }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Ukuran:</label>
                    <select id="select_ukuran" class="form-control" onchange="updateKombinasiProduk()" required>
                        <option value="">Pilih Ukuran</option>
                        @foreach($data_produk->unique('ukuran') as $p)
                            <option value="{{ $p->ukuran }}">{{ $p->ukuran }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jenis:</label>
                    <select id="select_jenis" class="form-control" onchange="updateKombinasiProduk()" required>
                        <option value="">Pilih Jenis</option>
                        @foreach($data_produk->unique('jenis') as $p)
                            <option value="{{ $p->jenis }}">{{ $p->jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah:</label>
                    <input type="number" name="jumlah_terjual" id="jumlah_terjual" class="form-control" placeholder="0" min="1" required oninput="hitungTotalOtomatis()">
                </div>

                <div class="form-group">
                    <label>Harga Jual:</label>
                    <input type="number" name="harga_satuan" id="harga_satuan" class="form-control" placeholder="Rp 0" min="0" required oninput="hitungTotalOtomatis()">
                </div>

                <div class="total-box">
                    <span id="label-total-harga">Total: Rp 0</span>
                </div>
            </form>
        </div>

        <div class="action-container">
            <button type="button" class="btn-action" onclick="location.href='{{ url('/pilih-jongko') }}'">Ganti Blok</button>
            <button type="button" class="btn-action" onclick="submitFormTransaksi()">Tambah</button>
        </div>

        <div class="ellipse-base ellipse-1"></div>
        <div class="ellipse-base ellipse-2"></div>
        <div class="ellipse-base ellipse-3"></div>
        <div class="ellipse-base ellipse-4"></div>
    </div>

    <script>
        // Membuka data produk dari database Laravel menjadi bentuk Array JavaScript
        const listProduks = @json($data_produk);

        // Fungsi mencocokkan kombinasi Nama + Ukuran + Jenis untuk mencari Produk ID asli
        function updateKombinasiProduk() {
            const nama = document.getElementById('select_nama_produk').value;
            const ukuran = document.getElementById('select_ukuran').value;
            const jenis = document.getElementById('select_jenis').value;
            const hiddenInput = document.getElementById('produk_id_hidden');

            // Cari di dalam array produk yang speksifikasinya cocok 100%
            const produkCocok = listProduks.find(p => p.nama_produk === nama && p.ukuran === ukuran && p.jenis === jenis);

            if (produkCocok) {
                hiddenInput.value = produkCocok.id; // Pasang ID-nya ke input tersembunyi
            } else {
                hiddenInput.value = ""; // Kosongkan jika kombinasi tidak ditemukan
            }
        }

        // Fungsi Hitung Perkalian Real-Time
        function hitungTotalOtomatis() {
            const jumlah = document.getElementById('jumlah_terjual').value || 0;
            const harga = document.getElementById('harga_satuan').value || 0;
            const total = parseInt(jumlah) * parseInt(harga);
            document.getElementById('label-total-harga').innerText = "Total: Rp " + total.toLocaleString('id-ID');
        }

        // Validasi sebelum submit form
        function submitFormTransaksi() {
            const produkId = document.getElementById('produk_id_hidden').value;
            if (!produkId) {
                alert("Maaf, kombinasi Produk, Ukuran, dan Jenis tersebut tidak terdaftar di database Admin. Silakan cek kembali!");
                return;
            }
            document.getElementById('form-transaksi').submit();
        }
    </script>

</body>
</html>