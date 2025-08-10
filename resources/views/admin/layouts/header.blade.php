<header class="header">
    <div class="header-left">
        <button class="mobile-menu-toggle hover-scale" onclick="toggleMobileSidebar()" aria-label="Toggle Mobile Menu">
            ☰
        </button>
        <div>
            <h1 class="page-title" id="pageTitle">Dashboard Overview</h1>
            <div class="breadcrumb" id="breadcrumb">
                <span>Admin</span>
                <span class="breadcrumb-separator">/</span>
                <span>Dashboard</span>
            </div>
        </div>
    </div>

    <div class="header-right">
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Cari kegiatan, siswa, atau pengumuman..."
                id="globalSearch" />
            <span class="search-icon">🔍</span>
            <div class="search-suggestions" id="searchSuggestions">
                <!-- Search suggestions will be populated here -->
            </div>
        </div>

        <div class="header-actions">
            <button class="action-btn hover-lift" onclick="toggleNotifications()" aria-label="Notifications">
                🔔
                <span class="notifications-badge animate-bounce" id="notificationsBadge">3</span>
            </button>

            <!-- ENHANCED THEME SWITCHER -->

            <button class="action-btn hover-lift" onclick="toggleTheme()" aria-label="Toggle Theme">
                <span id="themeIcon">🌙</span>
            </button>

            <div class="user-menu">
                <div class="user-avatar hover-glow" onclick="toggleUserMenu()" aria-label="User Menu">
                    A
                </div>
            </div>
        </div>
    </div>
</header>
