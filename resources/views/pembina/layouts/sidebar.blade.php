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
                <a href="#" class="nav-link active" onclick="navigate(event , 'dashboard')" data-section="dashboard">
                    <span class="nav-icon">🏠</span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'profile')" data-section="profile">
                    <span class="nav-icon">👤</span>
                    <span class="nav-text">Profile</span>
                </a>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Manajemen Ekstrakurikuler</div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'calendar')" data-section="calendar">
                    <span class="nav-icon">📅</span>
                    <span class="nav-text">Calendar</span>
                    <span class="nav-badge animate-pulse" id="calendarBadge">12</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'attendance')" data-section="attendance">
                    <span class="nav-icon">📊</span>
                    <span class="nav-text">Attendance</span>
                    <span class="nav-badge animate-pulse" id="attendanceBadge">85</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'activities')" data-section="activities">
                    <span class="nav-icon">🎪</span>
                    <span class="nav-text">Activities</span>
                    <span class="nav-badge animate-pulse" id="activitiesBadge">8</span>
                </a>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Komunikasi & Data</div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'announcements')" data-section="announcements">
                    <span class="nav-icon">📢</span>
                    <span class="nav-text">Announcements</span>
                    <span class="nav-badge animate-pulse" id="announcementsBadge">4</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'students')" data-section="students">
                    <span class="nav-icon">👥</span>
                    <span class="nav-text">Students</span>
                    <span class="nav-badge animate-pulse" id="studentsBadge">42</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link" onclick="navigate(event, 'applications')" data-section="applications">
                    <span class="nav-icon">📝</span>
                    <span class="nav-text">Aplikasi Siswa</span>
                    <span class="nav-badge animate-pulse" id="applicationsBadge">15</span>
                </a>
            </div>
        </div>
    </nav>
</aside>
