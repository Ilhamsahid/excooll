<div id="addStudentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary" id="headerStudentModal">Tambah Siswa Baru</h3>
            <button class="close-btn hover-scale" onclick="closeModal('addStudentModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="addStudentForm">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-input" required placeholder="Nama lengkap siswa" id="name"/>
                    <div class="validation-message">Nama Lengkap Harus diisi</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" required placeholder="email@student.edu" id="email"/>
                    <div class="validation-message">Email Harus diisi</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kelas</label>
                    <select class="form-select" name="kelas" required id="class">
                        <option value="">Pilih Kelas</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k }}">{{ $k }}</option>
                        @endforeach
                    </select>
                    <div class="validation-message">Kelas Harus diisi</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="tel" name="no_tel" class="form-input" id="notel" required placeholder="+62 812 3456 7890"/>
                    <div class="validation-message">Nomor Telepon Harus diisi</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nisn</label>
                    <input type="tel" name="nisn" class="form-input" id="nisn" required placeholder="0000223213" />
                    <div class="validation-message">Nisn Harus diisi</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="j_kel" required id="j_kel">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    <div class="validation-message">Jenis Kelamin Harus diisi</div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea class="form-textarea" name="alamat" id="alamat" required placeholder="Alamat lengkap siswa"></textarea>
                <div class="validation-message">Alamat Harus diisi</div>
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
