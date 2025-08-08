<nav class="nav">
    <div class="logo">EkstraKu</div>
    <div class="nav-links">
        <a href="#home" class="nav-link">Beranda</a>
        <a href="#activities" class="nav-link">Kegiatan</a>
        <a href="#announcements" class="nav-link">Pengumuman</a>
        <a href="#about" class="nav-link">Tentang</a>
    </div>
    <div class="nav-buttons" id="guestNav">
        <button class="theme-toggle" onclick="toggleTheme()" aria-label="Ganti tema">🌙</button>
        <button class="btn btn-secondary" onclick="openModal('loginModal')">Masuk</button>
        <button class="btn btn-primary" onclick="openModal('registerModal')">Daftar</button>
    </div>
    @include('guest.dashboard.partials.profile-dropdown')
    <button class="mobile-menu-btn" onclick="toggleMobileMenu()" aria-label="Buka menu">☰</button>
</nav>
<div class="mobile-nav" id="mobileNav">
    <div class="mobile-nav-content">
        <div class="mobile-user-section" id="mobileUserSection">
            <div class="mobile-user-info">
                <div class="mobile-user-avatar" id="mobileUserAvatar">A</div>
                <div class="mobile-user-details">
                    <div class="mobile-user-name" id="mobileUserName">Ahmad Siswa</div>
                    <div class="mobile-user-role" id="mobileUserRole">siswa</div>
                </div>
            </div>
            <div class="mobile-user-actions">
                <button class="mobile-user-btn" onclick="openProfileModal(); closeMobileMenu();">
                    👤 Profil
                </button>
                <button class="mobile-user-btn" onclick="openEditProfile(); closeMobileMenu();">
                    ✏️ Edit
                </button>
                <button class="mobile-user-btn" onclick="openNotificationsModal(); closeMobileMenu();">
                    🔔 Notifikasi
                </button>
            </div>
        </div>
        <div class="mobile-nav-links">
            <a href="#home" class="mobile-nav-link" onclick="closeMobileMenu()">🏠 Beranda</a>
            <a href="#activities" class="mobile-nav-link" onclick="closeMobileMenu()">🎯 Kegiatan</a>
            <a href="#announcements" class="mobile-nav-link" onclick="closeMobileMenu()">📢 Pengumuman</a>
            <a href="#about" class="mobile-nav-link" onclick="closeMobileMenu()">ℹ️ Tentang</a>
        </div>
        <div class="mobile-nav-buttons">
            <button class="theme-toggle" onclick="toggleTheme()" style="justify-content: center;">
                <span id="mobileThemeIcon">🌙</span> Ganti Tema
            </button>
            <button class="btn btn-secondary" id="loginButton"
                onclick="openModal('loginModal'); closeMobileMenu()">Masuk</button>
            <button class="btn btn-primary" id="registerButton"
                onclick="openModal('registerModal'); closeMobileMenu()">Daftar</button>
            <button class="btn btn-secondary" style="display:none" onclick="showLogoutConfirmation()"
                id="logoutButton">Keluar</button>
        </div>
    </div>
</div>
