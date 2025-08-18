<div id="viewActivityModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">Detail Kegiatan</h3>
            <button class="close-btn hover-scale" onclick="closeModal('viewActivityModal')" aria-label="Close">
                &times;
            </button>
        </div>
        <div id="activityDetails">
            
        </div>
        <div style="display: flex; gap: var(--space-4); justify-content: flex-end; margin-top: var(--space-8);">
            <button class="btn btn-secondary hover-scale" onclick="closeModal('viewActivityModal')">
                <span>✕</span>
                <span>Tutup</span>
            </button>
            <button class="btn btn-primary hover-lift" onclick="editActivityFromView()">
                <span>✏️</span>
                <span>Edit Kegiatan</span>
            </button>
        </div>
    </div>
</div>