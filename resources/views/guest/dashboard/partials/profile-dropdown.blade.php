<div class="user-profile" id="profileNav">
    <button class="theme-toggle" onclick="toggleTheme()" aria-label="Ganti tema">🌙</button>
    <div class="profile-trigger" onclick="toggleProfileDropdown()">
        <div class="user-avatar" id="userAvatar">
            <div class="online-indicator"></div>
        </div>
        <div class="user-info">
            <div class="user-name" id="userName"></div>
            <div class="user-role" id="userRole"></div>
        </div>
        <div class="notification-badge" id="notificationBadge">3</div>
    </div>
    <div class="profile-dropdown" id="profileDropdown">
        <div class="profile-dropdown-header">
            <div class="profile-dropdown-avatar" id="dropdownAvatar"></div>
            <div class="profile-dropdown-name" id="dropdownName"></div>
            <div class="profile-dropdown-email" id="dropdownEmail"></div>
            <div class="profile-dropdown-role" id="dropdownRole">siswa</div>
        </div>
        <div class="profile-dropdown-menu">
            <button class="profile-dropdown-item" onclick="openProfileModal()">
                👤 Lihat Profil Lengkap
            </button>
            <button class="profile-dropdown-item" onclick="openNotificationsModal()">
                🔔 Notifikasi <span
                    style="margin-left: auto; background: var(--error); color: white; border-radius: 50%; width: 1.25rem; height: 1.25rem; display: flex; align-items: center; justify-content: center; font-size: 0.75rem;">3</span>
            </button>
            <button class="profile-dropdown-item">
                📊 Kehadiran Saya
            </button>
            <button class="profile-dropdown-item">
                🏆 Kegiatan saya
            </button>
            <div class="profile-dropdown-divider"></div>
            <button class="profile-dropdown-item">
                ⚙️ Pengaturan
            </button>
            <button class="profile-dropdown-item danger" onclick="showLogoutConfirmation()">
                🚪 Keluar
            </button>
        </div>
    </div>
</div>
