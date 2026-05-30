<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Princess Hijab</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&family=Tangerine:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <style>
        /* 2. KODE CSS BUATAN KAMU */
        * {
            -webkit-font-smoothing: antialiased;
            box-shadow: none;
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5; /* Warna di luar layar HP */
        }

        /* CANVAS UTAMA FRAME HP */
        .android-compact {
            width: 412px;
            height: 917px;
            position: relative;
            overflow: hidden;
            border-radius: 40px;
            border: 1.5px solid #000000;
            box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
            background: linear-gradient(
                180deg,
                rgba(245, 185, 219, 1) 0%,
                rgba(253, 246, 200, 1) 44%,
                rgba(193, 214, 243, 1) 100%
            );
        }

        /* SETTING TEKS ATAS */
        .welcome-header {
            position: absolute;
            top: 195px;
            width: 100%;
            text-align: center;
        }

        .welcome-header .sub-title {
            font-family: "Montserrat Alternates", sans-serif;
            font-weight: 500;
            color: #000000;
            font-size: 20px;
            margin-bottom: -5px;
        }

        .welcome-header .main-title {
            font-family: "Tangerine", cursive;
            font-weight: 700;
            color: #000000;
            font-size: 72px;
            text-decoration: underline;
            text-underline-offset: 8px;
        }

        /* SETTING KOMPONEN GAMBAR */
        .avatar-container {
            position: absolute;
            top: 375px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Bulatan Merah Muda */
        .avatar-container .circle-bg {
            width: 165px;
            height: 165px;
            background-color: #f5b9db;
            border-radius: 50%;
            border: 1.5px solid #000000; /* Ditambah border hitam tipis biar tegas seperti figma */
            position: absolute;
        }

        /* Foto Hijab Wanita */
        .avatar-container .avatar-img {
            width: 150px; /* Diperkecil sedikit agar pas di dalam lingkaran */
            height: 150px;
            object-fit: contain;
            z-index: 2;
            position: relative;
        }

        /* Ikon Love Kecil Manual pake CSS Text biar kamu ga usah ekspor love lagi */
        .avatar-container .heart-icon {
            position: absolute;
            left: 135px;
            top: 10px;
            z-index: 3;
            font-size: 24px;
        }

        /* KOTAK PUTIH DI BAGIAN BAWAH */
        .white-card {
            position: absolute;
            bottom: 35px;
            left: 18px;
            width: 376px;
            height: 255px;
            background-color: rgba(255, 255, 255, 0.65);
            border-radius: 45px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 22px;
        }

        /* DESAIN TOMBOL */
        .btn {
            width: 285px;
            height: 58px;
            background-color: #c1d6f3;
            border-radius: 22px;
            border: 2px solid #000000;
            font-family: "Montserrat Alternates", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 19px;
            text-decoration: none; /* Menghilangkan garis bawah link */
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn:hover {
            background-color: #a7c3eb;
            transform: scale(1.02);
        }
    </style>
</head>
<body>

    <div class="android-compact">
        
        <div class="welcome-header">
            <p class="sub-title">Selamat Datang di,</p>
            <h1 class="main-title">Princess Hijab</h1>
        </div>

        <div class="avatar-container">
            <div class="circle-bg"></div>
            
            <img class="avatar-img" src="{{ asset('Images/logo.svg') }}" alt="Princess Hijab">
            
            <div class="heart-icon">🖤</div>
        </div>

        <div class="white-card">
    <a href="/daftar" class="btn">Daftar Akun</a>
    <a href="/login" class="btn">Login Akun</a> </div>
</div>

    </div>

</body>
</html>