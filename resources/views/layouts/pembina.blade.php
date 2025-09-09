<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>EkstraKu Pembina - Dashboard Supervisor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3"></script>
    <link rel="stylesheet" href="{{ asset('styles/pembina.css') }}">
</head>

<body>
    <div class="pembina-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <button class="sidebar-toggle" onclick="handleSidebarToggle()" aria-label="Toggle Sidebar">
                    <span id="sidebarToggleIcon">☰</span>
                </button>
                <div class="sidebar-logo">
                    EkstraKu Pembina
                    <span class="logo-subtitle">Dashboard Supervisor</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Dashboard</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link active" onclick="showSection('dashboard')"
                            data-section="dashboard">
                            <span class="nav-icon">🏠</span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('profile')" data-section="profile">
                            <span class="nav-icon">👤</span>
                            <span class="nav-text">Profile</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Manajemen Ekstrakurikuler</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('calendar')" data-section="calendar">
                            <span class="nav-icon">📅</span>
                            <span class="nav-text">Calendar</span>
                            <span class="nav-badge animate-pulse" id="calendarBadge">12</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('attendance')"
                            data-section="attendance">
                            <span class="nav-icon">📊</span>
                            <span class="nav-text">Attendance</span>
                            <span class="nav-badge animate-pulse" id="attendanceBadge">85</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('activities')"
                            data-section="activities">
                            <span class="nav-icon">🎪</span>
                            <span class="nav-text">Activities</span>
                            <span class="nav-badge animate-pulse" id="activitiesBadge">8</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Komunikasi & Data</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('announcements')"
                            data-section="announcements">
                            <span class="nav-icon">📢</span>
                            <span class="nav-text">Announcements</span>
                            <span class="nav-badge animate-pulse" id="announcementsBadge">4</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('students')" data-section="students">
                            <span class="nav-icon">👥</span>
                            <span class="nav-text">Students</span>
                            <span class="nav-badge animate-pulse" id="studentsBadge">42</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="showSection('applications')"
                            data-section="applications">
                            <span class="nav-icon">📝</span>
                            <span class="nav-text">Aplikasi Siswa</span>
                            <span class="nav-badge animate-pulse" id="applicationsBadge">15</span>
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="header-left">
                    <button class="mobile-menu-toggle" onclick="toggleMobileSidebar()"
                        aria-label="Toggle Mobile Menu">
                        ☰
                    </button>
                    <div>
                        <h1 class="page-title" id="pageTitle">Dashboard Pembina</h1>
                        <div class="breadcrumb" id="breadcrumb">
                            <span>EkstraKu</span>
                            <span class="breadcrumb-separator">/</span>
                            <span>Dashboard</span>
                        </div>
                    </div>
                </div>

                <div class="header-right">
                    <div class="search-container">
                        <input type="text" class="search-input" placeholder="Cari siswa, kegiatan, atau jadwal..."
                            id="globalSearch" />
                        <span class="search-icon">🔍</span>
                    </div>

                    <div class="header-actions">
                        <button class="action-btn" onclick="toggleNotifications()" aria-label="Notifications">
                            <span>🔔</span>
                            <span class="notifications-badge animate-bounce" id="notificationsBadge">5</span>
                        </button>

                        <button class="action-btn" onclick="toggleTheme()" aria-label="Toggle Theme">
                            <span id="themeIcon">🌙</span>
                        </button>

                        <div class="user-menu">
                            <div class="user-avatar" onclick="toggleUserMenu()" aria-label="User Menu">
                                AS
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="content">
                <!-- Dashboard Section -->
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
                                    onclick="openModal('createAnnouncementModal')">
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

                <!-- Profile Section -->
                <section id="profile" class="content-section">
                    <div class="profile-card">
                        <div class="profile-avatar">AS</div>
                        <div class="profile-info">
                            <h2 class="profile-name">Ahmad Surya</h2>
                            <p class="profile-role">
                                Pembina Klub Basket • NIP: 198505102010011002
                            </p>
                            <div
                                style="
                    margin: var(--space-4) 0;
                    display: flex;
                    gap: var(--space-4);
                    justify-content: center;
                    flex-wrap: wrap;
                  ">
                                <span class="badge badge-primary">🏀 Klub Basket</span>
                                <span class="badge badge-success">✅ Aktif</span>
                                <span class="badge badge-info">📞 +62 812-3456-7890</span>
                            </div>
                        </div>
                        <div class="profile-stats">
                            <div class="profile-stat">
                                <div class="profile-stat-number">5</div>
                                <div class="profile-stat-label">Tahun Mengajar</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-number">85</div>
                                <div class="profile-stat-label">Siswa Dibina</div>
                            </div>
                            <div class="profile-stat">
                                <div class="profile-stat-number">12</div>
                                <div class="profile-stat-label">Prestasi Tahun Ini</div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-elevated">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Informasi Profile</h3>
                                <p class="card-subtitle">Kelola data pribadi dan kontak</p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-primary" onclick="openModal('editProfileModal')">
                                    ✏️ Edit Profile
                                </button>
                            </div>
                        </div>

                        <div
                            style="
                  display: grid;
                  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                  gap: var(--space-6);
                ">
                            <div>
                                <h4
                                    style="
                      font-size: var(--font-size-lg);
                      font-weight: var(--font-weight-bold);
                      margin-bottom: var(--space-4);
                      color: var(--text-primary);
                    ">
                                    Data Pribadi
                                </h4>
                                <div style="space-y: var(--space-3)">
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Nama Lengkap:</strong><br />
                                        Ahmad Surya, S.Pd., M.Or
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>NIP:</strong><br />
                                        198505102010011002
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Jenis Kelamin:</strong><br />
                                        Laki-laki
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Tempat, Tanggal Lahir:</strong><br />
                                        Jakarta, 10 Mei 1985
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Alamat:</strong><br />
                                        Jl. Sudirman No. 45, Jakarta Selatan
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h4
                                    style="
                      font-size: var(--font-size-lg);
                      font-weight: var(--font-weight-bold);
                      margin-bottom: var(--space-4);
                      color: var(--text-primary);
                    ">
                                    Kontak & Pendidikan
                                </h4>
                                <div style="space-y: var(--space-3)">
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>No. Telepon:</strong><br />
                                        +62 812-3456-7890
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Email:</strong><br />
                                        ahmad.surya@school.edu.id
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Pendidikan Terakhir:</strong><br />
                                        S2 Olahraga - Universitas Negeri Jakarta
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Mata Pelajaran:</strong><br />
                                        Pendidikan Jasmani dan Olahraga
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Ekstrakurikuler yang Dibina:</strong><br />
                                        <span class="badge badge-primary">🏀 Klub Basket</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activities -->
                        <div style="margin-top: var(--space-8)">
                            <h4
                                style="
                    font-size: var(--font-size-lg);
                    font-weight: var(--font-weight-bold);
                    margin-bottom: var(--space-4);
                    color: var(--text-primary);
                  ">
                                Aktivitas Terbaru
                            </h4>
                            <div class="activity-feed">
                                <div class="activity-item">
                                    <div class="activity-icon">📊</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Update Profile</div>
                                        <div class="activity-description">
                                            Memperbarui nomor telepon
                                        </div>
                                        <div class="activity-time">3 hari yang lalu</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">🏀</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Menambah Kegiatan</div>
                                        <div class="activity-description">
                                            Turnamen Basket Antar Sekolah
                                        </div>
                                        <div class="activity-time">1 minggu yang lalu</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">📢</div>
                                    <div class="activity-content">
                                        <div class="activity-title">Pengumuman Baru</div>
                                        <div class="activity-description">
                                            Latihan tambahan untuk turnamen
                                        </div>
                                        <div class="activity-time">2 minggu yang lalu</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Calendar Section -->
                <section id="calendar" class="content-section">
                    <div class="card card-elevated">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Calendar - Klub Basket</h3>
                                <p class="card-subtitle">
                                    Kelola jadwal kegiatan dengan kalender interaktif
                                </p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-secondary btn-sm" onclick="exportSchedule()">
                                    📊 Export Jadwal
                                </button>
                                <button class="btn btn-primary" onclick="openModal('scheduleModal')">
                                    ➕ Tambah Jadwal
                                </button>
                            </div>
                        </div>

                        <!-- Enhanced Calendar -->
                        <div class="calendar-container">
                            <div class="calendar-header">
                                <h4 class="calendar-title" id="currentMonth">Maret 2025</h4>
                                <div class="calendar-nav">
                                    <button class="calendar-nav-btn" onclick="previousMonth()"
                                        aria-label="Previous Month">
                                        ‹
                                    </button>
                                    <button class="calendar-nav-btn" onclick="goToToday()">
                                        Hari Ini
                                    </button>
                                    <button class="calendar-nav-btn" onclick="nextMonth()" aria-label="Next Month">
                                        ›
                                    </button>
                                </div>
                            </div>

                            <div class="calendar-grid">
                                <!-- Day Headers -->
                                <div class="calendar-day-header">Min</div>
                                <div class="calendar-day-header">Sen</div>
                                <div class="calendar-day-header">Sel</div>
                                <div class="calendar-day-header">Rab</div>
                                <div class="calendar-day-header">Kam</div>
                                <div class="calendar-day-header">Jum</div>
                                <div class="calendar-day-header">Sab</div>

                                <!-- Calendar Days will be generated by JavaScript -->
                                <div id="calendarDays" style="grid-column: 1 / -1; display: contents">
                                    <!-- Days will be dynamically inserted here -->
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Legend -->
                        <div
                            style="
                  display: flex;
                  gap: var(--space-4);
                  margin: var(--space-6) 0;
                  flex-wrap: wrap;
                  justify-content: center;
                ">
                            <div
                                style="
                    display: flex;
                    align-items: center;
                    gap: var(--space-2);
                  ">
                                <div
                                    style="
                      width: 16px;
                      height: 16px;
                      background: linear-gradient(
                        135deg,
                        var(--primary-500),
                        var(--primary-600)
                      );
                      border-radius: 50%;
                    ">
                                </div>
                                <span style="font-size: var(--font-size-sm)">Hari Ini</span>
                            </div>
                            <div
                                style="
                    display: flex;
                    align-items: center;
                    gap: var(--space-2);
                  ">
                                <div
                                    style="
                      width: 16px;
                      height: 16px;
                      background: linear-gradient(
                        135deg,
                        var(--error-500),
                        var(--error-600)
                      );
                      border-radius: 50%;
                    ">
                                </div>
                                <span style="font-size: var(--font-size-sm)">Ada Jadwal</span>
                            </div>
                            <div
                                style="
                    display: flex;
                    align-items: center;
                    gap: var(--space-2);
                  ">
                                <div
                                    style="
                      width: 16px;
                      height: 16px;
                      background: linear-gradient(
                        135deg,
                        var(--accent-500),
                        var(--accent-600)
                      );
                      border-radius: 50%;
                    ">
                                </div>
                                <span style="font-size: var(--font-size-sm)">Dipilih</span>
                            </div>
                        </div>

                        <!-- Selected Date Schedule -->
                        <div id="selectedDateSchedule" style="margin-top: var(--space-8)">
                            <h4
                                style="
                    font-size: var(--font-size-xl);
                    font-weight: var(--font-weight-bold);
                    margin-bottom: var(--space-6);
                    color: var(--text-primary);
                  ">
                                📅 Jadwal Hari Ini - Senin, 15 Maret 2025
                            </h4>

                            <div class="schedule-cards">
                                <div class="schedule-card">
                                    <div class="schedule-time">15:30 - 17:00</div>
                                    <div class="schedule-activity">Latihan Basket Reguler</div>
                                    <div class="schedule-location">
                                        📍 Lapangan Basket Utama
                                    </div>
                                    <div class="schedule-participants">
                                        👥 85 siswa terdaftar • 78 hadir
                                    </div>
                                    <div class="schedule-actions">
                                        <button class="btn btn-ghost btn-sm" onclick="editSchedule(1)">
                                            ✏️
                                        </button>
                                        <button class="btn btn-ghost btn-sm" onclick="takeAttendance(1)">
                                            ✅ Absen
                                        </button>
                                        <button class="btn btn-ghost btn-sm" onclick="viewScheduleDetails(1)">
                                            👁️
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Weekly Overview -->
                        <div style="margin-top: var(--space-8)">
                            <h4
                                style="
                    font-size: var(--font-size-xl);
                    font-weight: var(--font-weight-bold);
                    margin-bottom: var(--space-6);
                    color: var(--text-primary);
                  ">
                                📊 Ringkasan Minggu Ini
                            </h4>

                            <div class="stats-grid"
                                style="
                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                    gap: var(--space-4);
                  ">
                                <div class="stat-card" style="padding: var(--space-4)">
                                    <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                        6
                                    </div>
                                    <div class="stat-label">Total Jadwal</div>
                                </div>
                                <div class="stat-card success" style="padding: var(--space-4)">
                                    <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                        5
                                    </div>
                                    <div class="stat-label">Terlaksana</div>
                                </div>
                                <div class="stat-card warning" style="padding: var(--space-4)">
                                    <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                        1
                                    </div>
                                    <div class="stat-label">Akan Datang</div>
                                </div>
                                <div class="stat-card error" style="padding: var(--space-4)">
                                    <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                        0
                                    </div>
                                    <div class="stat-label">Dibatalkan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Attendance Section -->
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
                            <button class="btn btn-ghost active" id="attendanceAll"
                                onclick="filterAttendance('all')">
                                Semua (85)
                            </button>
                            <button class="btn btn-ghost" id="attendancePresent"
                                onclick="filterAttendance('present')">
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
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="editAttendanceStatus('ahmad_rizki')">
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
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="editAttendanceStatus('budi_santoso')">
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
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="editAttendanceStatus('andi_pratama')">
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
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewActivityDetails('turnamen_basket')">
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
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewActivityReport('friendly_match')">
                                        📊 Laporan
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewActivityGallery('friendly_match')">
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
                                    <button class="btn btn-success btn-sm"
                                        onclick="prepareActivity('workshop_basic')">
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
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="manageCampRegistration('training_camp')">
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
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewSelectionCriteria('seleksi_tim')">
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

                <!-- Announcements Section -->
                <section id="announcements" class="content-section">
                    <div class="card card-elevated">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Announcements - Klub Basket</h3>
                                <p class="card-subtitle">
                                    Buat dan kelola pengumuman untuk siswa klub basket
                                </p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-secondary btn-sm" onclick="exportAnnouncements()">
                                    📊 Export
                                </button>
                                <button class="btn btn-primary" onclick="openModal('announcementModal')">
                                    📢 Buat Pengumuman
                                </button>
                            </div>
                        </div>

                        <div class="applications-grid">
                            <div class="application-card">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">
                                            Persiapan Turnamen Basket Regional
                                        </h4>
                                        <div class="application-meta">
                                            <span>📅 14 Maret 2025</span>
                                            <span>🏀 Klub Basket</span>
                                            <span>👁️ 85 views</span>
                                            <span>⚡ Prioritas Tinggi</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-success">📢 PUBLISHED</span>
                                </div>
                                <div class="application-content">
                                    <p>
                                        Latihan tambahan untuk persiapan turnamen basket regional
                                        akan diadakan setiap hari Sabtu mulai tanggal 16 Maret.
                                        Semua anggota tim inti wajib hadir tepat waktu di lapangan
                                        basket pada pukul 07:00.
                                    </p>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('turnamen_prep')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewAnnouncementStats('turnamen_prep')">
                                        📊 Statistik
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="shareAnnouncement('turnamen_prep')">
                                        🔗 Bagikan
                                    </button>
                                </div>
                            </div>

                            <div class="application-card">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">
                                            Dress Code untuk Turnamen
                                        </h4>
                                        <div class="application-meta">
                                            <span>📅 13 Maret 2025</span>
                                            <span>🏀 Klub Basket</span>
                                            <span>👁️ 78 views</span>
                                            <span>📌 Prioritas Normal</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-success">📢 PUBLISHED</span>
                                </div>
                                <div class="application-content">
                                    <p>
                                        Untuk turnamen mendatang, semua anggota tim wajib
                                        menggunakan jersey resmi tim dan sepatu basket putih.
                                        Mohon persiapkan kelengkapan sebelum hari H.
                                    </p>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('dress_code')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewAnnouncementStats('dress_code')">
                                        📊 Statistik
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="shareAnnouncement('dress_code')">
                                        🔗 Bagikan
                                    </button>
                                </div>
                            </div>

                            <div class="application-card">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">
                                            Training Schedule Update
                                        </h4>
                                        <div class="application-meta">
                                            <span>📅 12 Maret 2025</span>
                                            <span>🏀 Klub Basket</span>
                                            <span>👁️ 92 views</span>
                                            <span>🚨 Prioritas Urgent</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-success">📢 PUBLISHED</span>
                                </div>
                                <div class="application-content">
                                    <p>
                                        Update jadwal latihan: mulai minggu depan latihan akan
                                        dimulai pukul 15:30 (30 menit lebih awal). Mohon semua
                                        anggota mengatur waktu dengan baik.
                                    </p>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="editAnnouncement('schedule_update')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewAnnouncementStats('schedule_update')">
                                        📊 Statistik
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="shareAnnouncement('schedule_update')">
                                        🔗 Bagikan
                                    </button>
                                </div>
                            </div>

                            <div class="application-card">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">
                                            Recruitment Anggota Baru
                                        </h4>
                                        <div class="application-meta">
                                            <span>📅 11 Maret 2025</span>
                                            <span>🏀 Klub Basket</span>
                                            <span>👁️ 156 views</span>
                                            <span>📌 Prioritas Normal</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-success">📢 PUBLISHED</span>
                                </div>
                                <div class="application-content">
                                    <p>
                                        Buka pendaftaran anggota baru untuk klub basket semester
                                        genap. Khusus untuk siswa kelas X dan XI yang memiliki
                                        tinggi minimal 165 cm dan pengalaman bermain basket.
                                    </p>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('recruitment')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewAnnouncementStats('recruitment')">
                                        📊 Statistik
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="shareAnnouncement('recruitment')">
                                        🔗 Bagikan
                                    </button>
                                </div>
                            </div>

                            <div class="application-card">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">
                                            Evaluasi Semester Ganjil
                                        </h4>
                                        <div class="application-meta">
                                            <span>📅 10 Maret 2025</span>
                                            <span>🏀 Klub Basket</span>
                                            <span>👁️ 67 views</span>
                                            <span>📌 Prioritas Normal</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-gray">📝 DRAFT</span>
                                </div>
                                <div class="application-content">
                                    <p>
                                        Evaluasi performa klub basket semester ganjil telah
                                        selesai. Secara keseluruhan klub menunjukkan progress yang
                                        baik dengan tingkat kehadiran 94% dan 7 prestasi yang
                                        diraih.
                                    </p>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-success btn-sm"
                                        onclick="publishAnnouncement('evaluasi_semester')">
                                        📢 Publikasi
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="editAnnouncement('evaluasi_semester')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="deleteAnnouncement('evaluasi_semester')">
                                        🗑️ Hapus
                                    </button>
                                </div>
                            </div>

                            <div class="application-card">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">
                                            Basketball Equipment Check
                                        </h4>
                                        <div class="application-meta">
                                            <span>📅 09 Maret 2025</span>
                                            <span>🏀 Klub Basket</span>
                                            <span>👁️ 45 views</span>
                                            <span>📌 Prioritas Normal</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-success">📢 PUBLISHED</span>
                                </div>
                                <div class="application-content">
                                    <p>
                                        Pengecekan kelengkapan peralatan basket akan dilakukan
                                        setiap awal bulan. Pastikan semua anggota membawa sepatu
                                        basket yang layak dan dalam kondisi baik.
                                    </p>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="editAnnouncement('equipment_check')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewAnnouncementStats('equipment_check')">
                                        📊 Statistik
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="shareAnnouncement('equipment_check')">
                                        🔗 Bagikan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Students Section -->
                <section id="students" class="content-section">
                    <div class="card card-elevated">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Students - Klub Basket</h3>
                                <p class="card-subtitle">
                                    Kelola dan pantau siswa anggota klub basket
                                </p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-secondary btn-sm" onclick="exportStudents()">
                                    📊 Export Data
                                </button>
                                <button class="btn btn-primary" onclick="openModal('addStudentModal')">
                                    ➕ Tambah Siswa
                                </button>
                            </div>
                        </div>

                        <!-- Student Summary Stats -->
                        <div class="stats-grid"
                            style="
                  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                  gap: var(--space-4);
                  margin-bottom: var(--space-8);
                ">
                            <div class="stat-card" style="padding: var(--space-4)">
                                <div class="stat-icon"
                                    style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                                    👥
                                </div>
                                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                    85
                                </div>
                                <div class="stat-label">Total Anggota</div>
                            </div>
                            <div class="stat-card success" style="padding: var(--space-4)">
                                <div class="stat-icon"
                                    style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                                    🏀
                                </div>
                                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                    12
                                </div>
                                <div class="stat-label">Tim Inti</div>
                            </div>
                            <div class="stat-card warning" style="padding: var(--space-4)">
                                <div class="stat-icon"
                                    style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                                    📈
                                </div>
                                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                    94.2%
                                </div>
                                <div class="stat-label">Avg. Kehadiran</div>
                            </div>
                            <div class="stat-card secondary" style="padding: var(--space-4)">
                                <div class="stat-icon"
                                    style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                                    🆕
                                </div>
                                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                    15
                                </div>
                                <div class="stat-label">Anggota Baru</div>
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
                                <label class="form-label">Filter Kelas</label>
                                <select class="form-select" id="studentClassFilter" onchange="filterStudents()">
                                    <option value="">Semua Kelas</option>
                                    <option value="X">Kelas X</option>
                                    <option value="XI">Kelas XI</option>
                                    <option value="XII">Kelas XII</option>
                                </select>
                            </div>
                            <div style="min-width: 200px">
                                <label class="form-label">Status Anggota</label>
                                <select class="form-select" id="studentStatusFilter" onchange="filterStudents()">
                                    <option value="">Semua Status</option>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Tidak Aktif</option>
                                    <option value="core">Tim Inti</option>
                                </select>
                            </div>
                            <div style="flex: 1; min-width: 300px">
                                <label class="form-label">Cari Siswa</label>
                                <input type="text" class="form-input" placeholder="Cari nama siswa atau NISN..."
                                    id="studentSearchInput" oninput="filterStudents()" />
                            </div>
                        </div>

                        <!-- Students Grid -->
                        <div class="students-grid" id="studentsGrid">
                            <div class="student-card">
                                <div class="student-header">
                                    <div class="student-avatar">AR</div>
                                    <div class="student-info">
                                        <div class="student-name">Ahmad Rizki Pratama</div>
                                        <div class="student-meta">
                                            <span>📚 XI IPA 2</span>
                                            <span>🆔 0012345678</span>
                                            <span class="badge badge-success">Tim Inti</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="student-stats">
                                    <div class="student-stat">
                                        <div class="student-stat-number">96%</div>
                                        <div class="student-stat-label">Kehadiran</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">4.2</div>
                                        <div class="student-stat-label">Rating</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">PG</div>
                                        <div class="student-stat-label">Posisi</div>
                                    </div>
                                </div>
                                <div
                                    style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                                    📧 ahmad.rizki@student.school.id<br />
                                    📞 +62 812-1234-5678<br />
                                    📍 Jakarta Selatan
                                </div>
                                <div class="student-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('ahmad_rizki')">
                                        👁️ Detail
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="editStudent('ahmad_rizki')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('ahmad_rizki')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <div class="student-card">
                                <div class="student-header">
                                    <div class="student-avatar">BS</div>
                                    <div class="student-info">
                                        <div class="student-name">Budi Santoso</div>
                                        <div class="student-meta">
                                            <span>📚 XII IPA 3</span>
                                            <span>🆔 0012345679</span>
                                            <span class="badge badge-success">Tim Inti</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="student-stats">
                                    <div class="student-stat">
                                        <div class="student-stat-number">92%</div>
                                        <div class="student-stat-label">Kehadiran</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">4.5</div>
                                        <div class="student-stat-label">Rating</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">C</div>
                                        <div class="student-stat-label">Posisi</div>
                                    </div>
                                </div>
                                <div
                                    style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                                    📧 budi.santoso@student.school.id<br />
                                    📞 +62 813-2345-6789<br />
                                    📍 Jakarta Timur
                                </div>
                                <div class="student-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('budi_santoso')">
                                        👁️ Detail
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="editStudent('budi_santoso')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('budi_santoso')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <div class="student-card">
                                <div class="student-header">
                                    <div class="student-avatar">AP</div>
                                    <div class="student-info">
                                        <div class="student-name">Andi Pratama</div>
                                        <div class="student-meta">
                                            <span>📚 XII IPA 1</span>
                                            <span>🆔 0012345680</span>
                                            <span class="badge badge-warning">Reserve</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="student-stats">
                                    <div class="student-stat">
                                        <div class="student-stat-number">88%</div>
                                        <div class="student-stat-label">Kehadiran</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">3.8</div>
                                        <div class="student-stat-label">Rating</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">SF</div>
                                        <div class="student-stat-label">Posisi</div>
                                    </div>
                                </div>
                                <div
                                    style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                                    📧 andi.pratama@student.school.id<br />
                                    📞 +62 814-3456-7890<br />
                                    📍 Jakarta Barat
                                </div>
                                <div class="student-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('andi_pratama')">
                                        👁️ Detail
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="editStudent('andi_pratama')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('andi_pratama')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <div class="student-card">
                                <div class="student-header">
                                    <div class="student-avatar">DS</div>
                                    <div class="student-info">
                                        <div class="student-name">Dino Saputra</div>
                                        <div class="student-meta">
                                            <span>📚 XI IPA 1</span>
                                            <span>🆔 0012345681</span>
                                            <span class="badge badge-success">Tim Inti</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="student-stats">
                                    <div class="student-stat">
                                        <div class="student-stat-number">98%</div>
                                        <div class="student-stat-label">Kehadiran</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">4.7</div>
                                        <div class="student-stat-label">Rating</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">PF</div>
                                        <div class="student-stat-label">Posisi</div>
                                    </div>
                                </div>
                                <div
                                    style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                                    📧 dino.saputra@student.school.id<br />
                                    📞 +62 815-4567-8901<br />
                                    📍 Jakarta Pusat
                                </div>
                                <div class="student-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('dino_saputra')">
                                        👁️ Detail
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="editStudent('dino_saputra')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('dino_saputra')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <div class="student-card">
                                <div class="student-header">
                                    <div class="student-avatar">EW</div>
                                    <div class="student-info">
                                        <div class="student-name">Eko Wijaya</div>
                                        <div class="student-meta">
                                            <span>📚 X IPA 2</span>
                                            <span>🆔 0012345682</span>
                                            <span class="badge badge-primary">Anggota Baru</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="student-stats">
                                    <div class="student-stat">
                                        <div class="student-stat-number">85%</div>
                                        <div class="student-stat-label">Kehadiran</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">3.5</div>
                                        <div class="student-stat-label">Rating</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">SG</div>
                                        <div class="student-stat-label">Posisi</div>
                                    </div>
                                </div>
                                <div
                                    style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                                    📧 eko.wijaya@student.school.id<br />
                                    📞 +62 816-5678-9012<br />
                                    📍 Jakarta Selatan
                                </div>
                                <div class="student-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('eko_wijaya')">
                                        👁️ Detail
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="editStudent('eko_wijaya')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('eko_wijaya')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <div class="student-card">
                                <div class="student-header">
                                    <div class="student-avatar">FA</div>
                                    <div class="student-info">
                                        <div class="student-name">Farid Ahmad</div>
                                        <div class="student-meta">
                                            <span>📚 XI IPS 1</span>
                                            <span>🆔 0012345683</span>
                                            <span class="badge badge-warning">Reserve</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="student-stats">
                                    <div class="student-stat">
                                        <div class="student-stat-number">90%</div>
                                        <div class="student-stat-label">Kehadiran</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">4.0</div>
                                        <div class="student-stat-label">Rating</div>
                                    </div>
                                    <div class="student-stat">
                                        <div class="student-stat-number">PG</div>
                                        <div class="student-stat-label">Posisi</div>
                                    </div>
                                </div>
                                <div
                                    style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                                    📧 farid.ahmad@student.school.id<br />
                                    📞 +62 817-6789-0123<br />
                                    📍 Jakarta Utara
                                </div>
                                <div class="student-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('farid_ahmad')">
                                        👁️ Detail
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="editStudent('farid_ahmad')">
                                        ✏️ Edit
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('farid_ahmad')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="applications" class="content-section">
                    <div class="card card-elevated">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">Aplikasi Siswa</h3>
                                <p class="card-subtitle">
                                    Review dan kelola aplikasi pendaftaran ekstrakurikuler
                                </p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-secondary btn-sm" onclick="exportApplications()">
                                    📊 Export
                                </button>
                                <button class="btn btn-success" onclick="approveAllPending()">
                                    ✅ Setujui Semua Pending
                                </button>
                            </div>
                        </div>

                        <!-- Application Summary Stats -->
                        <div class="stats-grid"
                            style="
                  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                  gap: var(--space-4);
                  margin-bottom: var(--space-6);
                ">
                            <div class="stat-card" style="padding: var(--space-4)">
                                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                    47
                                </div>
                                <div class="stat-label">Total Aplikasi</div>
                            </div>
                            <div class="stat-card warning" style="padding: var(--space-4)">
                                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                    15
                                </div>
                                <div class="stat-label">Pending Review</div>
                            </div>
                            <div class="stat-card success" style="padding: var(--space-4)">
                                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                    28
                                </div>
                                <div class="stat-label">Disetujui</div>
                            </div>
                            <div class="stat-card error" style="padding: var(--space-4)">
                                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                                    4
                                </div>
                                <div class="stat-label">Ditolak</div>
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
                            <button class="btn btn-ghost active" id="appAll" onclick="filterApplications('all')">
                                Semua (47)
                            </button>
                            <button class="btn btn-ghost" id="appPending" onclick="filterApplications('pending')">
                                Pending (15)
                            </button>
                            <button class="btn btn-ghost" id="appApproved" onclick="filterApplications('approved')">
                                Disetujui (28)
                            </button>
                            <button class="btn btn-ghost" id="appRejected" onclick="filterApplications('rejected')">
                                Ditolak (4)
                            </button>
                        </div>

                        <div class="applications-grid" id="applicationsGrid">
                            <!-- Pending Applications -->
                            <div class="application-card pending">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">Ahmad Rizki Pratama</h4>
                                        <div class="application-meta">
                                            <span>📧 ahmad.rizki@student.school.id</span>
                                            <span>🎓 Kelas XI IPA 2</span>
                                            <span>🏀 Klub Basket</span>
                                            <span>📅 13 Maret 2025</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-warning">⏳ PENDING</span>
                                </div>
                                <div class="application-content">
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Alasan bergabung:</strong><br />
                                        Saya sangat menyukai olahraga basket sejak SMP. Saya ingin
                                        mengembangkan skill bermain basket dan belajar tentang
                                        kerjasama tim. Saya juga ingin berkontribusi untuk membawa
                                        prestasi bagi sekolah.
                                    </div>
                                    <div>
                                        <strong>Pengalaman sebelumnya:</strong><br />
                                        Pernah bermain di tim basket SMP selama 2 tahun, posisi
                                        Point Guard. Juara 2 tournament basket antar SMP tingkat
                                        kota.
                                    </div>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-success btn-sm"
                                        onclick="approveApplication('ahmad_rizki')">
                                        ✅ Setujui
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="rejectApplication('ahmad_rizki')">
                                        ❌ Tolak
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('ahmad_rizki')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <div class="application-card pending">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">Sari Indah Sari</h4>
                                        <div class="application-meta">
                                            <span>📧 sari.indah@student.school.id</span>
                                            <span>🎓 Kelas X IPS 1</span>
                                            <span>🎭 Drama Club</span>
                                            <span>📅 12 Maret 2025</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-warning">⏳ PENDING</span>
                                </div>
                                <div class="application-content">
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Alasan bergabung:</strong><br />
                                        Saya tertarik dengan dunia akting dan ingin mengembangkan
                                        kemampuan public speaking. Drama club akan membantu saya
                                        lebih percaya diri tampil di depan umum.
                                    </div>
                                    <div>
                                        <strong>Pengalaman sebelumnya:</strong><br />
                                        Pernah ikut drama sekolah di SMP sebagai pemeran utama.
                                        Suka menonton teater dan film.
                                    </div>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-success btn-sm" onclick="approveApplication('sari_indah')">
                                        ✅ Setujui
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="rejectApplication('sari_indah')">
                                        ❌ Tolak
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('sari_indah')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <!-- Approved Applications -->
                            <div class="application-card approved">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">Budi Santoso</h4>
                                        <div class="application-meta">
                                            <span>📧 budi.santoso@student.school.id</span>
                                            <span>🎓 Kelas XII IPA 3</span>
                                            <span>🤖 Klub Robotik</span>
                                            <span>📅 10 Maret 2025</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-success">✅ DISETUJUI</span>
                                </div>
                                <div class="application-content">
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Alasan bergabung:</strong><br />
                                        Sangat tertarik dengan teknologi robotik dan AI. Ingin
                                        mengembangkan skill programming dan engineering untuk
                                        persiapan kuliah teknik.
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Pengalaman sebelumnya:</strong><br />
                                        Sudah belajar programming Python dan C++. Pernah membuat
                                        robot sederhana menggunakan Arduino.
                                    </div>
                                    <div
                                        style="
                        font-size: var(--font-size-xs);
                        color: var(--text-tertiary);
                      ">
                                        <strong>Disetujui oleh:</strong> Ahmad Surya •
                                        <strong>Tanggal:</strong> 11 Maret 2025
                                    </div>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewStudentProfile('budi_santoso')">
                                        👤 Profil
                                    </button>
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="viewStudentActivity('budi_santoso')">
                                        📊 Aktivitas
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('budi_santoso')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <div class="application-card pending">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">Maya Sari Dewi</h4>
                                        <div class="application-meta">
                                            <span>📧 maya.sari@student.school.id</span>
                                            <span>🎓 Kelas XI IPS 2</span>
                                            <span>🇬🇧 English Club</span>
                                            <span>📅 11 Maret 2025</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-warning">⏳ PENDING</span>
                                </div>
                                <div class="application-content">
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Alasan bergabung:</strong><br />
                                        Ingin meningkatkan kemampuan bahasa Inggris untuk
                                        persiapan TOEFL dan kuliah luar negeri. Tertarik dengan
                                        program debate dan public speaking.
                                    </div>
                                    <div>
                                        <strong>Pengalaman sebelumnya:</strong><br />
                                        TOEFL score 485, sering menonton film berbahasa Inggris,
                                        pernah ikut English speech contest tingkat sekolah.
                                    </div>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-success btn-sm"
                                        onclick="approveApplication('maya_sari')">
                                        ✅ Setujui
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="rejectApplication('maya_sari')">
                                        ❌ Tolak
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('maya_sari')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <div class="application-card pending">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">Andi Pratama</h4>
                                        <div class="application-meta">
                                            <span>📧 andi.pratama@student.school.id</span>
                                            <span>🎓 Kelas XII IPA 1</span>
                                            <span>📸 Fotografi Club</span>
                                            <span>📅 09 Maret 2025</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-warning">⏳ PENDING</span>
                                </div>
                                <div class="application-content">
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Alasan bergabung:</strong><br />
                                        Hobi fotografi sejak kecil, ingin belajar teknik fotografi
                                        yang lebih advanced dan bergabung dalam dokumentasi acara
                                        sekolah.
                                    </div>
                                    <div>
                                        <strong>Pengalaman sebelumnya:</strong><br />
                                        Memiliki kamera DSLR Canon 80D, sering foto landscape dan
                                        street photography, pernah menang lomba foto tingkat kota.
                                    </div>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-success btn-sm"
                                        onclick="approveApplication('andi_pratama')">
                                        ✅ Setujui
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="rejectApplication('andi_pratama')">
                                        ❌ Tolak
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('andi_pratama')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>

                            <!-- Rejected Application -->
                            <div class="application-card rejected">
                                <div class="application-header">
                                    <div>
                                        <h4 class="application-student">Rina Wati</h4>
                                        <div class="application-meta">
                                            <span>📧 rina.wati@student.school.id</span>
                                            <span>🎓 Kelas X IPA 3</span>
                                            <span>⛺ Pramuka</span>
                                            <span>📅 08 Maret 2025</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-danger">❌ DITOLAK</span>
                                </div>
                                <div class="application-content">
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Alasan bergabung:</strong><br />
                                        Ingin belajar tentang kepemimpinan dan kegiatan alam
                                        terbuka melalui pramuka.
                                    </div>
                                    <div style="margin-bottom: var(--space-3)">
                                        <strong>Pengalaman sebelumnya:</strong><br />
                                        Belum pernah ikut pramuka sebelumnya, tapi tertarik dengan
                                        kegiatan outdoor.
                                    </div>
                                    <div
                                        style="
                        font-size: var(--font-size-xs);
                        color: var(--error-600);
                      ">
                                        <strong>Alasan ditolak:</strong> Kuota sudah penuh untuk
                                        tahun ini • <strong>Tanggal:</strong> 09 Maret 2025
                                    </div>
                                </div>
                                <div class="application-actions">
                                    <button class="btn btn-ghost btn-sm"
                                        onclick="reconsiderApplication('rina_wati')">
                                        🔄 Pertimbangkan Ulang
                                    </button>
                                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('rina_wati')">
                                        💬 Kontak
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-bottom-nav">
        <div class="mobile-bottom-nav-items">
            <a href="#" class="mobile-bottom-nav-item active" onclick="showSection('dashboard')"
                data-section="dashboard">
                <span class="mobile-bottom-nav-icon">🏠</span>
                <span>Dashboard</span>
            </a>
            <a href="#" class="mobile-bottom-nav-item" onclick="showSection('profile')"
                data-section="profile">
                <span class="mobile-bottom-nav-icon">👤</span>
                <span>Profile</span>
            </a>
            <a href="#" class="mobile-bottom-nav-item" onclick="showSection('calendar')"
                data-section="calendar">
                <span class="mobile-bottom-nav-icon">📅</span>
                <span>Calendar</span>
            </a>
            <a href="#" class="mobile-bottom-nav-item" onclick="showSection('attendance')"
                data-section="attendance">
                <span class="mobile-bottom-nav-icon">📊</span>
                <span>Attendance</span>
            </a>
            <a href="#" class="mobile-bottom-nav-item" onclick="showSection('students')"
                data-section="students">
                <span class="mobile-bottom-nav-icon">👥</span>
                <span>Students</span>
            </a>
        </div>
    </nav>

    <!-- Enhanced Modals -->
    <div id="scheduleModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Jadwal Baru - Klub Basket</h3>
                <button class="close-btn" onclick="closeModal('scheduleModal')" aria-label="Close">
                    &times;
                </button>
            </div>

            <form id="scheduleForm" onsubmit="handleScheduleSubmit(event)">
                <div class="form-group">
                    <label class="form-label">Jenis Kegiatan</label>
                    <select class="form-select" required>
                        <option value="">Pilih Jenis</option>
                        <option value="latihan">Latihan Reguler</option>
                        <option value="workshop">Workshop/Pelatihan</option>
                        <option value="kompetisi">Kompetisi/Lomba</option>
                        <option value="pertandingan">Pertandingan</option>
                        <option value="meeting">Rapat/Meeting</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-input" required placeholder="Masukkan nama kegiatan" />
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-input" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-input" required />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Durasi (menit)</label>
                        <input type="number" class="form-input" min="30" value="120" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Lokasi</label>
                        <input type="text" class="form-input" required placeholder="Lokasi kegiatan"
                            value="Lapangan Basket" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi/Catatan</label>
                    <textarea class="form-textarea" placeholder="Deskripsi kegiatan atau catatan khusus"></textarea>
                </div>

                <div
                    style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('scheduleModal')">
                        ❌ Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        📅 Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="announcementModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Buat Pengumuman - Klub Basket</h3>
                <button class="close-btn" onclick="closeModal('announcementModal')" aria-label="Close">
                    &times;
                </button>
            </div>

            <form id="announcementForm" onsubmit="handleAnnouncementSubmit(event)">
                <div class="form-group">
                    <label class="form-label">Judul Pengumuman</label>
                    <input type="text" class="form-input" required placeholder="Judul pengumuman" />
                </div>

                <div class="form-group">
                    <label class="form-label">Isi Pengumuman</label>
                    <textarea class="form-textarea" rows="6" required placeholder="Tulis pengumuman untuk klub basket..."></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Target Audience</label>
                        <select class="form-select" required>
                            <option value="all">Semua Anggota Klub Basket</option>
                            <option value="core">Tim Inti</option>
                            <option value="reserve">Tim Reserve</option>
                            <option value="new">Anggota Baru</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Prioritas</label>
                        <select class="form-select" required>
                            <option value="normal">📌 Normal</option>
                            <option value="high">⚡ Tinggi</option>
                            <option value="urgent">🚨 Urgent</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Status Publikasi</label>
                        <select class="form-select" required>
                            <option value="draft">📝 Simpan sebagai Draft</option>
                            <option value="publish">📢 Publikasi Sekarang</option>
                            <option value="schedule">⏰ Jadwalkan Publikasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Publikasi (opsional)</label>
                        <input type="datetime-local" class="form-input" />
                    </div>
                </div>

                <div
                    style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('announcementModal')">
                        ❌ Batal
                    </button>
                    <button type="button" class="btn btn-ghost" onclick="saveDraft()">
                        💾 Simpan Draft
                    </button>
                    <button type="submit" class="btn btn-primary">📢 Publikasi</button>
                </div>
            </form>
        </div>
    </div>

    <div id="activityModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Buat Kegiatan - Klub Basket</h3>
                <button class="close-btn" onclick="closeModal('activityModal')" aria-label="Close">
                    &times;
                </button>
            </div>

            <form id="activityForm" onsubmit="handleActivitySubmit(event)">
                <div class="form-group">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text" class="form-input" required placeholder="Nama kegiatan basket" />
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Kegiatan</label>
                    <textarea class="form-textarea" required placeholder="Deskripsi detail kegiatan"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori Kegiatan</label>
                        <select class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="kompetisi">🏆 Kompetisi/Lomba</option>
                            <option value="workshop">🎯 Workshop/Pelatihan</option>
                            <option value="pertandingan">🏀 Pertandingan</option>
                            <option value="latihan">💪 Latihan Intensif</option>
                            <option value="seminar">📚 Seminar/Kuliah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Level Kegiatan</label>
                        <select class="form-select" required>
                            <option value="">Pilih Level</option>
                            <option value="internal">Internal Sekolah</option>
                            <option value="regional">Regional</option>
                            <option value="nasional">Nasional</option>
                            <option value="friendly">Pertandingan Persahabatan</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-input" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-input" required />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-input" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-input" required />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Lokasi</label>
                        <input type="text" class="form-input" required placeholder="Lokasi kegiatan"
                            value="Lapangan Basket" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Target Peserta</label>
                        <input type="number" class="form-input" min="1"
                            placeholder="Jumlah target peserta" value="85" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Budget (Rp)</label>
                        <input type="number" class="form-input" min="0" placeholder="Budget kegiatan" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Penanggung Jawab</label>
                        <input type="text" class="form-input" required placeholder="Nama PIC"
                            value="Ahmad Surya" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan Tambahan</label>
                    <textarea class="form-textarea" placeholder="Catatan khusus atau persyaratan"></textarea>
                </div>

                <div
                    style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('activityModal')">
                        ❌ Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        🎪 Buat Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>

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

    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Profile Pembina</h3>
                <button class="close-btn" onclick="closeModal('editProfileModal')" aria-label="Close">
                    &times;
                </button>
            </div>

            <form id="profileForm" onsubmit="handleProfileSubmit(event)">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-input" required value="Ahmad Surya" />
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-input" required value="198505102010011002" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="form-select" required>
                            <option value="L" selected>Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">No. Telepon</label>
                        <input type="tel" class="form-input" required value="+62 812-3456-7890" />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-input" required value="ahmad.surya@school.edu.id" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-textarea" required>
