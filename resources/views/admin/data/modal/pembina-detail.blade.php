<div id="viewMentorModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">Detail Mentor</h3>
            <button class="close-btn hover-scale" onclick="closeModal('viewAnnouncementModal')" aria-label="Close">
                &times;
            </button>
        </div>
        <div id="mentorDetails">

        </div>
        <div style="display: flex; gap: var(--space-4); justify-content: flex-end; margin-top: var(--space-8);">
            <button class="btn btn-secondary hover-scale" onclick="closeModal('viewMentorModal')">
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
