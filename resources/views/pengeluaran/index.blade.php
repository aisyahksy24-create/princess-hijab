<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<title>Daftar Pengeluaran - Princess Hijab</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/shared.css') }}">
<style>
  .page-pengeluaran .data-table-container {
    position: absolute;
    top: 155px;
    left: 24px;
    width: calc(100% - 48px);
    height: 575px;
    background-color: rgba(255, 255, 255, 0.65);
    backdrop-filter: blur(8px);
    border-radius: 30px;
    border: 1.5px solid #000;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.08);
    overflow-y: auto;
    padding: 15px 10px;
  }

  .figma-grid-table {
    display: flex;
    flex-direction: column;
    width: 100%;
  }
  .table-header-row {
    display: grid;
    grid-template-columns: 1.5fr 2fr 2fr 1fr;
    border-bottom: 1.5px solid #000;
    padding-bottom: 8px;
    font-weight: 600;
    font-size: 11px;
    text-align: center;
  }
  .table-body-row {
    display: grid;
    grid-template-columns: 1.5fr 2fr 2fr 1fr;
    padding: 10px 0;
    border-bottom: 1px dashed rgba(0,0,0,0.1);
    font-size: 11px;
    align-items: center;
    text-align: center;
  }
  .btn-mini-delete {
    color: #ff477e;
    font-size: 14px;
    cursor: pointer;
    transition: transform 0.2s;
  }
  .btn-mini-delete:hover {
    transform: scale(1.1);
  }
  .add-data-action-container {
    position: absolute;
    top: 745px;
    left: 24px;
    width: calc(100% - 48px);
    display: flex;
    justify-content: center;
    z-index: 10;
  }
  .add-data-btn {
    width: 220px;
    height: 48px;
    background-color: var(--primary-pink);
    border: 1.5px solid #000000;
    border-radius: 20px;
    font-family: "Montserrat Alternates", sans-serif;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
  }
  .add-data-btn:hover {
    background-color: #f0bcd8;
    transform: translateY(-2px);
  }
</style>
</head>
<body>

<div class="android-compact page-pendataan page-pengeluaran">
  <div class="rectangle-header" style="background: linear-gradient(0deg, rgba(193, 214, 243, 1) 0%, rgba(245, 185, 219, 1) 100%); font-family: 'Montserrat Alternates', sans-serif;"></div>

  @if(session('sukses'))
    <div class="alert-popup-success" id="successAlert" style="top: 15px;">
        <i class="fa-solid fa-circle-check"></i> {{ session('sukses') }}
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('successAlert');
            if(el) el.style.display = 'none';
        }, 3000);
    </script>
  @endif

  @if(session('error'))
    <div class="alert-popup-error" id="errorAlert" style="top: 15px;">
        <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('errorAlert');
            if(el) el.style.display = 'none';
        }, 3000);
    </script>
  @endif

  <a href="{{ url('/dashboard-admin') }}" class="material-symbols-back">
    <img src="{{ asset('Images/keluar.svg') }}" alt="Tombol Keluar" />
  </a>

  <div class="text-wrapper-title" style="left: 110px;">Pengeluaran</div>
  
  <div class="streamline-freehand">
    <img src="{{ asset('Images/dompet.svg') }}" alt="Ikon Pengeluaran" />
  </div>

  <hr class="line-separator">



  <div class="data-table-container">
    <div class="figma-grid-table">
      <div class="table-header-row">
        <div class="col-4-reduced">Nomor</div>
        <div class="col-3-reduced">Kategori</div>
        <div class="col-3-reduced">Total</div>
        <div class="col-5-action">Aksi</div>
      </div>
      <div class="table-data-rows">
        @if(isset($data_pengeluaran) && $data_pengeluaran->count() > 0)
          @foreach($data_pengeluaran as $pengeluaran)
            <div class="table-body-row">
              <div class="col-4-reduced" style="font-weight: 600;">#{{ $pengeluaran->nomor_pengeluaran }}</div>
              <div class="col-3-reduced">
                <span style="font-size:9px; background-color: #e3f2fd; padding: 2px 6px; border-radius: 8px; border: 1px solid #90caf9; font-weight: 600; display: inline-block;">
                  {{ $pengeluaran->kategori }}
                </span>
                <div style="font-size:8px; color:#666; margin-top:2px;">
                  Mulai: {{ date('d/m/Y', strtotime($pengeluaran->tanggal_mulai ?? $pengeluaran->tanggal)) }}
                  <span style="background-color: #fbe9e7; color: #d84315; padding: 1px 4px; border-radius: 4px; font-size: 7px; font-weight: 700; text-transform: uppercase;">
                    {{ $pengeluaran->periode }}
                  </span>
                </div>
              </div>
              <div class="col-3-reduced" style="font-weight: 600; color: #e6005c;">Rp {{ number_format($pengeluaran->total, 0, ',', '.') }}</div>
              <div class="col-5-action">
                <a href="{{ url('/pengeluaran/edit/'.$pengeluaran->id) }}" class="btn-mini-edit" title="Ubah">
                  <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="{{ url('/pengeluaran/hapus/'.$pengeluaran->id) }}" onclick="return confirm('Hapus pengeluaran #{{ $pengeluaran->nomor_pengeluaran }} ({{ $pengeluaran->kategori }})?')" class="btn-mini-delete" title="Hapus">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align: center; color: #a5a5a5; padding: 50px 10px; font-size: 13px;">
            Belum ada catatan pengeluaran.
          </div>
        @endif
      </div>
    </div>
  </div> 

  <div class="add-data-action-container">
    <button type="button" class="add-data-btn" onclick="location.href='/pengeluaran/kategori'">
      + Catat Pengeluaran
    </button>
  </div>

  <div class="bg-gradient-bottom" style="background: linear-gradient(180deg, #ffffff 0%, rgba(193, 214, 243, 1) 100%);"></div>

  <div class="admin-bottom-nav">
    <a href="{{ url('/dashboard-admin') }}" class="nav-item"><img src="{{ asset('Images/rumah.svg') }}" alt="Home Icon" /></a>
    <a href="{{ url('/rekap-omset') }}" class="nav-item"><img src="{{ asset('Images/uang-hitam.svg') }}" alt="Money Icon" /></a>
    <a href="{{ url('/pengeluaran') }}" class="nav-item active"><img src="{{ asset('Images/dompet.svg') }}" alt="Expenses Icon" /></a>
    <a href="{{ url('/pendataan') }}" class="nav-item"><img src="{{ asset('Images/catatan-hitam.svg') }}" alt="Bill List Icon" /></a>
  </div>

</div>

<script src="{{ asset('js/shared.js') }}"></script>
</body>
</html>
