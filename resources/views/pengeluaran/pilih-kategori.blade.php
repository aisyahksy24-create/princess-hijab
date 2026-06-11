<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<title>Pilih Kategori - Princess Hijab</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/shared.css') }}">
<style>
  .page-pilih-kategori .rectangle-3 {
    position: absolute;
    top: 210px;
    left: 45px;
    width: calc(100% - 90px);
    height: 580px;
    background-color: rgba(193, 214, 243, 0.48);
    border-radius: 30px;
    box-shadow: 0px 4px 4px rgba(0,0,0,0.25);
    padding: 35px 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    overflow-y: auto;
    border: 1.5px solid #000;
  }
  .category-btn {
    width: 100%;
    height: 60px;
    border-radius: 20px;
    box-shadow: 0px 4px 4px rgba(0,0,0,0.1);
    border: 1.5px solid #000;
    font-family: "Montserrat Alternates", sans-serif;
    font-weight: 600;
    color: #000;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    padding: 0 20px;
    gap: 15px;
  }
  .category-btn:hover {
    transform: scale(1.02);
  }
  .category-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: #fff;
    border: 1px solid #000;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
  }
</style>
</head>
<body>

<div class="android-compact page-pilih-jongko page-pilih-kategori">
  <div class="rectangle"></div>
  <div class="decor-circle login-pink"></div>
  <div class="decor-circle login-green"></div>
  <div class="decor-circle login-pink-large"></div>
  <div class="decor-circle login-blue"></div>
  <div class="ellipse-4"></div>
  
  <div class="material-symbols-back" onclick="location.href='{{ url('/pengeluaran') }}'" style="position: absolute; top: 75px; left: 18px; width: 35px; height: 35px; cursor: pointer; z-index: 10;">
    <img src="{{ asset('Images/keluar.svg') }}" alt="Tombol Keluar" style="width: 100%; height: 100%;" />
  </div>
  
  <div class="text-wrapper-2" style="top: 135px; font-size: 23px; width: 100%; text-align: center;">Pilih Kategori</div>
  
  <div class="rectangle-3">
    <!-- Biaya Upah -->
    <button type="button" class="category-btn" style="background-color: #EDD9F7;" onclick="selectCategory('Biaya Upah')">
      <div class="category-icon"><i class="fa-solid fa-hand-holding-dollar" style="color: #9b59b6;"></i></div>
      Biaya Upah
    </button>

    <!-- Biaya Kebersihan -->
    <button type="button" class="category-btn" style="background-color: #D0F0FF;" onclick="selectCategory('Biaya Kebersihan')">
      <div class="category-icon"><i class="fa-solid fa-broom" style="color: #0288d1;"></i></div>
      Biaya Kebersihan
    </button>

    <!-- Persediaan Stok -->
    <button type="button" class="category-btn" style="background-color: #F5B9DB;" onclick="selectCategory('Persediaan Stok')">
      <div class="category-icon"><i class="fa-solid fa-cart-shopping" style="color: #ff477e;"></i></div>
      Persediaan Stok
    </button>

    <!-- Biaya Listrik -->
    <button type="button" class="category-btn" style="background-color: #D6FCCD;" onclick="selectCategory('Biaya Listrik')">
      <div class="category-icon"><i class="fa-solid fa-bolt" style="color: #2ca02c;"></i></div>
      Biaya Listrik
    </button>

    <!-- Biaya Sewa -->
    <button type="button" class="category-btn" style="background-color: #FDF6C8;" onclick="selectCategory('Biaya Sewa')">
      <div class="category-icon"><i class="fa-solid fa-building" style="color: #f5a623;"></i></div>
      Biaya Sewa
    </button>

    <!-- Lain-lain -->
    <button type="button" class="category-btn" style="background-color: #e9ecef;" onclick="selectCategory('Lain-lain')">
      <div class="category-icon"><i class="fa-solid fa-ellipsis" style="color: #555;"></i></div>
      Lain-lain
    </button>
  </div>
</div>

<script>
  function selectCategory(category) {
    location.href = `/pengeluaran/tambah?kategori=` + encodeURIComponent(category);
  }
</script>

<script src="{{ asset('js/shared.js') }}"></script>
</body>
</html>