Jl. Sudirman No. 45, Jakarta Selatan</textarea
            >
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi (Bio)</label>
            <textarea
              class="form-textarea"
              placeholder="Tulis deskripsi singkat tentang Anda"
            >
Pembina Klub Basket dengan pengalaman 5 tahun. Lulusan S2 Olahraga dari Universitas Negeri Jakarta. Passionate dalam mengembangkan bakat basket siswa.</textarea
            >
          </div>

          <div
            style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            "
          >
            <button
              type="button"
              class="btn btn-secondary"
              onclick="closeModal('editProfileModal')"
            >
              ❌ Batal
            </button>
            <button type="submit" class="btn btn-primary">
              💾 Simpan Profile
            </button>
          </div>
        </form>
      </div>
    </div>

    <div id="addStudentModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title">Tambah Siswa ke Klub Basket</h3>
          <button
            class="close-btn"
            onclick="closeModal('addStudentModal')"
            aria-label="Close"
          >
            &times;
          </button>
        </div>

        <form id="studentForm" onsubmit="handleStudentSubmit(event)">
          <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input
              type="text"
              class="form-input"
              required
              placeholder="Nama lengkap siswa"
            />
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">NISN</label>
              <input
                type="text"
                class="form-input"
                required
                placeholder="NISN siswa"
              />
            </div>
            <div class="form-group">
              <label class="form-label">Kelas</label>
              <select class="form-select" required>
                <option value="">Pilih Kelas</option>
                <option value="X IPA 1">X IPA 1</option>
                <option value="X IPA 2">X IPA 2</option>
                <option value="X IPS 1">X IPS 1</option>
                <option value="XI IPA 1">XI IPA 1</option>
                <option value="XI IPA 2">XI IPA 2</option>
                <option value="XI IPS 1">XI IPS 1</option>
                <option value="XII IPA 1">XII IPA 1</option>
                <option value="XII IPA 2">XII IPA 2</option>
                <option value="XII IPS 1">XII IPS 1</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Email</label>
              <input
                type="email"
                class="form-input"
                required
                placeholder="email@student.school.id"
              />
            </div>
            <div class="form-group">
              <label class="form-label">No. Telepon</label>
              <input
                type="tel"
                class="form-input"
                placeholder="+62 xxx-xxxx-xxxx"
              />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Posisi Basket</label>
              <select class="form-select" required>
                <option value="">Pilih Posisi</option>
                <option value="PG">Point Guard (PG)</option>
                <option value="SG">Shooting Guard (SG)</option>
                <option value="SF">Small Forward (SF)</option>
                <option value="PF">Power Forward (PF)</option>
                <option value="C">Center (C)</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Status Tim</label>
              <select class="form-select" required>
                <option value="member">Anggota Biasa</option>
                <option value="reserve">Tim Reserve</option>
                <option value="core">Tim Inti</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea
              class="form-textarea"
              placeholder="Alamat lengkap siswa"
            ></textarea>
                </div>

                <div
                    style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addStudentModal')">
                        ❌ Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        👥 Tambah Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="createAnnouncementModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Pengumuman Cepat - Klub Basket</h3>
                <button class="close-btn" onclick="closeModal('createAnnouncementModal')" aria-label="Close">
                    &times;
                </button>
            </div>

            <form id="quickAnnouncementForm" onsubmit="handleQuickAnnouncementSubmit(event)">
                <div class="form-group">
                    <label class="form-label">Judul Pengumuman</label>
                    <input type="text" class="form-input" required placeholder="Judul pengumuman" />
                </div>

                <div class="form-group">
                    <label class="form-label">Isi Pengumuman</label>
                    <textarea class="form-textarea" rows="4" required placeholder="Tulis pengumuman singkat..."></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Target</label>
                        <select class="form-select" required>
                            <option value="all">Semua Anggota</option>
                            <option value="core">Tim Inti</option>
                            <option value="reserve">Tim Reserve</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Prioritas</label>
                        <select class="form-select" required>
                            <option value="normal">📌 Normal</option>
                            <option value="high">⚡ Tinggi</option>
                            <option value="urgent">🚨 Urgent</option>
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
                    <button type="button" class="btn btn-secondary"
                        onclick="closeModal('createAnnouncementModal')">
                        ❌ Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        📢 Publikasi Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="notificationContainer" class="notification-container"></div>

    <script src="{{ asset('scripts/pembina.js') }}"></script>
</body>

</html>
