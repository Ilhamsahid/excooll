<div id="activityModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Buat Kegiatan - {{ $pembina->ekskulDibina[0]->nama }}</h3>
            <button class="close-btn" onclick="closeModal('activityModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="activityForm">
            <input type="hidden" name="ekskul_id" value="{{ $pembina->ekskulDibina[0]->id }}" />

            <div class="form-group">
                <label class="form-label">Nama Kegiatan</label>
                <input type="text" class="form-input" required name="judul" id="judulActivity" placeholder="Nama kegiatan" />
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Kegiatan</label>
                <textarea class="form-textarea" required name="deskripsi" id="deskripsi" placeholder="Deskripsi detail kegiatan"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Waktu Mulai</label>
                    <input type="time" class="form-input" name="jam_mulai" id="jam_mulaiActivity" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Waktu Selesai</label>
                    <input type="time" class="form-input" name="jam_selesai" id="jam_selesaiActivity" required />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-input" name="tanggal" id="tanggalActivity" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-input" required placeholder="Lokasi kegiatan"
                        name="lokasi" id="lokasiActivity"/>
                </div>
            </div>

            <input type="hidden" name="status" value="upcoming" />

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
