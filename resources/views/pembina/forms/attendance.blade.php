<div id="attendanceModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Catat Absensi - Klub Basket</h3>
            <button class="close-btn" onclick="closeModal('attendanceModal')" aria-label="Close">
                &times;
            </button>
        </div>

        <form id="attendanceForm" onsubmit="handleAttendanceSubmit(event)">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-input" required id="attendanceDate" />
                </div>
                <div class="form-group">
                    <label class="form-label">Jam Kegiatan</label>
                    <input type="time" class="form-input" required value="15:30" />
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Kegiatan</label>
                <input type="text" class="form-input" required placeholder="Nama kegiatan/latihan"
                    value="Latihan Basket Reguler" />
            </div>

            <div style="margin-top: var(--space-6)" id="membersList">
                <h4
                    style="
                font-size: var(--font-size-lg);
                font-weight: var(--font-weight-bold);
                margin-bottom: var(--space-4);
              ">
                    Daftar Anggota Klub Basket (85 siswa)
                </h4>
                <div class="attendance-grid" style="gap: var(--space-3)">
                    <div class="attendance-card" style="padding: var(--space-4)">
                        <div class="attendance-header">
                            <div class="attendance-student">Ahmad Rizki Pratama</div>
                            <div style="display: flex; gap: var(--space-2)">
                                <button class="btn btn-success btn-sm" onclick="markAttendance(0, 'present')"
                                    id="present_0">
                                    ✅
                                </button>
                                <button class="btn btn-warning btn-sm" onclick="markAttendance(0, 'late')"
                                    id="late_0">
                                    ⏰
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="markAttendance(0, 'absent')"
                                    id="absent_0">
                                    ❌
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="attendance-card" style="padding: var(--space-4)">
                        <div class="attendance-header">
                            <div class="attendance-student">Budi Santoso</div>
                            <div style="display: flex; gap: var(--space-2)">
                                <button class="btn btn-success btn-sm" onclick="markAttendance(1, 'present')"
                                    id="present_1">
                                    ✅
                                </button>
                                <button class="btn btn-warning btn-sm" onclick="markAttendance(1, 'late')"
                                    id="late_1">
                                    ⏰
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="markAttendance(1, 'absent')"
                                    id="absent_1">
                                    ❌
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="attendance-card" style="padding: var(--space-4)">
                        <div class="attendance-header">
                            <div class="attendance-student">Andi Pratama</div>
                            <div style="display: flex; gap: var(--space-2)">
                                <button class="btn btn-success btn-sm" onclick="markAttendance(2, 'present')"
                                    id="present_2">
                                    ✅
                                </button>
                                <button class="btn btn-warning btn-sm" onclick="markAttendance(2, 'late')"
                                    id="late_2">
                                    ⏰
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="markAttendance(2, 'absent')"
                                    id="absent_2">
                                    ❌
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="attendance-card" style="padding: var(--space-4)">
                        <div class="attendance-header">
                            <div class="attendance-student">Dino Saputra</div>
                            <div style="display: flex; gap: var(--space-2)">
                                <button class="btn btn-success btn-sm" onclick="markAttendance(3, 'present')"
                                    id="present_3">
                                    ✅
                                </button>
                                <button class="btn btn-warning btn-sm" onclick="markAttendance(3, 'late')"
                                    id="late_3">
                                    ⏰
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="markAttendance(3, 'absent')"
                                    id="absent_3">
                                    ❌
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="attendance-card" style="padding: var(--space-4)">
                        <div class="attendance-header">
                            <div class="attendance-student">Eko Wijaya</div>
                            <div style="display: flex; gap: var(--space-2)">
                                <button class="btn btn-success btn-sm" onclick="markAttendance(4, 'present')"
                                    id="present_4">
                                    ✅
                                </button>
                                <button class="btn btn-warning btn-sm" onclick="markAttendance(4, 'late')"
                                    id="late_4">
                                    ⏰
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="markAttendance(4, 'absent')"
                                    id="absent_4">
                                    ❌
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="attendance-card" style="padding: var(--space-4)">
                        <div class="attendance-header">
                            <div class="attendance-student">Farid Ahmad</div>
                            <div style="display: flex; gap: var(--space-2)">
                                <button class="btn btn-success btn-sm" onclick="markAttendance(5, 'present')"
                                    id="present_5">
                                    ✅
                                </button>
                                <button class="btn btn-warning btn-sm" onclick="markAttendance(5, 'late')"
                                    id="late_5">
                                    ⏰
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="markAttendance(5, 'absent')"
                                    id="absent_5">
                                    ❌
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                <button type="button" class="btn btn-secondary" onclick="closeModal('attendanceModal')">
                    ❌ Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    ✅ Simpan Absensi
                </button>
            </div>
        </form>
    </div>
</div>
