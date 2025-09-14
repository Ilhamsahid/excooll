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
                    <button class="btn btn-ghost btn-sm" onclick="viewStudentProfile('ahmad_rizki')">
                        👤 Profil
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="editAttendanceStatus('ahmad_rizki')">
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

<!-- Activities Section -->
<section id="activities" class="content-section">
    <div class="card card-elevated">
        <div class="card-header">
            <div>
                <h3 class="card-title">Activities - Klub Basket</h3>
                <p class="card-subtitle">
                    Kelola dan pantau kegiatan ekstrakurikuler basket
                </p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm" onclick="exportActivities()">
                    📊 Export Kegiatan
                </button>
                <button class="btn btn-primary" onclick="openModal('activityModal')">
                    ➕ Buat Kegiatan
                </button>
            </div>
        </div>

        <!-- Filter Section -->
        <div
            style="
                  display: flex;
                  gap: var(--space-4);
                  margin-bottom: var(--space-6);
                  flex-wrap: wrap;
                  align-items: end;
                ">
            <div style="min-width: 200px">
                <label class="form-label">Status Kegiatan</label>
                <select class="form-select" id="activityStatusFilter" onchange="filterActivities()">
                    <option value="">Semua Status</option>
                    <option value="upcoming">Akan Datang</option>
                    <option value="ongoing">Sedang Berlangsung</option>
                    <option value="completed">Selesai</option>
                    <option value="cancelled">Dibatalkan</option>
                </select>
            </div>
            <div style="flex: 1; min-width: 300px">
                <label class="form-label">Cari Kegiatan</label>
                <input type="text" class="form-input" placeholder="Cari nama kegiatan..."
                    id="activitySearchInput" oninput="filterActivities()" />
            </div>
        </div>

        <!-- Activities Grid -->
        <div class="applications-grid" id="activitiesGrid">
            <!-- Upcoming Activities -->
            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Turnamen Basket Antar Sekolah
                        </h4>
                        <div class="application-meta">
                            <span>🏀 Klub Basket</span>
                            <span>📅 20 Maret 2025</span>
                            <span>⏰ 08:00 - 17:00</span>
                            <span>📍 GOR Sekolah</span>
                        </div>
                    </div>
                    <span class="badge badge-warning">📅 AKAN DATANG</span>
                </div>
                <div class="application-content">
                    <p>
                        Turnamen basket tingkat SMA se-Jakarta Selatan. Akan
                        diikuti oleh 16 sekolah dengan sistem eliminasi. Tim
                        basket sekolah akan menjadi tuan rumah dan berpartisipasi
                        penuh.
                    </p>
                    <div style="margin-top: var(--space-4)">
                        <strong>Target Peserta:</strong> 85 siswa •
                        <strong>Budget:</strong> Rp 15.000.000 •
                        <strong>PIC:</strong> Ahmad Surya
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editActivity('turnamen_basket')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewActivityDetails('turnamen_basket')">
                        👁️ Detail
                    </button>
                    <button class="btn btn-success btn-sm" onclick="startActivity('turnamen_basket')">
                        ▶️ Mulai
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Latihan Intensif Persiapan Turnamen
                        </h4>
                        <div class="application-meta">
                            <span>🏀 Klub Basket</span>
                            <span>📅 18 Maret 2025</span>
                            <span>⏰ 15:30 - 18:00</span>
                            <span>📍 Lapangan Basket</span>
                        </div>
                    </div>
                    <span class="badge badge-info">🔄 SEDANG BERLANGSUNG</span>
                </div>
                <div class="application-content">
                    <p>
                        Latihan intensif untuk persiapan turnamen basket regional.
                        Fokus pada strategi permainan, shooting drill, dan
                        conditioning fisik untuk menghadapi kompetisi.
                    </p>
                    <div style="margin-top: var(--space-4)">
                        <strong>Peserta:</strong> 85 siswa •
                        <strong>Coach:</strong> Ahmad Surya •
                        <strong>Fokus:</strong> Shooting, Defense, Team Play
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editActivity('latihan_intensif')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="takeAttendance('latihan_intensif')">
                        ✅ Absen
                    </button>
                    <button class="btn btn-warning btn-sm" onclick="endActivity('latihan_intensif')">
                        ⏹️ Selesai
                    </button>
                </div>
            </div>

            <div class="application-card approved">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Friendly Match vs SMAN 8
                        </h4>
                        <div class="application-meta">
                            <span>🏀 Klub Basket</span>
                            <span>📅 15 Maret 2025</span>
                            <span>⏰ 16:00 - 18:00</span>
                            <span>📍 Lapangan Basket</span>
                        </div>
                    </div>
                    <span class="badge badge-success">✅ SELESAI</span>
                </div>
                <div class="application-content">
                    <p>
                        Pertandingan persahabatan melawan SMAN 8 Jakarta. Tim
                        basket sekolah menang dengan skor 78-65. Permainan bagus
                        dari semua pemain.
                    </p>
                    <div style="margin-top: var(--space-4)">
                        <strong>Skor:</strong> 78-65 (Menang) •
                        <strong>MVP:</strong> Ahmad Rizki •
                        <strong>Point:</strong> 78 •
                        <strong>Penonton:</strong> 150 orang
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="viewActivityReport('friendly_match')">
                        📊 Laporan
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewActivityGallery('friendly_match')">
                        📸 Galeri
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="shareActivity('friendly_match')">
                        🔗 Bagikan
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Workshop Basic Basketball Skills
                        </h4>
                        <div class="application-meta">
                            <span>🏀 Klub Basket</span>
                            <span>📅 25 Maret 2025</span>
                            <span>⏰ 14:00 - 17:00</span>
                            <span>📍 Lapangan Basket</span>
                        </div>
                    </div>
                    <span class="badge badge-warning">📅 AKAN DATANG</span>
                </div>
                <div class="application-content">
                    <p>
                        Workshop keterampilan dasar basket untuk anggota baru.
                        Akan difokuskan pada fundamental skills seperti dribbling,
                        shooting, dan passing yang benar.
                    </p>
                    <div style="margin-top: var(--space-4)">
                        <strong>Peserta:</strong> 25 siswa baru •
                        <strong>Instruktur:</strong> Ahmad Surya + Alumni •
                        <strong>Materi:</strong> Fundamental Skills
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editActivity('workshop_basic')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewParticipants('workshop_basic')">
                        👥 Peserta
                    </button>
                    <button class="btn btn-success btn-sm" onclick="prepareActivity('workshop_basic')">
                        🎯 Persiapan
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">Training Camp Basket</h4>
                        <div class="application-meta">
                            <span>🏀 Klub Basket</span>
                            <span>📅 28-30 Maret 2025</span>
                            <span>⏰ 3 Hari 2 Malam</span>
                            <span>📍 Puncak Training Center</span>
                        </div>
                    </div>
                    <span class="badge badge-warning">📅 AKAN DATANG</span>
                </div>
                <div class="application-content">
                    <p>
                        Training camp intensif untuk persiapan turnamen regional.
                        Fokus pada team building, strategi permainan, dan kondisi
                        fisik pemain.
                    </p>
                    <div style="margin-top: var(--space-4)">
                        <strong>Peserta:</strong> 50 siswa •
                        <strong>Coach:</strong> Ahmad Surya + Assistant •
                        <strong>Budget:</strong> Rp 25.000.000
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editActivity('training_camp')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="manageCampRegistration('training_camp')">
                        📋 Pendaftaran
                    </button>
                    <button class="btn btn-success btn-sm" onclick="prepareCamp('training_camp')">
                        🎒 Persiapan
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Seleksi Tim Inti Basket
                        </h4>
                        <div class="application-meta">
                            <span>🏀 Klub Basket</span>
                            <span>📅 22 Maret 2025</span>
                            <span>⏰ 15:30 - 18:00</span>
                            <span>📍 Lapangan Basket</span>
                        </div>
                    </div>
                    <span class="badge badge-warning">📅 AKAN DATANG</span>
                </div>
                <div class="application-content">
                    <p>
                        Seleksi untuk menentukan tim inti yang akan mewakili
                        sekolah di turnamen regional. Penilaian berdasarkan skill
                        teknik, fisik, dan mental.
                    </p>
                    <div style="margin-top: var(--space-4)">
                        <strong>Peserta:</strong> 85 siswa •
                        <strong>Target Tim Inti:</strong> 12 pemain •
                        <strong>Kriteria:</strong> Skill, Fisik, Mental
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editActivity('seleksi_tim')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewSelectionCriteria('seleksi_tim')">
                        📋 Kriteria
                    </button>
                    <button class="btn btn-success btn-sm" onclick="prepareSelection('seleksi_tim')">
                        🎯 Persiapan
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
