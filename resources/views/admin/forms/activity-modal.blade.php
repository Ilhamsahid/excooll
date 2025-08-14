<!-- Enhanced Modals with Improved Design -->
<div id="addActivityModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">
                Tambah Kegiatan Baru
            </h3>
            <button class="close-btn hover-scale" onclick="closeModal('addActivityModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="addActivityForm">
            <div class="form-group">
                <label class="form-label">Nama Kegiatan</label>
                <input type="text" name="nama" class="form-input" required placeholder="Masukkan nama kegiatan" />
                <div class="validation-message">Nama Ekskul Harus diisi</div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-textarea" name="deskripsi" required placeholder="Deskripsi kegiatan"></textarea>
                <div class="validation-message">Deskripsi Harus diisi</div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select class="form-select" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="olahraga">Olahraga</option>
                        <option value="seni">Seni & Budaya</option>
                        <option value="akademik">Akademik</option>
                        <option value="teknologi">Teknologi</option>
                        <option value="sosial">Sosial</option>
                    </select>
                    <div class="validation-message">Kategori Harus diisi</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Pembina</label>
                    <select class="form-select" name="pembina" required id="selectPembina">
                        <option value="">Pilih Pembina</option>
                    </select>
                    <div class="validation-message">Pembina Harus diisi</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Jadwal</label>
                <input type="text" class="form-input" name="jadwal" placeholder="Contoh: Senin, Rabu, Jumat 15:30-17:00"
                    required />
                <div class="validation-message">Jadwal Harus diisi</div>
            </div>

            <div class="form-group">
                <label class="form-label">Lokasi</label>
                <input type="text" class="form-input" name="lokasi" placeholder="Lokasi kegiatan" required />
                <div class="validation-message">Lokasi Harus diisi</div>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary hover-scale" onclick="closeModal('addActivityModal')">
                    <span>❌</span>
                    <span>Batal</span>
                </button>
                <button type="submit" class="btn btn-primary hover-lift">
                    <span>💾</span>
                    <span>Simpan Kegiatan</span>
                </button>
            </div>
        </form>
    </div>
</div>
