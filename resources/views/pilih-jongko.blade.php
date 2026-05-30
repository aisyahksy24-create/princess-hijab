<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<title>Pilih Jongko - Princess Hijab</title>
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
  margin: 0px;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #f0f2f5;
  font-family: "Montserrat Alternates", sans-serif;
}

/* SMARTPHONE FRAME CONTAINER */
.android-compact {
  background-color: #ffffff;
  overflow: hidden;
  width: 412px;
  height: 917px;
  position: relative;
  box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
}

.android-compact .rectangle {
  position: absolute;
  top: 535px;
  left: 0;
  width: 424px;
  height: 382px;
  background: linear-gradient(180deg, rgba(255, 255, 255, 1) 0%, rgba(245, 185, 219, 1) 100%);
}

.android-compact .ellipse {
  position: absolute;
  top: 670px;
  left: -20px;
  width: 70px;
  height: 65px;
  background-color: #f5b9db;
  border-radius: 35px / 32.5px;
}

.android-compact .div {
  position: absolute;
  top: 801px;
  left: 262px;
  width: 58px;
  height: 53px;
  background-color: #d6fccd;
  border-radius: 29px / 26.5px;
}

.android-compact .ellipse-2 {
  position: absolute;
  top: 828px;
  left: 59px;
  width: 132px;
  height: 118px;
  background-color: #fdf6c8;
  border-radius: 66px / 59px;
}

.android-compact .ellipse-3 {
  position: absolute;
  top: 626px;
  left: 343px;
  width: 99px;
  height: 109px;
  background-color: #c1d6f3;
  border-radius: 49.5px / 54.5px;
}

.android-compact .ellipse-4 {
  position: absolute;
  top: -83px;
  left: -21px;
  width: 465px;
  height: 386px;
  border-radius: 232.5px / 193px;
  background: linear-gradient(208deg, rgba(253, 246, 200, 1) 25%, rgba(255, 255, 255, 1) 82%);
}

.android-compact .line {
  position: absolute;
  top: 140px;
  left: 0;
  width: 412px;
  height: 2px;
}

.android-compact .rectangle-2 {
  position: absolute;
  width: calc(100% - 58px);
  top: 36px;
  left: 31px;
  height: 74px;
  border-radius: 40px;
  box-shadow: 0px 4px 4px #00000040;
  background: linear-gradient(180deg, rgba(255, 255, 255, 1) 0%, rgba(245, 185, 219, 1) 73%);
}

/* KOTAK AVATAR WAJAH */
.android-compact .ic-baseline-face {
  position: absolute;
  top: 53px;
  left: 69px;
  width: 41px;
  height: 41px;
  aspect-ratio: 1;
  /* Mengambil gambar wajah/avatar dari folder Images */
  background-image: url("{{ asset('Images/image.svg') }}");
  background-size: 100% 100%;
}

.android-compact .vector {
  position: absolute;
  width: 67.71%;
  height: 46.88%;
  top: 53.12%;
  left: 32.29%;
}

.android-compact .img {
  position: absolute;
  width: 42.71%;
  height: 46.88%;
  top: 53.12%;
  left: 57.29%;
}

.android-compact .text-wrapper {
  position: absolute;
  top: 59px;
  left: 149px;
  width: 180px;
  font-weight: 600;
  color: #000000;
  font-size: 25px;
}

.android-compact .text-wrapper-2 {
  position: absolute;
  top: 174px;
  left: 0;
  width: 412px;
  text-align: center;
  font-weight: 600;
  color: #000000;
  font-size: 25px;
}

/* WADAH KARTU PILIHAN */
.android-compact .rectangle-3 {
  position: absolute;
  top: 258px;
  left: 45px;
  width: 327px;
  height: 453px;
  background-color: #c1d6f37a;
  border-radius: 30px;
  box-shadow: 0px 4px 4px #00000040;
  padding: 30px 20px;
  display: flex;
  flex-direction: column;
  gap: 20px;
  overflow-y: auto;
}

/* MODIFIKASI TOMBOL PILIHAN BLOK DINAMIS */
.jongko-btn-submit {
  width: 100%;
  height: 53px;
  background-color: #ffffff;
  border-radius: 20px;
  box-shadow: 0px 4px 4px #00000025;
  border: none;
  font-family: "Montserrat Alternates", sans-serif;
  font-weight: 600;
  color: #000000;
  font-size: 25px;
  cursor: pointer;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.jongko-btn-submit:hover {
  background-color: #fdf6c8;
  transform: scale(1.02);
}
</style>
</head>
<body>

<div class="android-compact">
  <div class="rectangle"></div>
  <div class="ellipse"></div>
  <div class="div"></div>
  <div class="ellipse-2"></div>
  <div class="ellipse-3"></div>
  <div class="ellipse-4"></div>
  
  <img class="line" src="{{ asset('Images/line-3.svg') }}" />
  
  <div class="rectangle-2"></div>
  
  <div class="ic-baseline-face">
    <img class="vector" src="{{ asset('Images/vector.svg') }}" />
    <img class="img" src="{{ asset('Images/vector-2.svg') }}" />
  </div>
  
  <div class="text-wrapper">Halo, Delia!</div>
  <div class="text-wrapper-2">Pilih Jongko Hari Ini!</div>
  
  <form id="form-pilih-jongko" action="{{ url('/set-jongko-kerja') }}" method="POST">
    @csrf
    <input type="hidden" name="jongko_id" id="selected-jongko-input">

    <div class="rectangle-3">
      @if(isset($data_jongko) && $data_jongko->count() > 0)
        @foreach($data_jongko as $jongko)
          <button type="button" class="jongko-btn-submit" onclick="submitPilihanJongko('{{ $jongko->id }}')">
            {{ $jongko->nama_jongko }}
          </button>
        @endforeach
      @else
        <div style="text-align: center; font-size: 14px; color: #555; margin-top: 50px; font-weight: 500;">
          Belum ada data cabang/jongko terdaftar di database.
        </div>
      @endif
    </div>
  </form>
</div>

<script>
  function submitPilihanJongko(jongkoId) {
    document.getElementById('selected-jongko-input').value = jongkoId;
    document.getElementById('form-pilih-jongko').submit();
  }
</script>

</body>
</html>