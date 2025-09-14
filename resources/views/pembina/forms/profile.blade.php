<div id="editProfileModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Profile Pembina</h3>
                <button class="close-btn" onclick="closeModal('editProfileModal')" aria-label="Close">
                    &times;
                </button>
            </div>

            <form id="profileForm" onsubmit="handleProfileSubmit(event)">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" required value="Ahmad Surya" />
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-input" required value="198505102010011002" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" required>
                            <option value="L" selected>Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">No. Telepon</label>
                        <input type="tel" class="form-input" required value="+62 812-3456-7890" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" required value="ahmad.surya@school.edu.id" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-textarea" required>
Jl. Sudirman No. 45, Jakarta Selatan</textarea
            >
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi (Bio)</label>
            <textarea
              class="form-textarea"
              placeholder="Tulis deskripsi singkat tentang Anda"
            >
Pembina Klub Basket dengan pengalaman 5 tahun. Lulusan S2 Olahraga dari Universitas Negeri Jakarta. Passionate dalam mengembangkan bakat basket siswa.</textarea
            >
          </div>

          <div
            style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            "
          >
            <button
              type="button"
              class="btn btn-secondary"
              onclick="closeModal('editProfileModal')"
            >
              ❌ Batal
            </button>
            <button type="submit" class="btn btn-primary">
              💾 Simpan Profile
            </button>
          </div>
        </form>
      </div>
    </div>

    <div id="addStudentModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Siswa ke Klub Basket</h3>
          <button
            class="close-btn"
            onclick="closeModal('addStudentModal')"
            aria-label="Close"
          >
            &times;
          </button>
        </div>

        <form id="studentForm" onsubmit="handleStudentSubmit(event)">
          <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input
              type="text"
              class="form-input"
              required
              placeholder="Nama lengkap siswa"
            />
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">NISN</label>
              <input
                type="text"
                class="form-input"
                required
                placeholder="NISN siswa"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Kelas</label>
              <select class="form-select" required>
                <option value="">Pilih Kelas</option>
                <option value="X IPA 1">X IPA 1</option>
                <option value="X IPA 2">X IPA 2</option>
                <option value="X IPS 1">X IPS 1</option>
                <option value="XI IPA 1">XI IPA 1</option>
                <option value="XI IPA 2">XI IPA 2</option>
                <option value="XI IPS 1">XI IPS 1</option>
                <option value="XII IPA 1">XII IPA 1</option>
                <option value="XII IPA 2">XII IPA 2</option>
                <option value="XII IPS 1">XII IPS 1</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Email</label>
              <input
                type="email"
                class="form-input"
                required
                placeholder="email@student.school.id"
              />
            </div>
            <div class="form-group">
              <label class="form-label">No. Telepon</label>
              <input
                type="tel"
                class="form-input"
                placeholder="+62 xxx-xxxx-xxxx"
              />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Posisi Basket</label>
              <select class="form-select" required>
                <option value="">Pilih Posisi</option>
                <option value="PG">Point Guard (PG)</option>
                <option value="SG">Shooting Guard (SG)</option>
                <option value="SF">Small Forward (SF)</option>
                <option value="PF">Power Forward (PF)</option>
                <option value="C">Center (C)</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Status Tim</label>
              <select class="form-select" required>
                <option value="member">Anggota Biasa</option>
                <option value="reserve">Tim Reserve</option>
                <option value="core">Tim Inti</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea
              class="form-textarea"
              placeholder="Alamat lengkap siswa"
            ></textarea>
                </div>

                <div
                    style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addStudentModal')">
                        ❌ Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        👥 Tambah Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
