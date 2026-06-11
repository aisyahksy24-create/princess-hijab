<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta charset="utf-8" />
<title>Tambah Pengeluaran - Princess Hijab</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/shared.css') }}">
<style>
  .tambah-form-card {
    position: absolute;
    top: 135px;
    left: 24px;
    width: calc(100% - 48px);
    background: #fff;
    border: 1.5px solid #000;
    border-radius: 20px;
    padding: 15px;
    display: flex;
    gap: 12px;
    z-index: 5;
  }
  .category-banner {
    position: absolute;
    top: 295px;
    left: 24px;
    width: calc(100% - 48px);
    background: #fff;
    border: 1.5px solid #000;
    border-radius: 20px;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 5;
  }
  .items-section {
    position: absolute;
    top: 370px;
    left: 24px;
    width: calc(100% - 48px);
    z-index: 5;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .total-section {
    position: absolute;
    top: 675px;
    left: 24px;
    width: calc(100% - 48px);
    background: #fff;
    border: 1.5px solid #000;
    border-radius: 15px;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 5;
  }
  .submit-section {
    position: absolute;
    top: 755px;
    left: 24px;
    width: calc(100% - 48px);
    z-index: 5;
  }
  .submit-btn {
    width: 100%;
    height: 50px;
    background: #e2e2e7;
    border: 1.5px solid #000;
    border-radius: 20px;
    font-family: 'Montserrat Alternates', sans-serif;
    font-weight: 600;
    font-size: 16px;
    color: #8e8e93;
    cursor: not-allowed;
    transition: all 0.2s ease;
  }
</style>
</head>
<body>

<div class="android-compact page-pendataan">
  <div class="rectangle-header" style="background: linear-gradient(0deg, rgba(193, 214, 243, 1) 0%, rgba(245, 185, 219, 1) 100%);"></div>

  @if(session('error'))
    <div class="alert-popup-error" id="errorAlert" style="top: 15px; z-index: 9999;">
        <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
    </div>
    <script>
        setTimeout(() => {
            const el = document.getElementById('errorAlert');
            if(el) el.style.display = 'none';
        }, 3000);
    </script>
  @endif

  <a href="{{ url('/pengeluaran/kategori') }}" class="material-symbols-back">
    <img src="{{ asset('Images/keluar.svg') }}" alt="Tombol Keluar" />
  </a>

  <div class="text-wrapper-title" style="left: 100px; font-size: 24px;">Catat Pengeluaran</div>
  
  <div class="streamline-freehand">
    <img src="{{ asset('Images/dompet.svg') }}" alt="Ikon Pengeluaran" />
  </div>

  <hr class="line-separator">

  <!-- Bagian 1: Nomor Pengeluaran & Tanggal & Periode & Tanggal Mulai -->
  <div class="tambah-form-card" style="display: flex; flex-direction: column; gap: 10px;">
    <div style="display: flex; gap: 12px; width: 100%;">
      <div style="flex: 1; display: flex; flex-direction: column; gap: 4px;">
        <label style="font-size: 11px; font-weight: 600; color: #666;">Nomor Pengeluaran</label>
        <select name="nomor_pengeluaran" style="width: 100%; height: 38px; border: 1.5px solid #000; border-radius: 10px; font-family: 'Montserrat Alternates', sans-serif; font-size: 13px; font-weight: 600; padding: 0 10px; outline: none; background: #fff;">
           <option value="{{ $next_number }}" selected>{{ $next_number }}</option>
           @for($i = 1; $i <= 50; $i++)
             @if($i != $next_number)
               <option value="{{ $i }}">{{ $i }}</option>
             @endif
           @endfor
        </select>
      </div>
      <div style="flex: 1; display: flex; flex-direction: column; gap: 4px;">
        <label style="font-size: 11px; font-weight: 600; color: #666;">Tanggal</label>
        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" style="width: 100%; height: 38px; border: 1.5px solid #000; border-radius: 10px; font-family: 'Montserrat Alternates', sans-serif; font-size: 12px; font-weight: 600; padding: 0 10px; outline: none;">
      </div>
    </div>
    <div style="display: flex; gap: 12px; width: 100%;">
      <div style="flex: 1; display: flex; flex-direction: column; gap: 4px;">
        <label style="font-size: 11px; font-weight: 600; color: #666;">Periode</label>
        <select name="periode" style="width: 100%; height: 38px; border: 1.5px solid #000; border-radius: 10px; font-family: 'Montserrat Alternates', sans-serif; font-size: 13px; font-weight: 600; padding: 0 10px; outline: none; background: #fff;">
           <option value="harian" selected>Harian</option>
           <option value="mingguan">Mingguan</option>
           <option value="bulanan">Bulanan</option>
           <option value="tahunan">Tahunan</option>
        </select>
      </div>
      <div style="flex: 1; display: flex; flex-direction: column; gap: 4px;">
        <label style="font-size: 11px; font-weight: 600; color: #666;">Tanggal Mulai</label>
        <input type="date" name="tanggal_mulai" value="{{ date('Y-m-d') }}" style="width: 100%; height: 38px; border: 1.5px solid #000; border-radius: 10px; font-family: 'Montserrat Alternates', sans-serif; font-size: 12px; font-weight: 600; padding: 0 10px; outline: none;">
      </div>
    </div>
  </div>

  <!-- Bagian 2: Kategori Banner -->
  <div class="category-banner">
    <div style="display: flex; align-items: center; gap: 15px;">
      <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #ff477e; display: flex; align-items: center; justify-content: center; border: 1.5px solid #000;">
        <i class="fa-solid fa-wallet" style="color: #fff; font-size: 18px;"></i>
      </div>
      <span style="font-size: 15px; font-weight: 600; color: #000;">{{ $kategori }}</span>
    </div>
    <button type="button" onclick="location.href='/pengeluaran/kategori'" style="background: transparent; border: 1px solid #28a745; border-radius: 15px; padding: 4px 12px; font-family: 'Montserrat Alternates', sans-serif; font-weight: 600; color: #28a745; font-size: 12px; cursor: pointer; display: flex; align-items: center; gap: 5px;">
      <i class="fa-solid fa-arrows-rotate"></i> Ubah
    </button>
  </div>

  <!-- Bagian 3: Items section -->
  <div class="items-section">
    <button type="button" onclick="toggleItemModal(true)" style="width: 100%; height: 45px; background: #fff; border: 1.5px dashed #ff477e; border-radius: 15px; color: #ff477e; font-family: 'Montserrat Alternates', sans-serif; font-weight: 600; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px;">
      <i class="fa-solid fa-plus"></i> Tambah Item Pengeluaran
    </button>
    
    <div id="items-list-container" style="background: rgba(255, 255, 255, 0.65); border: 1.5px solid #000; border-radius: 20px; padding: 15px; max-height: 250px; overflow-y: auto; display: flex; flex-direction: column; gap: 8px;">
      <div id="no-items-message" style="text-align: center; color: #888; font-size: 12px; padding: 20px 0;">
        Belum ada item ditambahkan.
      </div>
    </div>
  </div>

  <!-- Bagian 4: Total box -->
  <div class="total-section">
    <span style="font-size: 15px; font-weight: 600; color: #000;">Total</span>
    <span id="overall-total-text" style="font-size: 16px; font-weight: 700; color: #ff477e; border-bottom: 1.5px solid #000; padding-bottom: 2px; min-width: 100px; text-align: right;">Rp 0</span>
  </div>

  <!-- Bagian 5: Simpan button -->
  <div class="submit-section">
    <button type="button" id="submit-btn" disabled onclick="submitMainForm()" class="submit-btn">
      Simpan
    </button>
  </div>

  <!-- Form Submission -->
  <form id="expense-form" action="{{ url('/pengeluaran/store') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="kategori" value="{{ $kategori }}">
    <input type="hidden" name="nomor_pengeluaran" id="nomor_pengeluaran_hidden">
    <input type="hidden" name="tanggal" id="tanggal_hidden">
    <input type="hidden" name="periode" id="periode_hidden">
    <input type="hidden" name="tanggal_mulai" id="tanggal_mulai_hidden">
    <input type="hidden" name="items" id="items_json_hidden">
  </form>

  <!-- Modal Item Pengeluaran (Bottom Sheet style overlay) -->
  <div id="item-modal" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; backdrop-filter: blur(5px); border-radius: 40px;">
    <div style="position: absolute; bottom: 0; left: 0; width: 100%; background: #fff; border-radius: 30px 30px 0 0; border-top: 2px solid #000; padding: 25px 20px; display: flex; flex-direction: column; gap: 15px; box-shadow: 0px -5px 15px rgba(0,0,0,0.15); font-family: 'Montserrat Alternates', sans-serif;">
      <div style="font-size: 16px; font-weight: 600; color: #000; display: flex; justify-content: space-between; align-items: center;">
        <span>Tambah Item Pengeluaran</span>
        <i class="fa-solid fa-xmark" style="cursor: pointer; font-size: 20px;" onclick="toggleItemModal(false)"></i>
      </div>
      
      <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
        <div style="display: flex; flex-direction: column; gap: 4px;">
          <label style="font-size: 12px; font-weight: 600; color: #555;">Nama</label>
          <input type="text" id="modal-item-nama" placeholder="Masukkan nama item" style="width: 100%; height: 42px; border: 1.5px solid #000; border-radius: 12px; padding: 0 15px; font-family: 'Montserrat Alternates', sans-serif; font-size: 13px; outline: none;">
        </div>
        
        <div style="display: flex; gap: 10px;">
          <div style="flex: 1; display: flex; flex-direction: column; gap: 4px;">
            <label style="font-size: 12px; font-weight: 600; color: #555;">Jumlah</label>
            <input type="number" id="modal-item-jumlah" value="1" min="1" oninput="calculateModalTotal()" style="width: 100%; height: 42px; border: 1.5px solid #000; border-radius: 12px; padding: 0 15px; font-family: 'Montserrat Alternates', sans-serif; font-size: 13px; outline: none;">
          </div>
          <div style="flex: 2; display: flex; flex-direction: column; gap: 4px;">
            <label style="font-size: 12px; font-weight: 600; color: #555;">Tarif</label>
            <input type="number" id="modal-item-tarif" value="0" min="0" oninput="calculateModalTotal()" style="width: 100%; height: 42px; border: 1.5px solid #000; border-radius: 12px; padding: 0 15px; font-family: 'Montserrat Alternates', sans-serif; font-size: 13px; outline: none;">
          </div>
        </div>
        
        <div style="background: #f8f9fa; border: 1.5px solid #000; border-radius: 12px; padding: 12px; display: flex; justify-content: space-between; align-items: center; margin-top: 5px;">
          <span style="font-size: 13px; font-weight: 600; color: #555;">Total</span>
          <span id="modal-item-total-text" style="font-size: 15px; font-weight: 700; color: #ff477e;">Rp 0</span>
        </div>
      </div>
      
      <button type="button" onclick="saveItemToForm()" style="width: 100%; height: 45px; background: #f5b9db; border: 1.5px solid #000; border-radius: 15px; font-family: 'Montserrat Alternates', sans-serif; font-weight: 600; font-size: 15px; color: #000; cursor: pointer; margin-top: 10px;">
        Simpan
      </button>
    </div>
  </div>

  <div class="bg-gradient-bottom"></div>
</div>

<script>
  let expenseItems = [];

  function toggleItemModal(show) {
    const modal = document.getElementById('item-modal');
    modal.style.display = show ? 'block' : 'none';
    if (show) {
      document.getElementById('modal-item-nama').value = '';
      document.getElementById('modal-item-jumlah').value = '1';
      document.getElementById('modal-item-tarif').value = '0';
      document.getElementById('modal-item-total-text').innerText = 'Rp 0';
    }
  }

  function calculateModalTotal() {
    const jumlah = parseInt(document.getElementById('modal-item-jumlah').value) || 0;
    const tarif = parseInt(document.getElementById('modal-item-tarif').value) || 0;
    const total = jumlah * tarif;
    document.getElementById('modal-item-total-text').innerText = 'Rp ' + total.toLocaleString('id-ID');
  }

  function saveItemToForm() {
    const nama = document.getElementById('modal-item-nama').value.trim();
    const jumlah = parseInt(document.getElementById('modal-item-jumlah').value) || 0;
    const tarif = parseInt(document.getElementById('modal-item-tarif').value) || 0;
    
    if (!nama) {
      alert('Nama item tidak boleh kosong!');
      return;
    }
    if (jumlah <= 0) {
      alert('Jumlah item harus lebih besar dari 0!');
      return;
    }
    if (tarif < 0) {
      alert('Tarif item tidak boleh negatif!');
      return;
    }
    
    expenseItems.push({
      nama: nama,
      jumlah: jumlah,
      tarif: tarif
    });
    
    renderItemsList();
    toggleItemModal(false);
  }

  function deleteItem(index) {
    expenseItems.splice(index, 1);
    renderItemsList();
  }

  function renderItemsList() {
    const container = document.getElementById('items-list-container');
    
    if (expenseItems.length === 0) {
      container.innerHTML = `
        <div id="no-items-message" style="text-align: center; color: #888; font-size: 12px; padding: 20px 0;">
          Belum ada item ditambahkan.
        </div>
      `;
      updateSubmitButton(false);
      updateOverallTotal(0);
      return;
    }
    
    let html = '';
    let overallTotal = 0;
    
    expenseItems.forEach((item, index) => {
      const itemTotal = item.jumlah * item.tarif;
      overallTotal += itemTotal;
      
      html += `
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #ddd; padding: 8px 0;">
          <div style="display: flex; flex-direction: column;">
            <span style="font-size: 12px; font-weight: 600; color: #000;">${item.nama}</span>
            <span style="font-size: 10px; color: #666;">${item.jumlah} x Rp ${item.tarif.toLocaleString('id-ID')}</span>
          </div>
          <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 12px; font-weight: 700; color: #000;">Rp ${itemTotal.toLocaleString('id-ID')}</span>
            <i class="fa-solid fa-trash-can" style="color: #ff477e; cursor: pointer; font-size: 12px;" onclick="deleteItem(${index})"></i>
          </div>
        </div>
      `;
    });
    
    container.innerHTML = html;
    updateOverallTotal(overallTotal);
    updateSubmitButton(true);
  }

  function updateOverallTotal(total) {
    document.getElementById('overall-total-text').innerText = 'Rp ' + total.toLocaleString('id-ID');
  }

  function updateSubmitButton(enable) {
    const btn = document.getElementById('submit-btn');
    if (enable) {
      btn.disabled = false;
      btn.style.background = '#f5b9db'; // Pink active
      btn.style.color = '#000';
      btn.style.cursor = 'pointer';
    } else {
      btn.disabled = true;
      btn.style.background = '#e2e2e7'; // Gray inactive
      btn.style.color = '#8e8e93';
      btn.style.cursor = 'not-allowed';
    }
  }

  function submitMainForm() {
    if (expenseItems.length === 0) {
      alert('Harap tambahkan minimal 1 item pengeluaran!');
      return;
    }
    
    // Set hidden fields
    const nomor = document.querySelector('select[name="nomor_pengeluaran"]').value;
    const tanggal = document.querySelector('input[name="tanggal"]').value;
    const periode = document.querySelector('select[name="periode"]').value;
    const tanggalMulai = document.querySelector('input[name="tanggal_mulai"]').value;
    
    document.getElementById('nomor_pengeluaran_hidden').value = nomor;
    document.getElementById('tanggal_hidden').value = tanggal;
    document.getElementById('periode_hidden').value = periode;
    document.getElementById('tanggal_mulai_hidden').value = tanggalMulai;
    document.getElementById('items_json_hidden').value = JSON.stringify(expenseItems);
    
    document.getElementById('expense-form').submit();
  }
</script>

<script src="{{ asset('js/shared.js') }}"></script>
</body>
</html>
