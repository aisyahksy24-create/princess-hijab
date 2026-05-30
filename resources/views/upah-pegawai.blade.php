<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta charset="utf-8" />
    <title>Upah Pegawai - Princess Hijab</title>
    <style>
        @import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");
        @import url("https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&display=swap");

        * {
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }
        html, body {
            margin: 0px;
            padding: 0px;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
            font-family: "Montserrat Alternates", sans-serif;
        }

        .android-compact {
            background-color: #ffffff;
            overflow: hidden;
            width: 412px;
            height: 917px;
            position: relative;
            border: 2px solid #000;
            box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
        }

        /* GRADASI ATAS (HIJAU) */
        .android-compact .rectangle {
            position: absolute;
            top: 0;
            left: -13px;
            width: 433px;
            height: 149px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 1) 0%, rgba(184, 230, 173, 1) 100%);
            z-index: 1;
        }

        .android-compact .header-container {
            position: absolute;
            top: 80px;
            left: 0;
            width: 412px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            padding: 0 70px;
        }

        .android-compact .text-wrapper {
            font-weight: 600;
            color: #000000;
            font-size: 30px;
            text-align: center;
            white-space: nowrap;
        }

        .android-compact .material-symbols {
            position: absolute;
            top: 82px;
            left: 27px;
            width: 35px;
            height: 35px;
            display: flex;
            z-index: 10;
            cursor: pointer;
        }
        .android-compact .material-symbols img {
            width: 100%;
            height: 100%;
        }

        .android-compact .mdi-emoji-woman {
            position: absolute;
            top: 80px;
            left: 351px;
            width: 40px;
            height: 40px;
            display: flex;
            z-index: 3;
        }
        .android-compact .mdi-emoji-woman img {
            width: 100%;
            height: 100%;
        }

        .android-compact .line {
            top: 149px;
            left: 0;
            width: 412px;
            position: absolute;
            height: 2px;
            z-index: 3;
            background-color: #000000;
            border: none;
        }

        /* CONTAINER SWIPE SLIDER */
        .android-compact .rectangle-3 {
            position: absolute;
            top: 185px;
            left: 18px;
            width: 375px;
            height: 383px;
            background-color: #f5b9db;
            border-radius: 30px;
            box-shadow: 0px 4px 4px #00000040;
            z-index: 4;
            overflow: hidden;
        }

        .slider-wrapper {
            display: flex;
            width: 750px;
            height: 100%;
            transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .slide-panel {
            width: 375px;
            height: 100%;
            position: relative;
            flex-shrink: 0;
        }

        /* PANEL 1 STYLING */
        .slide-panel .rectangle-6 { position: absolute; top: 10px; left: 20px; width: 45px; height: 23px; background-color: #ffffff99; border-radius: 10px; }
        .slide-panel .rectangle-5 { position: absolute; top: 10px; left: 80px; width: 150px; height: 23px; background-color: #ffffff99; border-radius: 10px; }
        .slide-panel .rectangle-4 { position: absolute; top: 10px; left: 245px; width: 110px; height: 23px; background-color: #ffffff99; border-radius: 10px; }
        
        .slide-panel .text-wrapper-4 { position: absolute; top: 14px; left: 20px; width: 45px; font-weight: 600; font-size: 14px; text-align: center; color: #000000; }
        .slide-panel .text-wrapper-3 { position: absolute; top: 14px; left: 80px; width: 150px; font-weight: 600; font-size: 14px; text-align: center; color: #000000; }
        .slide-panel .text-wrapper-2 { position: absolute; top: 14px; left: 245px; width: 110px; font-weight: 600; font-size: 14px; text-align: center; color: #000000; }
        
        .slide-panel .line-2 { top: 42px; left: 0; width: 375px; position: absolute; height: 2px; background-color: #000000; border: none; }
        
        .slide-panel .rectangle-8 { position: absolute; top: 55px; left: 20px; width: 45px; height: 305px; background-color: #ffffff80; border-radius: 20px; }
        .slide-panel .rectangle-7 { position: absolute; top: 55px; left: 80px; width: 150px; height: 305px; background-color: #ffffff80; border-radius: 20px; }
        .slide-panel .rectangle-9 { position: absolute; top: 55px; left: 245px; width: 110px; height: 305px; background-color: #ffffff80; border-radius: 20px; }
        
        .slide-panel .element { position: absolute; top: 70px; left: 20px; width: 45px; line-height: 2.5; font-weight: 600; text-align: center; color: #000000; font-size: 14px; }
        .slide-panel .names-list { position: absolute; top: 70px; left: 80px; width: 150px; line-height: 2.5; font-weight: 600; text-align: center; text-decoration: underline; cursor: pointer; color: #000000; font-size: 14px; }
        .slide-panel .jongko-list { position: absolute; top: 70px; left: 245px; width: 110px; line-height: 2.5; font-weight: 600; text-align: center; color: #000000; font-size: 14px; }

        /* PANEL 2 STYLING */
        .slide-panel .upah-header-1 { position: absolute; top: 10px; left: 20px; width: 55px; height: 23px; background-color: #ffffff99; border-radius: 10px; }
        .slide-panel .upah-header-2 { position: absolute; top: 10px; left: 90px; width: 140px; height: 23px; background-color: #ffffff99; border-radius: 10px; }
        .slide-panel .upah-header-3 { position: absolute; top: 10px; left: 245px; width: 110px; height: 23px; background-color: #ffffff99; border-radius: 10px; }
        
        .slide-panel .upah-txt-1 { position: absolute; top: 14px; left: 20px; width: 55px; font-weight: 600; font-size: 14px; text-align: center; color: #000000; }
        .slide-panel .upah-txt-2 { position: absolute; top: 14px; left: 90px; width: 140px; font-weight: 600; font-size: 14px; text-align: center; color: #000000; }
        .slide-panel .upah-txt-3 { position: absolute; top: 14px; left: 245px; width: 110px; font-weight: 600; font-size: 14px; text-align: center; color: #000000; }
        
        .slide-panel .rect-data-1 { position: absolute; top: 55px; left: 20px; width: 55px; height: 305px; background-color: #ffffff80; border-radius: 20px; }
        .slide-panel .rect-data-2 { position: absolute; top: 55px; left: 90px; width: 140px; height: 305px; background-color: #ffffff80; border-radius: 20px; }
        .slide-panel .rect-data-3 { position: absolute; top: 55px; left: 245px; width: 110px; height: 305px; background-color: #ffffff80; border-radius: 20px; }
        
        .slide-panel .val-1 { position: absolute; top: 70px; left: 20px; width: 55px; line-height: 2.5; font-weight: 600; text-align: center; color: #000000; font-size: 14px; }
        .slide-panel .val-2 { position: absolute; top: 70px; left: 90px; width: 140px; line-height: 2.5; font-weight: 600; text-align: center; color: #000000; font-size: 14px; }
        .slide-panel .val-3 { position: absolute; top: 70px; left: 245px; width: 110px; line-height: 2.5; font-weight: 600; text-align: center; color: #000000; font-size: 14px; }

        /* DOTS */
        .android-compact .icon-park-outline,
        .android-compact .img-wrapper {
            position: absolute;
            top: 582px;
            width: 17px;
            height: 17px;
            display: flex;
            cursor: pointer;
            z-index: 10;
        }
        .android-compact .icon-park-outline { left: 188px; }
        .android-compact .img-wrapper { left: 213px; }
        .android-compact .dot {
            width: 12px;
            height: 12px;
            background-color: #dad5d5;
            border-radius: 50%;
            margin: auto;
        }
        .android-compact .dot.active {
            background-color: #000000;
        }

        /* STYLE BARU: TOMBOL CETAK PDF */
        .android-compact .btn-cetak-pdf {
            position: absolute;
            top: 610px;
            left: 23px;
            width: 368px;
            height: 40px;
            background-color: #a1c4fd; /* Warna soft blue senada */
            border-radius: 20px;
            box-shadow: 0px 4px 4px #00000025;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            color: #000000;
            font-weight: 600;
            font-size: 14px;
            z-index: 9;
            border: 1px solid #00000030;
            transition: background-color 0.2s;
        }
        .android-compact .btn-cetak-pdf:active {
            background-color: #8bb3f7;
        }

        /* TOTAL AREA (Digeser sedikit ke bawah agar tidak menabrak tombol cetak) */
        .android-compact .rectangle-10 {
            position: absolute;
            top: 665px;
            left: 23px;
            width: 368px;
            height: 105px;
            background-color: #c1d6f3;
            border-radius: 30px;
            box-shadow: 0px 4px 4px #00000040;
            z-index: 8;
        }
        .android-compact .text-wrapper-13 {
            position: absolute;
            top: 680px;
            left: 23px;
            width: 368px;
            font-weight: 600;
            color: #000000;
            font-size: 20px;
            text-align: center;
            z-index: 9;
        }
        .android-compact .text-wrapper-14 {
            position: absolute;
            top: 720px;
            left: 23px;
            width: 368px;
            font-weight: 600;
            color: #000000;
            font-size: 25px;
            text-align: center;
            text-decoration: underline;
            z-index: 9;
        }

        .android-compact .div {
            position: absolute;
            top: 658px;
            left: 0;
            width: 450px;
            height: 272px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 1) 0%, rgba(245, 185, 219, 1) 100%);
            z-index: 1;
        }

        /* NAVBAR */
        .android-compact .rectangle-2 {
            position: absolute;
            top: 797px;
            left: 59px;
            width: 301px;
            height: 60px;
            border-radius: 40px;
            box-shadow: 0px 4px 4px #00000040;
            background: linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(184, 230, 173, 1) 100%);
            z-index: 10;
        }

        .nav-item {
            position: absolute;
            top: 802px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 11;
            cursor: pointer;
            text-decoration: none;
        }
        .nav-item img { width: 32px; height: 32px; }
        .nav-item.active {
            background-color: #C1D6F3;
            border: 2px solid #000;
            border-radius: 50%;
        }

        .nav-rumah { left: 85px; }
        .nav-uang { left: 151px; }
        .nav-love { left: 220px; }
        .nav-catat { left: 290px; }
    </style>
</head>
<body>

    <div class="android-compact">
        <div class="rectangle"></div>
        
        <div class="header-container">
            <div class="text-wrapper">Upah Pegawai</div>
        </div>
        
        <hr class="line">

        <div class="material-symbols" onclick="location.href='/dashboard-admin'">
            <img src="{{ asset('Images/keluar.svg') }}" alt="Keluar">
        </div>

        <div class="mdi-emoji-woman">
            <img src="{{ asset('Images/orang.svg') }}" alt="Orang">
        </div>

        <div class="rectangle-3" id="swipeArea">
            <div class="slider-wrapper" id="slider">
                
                <div class="slide-panel">
                    <div class="rectangle-6"></div><div class="text-wrapper-4">No</div>
                    <div class="rectangle-5"></div><div class="text-wrapper-3">Nama</div>
                    <div class="rectangle-4"></div><div class="text-wrapper-2">Jongko</div>
                    <hr class="line-2">
                    
                    <div class="rectangle-8"></div>
                    <div class="element" id="listNo">-</div>
                    
                    <div class="rectangle-7"></div>
                    <div class="names-list" id="listNama" onclick="geser(1)">-</div>
                    
                    <div class="rectangle-9"></div>
                    <div class="jongko-list" id="listJongko">-</div>
                </div>

                <div class="slide-panel">
                    <div class="upah-header-1"></div><div class="upah-txt-1">Unit</div>
                    <div class="upah-header-2"></div><div class="upah-txt-2">Penjualan</div>
                    <div class="upah-header-3"></div><div class="upah-txt-3">Upah</div>
                    <hr class="line-2">

                    <div class="rect-data-1"></div>
                    <div class="val-1" id="listUnit">-</div>
                    
                    <div class="rect-data-2"></div>
                    <div class="val-2" id="listPenjualan">-</div>
                    
                    <div class="rect-data-3"></div>
                    <div class="val-3" id="listUpah">-</div>
                </div>
            </div>
        </div>

        <div class="icon-park-outline" onclick="geser(0)">
            <div class="dot active" id="dot0"></div>
        </div>
        <div class="img-wrapper" onclick="geser(1)">
            <div class="dot" id="dot1"></div>
        </div>

        <a href="{{ url('/cetak-upah-pegawai') }}" class="btn-cetak-pdf">
            🖨️ Cetak PDF Penggajian
        </a>

        <div class="rectangle-10"></div>
        <div class="text-wrapper-13">Total Yang Dibayarkan</div>
        <div class="text-wrapper-14" id="totalDibayarkan">Rp. 0</div>

        <div class="div"></div>

        <div class="rectangle-2"></div>
        <a href="/dashboard-admin" class="nav-item nav-rumah"><img src="{{ asset('Images/rumah.svg') }}"></a>
        <a href="/rekap-omset" class="nav-item nav-uang"><img src="{{ asset('Images/uang hitam.svg') }}"></a>
        <a href="/upah-pegawai" class="nav-item nav-love active"><img src="{{ asset('Images/tangan love.svg') }}"></a>
        <a href="/pendataan" class="nav-item nav-catat"><img src="{{ asset('Images/catatan hitam.svg') }}"></a>
    </div>

    <script>
        const slider = document.getElementById('slider');
        const dot0 = document.getElementById('dot0');
        const dot1 = document.getElementById('dot1');
        let currentPos = 0;

        function geser(index) {
            currentPos = index;
            slider.style.transform = `translateX(-${index * 375}px)`;
            dot0.classList.toggle('active', index === 0);
            dot1.classList.toggle('active', index === 1);
        }

        // SWIPE SYSTEM FOR MOBILE CHIPS
        let startX = 0;
        const swipeArea = document.getElementById('swipeArea');

        swipeArea.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        }, { passive: true });

        swipeArea.addEventListener('touchend', (e) => {
            let endX = e.changedTouches[0].clientX;
            let selisihX = startX - endX;

            if (selisihX > 50 && currentPos === 0) {
                geser(1);
            } else if (selisihX < -50 && currentPos === 1) {
                geser(0);
            }
        }, { passive: true });

        // FORMAT RUPIAH UTILITY
        function formatRupiah(angka) {
            return "Rp. " + Number(angka).toLocaleString('id-ID');
        }

        // FETCH AJAX DATA DARI DATABASE LARAVEL
        window.onload = function() {
            fetch('/api/ambil-upah')
                .then(response => response.json())
                .then(data => {
                    if (data.upah_data && data.upah_data.length > 0) {
                        let htmlNo = "";
                        let htmlNama = "";
                        let htmlJongko = "";
                        let htmlUnit = "";
                        let htmlPenjualan = "";
                        let htmlUpah = "";

                        data.upah_data.forEach((item, index) => {
                            htmlNo += `${index + 1}<br>`;
                            htmlNama += `${item.nama}<br>`;
                            htmlJongko += `${item.jongko}<br>`;
                            htmlUnit += `${item.unit}<br>`;
                            htmlPenjualan += `${formatRupiah(item.penjualan)}<br>`;
                            htmlUpah += `${formatRupiah(item.upah)}<br>`;
                        });

                        // Tulis hasil loop ke HTML penampung masing-masing kolom figma
                        document.getElementById('listNo').innerHTML = htmlNo;
                        document.getElementById('listNama').innerHTML = htmlNama;
                        document.getElementById('listJongko').innerHTML = htmlJongko;
                        document.getElementById('listUnit').innerHTML = htmlUnit;
                        document.getElementById('listPenjualan').innerHTML = htmlPenjualan;
                        document.getElementById('listUpah').innerHTML = htmlUpah;
                    }

                    // Tampilkan total akumulasi biaya pengeluaran gaji hari ini
                    document.getElementById('totalDibayarkan').innerText = formatRupiah(data.total_yang_dibayarkan || 0);
                })
                .catch(error => {
                    console.error("Gagal memuat data upah pegawai:", error);
                });
        }
    </script>
</body>
</html>