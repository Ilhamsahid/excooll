<div id="announcementModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Buat Pengumuman - Klub Basket</h3>
            <button class="close-btn" onclick="closeModal('announcementModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="announcementForm">
            <div class="form-group">
                <label class="form-label">Judul Pengumuman</label>
                <input type="text" class="form-input" required placeholder="Judul pengumuman" id="judulPengumuman" name="judul" />
            </div>

            <div class="form-group">
                <label class="form-label">Isi Pengumuman</label>
                <textarea class="form-textarea" rows="6" required placeholder="Tulis pengumuman untuk klub basket..." id="isi" name="isi"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Tipe Pengumuman</label>
                <select class="form-select" required name="tipe" id="tipe">
                    <option value="wajib">Wajib</option>
                    <option value="opsional">Opsional</option>
                </select>
            </div>

            <input type="hidden" name="ekskul_id" value="{{ $pembina->ekskulDibina[0]->id }}">

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Publikasi</label>
                    <input type="date" class="form-input" required name="tanggal" id="tanggalPengumuman" />
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi Pengumuman</label>
                    <input type="text" class="form-input" required placeholder="Lokasi pengumuman" name="lokasi"
                        id="lokasiPengumuman" />
                </div>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary" onclick="closeModal('announcementModal')">
                    ❌ Batal
                </button>
                <button type="submit" class="btn btn-primary">📢 Publikasi</button>
            </div>
        </form>
    </div>
</div>
