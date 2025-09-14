<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ekstraku | Tidak Diizinkan</title>
    <link rel="stylesheet" href="{{ asset('styles/unauthorized.css') }}">
</head>

<body>

    <!-- Desktop Application Container -->
    <div class="app-container">
        <!-- Desktop Header -->
        <header class="desktop-header">
            <div class="desktop-header-content">
                <div class="header-brand">
                    <div>
                        <div class="header-logo">EkstraKu</div>
                        <div class="header-subtitle">
                            Sistem Manajemen Ekstrakurikuler
                        </div>
                    </div>
                </div>

                <nav class="header-nav">
                    <a href="#" class="nav-link" onclick="showHelp()">Bantuan</a>
                    <a href="#" class="nav-link" onclick="showPrivacy()">Privasi</a>
                    <a href="#" class="nav-link" onclick="contactSupport()">Support</a>
                </nav>

                <div class="header-actions">
                    <div class="status-indicator">
                        <span>🚫</span>
                        <span>Akses Terbatas</span>
                    </div>
                    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle Theme">
                        <span id="themeIconMobile">🌙</span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Desktop Main Content -->
        <main class="desktop-main">
            <!-- Desktop Content Area -->
            <div class="desktop-content">
                <div class="unauthorized-card">
                    <!-- Logo Section -->
                    <div class="logo-section">
                        <div class="logo">EkstraKu</div>
                        <div class="logo-subtitle">Sistem Manajemen Ekstrakurikuler</div>
                    </div>

                    <!-- Unauthorized Icon -->
                    <div class="unauthorized-icon">🚫</div>

                    <!-- Main Content -->
                    <h1 class="unauthorized-title">Akses Tidak Diizinkan</h1>
                    <h2 class="unauthorized-subtitle">403 - Forbidden Access</h2>

                    <p class="unauthorized-description">
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Area
                        yang Anda coba akses hanya tersedia untuk pengguna dengan hak
                        akses khusus seperti Administrator, Instruktur, atau Siswa
                        terdaftar.
                    </p>

                    <!-- Features Info -->
                    <div class="unauthorized-features">
                        <h3 class="features-title">🎯 Yang Dapat Anda Akses</h3>
                        <ul class="features-list">
                            <li class="feature-item">
                                <span class="feature-icon">🏠</span>
                                <div class="feature-text">
                                    <strong>Halaman Utama</strong>
                                    <span>Jelajahi informasi umum dan overview sistem
                                        EkstraKu</span>
                                </div>
                            </li>
                            <li class="feature-item">
                                <span class="feature-icon">🎯</span>
                                <div class="feature-text">
                                    <strong>Daftar Kegiatan</strong>
                                    <span>Lihat semua kegiatan ekstrakurikuler yang tersedia</span>
                                </div>
                            </li>
                            <li class="feature-item">
                                <span class="feature-icon">📢</span>
                                <div class="feature-text">
                                    <strong>Pengumuman Publik</strong>
                                    <span>Baca pengumuman dan informasi terbaru untuk umum</span>
                                </div>
                            </li>
                            <li class="feature-item">
                                <span class="feature-icon">👤</span>
                                <div class="feature-text">
                                    <strong>Registrasi Akun</strong>
                                    <span>Daftarkan diri sebagai siswa untuk mengakses lebih banyak
                                        fitur</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Security Info -->
                    <div class="security-info">
                        <h4 class="security-info-title">
                            <span>🛡️</span>
                            Keamanan & Privasi
                        </h4>
                        <p class="security-info-text">
                            Akses ini dibatasi untuk melindungi data privasi siswa dan
                            informasi administratif sekolah. Jika Anda merasa ini adalah
                            kesalahan atau memerlukan akses khusus, silakan hubungi
                            administrator sistem.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <div class="actions-row">
                            <a href="{{ route('dashboard.' . $role, 'dashboard') }}" class="btn btn-primary btn-lg" >
                                <span>🏠</span>
                                <span>Kembali ke Beranda</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Desktop Footer -->
    </div>

    <header class="desktop-header" id="mobilenav">
        <div class="desktop-header-left slide-in-left">
            <div class="desktop-logo text-gradient-primary">EkstraKu</div>
        </div>
        <div class="desktop-header-right slide-in-right">
            <div class="desktop-status">
                <div class="status-dot"></div>
                <span>Akses Ditolak</span>
            </div>
            <button class="theme-toggle" onclick="toggleTheme()" aria-label="Toggle Theme">
                <span id="themeIcon">🌙</span>
            </button>
        </div>
    </header>
    <!-- Mobile Layout (shown only on mobile/tablet) -->
    <div class="unauthorized-layout">
        <div class="unauthorized-card">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo">EkstraKu</div>
                <div class="logo-subtitle">Sistem Manajemen Ekstrakurikuler</div>
            </div>

            <!-- Unauthorized Icon -->
            <div class="unauthorized-icon">🚫</div>

            <!-- Main Content -->
            <h1 class="unauthorized-title">Akses Tidak Diizinkan</h1>
            <h2 class="unauthorized-subtitle">403 - Forbidden Access</h2>

            <p class="unauthorized-description">
                Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Area yang
                Anda coba akses hanya tersedia untuk pengguna dengan hak akses khusus
                seperti Administrator, Instruktur, atau Siswa terdaftar.
            </p>

            <!-- Features Info -->
            <div class="unauthorized-features">
                <h3 class="features-title">🎯 Yang Dapat Anda Akses</h3>
                <ul class="features-list">
                    <li class="feature-item">
                        <span class="feature-icon">🏠</span>
                        <div class="feature-text">
                            <strong>Halaman Utama</strong>
                            <span>Jelajahi informasi umum dan overview sistem EkstraKu</span>
                        </div>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon">🎯</span>
                        <div class="feature-text">
                            <strong>Daftar Kegiatan</strong>
                            <span>Lihat semua kegiatan ekstrakurikuler yang tersedia</span>
                        </div>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon">📢</span>
                        <div class="feature-text">
                            <strong>Pengumuman Publik</strong>
                            <span>Baca pengumuman dan informasi terbaru untuk umum</span>
                        </div>
                    </li>
                    <li class="feature-item">
                        <span class="feature-icon">👤</span>
                        <div class="feature-text">
                            <strong>Registrasi Akun</strong>
                            <span>Daftarkan diri sebagai siswa untuk mengakses lebih banyak
                                fitur</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Security Info -->
            <div class="security-info">
                <h4 class="security-info-title">
                    <span>🛡️</span>
                    Keamanan & Privasi
                </h4>
                <p class="security-info-text">
                    Akses ini dibatasi untuk melindungi data privasi siswa dan informasi
                    administratif sekolah. Jika Anda merasa ini adalah kesalahan atau
                    memerlukan akses khusus, silakan hubungi administrator sistem.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <div class="actions-row">
                    <a href="{{ route('dashboard.' . $role, 'dashboard') }}" class="btn btn-primary btn-lg">
                        <span>🏠</span>
                        <span>Kembali ke Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="desktop-footer">
        <div class="footer-content">
            <div class="footer-links">
                <a href="#" class="footer-link" onclick="showHelp()">Bantuan</a>
                <a href="#" class="footer-link" onclick="showPrivacy()">Kebijakan Privasi</a>
                <a href="#" class="footer-link" onclick="showTerms()">Syarat Layanan</a>
                <a href="#" class="footer-link" onclick="contactSupport()">Dukungan Teknis</a>
            </div>
            <div>
                <span>&copy; 2025 EkstraKu. Semua hak dilindungi.</span>
            </div>
        </div>
    </footer>

    <!-- Notification Container -->
    <div id="notificationContainer" class="notification-container"></div>

    <script src="{{ asset('scripts/unauthorized.js') }}"></script>
</body>

</html>
