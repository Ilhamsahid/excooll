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
                    <input type="text" class="form-input" required placeholder="username" />
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" required placeholder="email@domain.com" />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-input" required placeholder="Password" />
                </div>
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-input" required placeholder="Konfirmasi Password" />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select class="form-select" required>
                        <option value="">Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="mentor">Mentor</option>
                        <option value="student">Siswa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-select" required>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non-aktif</option>
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
