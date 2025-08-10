    <section id="dashboard" class="content-section active">
        <div class="stats-grid">
            <div class="stat-card hover-lift">
                <div class="stat-header">
                    <div class="stat-icon animate-float">👥</div>
                </div>
                <div class="stat-number" id="totalStudents">500</div>
                <div class="stat-label">Total Siswa</div>
                <div class="stat-change positive hover-scale">
                    <span class="stat-change-icon">↗</span>
                    <span>+12% dari bulan lalu</span>
                </div>
            </div>

            <div class="stat-card success hover-lift">
                <div class="stat-header">
                    <div class="stat-icon animate-float">🎯</div>
                </div>
                <div class="stat-number" id="activeActivities">15</div>
                <div class="stat-label">Kegiatan Aktif</div>
                <div class="stat-change positive hover-scale">
                    <span class="stat-change-icon">↗</span>
                    <span>+2 kegiatan baru</span>
                </div>
            </div>

            <div class="stat-card warning hover-lift">
                <div class="stat-header">
                    <div class="stat-icon animate-float">👨‍🏫</div>
                </div>
                <div class="stat-number" id="totalMentors">25</div>
                <div class="stat-label">Mentor Aktif</div>
                <div class="stat-change positive hover-scale">
                    <span class="stat-change-icon">↗</span>
                    <span>+3 mentor baru</span>
                </div>
            </div>

            <div class="stat-card info hover-lift">
                <div class="stat-header">
                    <div class="stat-icon animate-float">📅</div>
                </div>
                <div class="stat-number" id="totalEvents">50</div>
                <div class="stat-label">Acara Tahun Ini</div>
                <div class="stat-change positive hover-scale">
                    <span class="stat-change-icon">↗</span>
                    <span>+8 acara bulan ini</span>
                </div>
            </div>
        </div>

        <div class="card card-elevated hover-lift">
            <div class="card-header">
                <div>
                    <h3 class="card-title text-gradient-primary">
                        Statistik Pendaftaran
                    </h3>
                    <p class="card-subtitle">
                        Tren pendaftaran siswa dalam 6 bulan terakhir
                    </p>
                </div>
            </div>
            <div class="chart-container large">
                <canvas id="registrationChart"></canvas>
            </div>
        </div>

        <div class="card card-elevated hover-lift">
            <div class="card-header">
                <div>
                    <h3 class="card-title text-gradient-primary">
                        Popularitas Kegiatan
                    </h3>
                    <p class="card-subtitle">Distribusi siswa per kategori</p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="popularityChart"></canvas>
            </div>
        </div>
        <div class="card card-elevated hover-lift">
            <div class="card-header">
                <div>
                    <h3 class="card-title text-gradient-primary">
                        Aktivitas Terbaru
                    </h3>
                    <p class="card-subtitle">
                        Aktivitas sistem dalam 24 jam terakhir
                    </p>
                </div>
                <div class="card-actions">
                    <button class="btn btn-ghost btn-sm hover-scale">
                        Lihat Semua
                    </button>
                </div>
            </div>

            <div class="activity-feed" id="activityFeed"></div>

        </div>
        <div class="card card-elevated hover-lift">
            <div class="card-header">
                <div>
                    <h3 class="card-title text-gradient-primary">Aksi Cepat</h3>
                    <p class="card-subtitle">Tindakan yang sering digunakan</p>
                </div>
            </div>

            <div class="quick-actions-grid">
                <button class="btn btn-primary hover-lift" onclick="openModal('addActivityModal')">
                    <span>➕</span>
                    <span>Tambah Kegiatan</span>
                </button>
                <button class="btn btn-success hover-lift" onclick="openModal('addAnnouncementModal')">
                    <span>📢</span>
                    <span>Buat Pengumuman</span>
                </button>
                <button class="btn btn-warning hover-lift" onclick="openModal('addMentorModal')">
                    <span>👨‍🏫</span>
                    <span>Tambah Mentor</span>
                </button>
                <button class="btn btn-secondary hover-lift" onclick="showSection('reports')">
                    <span>📊</span>
                    <span>Lihat Laporan</span>
                </button>
            </div>
        </div>
    </section>
