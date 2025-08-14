<div id="addStudentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">Tambah Siswa Baru</h3>
            <button class="close-btn hover-scale" onclick="closeModal('addStudentModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="addStudentForm">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" required placeholder="Nama lengkap siswa" />
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" required placeholder="email@student.edu" />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kelas</label>
                    <select class="form-select" required>
                        <option value="">Pilih Kelas</option>
                        <option value="10">Kelas 10</option>
                        <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" class="form-input" required placeholder="+62 812 3456 7890" />
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea class="form-textarea" required placeholder="Alamat lengkap siswa"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-input" required />
                </div>
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
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
                <button type="button" class="btn btn-secondary hover-scale" onclick="closeModal('addStudentModal')">
                    <span>❌</span>
                    <span>Batal</span>
                </button>
                <button type="submit" class="btn btn-primary hover-lift">
                    <span>💾</span>
                    <span>Simpan Siswa</span>
                </button>
            </div>
        </form>
    </div>
</div>
