<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<title>Login - Princess Hijab</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&family=Inter:wght@500&display=swap" rel="stylesheet">

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

.android-compact {
  overflow: hidden;
  border: 1px solid;
  border-color: #000000;
  background: linear-gradient(
    180deg,
    rgba(245, 185, 219, 1) 0%,
    rgba(253, 246, 200, 1) 44%,
    rgba(193, 214, 243, 1) 100%
  );
  width: 412px;
  height: 917px;
  position: relative;
  box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
}

.android-compact .text-wrapper {
  position: absolute;
  top: 191px;
  left: 50px;
  width: 346px;
  font-family: "Montserrat Alternates", sans-serif;
  font-weight: 500;
  color: #000000;
  font-size: 30px;
  letter-spacing: 0;
  line-height: normal;
}

/* ALERT NOTIFIKASI ERROR/SUKSES */
.alert-box {
  position: absolute;
  top: 245px;
  left: 85px;
  width: 258px;
  padding: 8px;
  border-radius: 10px;
  font-family: "Inter", sans-serif;
  font-size: 12px;
  text-align: center;
  z-index: 5;
}
.alert-danger { background-color: #f8d7da; color: #721c24; }
.alert-success { background-color: #d4edda; color: #155724; }

/* INPUT USERNAME */
.android-compact .input-username {
  position: absolute;
  top: 320px;
  left: 85px;
  width: 258px;
  height: 46px;
  background-color: #ffffff;
  border-radius: 30px;
  border: 2px solid #291f1f;
  padding-left: 45px; 
  padding-right: 20px;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  outline: none;
  z-index: 2;
}

/* INPUT PASSWORD CONTAINER & FIELD */
.input-password-container {
  position: absolute;
  top: 412px;
  left: 85px;
  width: 258px;
  height: 46px;
  z-index: 2;
}

.android-compact .input-password {
  width: 100%;
  height: 100%;
  background-color: #ffffff;
  border-radius: 30px;
  border: 2px solid #291f1f;
  padding-left: 45px; 
  padding-right: 45px;
  font-family: "Inter", sans-serif;
  font-size: 16px;
  outline: none;
}

/* TOMBOL MATA (SHOW/HIDE PASSWORD) */
.toggle-password-btn {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 4;
}

.toggle-password-btn svg {
  width: 20px;
  height: 20px;
  fill: #757575;
}

/* TOMBOL LOGIN BUTTON */
.android-compact .btn-login-submit {
  position: absolute;
  top: 497px;
  left: 129px;
  width: 162px;
  height: 48px;
  background-color: #c0d5f2;
  border-radius: 20px;
  border: 2px solid #291f1f;
  cursor: pointer;
  z-index: 2;
  display: flex;
  justify-content: center;
  align-items: center;
}

.android-compact .text-wrapper-2 {
  position: absolute;
  top: 294px;
  left: 95px;
  width: 115px;
  font-family: "Inter", sans-serif;
  font-weight: 500;
  color: #000000;
  font-size: 18px;
  z-index: 2;
}

.android-compact .text-wrapper-3 {
  position: absolute;
  top: 385px;
  left: 93px;
  width: 87px;
  font-family: "Inter", sans-serif;
  font-weight: 500;
  color: #000000;
  font-size: 18px;
  z-index: 2;
}

.android-compact .text-wrapper-4 {
  font-family: "Montserrat Alternates", sans-serif;
  font-weight: 600;
  color: #000000;
  font-size: 20px;
}

/* LINK DAFTAR AKUN BARU */
.link-daftar {
  position: absolute;
  top: 560px;
  width: 100%;
  text-align: center;
  font-family: "Inter", sans-serif;
  font-size: 14px;
  color: #000000;
  z-index: 5;
  text-decoration: underline;
}

/* POSISI IKON USERNAME */
.android-compact .boxicons-user-filled {
  position: absolute;
  top: 333px; 
  left: 102px; 
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 3; 
  pointer-events: none;
}

/* POSISI IKON PASSWORD (GEMBOK) */
.android-compact .boxicons-lock-filled {
  position: absolute;
  top: 425px; 
  left: 102px; 
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 3; 
  pointer-events: none;
}

.android-compact .vector,
.android-compact .img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

/* ELEMEN ROBOT & LOVE */
.android-compact .mdi-emoji-robot-love { position: absolute; top: 99px; left: 195px; width: 46px; height: 46px; display: flex; z-index: 10; }
.android-compact .robot-file { flex: 1; width: 42.17px; }
.android-compact .solar-heart-bold { position: absolute; top: 90px; left: 179px; width: 24px; height: 24px; display: flex; z-index: 10; }
.android-compact .love-file { flex: 1; width: 20px; }

/* Ornamen Bulat Latar Belakang */
.android-compact .ellipse { position: absolute; top: 670px; left: -20px; width: 70px; height: 65px; }
.android-compact .ellipse-2 { position: absolute; top: 801px; left: 262px; width: 58px; height: 53px; }
.android-compact .ellipse-3 { position: absolute; top: 610px; left: 162px; width: 77px; height: 75px; }
.android-compact .ellipse-4 { position: absolute; top: 828px; left: 59px; width: 132px; height: 118px; }
.android-compact .ellipse-5 { position: absolute; top: 626px; left: 343px; width: 99px; height: 109px; }
</style>
</head>
<body>

<div class="android-compact">
  <div class="text-wrapper">Login Ke Akun Anda</div>
  
  @if(session('error'))
      <div class="alert-box alert-danger">{{ session('error') }}</div>
  @endif
  @if(session('success'))
      <div class="alert-box alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ url('/login-proses') }}" method="POST">
    @csrf
    
    <div class="text-wrapper-2">Username</div>
    <input type="text" name="username" id="username" class="input-username" placeholder="Masukkan username..." autocomplete="off" required>
    
    <div class="text-wrapper-3">Password</div>
    <div class="input-password-container">
      <input type="password" name="password" id="password" class="input-password" placeholder="••••••" required>
      <button type="button" id="togglePassword" class="toggle-password-btn">
        <svg id="eyeIcon" viewBox="0 0 24 24">
          <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
        </svg>
      </button>
    </div>
    
    <button type="submit" class="btn-login-submit">
      <span class="text-wrapper-4">Login</span>
    </button>
  </form>

  <a href="{{ url('/daftar') }}" class="link-daftar">Belum punya akun? Daftar disini</a>
  
  <div class="boxicons-user-filled">
    <img class="vector" src="{{ asset('Images/orang%20hitam.svg') }}" />
  </div>
  
  <div class="boxicons-lock-filled">
    <img class="img" src="{{ asset('Images/gembok.svg') }}" />
  </div>
  
  <div class="mdi-emoji-robot-love"><img class="robot-file" src="{{ asset('Images/robot.svg') }}" /></div>
  <div class="solar-heart-bold"><img class="love-file" src="{{ asset('Images/love-kecil.svg') }}" /></div>
  
  <img class="ellipse" src="{{ asset('Images/bulat-pink.svg') }}" />
  <img class="ellipse-2" src="{{ asset('Images/bulat-hijau.svg') }}" />
  <img class="ellipse-3" src="{{ asset('Images/bulat-kuning.svg') }}" />
  <img class="ellipse-4" src="{{ asset('Images/bulat-pink-2.svg') }}" />
  <img class="ellipse-5" src="{{ asset('Images/bulat-biru.svg') }}" />
</div>

<script>
    // SCRIPT UTK SHOW / HIDE PASSWORD
    const passwordInput = document.getElementById('password');
    const togglePasswordBtn = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    const eyeClosePath = `<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.82l2.92 2.92c1.51-1.26 2.7-2.89 3.44-4.74-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>`;
    const eyeOpenPath = `<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>`;

    togglePasswordBtn.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = eyeClosePath;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = eyeOpenPath;
        }
    });
</script>

</body>
</html>