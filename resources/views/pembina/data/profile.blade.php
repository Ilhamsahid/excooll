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
