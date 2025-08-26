<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">Hapus Kegiatan</h3>
            <button class="close-btn hover-scale" onclick="closeModal('deleteModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <div style="text-align: center; padding: var(--space-6) 0;">
            <div style="font-size: var(--font-size-6xl); margin-bottom: var(--space-4); color: var(--error-500);">
                ⚠️
            </div>
            <h4
                style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); margin-bottom: var(--space-4); color: var(--text-primary);">
                Apakah Anda yakin ingin menghapus kegiatan ini?
            </h4>
            <p style="color: var(--text-secondary); margin-bottom: var(--space-2);">
                <strong id="deleteActivityName">Nama kegiatan akan ditampilkan di sini</strong>
            </p>
            <p style="color: var(--text-tertiary); font-size: var(--font-size-sm);">
                Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait kegiatan ini.
            </p>
        </div>

        <div style="display: flex; gap: var(--space-4); justify-content: center; margin-top: var(--space-6);">
            <button class="btn btn-secondary hover-scale" onclick="closeModal('deleteModal')">
                <span>❌</span>
                <span>Batal</span>
            </button>
            <form id="deleteForm">
                <button class="btn btn-danger hover-lift" type="submit" onclick="confirmDelete()">
                    <input type="hidden" name="id">
                    <span>🗑️</span>
                    <span>Ya, Hapus</span>
                </button>
            </form>
        </div>
    </div>
</div>
