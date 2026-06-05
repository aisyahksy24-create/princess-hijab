<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<title>Dashboard Admin - Princess Hijab</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/shared.css') }}">
<style>
  .page-dashboard-admin .menu-section-title {
    margin-top: 35px !important;
    margin-bottom: 12px !important;
  }
  .page-dashboard-admin .menu-list {
    gap: 15px !important;
  }
  .page-dashboard-admin .menu-item {
    height: 95px !important;
  }
  .page-dashboard-admin .menu-text {
    font-size: 20px !important;
  }
  .page-dashboard-admin .menu-icon {
    width: 50px !important;
    height: 50px !important;
  }
</style>
</head>
<body>

<div class="android-compact page-dashboard-admin" style="padding: 0 25px 40px;">
  <div class="bg-pink-top"></div>
  
  <div class="header-profile">
    <div class="welcome-text">
      <div class="admin-name" style="font-size: 21px; font-weight: 600; line-height: 1.2;">Selamat Datang di Dashboard Admin</div>
    </div>
    <a href="{{ url('/logout') }}" class="ic-baseline-face" title="Logout" style="cursor: pointer; transition: transform 0.2s; display: flex; align-items: center; justify-content: center;">
      <img src="{{ asset('images/keluar.svg') }}" alt="Logout" style="width: 35px; height: 35px;" />
    </a>
  </div>
  
  <div class="card-keuangan-container" style="position: relative; z-index: 2; width: 100%; background: var(--glass-white); border-radius: 30px; border: 2px solid #000000; padding: 15px 20px; box-shadow: var(--shadow-main); display: flex; flex-direction: column; gap: 12px;">
    <div class="card-keuangan-header" style="display: flex; justify-content: space-between; align-items: center;">
      <span style="font-size: 15px; font-weight: 600; color: #000000;">Keuangan Hari Ini</span>
      <span style="font-size: 12px; font-weight: 500; color: #666666;" id="real-time-date">-- Juni 2026</span>
    </div>
    
    <div class="keuangan-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
      <!-- Omset -->
      <div class="keuangan-box" style="background: #FDF6C8; border: 1.5px solid #000000; border-radius: 18px; padding: 10px 12px; display: flex; flex-direction: column; justify-content: space-between; height: 62px;">
        <span style="font-size: 9px; font-weight: 600; color: #666666;">Omset</span>
        <span style="font-size: 12px; font-weight: 700; color: #000000; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Rp {{ number_format($omset_hari_ini, 0, ',', '.') }}</span>
      </div>
      
      <!-- Pengeluaran -->
      <div class="keuangan-box" style="background: #F5B9DB; border: 1.5px solid #000000; border-radius: 18px; padding: 10px 12px; display: flex; flex-direction: column; justify-content: space-between; height: 62px;">
        <span style="font-size: 9px; font-weight: 600; color: #666666;">Pengeluaran</span>
        <span style="font-size: 12px; font-weight: 700; color: #000000; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Rp {{ number_format($pengeluaran_hari_ini, 0, ',', '.') }}</span>
      </div>
      
      <!-- Upah -->
      <div class="keuangan-box" style="background: #D6FCCD; border: 1.5px solid #000000; border-radius: 18px; padding: 10px 12px; display: flex; flex-direction: column; justify-content: space-between; height: 62px;">
        <span style="font-size: 9px; font-weight: 600; color: #666666;">Upah Pegawai</span>
        <span style="font-size: 12px; font-weight: 700; color: #000000; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Rp {{ number_format($upah_hari_ini, 0, ',', '.') }}</span>
      </div>
      
      <!-- Bersih -->
      <div class="keuangan-box" style="background: #C1D6F3; border: 1.5px solid #000000; border-radius: 18px; padding: 10px 12px; display: flex; flex-direction: column; justify-content: space-between; height: 62px;">
        <span style="font-size: 9px; font-weight: 600; color: #666666;">Estimasi Bersih</span>
        <span style="font-size: 12px; font-weight: 700; color: #000000; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Rp {{ number_format($bersih_hari_ini, 0, ',', '.') }}</span>
      </div>
    </div>
  </div>
  
  <div class="menu-section-title">Menu</div>
  
  <div class="menu-list">
    <div class="menu-item menu-rekap" onclick="location.href='/rekap-omset'">
      <span class="menu-text">Rekap Omset</span>
      <div class="menu-icon">
        <img src="{{ asset('images/uang.svg') }}" alt="Icon Rekap Omset" />
      </div>
    </div>
    
    <div class="menu-item menu-upah" onclick="location.href='/upah-pegawai'">
      <span class="menu-text">Upah Pegawai</span>
      <div class="menu-icon">
        <img src="{{ asset('images/memberi.svg') }}" alt="Icon Upah Pegawai" />
      </div>
    </div>

    <div class="menu-item" style="background-color: rgba(193, 214, 243, 1);" onclick="location.href='/pengeluaran'">
      <span class="menu-text">Pengeluaran</span>
      <div class="menu-icon">
        <img src="{{ asset('Images/dompet.svg') }}" alt="Icon Pengeluaran" />
      </div>
    </div>
    
    <div class="menu-item menu-pendataan" onclick="location.href='/pendataan'">
      <span class="menu-text">Pendataan</span>
      <div class="menu-icon">
        <img src="{{ asset('images/catatan.svg') }}" alt="Icon Pendataan" />
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

<script src="{{ asset('js/shared.js') }}"></script>
</body>
</html>