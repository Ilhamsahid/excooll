    <div id="viewAnnouncementModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-gradient-primary">Detail Pengumuman</h3>
                <button class="close-btn hover-scale" onclick="closeModal('viewAnnouncementModal')" aria-label="Close">
                    &times;
                </button>
            </div>
            <div id="announcementDetails">
                <!-- Announcement details will be populated here WITHOUT likes and views -->
            </div>
            <div style="display: flex; gap: var(--space-4); justify-content: flex-end; margin-top: var(--space-8);">
                <button class="btn btn-secondary hover-scale" onclick="closeModal('viewAnnouncementModal')">
                    <span>✕</span>
                    <span>Tutup</span>
                </button>
                <button class="btn btn-primary hover-lift" onclick="editAnnouncementFromView()">
                    <span>✏️</span>
                    <span>Edit Pengumuman</span>
                </button>
            </div>
        </div>
    </div>
