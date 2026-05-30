<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<title>Dashboard Admin - Princess Hijab</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&display=swap" rel="stylesheet">

<style>
@import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");

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
  font-family: "Montserrat Alternates", sans-serif;
}

/* CONTAINER UTAMA DENGAN WARNA FULL */
.android-compact {
  background: linear-gradient(
    180deg,
    rgba(255, 255, 255, 1) 74%,
    rgba(193, 214, 243, 1) 100%
  );
  width: 412px;
  height: 917px;
  position: relative;
  overflow: hidden;
  box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
  border: 1px solid #000000;
  padding: 30px 26px;
  display: flex;
  flex-direction: column;
}

/* BACKGROUND LENGKUNGAN PINK ATAS */
.android-compact .bg-pink-top {
  position: absolute;
  width: 100%;
  top: 0;
  left: 0;
  height: 366px;
  border-radius: 0 0 40px 40px;
  background: linear-gradient(
    180deg,
    rgba(255, 255, 255, 1) 0%,
    rgba(245, 185, 219, 1) 100%
  );
  z-index: 1;
}

/* HEADER PROFILE */
.header-profile {
  position: relative;
  z-index: 2;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 40px;
  margin-bottom: 30px;
}

.welcome-text .title-welcome { font-size: 25px; font-weight: 500; color: #000000; margin-bottom: 5px; }
.welcome-text .admin-name { font-size: 25px; font-weight: 600; color: #000000; }
.ic-baseline-face { width: 52px; height: 52px; }
.ic-baseline-face img { width: 100%; height: 100%; object-fit: contain; }

/* CARD HERO DATA OMSET (KOTAK BIRU GRADASI) */
.card-omset {
  position: relative;
  z-index: 2;
  width: 100%;
  height: 170px;
  border-radius: 40px;
  border: 2px solid #000000;
  background: linear-gradient(
    180deg,
    rgba(129, 177, 244, 1) 0%,
    rgba(192, 213, 242, 1) 100%
  );
  padding: 25px 30px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.05);
}

.card-omset-top { display: flex; justify-content: space-between; align-items: center; }
.card-omset-top .label-title { font-size: 17px; font-weight: 500; color: #000000; }
.card-omset-top .label-date { font-size: 14px; font-weight: 500; color: #000000; }
.card-omset-amount { font-size: 38px; font-weight: 500; color: #000000; margin-top: 15px; letter-spacing: -0.5px; }

/* SUBTITLE MENU (Jarak atas ditambah agar terdorong ke area putih) */
.menu-section-title {
  position: relative;
  z-index: 2;
  font-size: 22px; 
  font-weight: 600;
  color: #000000;
  margin-top: 65px; /* Ditambah agar pas di area putih */
  margin-bottom: 20px;
}

/* LIST CONTAINER MENU */
.menu-list {
  position: relative;
  z-index: 2;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

/* BASE STYLING TOMBOL MENU */
.menu-item {
  width: 100%;
  height: 126px;
  border-radius: 30px;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.12);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 35px;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s;
}

.menu-item:hover {
  transform: translateY(-2px);
  box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
}

/* WARNA MENU SOLID */
.menu-rekap { background-color: rgba(253, 246, 200, 1); } 
.menu-upah { background-color: rgba(214, 252, 205, 1); } 
.menu-pendataan { background-color: rgba(245, 185, 219, 1); } 

.menu-text { font-size: 24px; font-weight: 500; color: #000000; }
.menu-icon { width: 65px; height: 65px; display: flex; align-items: center; justify-content: center; }
.menu-icon img { width: 100%; height: 100%; object-fit: contain; }
</style>
</head>
<body>

<div class="android-compact">
  <div class="bg-pink-top"></div>
  
  <div class="header-profile">
    <div class="welcome-text">
      <div class="title-welcome">Selamat Datang,</div>
      <div class="admin-name">Delia!</div>
    </div>
    <div class="ic-baseline-face">
      <img src="{{ asset('Images/orang.svg') }}" alt="User Profile" />
    </div>
  </div>
  
  <div class="card-omset">
    <div class="card-omset-top">
      <span class="label-title">Omset Hari Ini</span>
      <span class="label-date" id="real-time-date">-- Mei 2026</span>
    </div>
    <div class="card-omset-amount">Rp. {{ number_format($omset_hari_ini, 0, ',', '.') }}</div>
</div>
  
  <div class="menu-section-title">Menu</div>
  
  <div class="menu-list">
    <div class="menu-item menu-rekap" onclick="location.href='/rekap-omset'">
      <span class="menu-text">Rekap Omset</span>
      <div class="menu-icon">
        <img src="{{ asset('Images/uang.svg') }}" alt="Icon Rekap Omset" />
      </div>
    </div>
    
    <div class="menu-item menu-upah" onclick="location.href='/upah-pegawai'">
      <span class="menu-text">Upah Pegawai</span>
      <div class="menu-icon">
        <img src="{{ asset('Images/memberi.svg') }}" alt="Icon Upah Pegawai" />
      </div>
    </div>
    
    <div class="menu-item menu-pendataan" onclick="location.href='/pendataan'">
      <span class="menu-text">Pendataan</span>
      <div class="menu-icon">
        <img src="{{ asset('Images/catatan.svg') }}" alt="Icon Pendataan" />
      </div>
    </div>
  </div>
</div>

<script>
  function setRealTimeDate() {
    const dateObj = new Date();
    const day = String(dateObj.getDate()).padStart(2, '0');
    const months = [
      "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
    const monthName = months[dateObj.getMonth()];
    const year = dateObj.getFullYear();
    document.getElementById('real-time-date').textContent = `${day} ${monthName} ${year}`;
  }

  window.onload = setRealTimeDate;
</script>

</body>
</html>