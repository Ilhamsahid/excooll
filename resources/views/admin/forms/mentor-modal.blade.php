<div id="addMentorModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">Tambah Mentor Baru</h3>
            <button class="close-btn hover-scale" onclick="closeModal('addMentorModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="addMentorForm">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-input" required placeholder="Nama lengkap mentor" id="nama"/>
                    <div class="validation-message">Nama lengkap harus diisi</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required placeholder="email@school.edu" id="emailMentor"/>
                    <div class="validation-message">Email Harus diisi</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" name="no_tel" class="form-input notel" id="notel" required placeholder="+62 812 3456 7890" />
                    <div class="validation-message">No telepon</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" required id="statusMentor">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non-aktif</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Bio/Deskripsi</label>
                <textarea class="form-textarea" name="deskripsi" required placeholder="Deskripsi singkat tentang mentor" id="deskripsiMentor"></textarea>
                <div class="validation-message">Deskripsi Harus diisi</div>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea class="form-textarea" name="alamat" required placeholder="Deskripsi singkat tentang mentor" id="alamatMentor"></textarea>
                <div class="validation-message">Alamat Harus diisi</div>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary hover-scale" onclick="closeModal('addMentorModal')">
                    <span>❌</span>
                    <span>Batal</span>
                </button>
                <button type="submit" class="btn btn-primary hover-lift">
                    <span>💾</span>
                    <span>Simpan Mentor</span>
                </button>
            </div>
        </form>
    </div>
</div>
