<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <button class="sidebar-toggle hover-scale" onclick="handleSidebarToggle()" aria-label="Toggle Sidebar">
            <span id="sidebarToggleIcon">x</span>
        </button>
        <div class="sidebar-logo text-gradient-primary">EkstraKu Admin</div>
        <!-- FIXED: Close button for mobile -->
        </button>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Dashboard</div>
            <div class="nav-item">
                <a href="#" class="nav-link active" onclick="navigate(event, 'dashboard')" data-section="dashboard">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Overview</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'analytics')" data-section="analytics">
                    <span class="nav-icon">📈</span>
                    <span class="nav-text">Analytics</span>
                </a>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Manajemen</div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'activities')" data-section="activities">
                    <span class="nav-icon">🎯</span>
                    <span class="nav-text">Kegiatan</span>
                    <span class="nav-badge animate-pulse" id="activitiesBadge">15</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'students')" data-section="students">
                    <span class="nav-icon">👥</span>
                    <span class="nav-text">Siswa</span>
                    <span class="nav-badge animate-pulse" id="studentsBadge">500</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'registrations')" data-section="registrations">
                    <span class="nav-icon">📝</span>
                    <span class="nav-text">Pendaftaran</span>
                    <span class="nav-badge animate-pulse" id="registrationsBadge">12</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'announcements')" data-section="announcements">
                    <span class="nav-icon">📢</span>
                    <span class="nav-text">Pengumuman</span>
                    <span class="nav-badge animate-pulse" id="announcementsBadge">8</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'mentors')" data-section="mentors">
                    <span class="nav-icon">👨‍🏫</span>
                    <span class="nav-text">Mentor</span>
                    <span class="nav-badge animate-pulse" id="mentorsBadge">25</span>
                </a>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Sistem</div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'users')" data-section="users">
                    <span class="nav-icon">👤</span>
                    <span class="nav-text">Pengguna</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'settings')" data-section="settings">
                    <span class="nav-icon">⚙️</span>
                    <span class="nav-text">Pengaturan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'reports')" data-section="reports">
                    <span class="nav-icon">📋</span>
                    <span class="nav-text">Laporan</span>
                </a>
            </div>
        </div>

        <!-- NEW SECTION FOR ENHANCED FEATURES -->
        <div class="nav-section">
            <div class="nav-section-title">Tools</div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'calendar')" data-section="calendar">
                    <span class="nav-icon">📅</span>
                    <span class="nav-text">Kalender</span>
                </a>
            </div>
        </div>
    </nav>
</aside>
