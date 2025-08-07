<div id="errorModal" class="modal error-modal">
    <div class="modal-logout-content">
        <div class="modal-error-header">
            <h3 class="modal-title">Terjadi Kesalahan</h3>
            <button class="close-btn" onclick="closeModal('errorModal')" aria-label="Tutup">&times;</button>
        </div>
        <div class="error-modal-body">
            <div class="error-icon">⚠️</div>
            <div class="error-title" id="errorTitle"></div>
            <div class="error-message" id="errorMessage">
            </div>
            <div class="error-actions">
                <button class="btn btn-primary" onclick="closeModal('errorModal')">
                    ✅ Mengerti
                </button>
            </div>
        </div>
    </div>
</div>