<div id="activityModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Buat Kegiatan - Klub Basket</h3>
            <button class="close-btn" onclick="closeModal('activityModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="activityForm" onsubmit="handleActivitySubmit(event)">
            <div class="form-group">
                <label class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-input" required placeholder="Nama kegiatan basket" />
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Kegiatan</label>
                <textarea class="form-textarea" required placeholder="Deskripsi detail kegiatan"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori Kegiatan</label>
                    <select class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="kompetisi">🏆 Kompetisi/Lomba</option>
                        <option value="workshop">🎯 Workshop/Pelatihan</option>
                        <option value="pertandingan">🏀 Pertandingan</option>
                        <option value="latihan">💪 Latihan Intensif</option>
                        <option value="seminar">📚 Seminar/Kuliah</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Level Kegiatan</label>
                    <select class="form-select" required>
                        <option value="">Pilih Level</option>
                        <option value="internal">Internal Sekolah</option>
                        <option value="regional">Regional</option>
                        <option value="nasional">Nasional</option>
                        <option value="friendly">Pertandingan Persahabatan</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-input" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-input" required />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-input" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-input" required />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-input" required placeholder="Lokasi kegiatan"
                        value="Lapangan Basket" />
                </div>
                <div class="form-group">
                    <label class="form-label">Target Peserta</label>
                    <input type="number" class="form-input" min="1" placeholder="Jumlah target peserta"
                        value="85" />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Budget (Rp)</label>
                    <input type="number" class="form-input" min="0" placeholder="Budget kegiatan" />
                </div>
                <div class="form-group">
                    <label class="form-label">Penanggung Jawab</label>
                    <input type="text" class="form-input" required placeholder="Nama PIC" value="Ahmad Surya" />
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Catatan Tambahan</label>
                <textarea class="form-textarea" placeholder="Catatan khusus atau persyaratan"></textarea>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary" onclick="closeModal('activityModal')">
                    ❌ Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    🎪 Buat Kegiatan
                </button>
            </div>
        </form>
    </div>
</div>
