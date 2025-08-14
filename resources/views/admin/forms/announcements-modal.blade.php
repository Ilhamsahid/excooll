<div id="addAnnouncementModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">
                Buat Pengumuman Baru
            </h3>
            <button class="close-btn hover-scale" onclick="closeModal('addAnnouncementModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="addAnnouncementForm">
            <div class="form-group">
                <label class="form-label">Judul Pengumuman</label>
                <input type="text" class="form-input" required placeholder="Judul pengumuman" />
            </div>

            <div class="form-group">
                <label class="form-label">Isi Pengumuman</label>
                <textarea class="form-textarea" rows="6" required placeholder="Isi pengumuman..."></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kegiatan Terkait</label>
                    <select class="form-select">
                        <option value="">Pengumuman Umum</option>
                        <option value="1">Klub Basket</option>
                        <option value="2">Komunitas Drama</option>
                        <option value="3">Olimpiade Sains</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Prioritas</label>
                    <select class="form-select" required>
                        <option value="normal">Normal</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Publikasi</label>
                    <input type="datetime-local" class="form-input" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select" required>
                        <option value="draft">Draft</option>
                        <option value="published">Publikasi Sekarang</option>
                        <option value="scheduled">Jadwalkan</option>
                    </select>
                </div>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary hover-scale"
                    onclick="closeModal('addAnnouncementModal')">
                    <span>❌</span>
                    <span>Batal</span>
                </button>
                <button type="submit" class="btn btn-primary hover-lift">
                    <span>📢</span>
                    <span>Publikasi Pengumuman</span>
                </button>
            </div>
        </form>
    </div>
</div>
