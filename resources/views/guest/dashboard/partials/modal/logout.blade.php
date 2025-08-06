<div id="logoutModal" class="modal logout-modal">
    <div class="modal-logout-content">
        <div class="modal-profile-header">
            <h3 class="modal-profile-title">Konfirmasi Keluar</h3>
            <button class="close-btn" onclick="closeModal('logoutModal')" aria-label="Tutup">&times;</button>
        </div>
        <div class="logout-modal-body">
            <div class="logout-icon">🚪</div>
            <div class="logout-title">Apakah Anda yakin ingin keluar?</div>
            <div class="logout-message">
                Anda akan keluar dari sistem EkstraKu dan perlu masuk lagi untuk mengakses fitur-fitur yang memerlukan
                autentikasi.
            </div>
            <div class="logout-actions">
                <button class="btn btn-secondary" onclick="closeModal('logoutModal')">
                    ❌ Batal
                </button>
                <button class="btn btn-danger" onclick="confirmLogout()">
                    🚪 Ya, Keluar
                </button>
            </div>
        </div>
    </div>
</div>
