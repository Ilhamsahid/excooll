<div id="addUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-gradient-primary">
                Tambah Pengguna Baru
            </h3>
            <button class="close-btn hover-scale" onclick="closeModal('addUserModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="addUserForm">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" id="username" class="form-input" required placeholder="username" name="name"/>
                    <div class="validation-message">Username Harus diisi</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" id="emailuser" class="form-input" required placeholder="email@domain.com" name="email"/>
                    <div class="validation-message">Email Harus diisi</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" id="registerPassword" class="form-input" required placeholder="Password" name="password"/>
                    <div class="validation-message">Password Harus diisi</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" id="confirmPassword" class="form-input" required placeholder="Konfirmasi Password"/>
                    <div class="validation-message">Konfirmasi kata sandi harus diisi</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select class="form-select" id="role" required name="role">
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="pembina">Pembina</option>
                        <option value="siswa">Siswa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select" id="status" required name="status">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non-aktif</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="display: none" id="nUser">
                <label class="form-label">Nisn</label>
                <input type="tel" name="nisn" class="form-input nisn" id="nisn" required placeholder="0000223213" />
                <div class="validation-message">Nisn Harus diisi</div>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary hover-scale" onclick="closeModal('addUserModal')">
                    <span>❌</span>
                    <span>Batal</span>
                </button>
                <button type="submit" class="btn btn-primary hover-lift">
                    <span>💾</span>
                    <span>Simpan Pengguna</span>
                </button>
            </div>
        </form>
    </div>
</div>
