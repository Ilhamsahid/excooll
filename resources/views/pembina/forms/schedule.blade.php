<div id="scheduleModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Jadwal Baru - {{ $pembina->ekskulDibina[0]->nama }}</h3>
            <button class="close-btn" onclick="closeModal('scheduleModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="scheduleForm" >
            <input type="hidden" name="id" id="schedule_id" value="{{ $pembina->ekskulDibina[0]->id }}">
            <input type="hidden" name="ekskul_id" value="{{ $pembina->ekskulDibina[0]->id }}">

            <div class="form-group">
                <label class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-input" id="judul" required placeholder="Masukkan nama kegiatan" name="judul"/>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-input" required id="tanggal" name="tanggal"/>
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-input" id="jam_mulai" required name="jam_mulai"/>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-input" id="jam_selesai" required name="jam_selesai"/>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-input" required placeholder="Lokasi kegiatan" id="lokasi" name="lokasi"/>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi/Catatan</label>
                <textarea class="form-textarea" placeholder="Deskripsi kegiatan atau catatan khusus" id="deskripsi_jadwal" name="deskripsi"></textarea>
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
