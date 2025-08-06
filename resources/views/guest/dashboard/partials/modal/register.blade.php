<div id="registerModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Bergabung dengan EkstraKu</h3>
            <button class="close-btn" onclick="closeModal('registerModal')" aria-label="Tutup">&times;</button>
        </div>
        <form id="registerForm">
            <div class="form-group float-label">
                <input type="text" id="registerName" class="form-input" placeholder=" " required>
                <label class="form-label" for="registerName">Nama Lengkap</label>
                <div class="validation-message">Nama lengkap harus diisi</div>
            </div>
            <div class="form-group float-label">
                <input type="text" id="registerNisn" class="form-input" placeholder=" " required>
                <label class="form-label" for="registerNisn">NISN</label>
                <div class="validation-message">NISN harus diisi</div>
            </div>
            <div class="form-group float-label">
                <input type="email" id="registerEmail" class="form-input" placeholder=" " required>
                <label class="form-label" for="registerEmail">Alamat Email</label>
                <div class="validation-message">Email harus diisi</div>
            </div>
            <div class="form-row">
                <div class="form-group float-label">
                    <input type="password" id="registerPassword" class="form-input" placeholder=" " required>
                    <label class="form-label" for="registerPassword">Kata Sandi</label>
                    <div class="validation-message">Kata sandi harus diisi</div>
                </div>
                <div class="form-group float-label">
                    <input type="password" id="confirmPassword" class="form-input" placeholder=" " required>
                    <label class="form-label" for="confirmPassword">Konfirmasi Kata Sandi</label>
                    <div class="validation-message">Konfirmasi kata sandi harus diisi</div>
                </div>
            </div>
            <div class="form-group" style="margin-top: 1rem;">
                <label style="display: flex; align-items: flex-start; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" id="agreeTerms" style="width: 1rem; height: 1rem; margin-top: 0.25rem;"
                        required>
                    <span style="font-size: 0.875rem; color: var(--text-secondary);">
                        Saya setuju dengan <a href="#"
                            style="color: var(--accent); text-decoration: none; font-weight: 500;">Syarat Layanan</a>
                        dan <a href="#"
                            style="color: var(--accent); text-decoration: none; font-weight: 500;">Kebijakan Privasi</a>
                    </span>
                </label>
                <div class="validation-message">Anda harus menyetujui syarat dan ketentuan</div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;">
                🚀 Buat Akun
            </button>
        </form>
        <p style="text-align: center; margin-top: 1.5rem; color: var(--text-secondary);">
            Sudah punya akun?
            <a href="#" onclick="closeModal('registerModal'); openModal('loginModal')"
                style="color: var(--accent); font-weight: 600;">Masuk di sini</a>
        </p>
    </div>
</div>
