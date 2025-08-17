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
                <input type="text" class="form-input" required placeholder="Judul pengumuman" name="judul"/>
                <div class="validation-message">Judul Harus diisi</div>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Pengumuman</label>
                <textarea class="form-textarea" rows="6" required placeholder="Isi pengumuman..." name="isi"></textarea>
                <div class="validation-message">Isi Pengumuman Harus diisi</div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kegiatan Terkait</label>
                    <select class="form-select" id="selectEkskul" name="ekskul_id" required>
                    </select>
                    <div class="validation-message">Kegiatan Harus diisi</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Tipe pengumuman</label>
                    <select class="form-select" required name="tipe">
                        <option value="wajib">Wajib</option>
                        <option value="opsional">Opsional</option>
                    </select>
                    <div class="validation-message">Tipe Pengumuman Harus diisi</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Publikasi</label>
                    <input type="date" class="form-input" required  name="tanggal"/>
                    <div class="validation-message">Tanggal Publikasi Harus diisi</div>
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
