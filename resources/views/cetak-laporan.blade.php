<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8" />
    <title>Cetak Laporan - Princess Hijab</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <style>
        .cetak-laporan-container {
            display: flex;
            flex-direction: column;
            padding: 0 25px 120px;
        }

        /* Header */
        .cl-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }
        .cl-header .cl-title {
            font-size: 20px;
            font-weight: 700;
        }
        .cl-header a img {
            width: 34px;
            height: 34px;
        }

        /* Section label */
        .section-label {
            font-size: 12px;
            font-weight: 600;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }

        /* Period Picker Card */
        .period-card {
            background: rgba(255,255,255,0.75);
            border-radius: 20px;
            border: 1.5px solid #000;
            padding: 20px;
            margin-bottom: 20px;
            backdrop-filter: blur(6px);
        }
        .period-card label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .period-input {
            width: 100%;
            height: 46px;
            background: #fff;
            border-radius: 14px;
            border: 1.5px solid #000;
            padding: 0 16px;
            font-family: "Montserrat Alternates", sans-serif;
            font-size: 14px;
            font-weight: 600;
            outline: none;
            cursor: pointer;
            -webkit-appearance: none;
            appearance: none;
        }
        .period-input:focus {
            border-color: #f5b9db;
            box-shadow: 0 0 0 3px rgba(245,185,219,0.3);
        }

        /* Preview Cards */
        .preview-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }
        .preview-card {
            background: rgba(255,255,255,0.75);
            border-radius: 18px;
            border: 1.5px solid #000;
            padding: 16px 14px;
            backdrop-filter: blur(6px);
        }
        .preview-card .pc-label {
            font-size: 11px;
            font-weight: 600;
            color: #666;
            margin-bottom: 6px;
        }
        .preview-card .pc-value {
            font-size: 15px;
            font-weight: 700;
            color: #222;
        }
        .preview-card.card-omset { background: rgba(253,246,200,0.8); }
        .preview-card.card-pengeluaran { background: rgba(245,185,219,0.7); }
        .preview-card.card-laba { background: rgba(184,230,173,0.8); }
        .preview-card.card-loading .pc-value { color: #aaa; font-size: 13px; }

        /* Laba besar fullwidth */
        .preview-laba-full {
            grid-column: 1 / -1;
        }

        /* Download Button */
        .btn-download-pdf {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            height: 54px;
            background: #000;
            color: #fff;
            border-radius: 18px;
            border: none;
            font-family: "Montserrat Alternates", sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-top: 8px;
        }
        .btn-download-pdf:hover {
            background: #333;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        .btn-download-pdf:active {
            transform: translateY(0px);
        }

        /* Info box */
        .info-box {
            background: rgba(193,214,243,0.5);
            border: 1px solid rgba(193,214,243,0.9);
            border-radius: 14px;
            padding: 12px 15px;
            font-size: 11px;
            color: #444;
            line-height: 1.6;
            margin-top: 16px;
        }
        .info-box strong { color: #000; }

        /* Loading state */
        .loading-dots span {
            display: inline-block;
            animation: dot-bounce 1.2s infinite;
        }
        .loading-dots span:nth-child(2) { animation-delay: 0.2s; }
        .loading-dots span:nth-child(3) { animation-delay: 0.4s; }
        @keyframes dot-bounce {
            0%, 80%, 100% { opacity: 0.2; }
            40% { opacity: 1; }
        }
    </style>
</head>
<body>
<div class="android-compact page-cetak-laporan">
    <div class="bg-pink-top" style="height: 130px;"></div>

    <div class="cetak-laporan-container">
        {{-- Header --}}
        <div class="cl-header">
            <div>
                <div class="cl-title">Cetak Laporan</div>
                <div style="font-size: 12px; font-weight:500; color:#555;">Keuangan Bulanan</div>
            </div>
            <a href="{{ url('/dashboard-admin') }}" title="Kembali">
                <img src="{{ asset('images/keluar.svg') }}" alt="Kembali" style="width:34px;height:34px;">
            </a>
        </div>

        {{-- Period Picker --}}
        <div class="section-label">Pilih Periode</div>
        <div class="period-card">
            <label for="bulan-laporan">Bulan &amp; Tahun</label>
            <input
                type="month"
                id="bulan-laporan"
                class="period-input"
                value="{{ now()->format('Y-m') }}"
                onchange="updatePreview(this.value)"
            >
        </div>

        {{-- Preview Cards --}}
        <div class="section-label">Pratinjau Data</div>
        <div class="preview-grid">
            <div class="preview-card card-omset" id="card-omset">
                <div class="pc-label">💰 Total Omset</div>
                <div class="pc-value" id="val-omset">
                    <span class="loading-dots"><span>.</span><span>.</span><span>.</span></span>
                </div>
            </div>
            <div class="preview-card card-pengeluaran" id="card-pengeluaran">
                <div class="pc-label">💸 Total Pengeluaran</div>
                <div class="pc-value" id="val-pengeluaran">
                    <span class="loading-dots"><span>.</span><span>.</span><span>.</span></span>
                </div>
            </div>
            <div class="preview-card card-laba preview-laba-full" id="card-laba">
                <div class="pc-label">📊 Laba Bersih</div>
                <div class="pc-value" id="val-laba">
                    <span class="loading-dots"><span>.</span><span>.</span><span>.</span></span>
                </div>
            </div>
        </div>

        {{-- Download Button --}}
        <a id="btn-cetak" href="{{ url('/cetak-laporan-bulanan/pdf?bulan=' . now()->format('Y-m')) }}" class="btn-download-pdf" target="_blank">
            🖨️ &nbsp;Unduh PDF Laporan
        </a>


    </div>

    {{-- Bottom Nav --}}
    <div class="admin-bottom-nav">
        <a href="{{ url('/dashboard-admin') }}" class="nav-link">
            <img src="{{ asset('images/rumah.svg') }}" alt="Rumah" />
        </a>
        <a href="{{ url('/rekap-omset') }}" class="nav-link">
            <img src="{{ asset('images/uang.svg') }}" alt="Uang" />
        </a>
        <a href="{{ url('/pengeluaran') }}" class="nav-link">
            <img src="{{ asset('Images/dompet hitam.svg') }}" alt="Dompet" />
        </a>
        <a href="{{ url('/pendataan') }}" class="nav-link">
            <img src="{{ asset('images/catatan-hitam.svg') }}" alt="Catatan" />
        </a>
    </div>
</div>

<script>
    function formatRupiah(angka) {
        return 'Rp ' + Math.round(angka).toLocaleString('id-ID');
    }

    function setLoading() {
        const loading = '<span class="loading-dots"><span>.</span><span>.</span><span>.</span></span>';
        document.getElementById('val-omset').innerHTML = loading;
        document.getElementById('val-pengeluaran').innerHTML = loading;
        document.getElementById('val-laba').innerHTML = loading;
    }

    function updatePreview(bulanVal) {
        if (!bulanVal) return;

        // Update tombol unduh
        document.getElementById('btn-cetak').href = '/cetak-laporan-bulanan/pdf?bulan=' + bulanVal;

        setLoading();

        fetch('/api/preview-laporan?bulan=' + bulanVal)
            .then(r => r.json())
            .then(data => {
                document.getElementById('val-omset').textContent = formatRupiah(data.omset);
                document.getElementById('val-pengeluaran').textContent = formatRupiah(data.pengeluaran);

                const laba = data.laba;
                const labaEl = document.getElementById('val-laba');
                labaEl.textContent = formatRupiah(laba);
                labaEl.style.color = laba >= 0 ? '#2e7d32' : '#c62828';
            })
            .catch(() => {
                document.getElementById('val-omset').textContent = 'Gagal memuat';
                document.getElementById('val-pengeluaran').textContent = 'Gagal memuat';
                document.getElementById('val-laba').textContent = 'Gagal memuat';
            });
    }

    // Load pada saat halaman dibuka
    window.onload = function() {
        const bulanInput = document.getElementById('bulan-laporan');
        updatePreview(bulanInput.value);
    };
</script>
<script src="{{ asset('js/shared.js') }}"></script>
</body>
</html>
