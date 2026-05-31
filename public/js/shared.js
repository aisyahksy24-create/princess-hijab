// GLOBAL LOADING OVERLAY UTILITY
function showLoadingOverlay(text = "Sedang memproses...") {
    let overlay = document.querySelector('.loading-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'loading-overlay';
        overlay.innerHTML = `
            <div class="spinner"></div>
            <div class="loading-text">${text}</div>
        `;
        
        // Cari container utama .android-compact atau body
        const container = document.querySelector('.android-compact') || document.body;
        container.appendChild(overlay);
    } else {
        const textEl = overlay.querySelector('.loading-text');
        if (textEl) textEl.textContent = text;
    }
    
    // Tampilkan overlay dengan menambahkan kelas .show
    overlay.classList.add('show');
}

// Intercept programmatic form.submit() calls
const originalFormSubmit = HTMLFormElement.prototype.submit;
HTMLFormElement.prototype.submit = function() {
    showLoadingOverlay();
    
    // Disable submit buttons in the form
    const submitButtons = this.querySelectorAll('button[type="submit"], input[type="submit"]');
    submitButtons.forEach(btn => {
        btn.disabled = true;
        btn.style.opacity = '0.7';
        btn.style.cursor = 'not-allowed';
    });
    
    originalFormSubmit.apply(this);
};

document.addEventListener('DOMContentLoaded', function() {
    // 1. Dapatkan semua form di halaman ini
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Jika validasi native HTML5 gagal, biarkan browser menangani tanpa memicu loading
            if (form.checkValidity && !form.checkValidity()) {
                return;
            }
            
            showLoadingOverlay();
            
            // Nonaktifkan semua tombol submit untuk menghindari double clicks/double submit
            const submitButtons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
            submitButtons.forEach(btn => {
                btn.disabled = true;
                btn.dataset.originalText = btn.innerHTML;
                btn.style.opacity = '0.7';
                btn.style.cursor = 'not-allowed';
            });
        });
    });

    // 2. Intercept click events on links with critical actions (hapus, pulihkan, permanen, logout, cetak)
    document.addEventListener('click', function(e) {
        const anchor = e.target.closest('a');
        if (anchor) {
            const href = anchor.getAttribute('href');
            if (href && (
                href.includes('hapus') || 
                href.includes('pulihkan') || 
                href.includes('permanen') || 
                href.includes('logout') || 
                href.includes('cetak-')
            )) {
                // Wait slightly to let any inline onclick (e.g. confirm) run first
                setTimeout(() => {
                    if (!e.defaultPrevented) {
                        showLoadingOverlay("Memuat halaman...");
                    }
                }, 0);
            }
        }
    });
});
