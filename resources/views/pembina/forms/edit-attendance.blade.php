    <div id="editAttendanceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Status Absensi</h3>
                <button class="close-btn" onclick="closeModal('editAttendanceModal')" aria-label="Close">
                    &times;
                </button>
            </div>

            <form id="editAttendanceForm" onsubmit="handleEditAttendanceSubmit(event)">
                <div class="form-group">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" class="form-input" id="editStudentName" readonly />
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-input" id="editAttendanceDate" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kegiatan</label>
                        <input type="text" class="form-input" id="editActivityName" required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Kehadiran</label>
                    <select class="form-select" id="editAttendanceStatus" required>
                        <option value="present">✅ Hadir</option>
                        <option value="late">⏰ Terlambat</option>
                        <option value="absent">❌ Tidak Hadir</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Waktu Datang</label>
                        <input type="time" class="form-input" id="editArrivalTime" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Keterlambatan (menit)</label>
                        <input type="number" class="form-input" id="editLateMinutes" min="0" placeholder="0" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan/Keterangan</label>
                    <textarea class="form-textarea" id="editAttendanceNotes" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>

                <div
                    style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editAttendanceModal')">
                        ❌ Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
