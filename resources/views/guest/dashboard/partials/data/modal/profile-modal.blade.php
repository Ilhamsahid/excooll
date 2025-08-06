<div id="profileModal" class="modal-profile">
    <div class="modal-profile-content">
        <div class="modal-profile-header">
            <h3 class="modal-title">Profil Pengguna</h3>
            <button class="close-btn" onclick="closeModal('profileModal')" aria-label="Tutup">&times;</button>
        </div>
        <div class="profile-tabs">
            <button class="profile-tab active" onclick="switchProfileTab('overview')">📊 Ringkasan</button>
            <button class="profile-tab" onclick="switchProfileTab('activities')">🎯 Kegiatan Saya</button>
            <button class="profile-tab" onclick="switchProfileTab('attendance')">📅 Kehadiran</button>
            <button class="profile-tab" onclick="switchProfileTab('notifications')">🔔 Notifikasi</button>
            <button class="profile-tab" onclick="switchProfileTab('settings')">⚙️ Pengaturan</button>
        </div>

        <!-- Overview Tab -->
        <x-profile.profile-detail />

        <!-- Activities Tab -->
        <x-profile.activities />

        <!-- Attendance Tab -->
        <x-profile.attendance />

        <!-- Notifications Tab -->
        <x-profile.notifications />

        <!-- Settings Tab -->
        <div class="profile-tab-content" id="settingsTab">
            <div class="settings-section">
                <div class="settings-title">🔔 Notifikasi</div>
                <div class="settings-item">
                    <div class="settings-item-info">
                        <div class="settings-item-title">Notifikasi Email</div>
                        <div class="settings-item-description">Terima pemberitahuan kegiatan via email</div>
                    </div>
                    <div class="toggle-switch active" onclick="toggleSetting(this)"></div>
                </div>
                <div class="settings-item">
                    <div class="settings-item-info">
                        <div class="settings-item-title">Notifikasi Push</div>
                        <div class="settings-item-description">Terima notifikasi langsung di browser</div>
                    </div>
                    <div class="toggle-switch active" onclick="toggleSetting(this)"></div>
                </div>
                <div class="settings-item">
                    <div class="settings-item-info">
                        <div class="settings-item-title">Pengingat Kehadiran</div>
                        <div class="settings-item-description">Ingatkan 30 menit sebelum kegiatan</div>
                    </div>
                    <div class="toggle-switch active" onclick="toggleSetting(this)"></div>
                </div>
            </div>

            <div class="settings-section">
                <div class="settings-title">🔒 Privasi</div>
                <div class="settings-item">
                    <div class="settings-item-info">
                        <div class="settings-item-title">Profil Publik</div>
                        <div class="settings-item-description">Izinkan siswa lain melihat profil Anda</div>
                    </div>
                    <div class="toggle-switch active" onclick="toggleSetting(this)"></div>
                </div>
                <div class="settings-item">
                    <div class="settings-item-info">
                        <div class="settings-item-title">Status Online</div>
                        <div class="settings-item-description">Tampilkan status online kepada anggota lain</div>
                    </div>
                    <div class="toggle-switch active" onclick="toggleSetting(this)"></div>
                </div>
            </div>

            <div class="settings-section">
                <div class="settings-title">🎨 Tampilan</div>
                <div class="settings-item">
                    <div class="settings-item-info">
                        <div class="settings-item-title">Mode Gelap</div>
                        <div class="settings-item-description">Gunakan tema gelap untuk mata yang lebih nyaman</div>
                    </div>
                    <div class="toggle-switch" id="darkModeToggle" onclick="toggleDarkModeFromSettings(this)"></div>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border);">
                <button class="btn btn-primary" style="margin-right: 1rem;" onclick="saveSettings()">💾 Simpan
                    Perubahan</button>
                <button class="btn btn-secondary" onclick="closeModal('profileModal')">❌ Batal</button>
            </div>
        </div>
    </div>
</div>
