<header class="header">
    <div class="header-left">
        <button class="mobile-menu-toggle" onclick="toggleMobileSidebar()" aria-label="Toggle Mobile Menu">
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
