<div id="scheduleModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Jadwal Baru - {{ $pembina->ekskulDibina[0]->nama }}</h3>
            <button class="close-btn" onclick="closeModal('scheduleModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="scheduleForm" onsubmit="handleScheduleSubmit(event)">
            <div class="form-group">
                <label class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-input" required placeholder="Masukkan nama kegiatan" />
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-input" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-input" required />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Durasi (menit)</label>
                    <input type="number" class="form-input" min="30" value="120" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-input" required placeholder="Lokasi kegiatan"
                        value="Lapangan Basket" />
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi/Catatan</label>
                <textarea class="form-textarea" placeholder="Deskripsi kegiatan atau catatan khusus"></textarea>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary" onclick="closeModal('scheduleModal')">
                    ❌ Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    📅 Simpan Jadwal
                </button>
            </div>
        </form>
    </div>
</div>