<div id="announcementModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Buat Pengumuman - Klub Basket</h3>
            <button class="close-btn" onclick="closeModal('announcementModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="announcementForm" onsubmit="handleAnnouncementSubmit(event)">
            <div class="form-group">
                <label class="form-label">Judul Pengumuman</label>
                <input type="text" class="form-input" required placeholder="Judul pengumuman" />
            </div>

            <div class="form-group">
                <label class="form-label">Isi Pengumuman</label>
                <textarea class="form-textarea" rows="6" required placeholder="Tulis pengumuman untuk klub basket..."></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Target Audience</label>
                    <select class="form-select" required>
                        <option value="all">Semua Anggota Klub Basket</option>
                        <option value="core">Tim Inti</option>
                        <option value="reserve">Tim Reserve</option>
                        <option value="new">Anggota Baru</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Prioritas</label>
                    <select class="form-select" required>
                        <option value="normal">📌 Normal</option>
                        <option value="high">⚡ Tinggi</option>
                        <option value="urgent">🚨 Urgent</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Publikasi</label>
                    <input type="date" class="form-input" required name="tanggal" id="tanggal" />
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi Pengumuman</label>
                    <input type="text" class="form-input" required placeholder="Lokasi pengumuman" name="lokasi"
                        id="lokasi" />
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
                <button type="button" class="btn btn-ghost" onclick="saveDraft()">
                    💾 Simpan Draft
                </button>
                <button type="submit" class="btn btn-primary">📢 Publikasi</button>
            </div>
        </form>
    </div>
</div>
