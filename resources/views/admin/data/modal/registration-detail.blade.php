<div id="viewRegistrationModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">Detail Pendaftaran</h3>
            <button class="close-btn hover-scale" onclick="closeModal('viewRegistrationModal')" aria-label="Close">
                &times;
            </button>
        </div>
        <div id="registrationDetails">
            <!-- Registration details will be populated here -->
        </div>
        <div style="display: flex; gap: var(--space-4); justify-content: flex-end; margin-top: var(--space-8);">
            <button class="btn btn-secondary hover-scale" onclick="closeModal('viewRegistrationModal')">
                <span>✕</span>
                <span>Tutup</span>
            </button>
        </div>
    </div>
</div>
