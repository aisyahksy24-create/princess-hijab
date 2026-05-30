<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<title>Pendataan - Princess Hijab</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

/* SMARTPHONE CONTAINER FRAME */
.android-compact {
  background-color: #ffffff;
  overflow: hidden;
  width: 412px;
  height: 917px;
  position: relative;
  box-shadow: 0px 15px 35px rgba(0, 0, 0, 0.15);
}

/* HEADER GRADIENT AREA */
.android-compact .rectangle-header {
  position: absolute;
  top: 0;
  left: 0;
  width: 412px;
  height: 135px;
  background: linear-gradient(0deg, rgba(253, 246, 200, 1) 0%, rgba(245, 185, 219, 1) 100%);
  z-index: 1;
}

/* TOMBOL KELUAR KIRI ATAS */
.android-compact .material-symbols-back {
  position: absolute;
  top: 75px;
  left: 18px;
  width: 35px;
  height: 35px;
  cursor: pointer;
  z-index: 3;
}
.android-compact .material-symbols-back img { width: 100%; height: 100%; }

/* JUDUL UTAMA HALAMAN */
.android-compact .text-wrapper-title {
  position: absolute;
  top: 75px;
  left: 121px;
  font-weight: 600;
  color: #000000;
  font-size: 28px;
  z-index: 2;
}

/* IKON CATATAN KANAN ATAS */
.android-compact .streamline-freehand {
  position: absolute;
  top: 70px;
  left: 325px;
  width: 45px;
  height: 45px;
  z-index: 3;
}
.android-compact .streamline-freehand img { width: 100%; height: 100%; object-fit: contain; }

/* GARIS PEMBATAS HEADER */
.android-compact .line-separator {
  position: absolute;
  top: 134px;
  left: 0;
  width: 412px;
  height: 2px;
  background-color: #000000;
  border: none;
  z-index: 2;
}

/* NAVIGATION TABS GRID */
.tab-navigation-grid {
  position: absolute;
  top: 150px;
  left: 24px;
  width: 364px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  z-index: 3;
}

.tab-nav-btn {
  height: 43px;
  font-family: "Montserrat Alternates", sans-serif;
  font-weight: 600;
  font-size: 14px;
  border-radius: 20px;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
}

.tab-nav-btn.active {
  background-color: #c1d6f3;
  border: 1px solid #000000;
  color: #000000;
}
.tab-nav-btn.inactive {
  background-color: #dad5d5;
  color: #666666;
}

