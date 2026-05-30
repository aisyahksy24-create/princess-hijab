<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&family=Montserrat+Alternates:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            -webkit-font-smoothing: antialiased;
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
        }

        /* Frame HP Princess Hijab */
        .android-compact {
            overflow: hidden;
            border: 1.5px solid #000000;
            border-radius: 40px;
            box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
            background: linear-gradient(
                180deg,
                rgba(245, 185, 219, 1) 0%,
                rgba(253, 246, 200, 1) 44%,
                rgba(193, 214, 243, 1) 100%
            );
            width: 412px;
            height: 917px;
            position: relative;
        }

        .android-compact .text-wrapper {
            position: absolute;
            top: 130px;
            left: 0;
            width: 100%;
            text-align: center;
            font-family: "Montserrat Alternates", sans-serif;
            font-weight: 500;
            color: #000000;
            font-size: 30px;
        }

        /* Kartu Putih Transparan Tengah */
        .android-compact .rectangle {
            position: absolute;
            top: 195px;
            left: 41px;
            width: 323px;
            height: 565px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 20px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            z-index: 2;
        }

        /* Desain Input Form */
        .form-container {
            position: relative;
            z-index: 3;
        }

        .form-group {
            position: absolute;
            left: 73px;
            width: 258px;
        }

        .form-group label {
            display: block;
            font-family: "Inter", sans-serif;
            font-weight: 500;
            color: #000000;
            font-size: 14px;
            margin-bottom: 4px;
            padding-left: 12px;
        }

        .form-group input {
            width: 100%;
            height: 42px;
            background-color: #ffffff;
            border-radius: 30px;
            border: 2px solid #291f1f;
            padding: 0 45px 0 15px; 
            font-size: 13px;
            font-family: "Inter", sans-serif;
            outline: none;
        }

        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666666;
            font-size: 16px;
            z-index: 4;
        }

        /* Jarak posisi masing-masing kolom inputan */
        .group-nama { top: 210px; }
        .group-alamat { top: 295px; }
        .group-telp { top: 380px; }
        .group-user { top: 465px; }
        .group-pass { top: 550px; }

        /* Tombol Daftar Biru Pastel */
        .android-compact .btn-daftar {
            position: absolute;
            top: 680px;
            left: 125px;
            width: 162px;
            height: 48px;
            background-color: #c0d5f2;
            border-radius: 20px;
            border: 2px solid #291f1f;
            font-family: "Montserrat Alternates", sans-serif;
            font-weight: 600;
            color: #000000;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* LINK KEMBALI KE LOGIN */
        .link-back-login {
            position: absolute;
            top: 740px;
            width: 100%;
            text-align: center;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            color: #000000;
            text-decoration: underline;
        }

        /* Icon Robot & Love di atas form */
        .robot-box { position: absolute; top: 54px; left: 190px; width: 46px; height: 46px; z-index: 3; }
        .love-box { position: absolute; top: 45px; left: 174px; width: 24px; height: 24px; z-index: 3; }

        /* POLKADOT BACKGROUND */
        .bulat-css { position: absolute; border-radius: 50%; z-index: 1; }
        .kuning-1 { top: 769px; left: 129px; width: 77px; height: 77px; background-color: #fdf6c8; }
        .pink-1 { top: 820px; left: -15px; width: 55px; height: 55px; background-color: #f5b9db; }
        .pink-2 { top: 120px; left: 340px; width: 45px; height: 45px; background-color: #f5b9db; }
        .hijau-1 { top: 830px; left: 79px; width: 132px; height: 132px; background-color: #d6fccd; }
        .biru-1 { top: 742px; left: 350px; width: 99px; height: 99px; background-color: #c1d6f3; }
    </style>
</head>
<body>

    <div class="android-compact">
        <img class="love-box" src="{{ asset('Images/love-kecil.svg') }}">
        <img class="robot-box" src="{{ asset('Images/robot.svg') }}">

        <div class="text-wrapper">Daftar Akun Baru</div>
        <div class="rectangle"></div>
        
        <div class="form-container">
            <form action="{{ url('/store-pegawai') }}" method="POST">
                @csrf
                
                <div class="form-group group-nama">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_pegawai" placeholder="Nama lengkap..." required>
                </div>

                <div class="form-group group-alamat">
                    <label>Alamat Rumah</label>
                    <input type="text" name="alamat" placeholder="Alamat lengkap..." required>
                </div>

                <div class="form-group group-telp">
                    <label>No. Telepon / WA</label>
                    <input type="text" name="no_telp" placeholder="Contoh: 081234xxx" required>
                </div>

                <div class="form-group group-user">
                    <label>Username Baru</label>
                    <input type="text" name="username" placeholder="Buat username..." autocomplete="off" required>
                </div>

                <div class="form-group group-pass">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" placeholder="Minimal 4 karakter..." required>
                        <i class="fa-solid fa-eye toggle-password" id="eyeIcon"></i>
                    </div>
                </div>

                <button type="submit" class="btn-daftar">Daftar</button>
            </form>
        </div>

        <a href="{{ url('/login') }}" class="link-back-login">Sudah punya akun? Login disini</a>

        <div class="bulat-css kuning-1"></div>
        <div class="bulat-css pink-1"></div>
        <div class="bulat-css pink-2"></div>
        <div class="bulat-css hijau-1"></div>
        <div class="bulat-css biru-1"></div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        eyeIcon.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>

</body>
</html>