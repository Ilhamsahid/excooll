<section id="attendance" class="content-section">
    <div class="card card-elevated">
        <div class="card-header">
            <div>
                <h3 class="card-title">Attendance - Klub Basket</h3>
                <p class="card-subtitle">
                    Pantau dan kelola kehadiran siswa klub basket
                </p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm" onclick="exportAttendance()">
                    📊 Export Absensi
                </button>
                <button class="btn btn-primary" onclick="openModal('attendanceModal')">
                    ✅ Catat Absensi
                </button>
            </div>
        </div>

        <!-- Attendance Summary Stats -->
        <div class="stats-grid"
            style="
                  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                  gap: var(--space-4);
                  margin-bottom: var(--space-8);
                ">
            <div class="stat-card success" style="padding: var(--space-4)">
                <div class="stat-icon"
                    style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                    ✅
                </div>
                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                    78
                </div>
                <div class="stat-label">Hadir Hari Ini</div>
            </div>
            <div class="stat-card warning" style="padding: var(--space-4)">
                <div class="stat-icon"
                    style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                    ⏰
                </div>
                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                    5
                </div>
                <div class="stat-label">Terlambat</div>
            </div>
            <div class="stat-card error" style="padding: var(--space-4)">
                <div class="stat-icon"
                    style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                    ❌
                </div>
                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                    2
                </div>
                <div class="stat-label">Tidak Hadir</div>
            </div>
            <div class="stat-card" style="padding: var(--space-4)">
                <div class="stat-icon"
                    style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                    📊
                </div>
                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                    94.2%
                </div>
                <div class="stat-label">Tingkat Kehadiran</div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div
            style="
                  display: flex;
                  gap: var(--space-2);
                  margin-bottom: var(--space-6);
                  flex-wrap: wrap;
                ">
            <button class="btn btn-ghost active" id="attendanceAll" onclick="filterAttendance('all')">
                Semua (85)
            </button>
            <button class="btn btn-ghost" id="attendancePresent" onclick="filterAttendance('present')">
                Hadir (78)
            </button>
            <button class="btn btn-ghost" id="attendanceLate" onclick="filterAttendance('late')">
                Terlambat (5)
            </button>
            <button class="btn btn-ghost" id="attendanceAbsent" onclick="filterAttendance('absent')">
                Tidak Hadir (2)
            </button>
        </div>

        <!-- Attendance Grid -->
        <div class="attendance-grid" id="attendanceGrid">
            <!-- Present Students -->
            <div class="attendance-card">
                <div class="attendance-header">
                    <div class="attendance-student">Ahmad Rizki Pratama</div>
                    <span class="attendance-status present">✅ HADIR</span>
                </div>
                <div
                    style="
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                      margin-bottom: var(--space-3);
                    ">
                    Kelas XI IPA 2 • NISN: 0012345678 • Datang: 15:25
                </div>
                <div class="attendance-actions">
                    <button class="btn btn-ghost btn-sm" onclick="viewAttendanceProfile('ahmad_rizki')">
                        👤 Profil
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="editAttendanceProfile('ahmad_rizki')">
                        ✏️ Edit
                    </button>
                </div>
            </div>

            <div class="attendance-card">
                <div class="attendance-header">
                    <div class="attendance-student">Budi Santoso</div>
                    <span class="attendance-status present">✅ HADIR</span>
                </div>
                <div
                    style="
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                      margin-bottom: var(--space-3);
                    ">
                    Kelas XII IPA 3 • NISN: 0012345679 • Datang: 15:30
                </div>
                <div class="attendance-actions">
                    <button class="btn btn-ghost btn-sm" onclick="viewStudentProfile('budi_santoso')">
                        👤 Profil
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="editAttendanceStatus('budi_santoso')">
                        ✏️ Edit
                    </button>
                </div>
            </div>

            <!-- Late Students -->
            <div class="attendance-card">
                <div class="attendance-header">
                    <div class="attendance-student">Andi Pratama</div>
                    <span class="attendance-status late">⏰ TERLAMBAT</span>
                </div>
                <div
                    style="
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                      margin-bottom: var(--space-3);
                    ">
                    Kelas XII IPA 1 • NISN: 0012345680 • Datang: 15:45
                    (Terlambat 15 menit)
                </div>
                <div
                    style="
                      font-size: var(--font-size-xs);
                      color: var(--text-tertiary);
                      margin-bottom: var(--space-3);
                      font-style: italic;
                    ">
                    💭 Catatan: Terlambat karena macet di jalan raya
                </div>
                <div class="attendance-actions">
                    <button class="btn btn-ghost btn-sm" onclick="viewStudentProfile('andi_pratama')">
                        👤 Profil
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="editAttendanceStatus('andi_pratama')">
                        ✏️ Edit
                    </button>
                </div>
            </div>

            <!-- Absent Students -->
            <div class="attendance-card">
                <div class="attendance-header">
                    <div class="attendance-student">Maya Sari Dewi</div>
                    <span class="attendance-status absent">❌ TIDAK HADIR</span>
                </div>
                <div
                    style="
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                      margin-bottom: var(--space-3);
                    ">
                    Kelas XI IPS 2 • NISN: 0012345681 • Tidak hadir
                </div>
                <div
                    style="
                      font-size: var(--font-size-xs);
                      color: var(--text-tertiary);
                      margin-bottom: var(--space-3);
                      font-style: italic;
                    ">
                    💭 Catatan: Sakit demam, sudah memberikan surat keterangan
                </div>
                <div class="attendance-actions">
                    <button class="btn btn-ghost btn-sm" onclick="viewStudentProfile('maya_sari')">
                        👤 Profil
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="editAttendanceStatus('maya_sari')">
                        ✏️ Edit
                    </button>
                </div>
            </div>
        </div>

        <!-- Attendance Analytics -->
        <div style="margin-top: var(--space-8)">
            <h4
                style="
                    font-size: var(--font-size-xl);
                    font-weight: var(--font-weight-bold);
                    margin-bottom: var(--space-6);
                    color: var(--text-primary);
                  ">
                📈 Analisis Kehadiran Mingguan
            </h4>
            <div class="chart-container">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>
</section>