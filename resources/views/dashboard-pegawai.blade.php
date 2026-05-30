<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8" />
    <title>Catat Transaksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@600&display=swap');

        * {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
            font-family: 'Montserrat Alternates', sans-serif;
        }

        /* CONTAINER UTAMA (PERSIS SEPERTI ANDROID COMPACT FIGMA) */
        .phone-container {
            width: 412px;
            height: 917px;
            background: linear-gradient(180deg, #FFFDE8 0%, #FAD5E9 50%, #F5B9DB 100%);
            position: relative;
            border: 2px solid #000;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 25px;
        }

        /* HEADER DENGAN ICON HEART SEPERTI FIGMA */
        .header-area {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 35px;
            position: relative;
            z-index: 10;
        }

        .title-box {
            background: linear-gradient(180deg, #ffffff 0%, #fbc2eb 100%);
            padding: 12px 35px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 20px;
            border: 2px solid #000;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        /* UKURAN ASSET UTK LOVE-HITAM.SVG AGAR SESUAI FIGMA */
        .title-box .love-icon-img {
            width: 24px;
            height: 24px;
            object-fit: contain;
            display: inline-block;
        }

        /* WRAPPER FORM (KOTAK UNGU/BIRU MUDA PASTEL) - PERBAIKAN PRESISI */
        .form-card {
            width: 100%;
            background-color: rgba(225, 233, 252, 0.8);
            border: 2px solid #000;
            border-radius: 30px;
            padding: 30px 20px 35px; /* Sesuaikan padding agar lebih rata */
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 16px; /* Mengurangi gap sedikit agar tidak terlalu renggang */
            margin-bottom: auto;
            position: relative;
        }

        .form-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-group label {
            font-size: 15px;
            font-weight: 600;
            color: #000;
            width: 110px; /* Sedikit dilebarkan untuk kenyamanan teks */
        }

        .form-control {
            width: 190px; /* Sedikit disesuaikan agar proporsional di dalam kotak */
            height: 42px;
            background-color: #ffffff;
            border: 2px solid #000000;
            border-radius: 15px;
            padding: 0 15px;
            font-family: 'Montserrat Alternates', sans-serif;
            font-size: 14px;
            font-weight: 600;
            outline: none;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'></polyline></svg>");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 14px;
        }

        /* BOX TOTAL KUNING FIGMA */
        .total-box {
            width: 100%;
            height: 48px;
            background-color: #FDF6C8;
            border: 2px solid #000;
            border-radius: 15px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 10px;
        }

        /* 3 TOMBOL BERJAJAR DI BAWAH (KELUAR, TAMBAH, SIMPAN) */
        .action-area {
            width: 100%;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 20px;
            z-index: 10;
        }

        .btn-action {
            flex: 1;
            height: 48px;
            background-color: #C1D6F3;
            border: 2px solid #000000;
            border-radius: 15px;
            font-family: 'Montserrat Alternates', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #000;
            transition: transform 0.1s;
        }
        
        .btn-action:active {
            transform: scale(0.95);
        }

        /* BULATAN AKSEN WARNA DI BACKGROUND BAWAH */
        .bg-circle-blue {
            position: absolute;
            width: 60px;
            height: 60px;
            background-color: #A3C5F5;
            border-radius: 50%;
            bottom: 110px;
            right: -15px;
            opacity: 0.8;
        }
        .bg-circle-pink {
            position: absolute;
            width: 50px;
            height: 50px;
            background-color: #F8A5C2;
            border-radius: 50%;
            bottom: 90px;
            left: -15px;
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <div class="phone-container">
        
        <div class="header-area">
            <div class="title-box">
                Catat Transaksi <img src="{{ asset('Images/love-hitam.svg') }}" class="love-icon-img" alt="Love Icon">
            </div>
        </div>

        <div class="bg-circle-blue"></div>
        <div class="bg-circle-pink"></div>

        <form id="transaction-form" action="{{ url('/store-transaksi') }}" method="POST" style="width:100%; display:contents;">
            @csrf

            <div class="form-card">
                <div class="form-group">
                    <label>Tanggal:</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label>Produk:</label>
                    <select name="produk" class="form-control" required>
                        <option value="">Pilih Produk</option>
                        <option value="Segi Empat">Segi Empat</option>
                        <option value="Pashmina">Pashmina</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ukuran:</label>
                    <select name="ukuran" class="form-control" required>
                        <option value="">Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jenis:</label>
                    <select name="jenis" class="form-control" required>
                        <option value="">Pilih Bahan</option>
                        <option value="Poliatur">Poliatur</option>
                        <option value="Ceruty">Ceruty</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah:</label>
                    <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="0" min="0" oninput="hitungTotalOtomatis()" required>
                </div>

                <div class="form-group">
                    <label>Harga Jual:</label>
                    <input type="number" id="harga" name="harga_jual" class="form-control" placeholder="Rp 0" min="0" oninput="hitungTotalOtomatis()" required>
                </div>

                <div class="total-box" id="total-display">
                    Total: Rp 0
                </div>
            </div>

            <div class="action-area">
                <button type="button" class="btn-action" onclick="window.location.href='http://laravel12.test/login'">Keluar</button>
                <button type="button" class="btn-action" onclick="transaksiSelanjutnya()">Tambah</button>
                <button type="submit" class="btn-action">Simpan</button>
            </div>

        </form>
    </div>

<script>
    // 1. Fungsi perkalian otomatis real-time (Jumlah x Harga Jual)
    function hitungTotalOtomatis() {
        const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
        const harga = parseFloat(document.getElementById('harga').value) || 0;
        const total = jumlah * harga;

        const formatRupiah = new Intl.NumberFormat('id-ID', {
            style: 'decimal',
            maximumFractionDigits: 0
        }).format(total);

        document.getElementById('total-display').innerText = "Total: Rp " + formatRupiah;
    }

    // 2. Fungsi tombol Tambah untuk mengosongkan kembali form isian
    function transaksiSelanjutnya() {
        document.getElementById('jumlah').value = '';
        document.getElementById('harga').value = '';
        document.getElementById('transaction-form').reset();
        document.getElementById('total-display').innerText = "Total: Rp 0";
    }

    // 3. LOGIKA MESSAGE BOX SETELAH DATA BERHASIL DISIMPAN KE DATABASE
    // Membaca session flash dari controller Laravel jika sukses
    @if(session('success'))
        Swal.fire({
            title: "Berhasil!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonColor: "#C1D6F3",
            confirmButtonText: "Selesai"
        });
    @endif
</script>

</body>
</html>