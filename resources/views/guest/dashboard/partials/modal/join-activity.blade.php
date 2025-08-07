<div id="joinActivityModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Bergabung dengan Kegiatan</h3>
            <button class="close-btn" onclick="closeModal('joinActivityModal')" aria-label="Tutup">&times;</button>
        </div>
        <form id="joinActivityForm">
            <div class="form-group float-label">
                <input type="hidden" id="idEkskul" class="form-input" readonly>
                <input type="text" id="selectedActivity" class="form-input" readonly>
                <label class="form-label" for="selectedActivity">Kegiatan yang Dipilih</label>
            </div>

            <div class="form-row">
                <div class="form-group float-label">
                    <input type="text" id="studentName" class="form-input" placeholder=" " required>
                    <label class="form-label" for="studentName">Nama Lengkap</label>
                    <div class="validation-message">Nama lengkap harus diisi</div>
                </div>
                <div class="form-group float-label">
                    <input type="email" id="studentEmail" class="form-input" placeholder=" " required>
                    <label class="form-label" for="studentEmail">Alamat Email</label>
                    <div class="validation-message">Email harus diisi</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group float-label">
                    <input type="text" name="" id="classStudent" class="form-input"  placeholder=" " required>
                    <label class="form-label" for="studentGrade">Kelas</label>
                    <div class="validation-message">Kelas Harus diisi</div>
                </div>
                <div class="form-group float-label">
                    <input type="tel" id="studentPhone" class="form-input" placeholder=" " required>
                    <label class="form-label" for="studentPhone">Nomor Telepon</label>
                    <div class="validation-message">Nomor telepon harus diisi</div>
                </div>
            </div>

            <div class="form-group float-label">
                <input type="text" id="studentAddress" class="form-input" placeholder=" " required>
                <label class="form-label" for="emergencyContact">Alamat</label>
                <div class="validation-message">Alamat harus diisi</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="whyJoin">Mengapa Anda ingin bergabung dengan kegiatan ini?</label>
                <textarea id="whyJoin" class="form-textarea"
                    placeholder="Ceritakan tentang minat Anda dan apa yang ingin Anda dapatkan dari kegiatan ini..." required></textarea>
                <div class="validation-message">Alasan bergabung harus diisi</div>
            </div>

            <div class="form-group">
                <label class="form-label" for="previousExperience">Pengalaman Sebelumnya (Opsional)</label>
                <textarea id="previousExperience" class="form-textarea"
                    placeholder="Pengalaman atau keterampilan relevan yang ingin Anda bagikan..."></textarea>
            </div>
            <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 1.5rem;">
                ✨ Submit
            </button>
        </form>
    </div>
</div>
