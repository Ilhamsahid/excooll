<div id="viewStudentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">Detail Siswa</h3>
            <button class="close-btn hover-scale" onclick="closeModal('viewStudentModal')" aria-label="Close">
                &times;
            </button>
        </div>
        <div id="studentDetails">
            <!-- Student details will be populated here -->
        </div>
        <div style="display: flex; gap: var(--space-4); justify-content: flex-end; margin-top: var(--space-8);">
            <button class="btn btn-secondary hover-scale" onclick="closeModal('viewStudentModal')">
                <span>✕</span>
                <span>Tutup</span>
            </button>
            <button class="btn btn-primary hover-lift" onclick="editStudentFromView()">
                <span>✏️</span>
                <span>Edit Siswa</span>
            </button>
        </div>
    </div>
</div>
