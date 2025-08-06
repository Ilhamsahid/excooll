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
            <button class="btn btn-secondary" onclick="openModal('loginModal'); closeMobileMenu()">Masuk</button>
            <button class="btn btn-primary" onclick="openModal('registerModal'); closeMobileMenu()">Daftar</button>
        </div>
    </div>
</div>
