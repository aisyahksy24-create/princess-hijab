<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rekap Omset</title>
    <style>
        @import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");
        * {
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }
        html,
        body {
            margin: 0px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
        }
        button:focus-visible {
            outline: 2px solid #4a90e2 !important;
        }
        a {
            text-decoration: none;
        }

        @font-face {
            font-family: "Montserrat Alternates-SemiBold";
            src: local("Montserrat Alternates-SemiBold");
        }
        
        /* CONTAINER UTAMA */
        .android-compact {
            background-color: #ffffff;
            overflow: hidden;
            width: 412px;
            height: 917px;
            position: relative;
            border: 2px solid #000;
        }

        .android-compact .rectangle {
            position: absolute;
            top: 67px;
            left: 173px;
            width: 277px;
            height: 61px;
            border-radius: 30px;
            background: linear-gradient(
                90deg,
                rgba(245, 185, 219, 1) 0%,
                rgba(193, 214, 243, 1) 48%
            );
        }

        .android-compact .text-wrapper {
            position: absolute;
            top: 79px;
            left: 201px;
            width: 234px;
            font-family: "Montserrat Alternates-SemiBold", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 30px;
            letter-spacing: 0;
            line-height: normal;
        }

        .android-compact .div {
            position: absolute;
            top: 658px;
            left: 0;
            width: 450px;
            height: 272px;
            background: linear-gradient(
                180deg,
                rgba(255, 255, 255, 1) 0%,
                rgba(245, 185, 219, 1) 100%
            );
        }

        .android-compact .solar-heart-bold {
            position: absolute;
            top: 75px;
            left: 160px;
            width: 36px;
            height: 36px;
            display: flex;
            aspect-ratio: 1;
        }

        /* TOMBOL KELUAR -> DASHBOARD-ADMIN */
        .android-compact .material-symbols {
            position: absolute;
            top: 80px;
            left: 27px;
            width: 35px;
            height: 35px;
            display: flex;
            aspect-ratio: 1;
            cursor: pointer;
        }
        
        .android-compact .material-symbols img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* BUTTON TOGGLE REKAP */
        .android-compact .toggle-btn-hari {
            position: absolute;
            top: 169px;
            left: 32px;
            width: 158px;
            height: 43px;
            border-radius: 20px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .android-compact .toggle-btn-bulan {
            position: absolute;
            top: 169px;
            left: 212px;
            width: 172px;
            height: 43px;
            border-radius: 20px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-active {
            background-color: #c1d6f3 !important;
            border: 1px solid #000000 !important;
        }
        .btn-inactive {
            background-color: #dad5d5 !important;
            border: none !important;
        }

        .android-compact .text-wrapper-2, 
        .android-compact .text-wrapper-3 {
            font-family: "Montserrat Alternates-SemiBold", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        /* MAIN CARD BODY */
        .android-compact .rectangle-4 {
            position: absolute;
            top: 241px;
            left: 29px;
            width: 355px;
            height: 498px;
            background-color: #b3b3b354;
            border-radius: 40px;
            box-shadow: 0px 4px 4px #00000040;
        }

        /* CONTAINER FILTER DROPDOWN KALENDER */
        .android-compact .datepicker-container {
            position: absolute;
            top: 261px;
            left: 207px;
            width: 141px;
            height: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            border: 1px solid #000000;
            cursor: pointer;
        }

        .android-compact .rectangle-6 {
            position: absolute;
            top: 261px;
            left: 313px;
            width: 35px;
            height: 30px;
            background-color: #f5b9db;
            border-radius: 10px;
            border: 1px solid #000000;
            pointer-events: none;
        }

        /* Input Kalender Native */
        .android-compact .native-picker {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 5;
        }

        .android-compact .native-picker::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .android-compact .vector-wrapper {
            position: absolute;
            top: 264px;
            left: 319px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .android-compact .vector-wrapper img {
            width: 16px;
            height: 16px;
            object-fit: contain;
            transform: rotate(-90deg);
        }

        .android-compact .text-wrapper-4 {
            position: absolute;
            top: 7px;
            left: 10px;
            width: 95px;
            font-family: "Montserrat Alternates-SemiBold", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 13px;
            letter-spacing: 0;
            line-height: normal;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            pointer-events: none;
        }

        .android-compact .text-wrapper-5 {
            position: absolute;
            top: 265px;
            left: 66px;
            width: 105px;
            font-family: "Montserrat Alternates-SemiBold", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 14px;
            letter-spacing: 0;
            line-height: normal;
            text-decoration: underline;
        }

        /* LIST JONGKO BOXES */
        .android-compact .rectangle-7,
        .android-compact .rectangle-8,
        .android-compact .rectangle-9,
        .android-compact .rectangle-10 {
            position: absolute;
            width: 299px;
            height: 44px;
            background-color: #ffffff;
            border-radius: 20px;
        }

        .android-compact .rectangle-7 { top: 324px; left: 55px; }
        .android-compact .rectangle-8 { top: 386px; left: 56px; }
        .android-compact .rectangle-9 { top: 453px; left: 55px; }
        .android-compact .rectangle-10 { top: 522px; left: 55px; }

        .android-compact .text-wrapper-6,
        .android-compact .text-wrapper-7,
        .android-compact .text-wrapper-8,
        .android-compact .text-wrapper-9 {
            position: absolute;
            left: 71px;
            width: 140px;
            font-family: "Montserrat Alternates-SemiBold", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 14px;
            letter-spacing: 0;
            line-height: normal;
            text-decoration: underline;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .android-compact .text-wrapper-6 { top: 335px; }
        .android-compact .text-wrapper-7 { top: 397px; }
        .android-compact .text-wrapper-8 { top: 464px; }
        .android-compact .text-wrapper-9 { top: 532px; }

        .android-compact .text-wrapper-10,
        .android-compact .text-wrapper-11,
        .android-compact .text-wrapper-12,
        .android-compact .text-wrapper-13 {
            position: absolute;
            width: 110px;
            font-family: "Montserrat Alternates-SemiBold", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 14px;
            letter-spacing: 0;
            line-height: normal;
            text-align: right;
        }

        .android-compact .text-wrapper-10 { top: 335px; left: 220px; }
        .android-compact .text-wrapper-11 { top: 397px; left: 220px; }
        .android-compact .text-wrapper-12 { top: 462px; left: 220px; }
        .android-compact .text-wrapper-13 { top: 533px; left: 220px; }

        /* TOTAL AREA */
        .android-compact .rectangle-11 {
            position: absolute;
            top: 596px;
            left: 163px;
            width: 197px;
            height: 97px;
            background-color: #fdf6c8;
            border-radius: 30px;
        }

        .android-compact .rectangle-12 {
            position: absolute;
            top: 596px;
            left: 45px;
            width: 105px;
            height: 93px;
            background-color: #f5b9db;
            border-radius: 30px;
        }

        .android-compact .text-wrapper-14 {
            top: 635px;
            left: 175px;
            width: 180px;
            font-size: 21px;
            position: absolute;
            font-family: "Montserrat Alternates-SemiBold", sans-serif;
            font-weight: 600;
            color: #000000;
            letter-spacing: 0;
            line-height: normal;
        }

        .android-compact .text-wrapper-15 {
            position: absolute;
            top: 608px;
            left: 185px;
            width: 142px;
            font-family: "Montserrat Alternates-SemiBold", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 14px;
            text-align: center;
            letter-spacing: 0;
            line-height: normal;
        }

        .android-compact .streamline-ultimate {
            position: absolute;
            top: 613px;
            left: 68px;
            width: 59px;
            height: 59px;
            aspect-ratio: 1;
        }

        .android-compact .line {
            position: absolute;
            top: 148px;
            left: 0;
            width: 412px;
            height: 2px;
        }

        /* BOTTOM NAVBAR */
        .android-compact .rectangle-13 {
            position: absolute;
            top: 797px;
            left: 56px;
            width: 301px;
            height: 60px;
            border-radius: 40px;
            box-shadow: 0px 4px 4px #00000040;
            background: linear-gradient(
                0deg,
                rgba(255, 255, 255, 1) 0%,
                rgba(184, 230, 173, 1) 100%
            );
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 0 10px;
        }

        .android-compact .nav-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            transition: background-color 0.2s ease;
        }

        .android-compact .nav-link.active {
            background-color: #C1D6F3;
            border: 1.5px solid #000000;
        }

        .android-compact .nav-link img {
            width: 30px;
            height: 30px;
            object-fit: contain;
        }
    </style>
</head>
<body>

<div class="android-compact">
    <div class="rectangle"></div>
    <div class="text-wrapper">Rekap Omset</div>
    <div class="div"></div>
    
    <div class="solar-heart-bold">
        <img class="vector" src="{{ asset('Images/love-kecil.svg') }}" alt="Heart" />
    </div>
    
    <a href="{{ url('/dashboard-admin') }}" class="material-symbols" title="Keluar">
        <img src="{{ asset('Images/keluar.svg') }}" alt="Keluar" />
    </a>
    
    <button id="tabHari" class="toggle-btn-hari btn-active" onclick="gantiKeHari()">
        <span class="text-wrapper-2">Omset Perhari</span>
    </button>
    <button id="tabBulan" class="toggle-btn-bulan btn-inactive" onclick="gantiKeBulan()">
        <span class="text-wrapper-3">Omset Perbulan</span>
    </button>
    
    <div class="rectangle-4"></div>
    
    <div class="datepicker-container">
        <input type="date" id="kalenderInput" class="native-picker" onchange="ambilDataOmset(this.value)">
        <div id="valueFilter" class="text-wrapper-4">-</div>
    </div>
    <div class="rectangle-6"></div>
    
    <div class="vector-wrapper">
        <img src="{{ asset('Images/panah kecil.svg') }}" alt="Dropdown Arrow" />
    </div>
    
    <div id="labelFilter" class="text-wrapper-5">Pilih Tanggal</div>
    
    <div class="rectangle-7"></div>
    <div class="rectangle-8"></div>
    <div class="rectangle-9"></div>
    <div class="rectangle-10"></div>
    
    <div id="namaJongko1" class="text-wrapper-6">-</div>
    <div id="namaJongko2" class="text-wrapper-7">-</div>
    <div id="namaJongko3" class="text-wrapper-8">-</div>
    <div id="namaJongko4" class="text-wrapper-9">-</div>
    
    <div id="omsetA" class="text-wrapper-10">Rp. 0</div>
    <div id="omsetB" class="text-wrapper-11">Rp. 0</div>
    <div id="omsetC" class="text-wrapper-12">Rp. 0</div>
    <div id="omsetD" class="text-wrapper-13">Rp. 0</div>
    
    <div class="rectangle-11"></div>
    <div class="rectangle-12"></div>
    <div id="totalOmset" class="text-wrapper-14">Rp. 0</div>
    <div class="text-wrapper-15">Total Omset</div>
    <img class="streamline-ultimate" src="{{ asset('Images/kucing.svg') }}" alt="Lucky Cat" />
    
    <img class="line" src="{{ asset('Images/line-1.svg') }}" />

    <div class="rectangle-13">
        <a href="{{ url('/dashboard-admin') }}" class="nav-link">
            <img src="{{ asset('Images/rumah.svg') }}" alt="Rumah" />
        </a>
        <a href="{{ url('/rekap-omset') }}" class="nav-link active">
            <img src="{{ asset('Images/uang.svg') }}" alt="Uang" />
        </a>
        <a href="{{ url('/upah-pegawai') }}" class="nav-link">
            <img src="{{ asset('Images/tangan love.svg') }}" alt="Tangan Love" />
        </a>
        <a href="{{ url('/pendataan') }}" class="nav-link">
            <img src="{{ asset('Images/catatan hitam.svg') }}" alt="Catatan" />
        </a>
    </div>
</div>

<script>
    let modeAktif = "hari";

    // 1. SET TANGGAL DEFAULT SAAT HALAMAN PERTAMA KALI DIBUKA
    window.onload = function() {
        const hariIni = new Date();
        const yyyy = hariIni.getFullYear();
        const mm = String(hariIni.getMonth() + 1).padStart(2, '0');
        const dd = String(hariIni.getDate()).padStart(2, '0');
        
        document.getElementById('kalenderInput').value = `${yyyy}-${mm}-${dd}`;
        ambilDataOmset(`${yyyy}-${mm}-${dd}`);
    }

    // 2. TOMBOL REKAP HARIAN AKTIF
    function gantiKeHari() {
        modeAktif = "hari";
        document.getElementById('tabHari').className = "toggle-btn-hari btn-active";
        document.getElementById('tabBulan').className = "toggle-btn-bulan btn-inactive";
        document.getElementById('labelFilter').innerText = "Pilih Tanggal";

        const input = document.getElementById('kalenderInput');
        input.type = "date";
        
        const hariIni = new Date();
        const yyyy = hariIni.getFullYear();
        const mm = String(hariIni.getMonth() + 1).padStart(2, '0');
        const dd = String(hariIni.getDate()).padStart(2, '0');
        input.value = `${yyyy}-${mm}-${dd}`;
        
        ambilDataOmset(input.value);
    }

    // 3. TOMBOL REKAP BULANAN AKTIF
    function gantiKeBulan() {
        modeAktif = "bulan";
        document.getElementById('tabHari').className = "toggle-btn-hari btn-inactive";
        document.getElementById('tabBulan').className = "toggle-btn-bulan btn-active";
        document.getElementById('labelFilter').innerText = "Pilih Bulan";

        const input = document.getElementById('kalenderInput');
        input.type = "month";
        
        const hariIni = new Date();
        const yyyy = hariIni.getFullYear();
        const mm = String(hariIni.getMonth() + 1).padStart(2, '0');
        input.value = `${yyyy}-${mm}`;
        
        ambilDataOmset(input.value);
    }

    // 4. FORMAT MENGUBAH ANGKA MENJADI RUPIAH (Rp. XX.XXX)
    function formatRupiah(angka) {
        return "Rp. " + Number(angka).toLocaleString('id-ID');
    }

    // 5. AJAX FETCH UNTUK DATA REKAP OMSET DINAMIS
    function ambilDataOmset(nilaiKalender) {
        if (!nilaiKalender) return;

        // Mengubah format teks filter di dalam kotak figma
        const namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const dateObj = new Date(nilaiKalender);

        if (modeAktif === "hari") {
            const tanggal = dateObj.getDate().toString().padStart(2, '0');
            const bulan = namaBulan[dateObj.getMonth()];
            const tahun = dateObj.getFullYear();
            document.getElementById('valueFilter').innerText = `${tanggal} ${bulan} ${tahun}`;
        } else {
            const bulan = namaBulan[dateObj.getMonth()];
            const tahun = dateObj.getFullYear();
            document.getElementById('valueFilter').innerText = `${bulan} ${tahun}`;
        }

        // Ambil data dari API Laravel
        fetch(`/api/ambil-rekap?mode=${modeAktif}&waktu=${nilaiKalender}`)
            .then(response => response.json())
            .then(data => {
                // Reset semua teks nama ke tanda strip dan omset ke Rp. 0
                for (let i = 1; i <= 4; i++) {
                    const elemenNama = document.getElementById(`namaJongko${i}`);
                    const elemenOmset = document.getElementById(i === 1 ? 'omsetA' : i === 2 ? 'omsetB' : i === 3 ? 'omsetC' : 'omsetD');
                    
                    if (elemenNama) elemenNama.innerText = "-";
                    if (elemenOmset) elemenOmset.innerText = "Rp. 0";
                }

                // Pasang nama asli dari database beserta nilai omsetnya (meskipun Rp. 0)
                if (data.jongko_data && data.jongko_data.length > 0) {
                    data.jongko_data.forEach((item, index) => {
                        const nomorKotak = index + 1; 

                        // Tulis nama cabang asli database ke label kiri figma
                        const elemenNama = document.getElementById(`namaJongko${nomorKotak}`);
                        if (elemenNama) {
                            elemenNama.innerText = item.nama_jongko;
                        }

                        // Petakan nominal rupiah ke kotak kanan masing-masing
                        if (nomorKotak === 1) {
                            document.getElementById('omsetA').innerText = formatRupiah(item.total_omset);
                        } else if (nomorKotak === 2) {
                            document.getElementById('omsetB').innerText = formatRupiah(item.total_omset);
                        } else if (nomorKotak === 3) {
                            document.getElementById('omsetC').innerText = formatRupiah(item.total_omset);
                        } else if (nomorKotak === 4) {
                            document.getElementById('omsetD').innerText = formatRupiah(item.total_omset);
                        }
                    });
                }

                // Masukkan total akumulasi keseluruhan di bagian paling bawah
                document.getElementById('totalOmset').innerText = formatRupiah(data.total_keseluruhan || 0);
            })
            .catch(error => {
                console.error("Gagal mengambil data rekap omset:", error);
            });
    }
</script>

</body>
</html>