<section id="dashboard" class="content-section active">
    <!-- Pembina Welcome Section -->
    <div class="card card-gradient mb-8">
        <div>
            <h1
                style="
                    font-size: var(--font-size-3xl);
                    font-weight: var(--font-weight-bold);
                    margin-bottom: var(--space-4);
                    color: white;
                  ">
                Selamat Datang, Ahmad Surya! 👋
            </h1>
            <p
                style="
                    font-size: var(--font-size-lg);
                    opacity: 0.9;
                    margin-bottom: var(--space-6);
                    color: white;
                  ">
                Kelola ekstrakurikuler Klub Basket dengan mudah dan pantau
                perkembangan siswa secara real-time
            </p>
            <div style="display: flex; gap: var(--space-4); flex-wrap: wrap">
                <button class="btn"
                    style="
                      background: rgba(255, 255, 255, 0.2);
                      color: white;
                      border: 1px solid rgba(255, 255, 255, 0.3);
                    "
                    onclick="showSection('calendar')">
                    📅 Lihat Jadwal Hari Ini
                </button>
                <button class="btn"
                    style="
                      background: rgba(255, 255, 255, 0.2);
                      color: white;
                      border: 1px solid rgba(255, 255, 255, 0.3);
                    "
                    onclick="showSection('attendance')">
                    📊 Cek Absensi
                </button>
                <button class="btn"
                    style="
                      background: rgba(255, 255, 255, 0.2);
                      color: white;
                      border: 1px solid rgba(255, 255, 255, 0.3);
                    "
                    onclick="openModal('announcementModal')">
                    📢 Buat Pengumuman
                </button>
            </div>
        </div>
    </div>

    <!-- Main Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-icon animate-float">👥</div>
            </div>
            <div class="stat-number" id="totalStudents">85</div>
            <div class="stat-label">Total Siswa Klub Basket</div>
            <div class="stat-change positive">
                <span class="stat-change-icon">↗</span>
                <span>+5 siswa bulan ini</span>
            </div>
        </div>

        <div class="stat-card success">
            <div class="stat-header">
                <div class="stat-icon animate-float">📈</div>
            </div>
            <div class="stat-number" id="totalActivities">12</div>
            <div class="stat-label">Kegiatan Bulan Ini</div>
            <div class="stat-change positive">
                <span class="stat-change-icon">↗</span>
                <span>+3 kegiatan baru</span>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="stat-header">
                <div class="stat-icon animate-float">📊</div>
            </div>
            <div class="stat-number" id="attendanceRate">94.2%</div>
            <div class="stat-label">Tingkat Kehadiran</div>
            <div class="stat-change positive">
                <span class="stat-change-icon">↗</span>
                <span>+2.1% minggu ini</span>
            </div>
        </div>

        <div class="stat-card secondary">
            <div class="stat-header">
                <div class="stat-icon animate-float">🏆</div>
            </div>
            <div class="stat-number" id="achievements">7</div>
            <div class="stat-label">Prestasi Semester Ini</div>
            <div class="stat-change positive">
                <span class="stat-change-icon">↗</span>
                <span>+2 prestasi baru</span>
            </div>
        </div>
    </div>

    <!-- Quick Overview Cards -->
    <div class="quick-actions-grid">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Jadwal Hari Ini</h3>
                    <p class="card-subtitle">Senin, 15 Maret 2025</p>
                </div>
                <button class="btn btn-ghost btn-sm" onclick="showSection('calendar')">
                    Lihat Semua
                </button>
            </div>
            <div class="schedule-cards">
                <div class="activity-item">
                    <div class="activity-icon">🏀</div>
                    <div class="activity-content">
                        <div class="activity-title">Latihan Basket Reguler</div>
                        <div class="activity-description">
                            15:30 - 17:00 • Lapangan Utama
                        </div>
                        <div class="activity-time">85 siswa terdaftar</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Absensi Hari Ini</h3>
                    <p class="card-subtitle">Status kehadiran terkini</p>
                </div>
                <button class="btn btn-ghost btn-sm" onclick="showSection('attendance')">
                    Lihat Detail
                </button>
            </div>
            <div>
                <div class="stats-grid"
                    style="
                      grid-template-columns: repeat(3, 1fr);
                      gap: var(--space-3);
                      margin: 0;
                    ">
                    <div class="stat-card success" style="padding: var(--space-3); margin: 0">
                        <div class="stat-number" style="font-size: var(--font-size-xl)">
                            78
                        </div>
                        <div class="stat-label" style="font-size: var(--font-size-xs)">
                            Hadir
                        </div>
                    </div>
                    <div class="stat-card warning" style="padding: var(--space-3); margin: 0">
                        <div class="stat-number" style="font-size: var(--font-size-xl)">
                            5
                        </div>
                        <div class="stat-label" style="font-size: var(--font-size-xs)">
                            Terlambat
                        </div>
                    </div>
                    <div class="stat-card error" style="padding: var(--space-3); margin: 0">
                        <div class="stat-number" style="font-size: var(--font-size-xl)">
                            2
                        </div>
                        <div class="stat-label" style="font-size: var(--font-size-xs)">
                            Tidak Hadir
                        </div>
                    </div>
                </div>
                <div
                    style="
                      display: flex;
                      gap: var(--space-2);
                      margin-top: var(--space-4);
                      justify-content: center;
                    ">
                    <button class="btn btn-primary btn-sm" onclick="openModal('attendanceModal')">
                        ✅ Catat Absensi
                    </button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Aktivitas Terbaru</h3>
                    <p class="card-subtitle">Update terkini dari klub</p>
                </div>
            </div>
            <div class="activity-feed">
                <div class="activity-item">
                    <div class="activity-icon">✅</div>
                    <div class="activity-content">
                        <div class="activity-title">Absensi Dicatat</div>
                        <div class="activity-description">
                            Latihan Basket - 78/85 siswa hadir
                        </div>
                        <div class="activity-time">1 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">📢</div>
                    <div class="activity-content">
                        <div class="activity-title">Pengumuman Dipublikasi</div>
                        <div class="activity-description">
                            Jadwal latihan tambahan untuk turnamen
                        </div>
                        <div class="activity-time">3 jam yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">🏆</div>
                    <div class="activity-content">
                        <div class="activity-title">Prestasi Baru</div>
                        <div class="activity-description">
                            Juara 1 Basket Tournament Regional
                        </div>
                        <div class="activity-time">2 hari yang lalu</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Chart -->
    <div class="card card-elevated">
        <div class="card-header">
            <div>
                <h3 class="card-title">Analisis Performa Bulanan</h3>
                <p class="card-subtitle">
                    Statistik kehadiran dan engagement siswa klub basket
                </p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm" onclick="exportAnalytics()">
                    📊 Export Data
                </button>
            </div>
        </div>
        <div class="chart-container large">
            <canvas id="performanceChart"></canvas>
        </div>
    </div>
</section>