/* CONTAINER UTAMA TABEL DATA */
.data-table-container {
  position: absolute;
  top: 265px;
  left: 21px;
  width: 371px;
  height: 420px;
  background-color: #ffffff;
  border: 2px solid #1e1e1e;
  border-radius: 20px;
  z-index: 2;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.figma-grid-table { width: 100%; height: 100%; display: flex; flex-direction: column; }
.table-header-row { display: flex; background-color: #ffffff; border-bottom: 2px solid #1e1e1e; padding: 12px 0; font-weight: 600; font-size: 13px; text-align: center; }
.table-data-rows { display: flex; flex-direction: column; overflow-y: auto; flex: 1; }
.table-body-row { display: flex; border-bottom: 1px solid #e0e0e0; padding: 14px 0; font-size: 12px; text-align: center; font-weight: 500; align-items: center; }

/* PENYESUAIAN UKURAN KOLOM AGAR CUKUP DENGAN TOMBOL HAPUS */
.col-5-action { width: 16%; display: flex; justify-content: center; align-items: center; }
.col-4-reduced { width: 21%; border-right: 1px solid #1e1e1e; word-break: break-word; padding: 0 2px; }
.col-3-reduced { width: 28%; border-right: 1px solid #1e1e1e; word-break: break-word; padding: 0 2px; }

/* TOMBOL SAMPAH MINI UNTUK HAPUS */
.btn-mini-delete {
  background: none;
  border: none;
  color: #ff4d4d;
  cursor: pointer;
  font-size: 15px;
  transition: transform 0.2s ease;
  padding: 4px;
}
.btn-mini-delete:hover {
  transform: scale(1.2);
}

/* NOTIFIKASI SUKSES POPUP */
.alert-popup-success {
  position: absolute;
  top: 15px;
  left: 26px;
  width: 360px;
  background-color: #d6fccd;
  border: 1.5px solid #000000;
  border-radius: 15px;
  padding: 12px;
  text-align: center;
  font-size: 13px;
  font-weight: 600;
  color: #274421;
  z-index: 20;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
}

/* TOMBOL + TAMBAH DATA */
.add-data-action-container {
  position: absolute;
  top: 698px;
  right: 21px;
  z-index: 3;
}
.add-data-btn {
  background-color: #c1d6f3;
  border: 1px solid #000000;
  border-radius: 12px;
  padding: 0 16px;
  height: 34px;
  color: #000000;
  font-family: "Montserrat Alternates", sans-serif;
  font-weight: 600;
  font-size: 13px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  transition: background-color 0.2s ease;
}
.add-data-btn:hover {
  background-color: #acc8eb;
}

/* SLIDE-UP FORM MODAL */
.modal-overlay-blur {
  position: absolute;
  top: 0; left: 0; width: 412px; height: 917px;
  background-color: rgba(0, 0, 0, 0.4);
  z-index: 10;
  display: none;
}

.bottom-sheet-form {
  position: absolute;
  bottom: 0; left: 0; width: 412px; height: 530px;
  background-color: #ffffff;
  border-radius: 40px 40px 0 0;
  box-shadow: 0px -4px 15px rgba(0,0,0,0.155);
  padding: 25px 24px;
  display: flex;
  flex-direction: column;
  align-items: center;
  pointer-events: auto;
  overflow-y: auto;
}

.bottom-sheet-title { font-size: 18px; font-weight: 600; color: #000000; margin-bottom: 20px; width: 100%; text-align: center; }

.form-input-group { width: 100%; display: flex; flex-direction: column; gap: 12px; }
.input-field-wrapper { width: 100%; }
.input-field-wrapper input {
  width: 100%; height: 44px;
  background-color: #fcebf5;
  border: none;
  border-radius: 15px; padding: 0 20px;
  font-family: "Montserrat Alternates", sans-serif;
  font-size: 14px; font-weight: 600; color: #000000; outline: none;
}
.input-field-wrapper input::placeholder { color: #a5a5a5; font-weight: 500; }

.form-actions-row { display: flex; width: 100%; justify-content: space-between; margin-top: 20px; }
.btn-action-form { width: 150px; height: 45px; border-radius: 12px; border: none; font-family: "Montserrat Alternates", sans-serif; font-weight: 600; font-size: 15px; cursor: pointer; }
.btn-action-form.btn-cancel { background-color: #d9d9d9; color: #000000; }
.btn-action-form.btn-save { background-color: #c1d6f3; color: #000000; border: 1px solid #000000; }

.android-compact .bg-gradient-bottom {
  position: absolute;
  top: 647px; left: 0; width: 412px; height: 304px;
  background: linear-gradient(180deg, rgba(255, 255, 255, 0) 24%, rgba(245, 185, 219, 0.5) 96%);
  z-index: 1; pointer-events: none;
}

/* BOTTOM NAVIGATION BAR */
.bottom-nav-bar {
  position: absolute;
  top: 812px;
  left: 56px;
  width: 301px;
  height: 60px;
  border-radius: 40px;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  background: linear-gradient(0deg, rgba(255, 255, 255, 1) 0%, rgba(184, 230, 173, 1) 100%);
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 0 10px;
  z-index: 5;
}
.nav-icon { width: 44px; height: 44px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
.nav-icon img { width: 100%; height: 100%; object-fit: contain; }

.nav-icon.active {
  background-color: #c1d6f3;
  border: 2px solid #000000;
  border-radius: 50%;
}

.hidden-section { display: none !important; }
</style>
</head>
<body>

<div class="android-compact">
  <div class="rectangle-header"></div>

  @if(session('sukses'))
    <div class="alert-popup-success" id="successAlert">
        <i class="fa-solid fa-circle-check"></i> {{ session('sukses') }}
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('successAlert').style.display = 'none';
        }, 3000);
    </script>
  @endif

  <div class="material-symbols-back" onclick="location.href='{{ url('/dashboard-admin') }}'">
    <img src="{{ asset('Images/keluar.svg') }}" alt="Tombol Keluar" />
  </div>

  <div class="text-wrapper-title">Pendataan</div>
  
  <div class="streamline-freehand">
    <img src="{{ asset('Images/catatan.svg') }}" alt="Ikon Catatan" />
  </div>

  <hr class="line-separator">

  <div class="tab-navigation-grid">
    <button type="button" id="tab-produk" class="tab-nav-btn active" onclick="switchTabArea('produk')">Data Produk</button>
    <button type="button" id="tab-pemasok" class="tab-nav-btn inactive" onclick="switchTabArea('pemasok')">Data Pemasok</button>
    <button type="button" id="tab-jongko" class="tab-nav-btn inactive" onclick="switchTabArea('jongko')">Data Jongko</button>
    <button type="button" id="tab-pegawai" class="tab-nav-btn inactive" onclick="switchTabArea('pegawai')">Data Pegawai</button>
  </div>

  <div class="data-table-container">
    
    <div id="section-produk" class="figma-grid-table">
      <div class="table-header-row">
        <div class="col-4-reduced">ID</div>
        <div class="col-4-reduced">Nama</div>
        <div class="col-4-reduced">Jenis</div>
        <div class="col-4-reduced">Ukuran</div>
        <div class="col-5-action">Aksi</div>
      </div>
      <div class="table-data-rows">
        @if(isset($data_produk) && $data_produk->count() > 0)
          @foreach($data_produk as $produk)
            <div class="table-body-row">
              <div class="col-4-reduced">PRD-{{ $produk->id }}</div>
              <div class="col-4-reduced">{{ $produk->nama_produk }}</div>
              <div class="col-4-reduced">{{ $produk->jenis }}</div>
              <div class="col-4-reduced">{{ $produk->ukuran }}</div>
              <div class="col-5-action">
                <a href="{{ url('/hapus-produk/'.$produk->id) }}" onclick="return confirm('Hapus produk {{ $produk->nama_produk }}?')" class="btn-mini-delete">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align: center; color: #a5a5a5; padding: 20px; font-size: 13px;">
            Belum ada data produk tersimpan di database.
          </div>
        @endif
      </div>
    </div> 

    <div id="section-pemasok" class="figma-grid-table hidden-section">
      <div class="table-header-row">
        <div class="col-4-reduced">ID</div>
        <div class="col-4-reduced">Nama</div>
        <div class="col-4-reduced">Alamat</div>
        <div class="col-4-reduced">No HP</div>
        <div class="col-5-action">Aksi</div>
      </div>
      <div class="table-data-rows">
        @if(isset($data_pemasok) && $data_pemasok->count() > 0)
          @foreach($data_pemasok as $pemasok)
            <div class="table-body-row">
              <div class="col-4-reduced">PMS-{{ $pemasok->id }}</div>
              <div class="col-4-reduced">{{ $pemasok->nama_pemasok }}</div>
              <div class="col-4-reduced">{{ $pemasok->alamat }}</div>
              <div class="col-4-reduced">{{ $pemasok->no_telp }}</div>
              <div class="col-5-action">
                <a href="{{ url('/hapus-pemasok/'.$pemasok->id) }}" onclick="return confirm('Hapus pemasok {{ $pemasok->nama_pemasok }}?')" class="btn-mini-delete">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align: center; color: #a5a5a5; padding: 20px; font-size: 13px;">
            Belum ada data pemasok tersimpan.
          </div>
        @endif
      </div>
    </div> 

    <div id="section-jongko" class="figma-grid-table hidden-section">
      <div class="table-header-row">
        <div class="col-3-reduced">ID Jongko</div>
        <div class="col-3-reduced">Nama</div>
        <div class="col-3-reduced">Alamat</div>
        <div class="col-5-action">Aksi</div>
      </div>
      <div class="table-data-rows">
        @if(isset($data_jongko) && $data_jongko->count() > 0)
          @foreach($data_jongko as $jongko)
            <div class="table-body-row">
              <div class="col-3-reduced">JGK-{{ $jongko->id }}</div>
              <div class="col-3-reduced">{{ $jongko->nama_jongko }}</div>
              <div class="col-3-reduced">{{ $jongko->alamat }}</div>
              <div class="col-5-action">
                <a href="{{ url('/hapus-jongko/'.$jongko->id) }}" onclick="return confirm('Hapus jongko {{ $jongko->nama_jongko }}?')" class="btn-mini-delete">
                  <i class="fa-solid fa-trash-can"></i>
                </a>
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align: center; color: #a5a5a5; padding: 20px; font-size: 13px;">
            Belum ada data jongko tersimpan.
          </div>
        @endif
      </div>
    </div> 

    <div id="section-pegawai" class="figma-grid-table hidden-section">
      <div class="table-header-row">
        <div class="col-4-reduced">ID</div>
        <div class="col-4-reduced">Nama</div>
        <div class="col-4-reduced">Alamat</div>
        <div class="col-4-reduced">No HP</div>
        <div class="col-5-action">Aksi</div>
      </div>
      <div class="table-data-rows">
        @if(isset($data_pegawai) && $data_pegawai->count() > 0)
          @foreach($data_pegawai as $pegawai)
            <div class="table-body-row">
              <div class="col-4-reduced">PGW-{{ $pegawai->id }}</div>
              <div class="col-4-reduced">{{ $pegawai->nama_pegawai }}</div>
              <div class="col-4-reduced">{{ $pegawai->alamat }}</div>
              <div class="col-4-reduced">{{ $pegawai->no_telp }}</div>
              <div class="col-5-action">
                @if($pegawai->role !== 'admin')
                  <a href="{{ url('/hapus-pegawai/'.$pegawai->id) }}" onclick="return confirm('Hapus pegawai {{ $pegawai->nama_pegawai }}?')" class="btn-mini-delete">
                    <i class="fa-solid fa-trash-can"></i>
                  </a>
                @else
                  <span style="font-size:10px; color:#aaa; font-weight:600;">Core</span>
                @endif
              </div>
            </div>
          @endforeach
        @else
          <div style="text-align: center; color: #a5a5a5; padding: 20px; font-size: 13px;">
            Belum ada data pegawai tersimpan.
          </div>
        @endif
      </div>
    </div> 

  </div> 

  <div class="add-data-action-container">
    <button type="button" class="add-data-btn" onclick="toggleModalForm(true)">
      + Tambah Data
    </button>
  </div>

  <div id="form-bottom-sheet" class="modal-overlay-blur" onclick="toggleModalForm(false)">
    <div class="bottom-sheet-form" onclick="event.stopPropagation();">
      <div class="bottom-sheet-title" id="dynamic-modal-title">Tambahkan Produk</div>
      
      <form id="dynamic-modal-form" action="{{ url('/store-produk') }}" method="POST" class="form-input-group">
        @csrf
        
        <div id="dynamic-inputs-container"></div>

        <div class="form-actions-row">
          <button type="button" class="btn-action-form btn-cancel" onclick="toggleModalForm(false)">Batal</button>
          <button type="submit" class="btn-action-form btn-save">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="bg-gradient-bottom"></div>

  <div class="bottom-nav-bar">
    <div class="nav-icon" onclick="location.href='{{ url('/dashboard-admin') }}'">
      <img src="{{ asset('Images/rumah.svg') }}" alt="Home Icon" />
    </div>
    <div class="nav-icon" onclick="location.href='{{ url('/rekap-omset') }}'">
      <img src="{{ asset('Images/uang hitam.svg') }}" alt="Money Icon" />
    </div>
    <div class="nav-icon" onclick="location.href='{{ url('/upah-pegawai') }}'">
      <img src="{{ asset('Images/tangan love.svg') }}" alt="Hand Heart Icon" />
    </div>
    <div class="nav-icon active" onclick="switchTabArea('produk')">
      <img src="{{ asset('Images/catatan hitam.svg') }}" alt="Bill List Icon" />
    </div>
  </div>

</div>

<script>
  let currentActiveTab = 'produk';

  function switchTabArea(targetTab) {
    currentActiveTab = targetTab;
    
    localStorage.setItem('activeTabPendataan', targetTab);

    const allTabs = ['produk', 'pemasok', 'jongko', 'pegawai'];

    allTabs.forEach(tab => {
        const tabBtn = document.getElementById(`tab-${tab}`);
        const section = document.getElementById(`section-${tab}`);
        if(tabBtn) {
            tabBtn.className = (tab === targetTab) ? "tab-nav-btn active" : "tab-nav-btn inactive";
        }
        if(section) {
            section.classList.add('hidden-section');
        }
    });

    const activeSection = document.getElementById(`section-${targetTab}`);
    if(activeSection) {
        activeSection.classList.remove('hidden-section');
    }

    const inputContainer = document.getElementById('dynamic-inputs-container');
    const mainForm = document.getElementById('dynamic-modal-form');
    const modalTitle = document.getElementById('dynamic-modal-title');

    if (!inputContainer) return; 

    if (targetTab === 'produk') {
        if(modalTitle) modalTitle.textContent = "Tambahkan Produk";
        if(mainForm) mainForm.action = "{{ url('/store-produk') }}";

        inputContainer.innerHTML = `
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="Nama Produk" name="nama_produk" required></div>
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="Jenis" name="jenis" required></div>
            <div class="input-field-wrapper"><input type="text" placeholder="Ukuran" name="ukuran" required></div>
        `;
    } else if (targetTab === 'pemasok') {
        if(modalTitle) modalTitle.textContent = "Tambahkan Pemasok";
        if(mainForm) mainForm.action = "{{ url('/store-pemasok') }}";

        inputContainer.innerHTML = `
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="Nama Pemasok" name="nama_pemasok" required></div>
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="Alamat" name="alamat" required></div>
            <div class="input-field-wrapper"><input type="text" placeholder="No HP" name="no_telp" required></div>
        `;
    } else if (targetTab === 'jongko') {
        if(modalTitle) modalTitle.textContent = "Tambahkan Jongko";
        if(mainForm) mainForm.action = "{{ url('/store-jongko') }}";

        inputContainer.innerHTML = `
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="Nama Jongko" name="nama_jongko" required></div>
            <div class="input-field-wrapper"><input type="text" placeholder="Alamat" name="alamat" required></div>
        `;
    } else if (targetTab === 'pegawai') {
        if(modalTitle) modalTitle.textContent = "Tambahkan Pegawai";
        if(mainForm) mainForm.action = "{{ url('/store-pegawai') }}"; 

        inputContainer.innerHTML = `
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="Nama Pegawai" name="nama_pegawai" required></div>
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="Alamat" name="alamat" required></div>
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="No HP" name="no_telp" required></div>
            <div class="input-field-wrapper" style="margin-bottom: 12px;"><input type="text" placeholder="Buat Username Login" name="username" required></div>
            <div class="input-field-wrapper"><input type="password" placeholder="Buat Password Login" name="password" required></div>
        `;
    }
  }

  function toggleModalForm(shouldShow) {
    const modal = document.getElementById('form-bottom-sheet');
    if(modal) {
      modal.style.display = shouldShow ? 'block' : 'none';
    }
    
    if(!shouldShow) {
      switchTabArea(currentActiveTab); 
    }
  }

  document.addEventListener("DOMContentLoaded", function() {
    const lastActiveTab = localStorage.getItem('activeTabPendataan') || 'produk';
    switchTabArea(lastActiveTab);
  });
</script>

</body>
</html>