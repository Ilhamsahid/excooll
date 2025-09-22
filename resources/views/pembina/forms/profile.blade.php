<div id="profileModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Profile Pembina</h3>
            <button class="close-btn" onclick="closeModal('profileModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="profileForm">
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-input" required id="nameProfileForm" name="nama" />
            </div>

            <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <select class="form-select" required id="jkProfile" name="jenis_kelamin">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">No. Telepon</label>
                    <input type="tel" class="form-input" required value="+62 812-3456-7890" id="noTelProfileForm"
                        name="no_tel" />
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" required value="ahmad.surya@school.edu.id"
                        id="emailProfileForm" name="email" />
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea class="form-textarea" required id="alamatProfileForm" name="alamat">
Jl. Sudirman No. 45, Jakarta Selatan</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi (Bio)</label>
                <textarea class="form-textarea" placeholder="Tulis deskripsi singkat tentang Anda"
                    id="deskripsiProfileForm" name="deskripsi">
Pembina Klub Basket dengan pengalaman 5 tahun. Lulusan S2 Olahraga dari Universitas Negeri Jakarta. Passionate dalam mengembangkan bakat basket siswa.</textarea>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary" onclick="closeModal('profileModal')">
                    ❌ Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    💾 Simpan Profile
                </button>
            </div>
        </form>
    </div>
</div>