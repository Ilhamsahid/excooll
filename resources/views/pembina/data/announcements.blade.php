<section id="announcements" class="content-section">
    <div class="card card-elevated">
        <div class="card-header">
            <div>
                <h3 class="card-title">Announcements - Klub Basket</h3>
                <p class="card-subtitle">
                    Buat dan kelola pengumuman untuk siswa klub basket
                </p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm" onclick="exportAnnouncements()">
                    📊 Export
                </button>
                <button class="btn btn-primary" onclick="openModal('announcementModal')">
                    📢 Buat Pengumuman
                </button>
            </div>
        </div>

        <div class="applications-grid">
            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Persiapan Turnamen Basket Regional
                        </h4>
                        <div class="application-meta">
                            <span>📅 14 Maret 2025</span>
                            <span>🏀 Klub Basket</span>
                            <span>👁️ 85 views</span>
                            <span>⚡ Prioritas Tinggi</span>
                        </div>
                    </div>
                    <span class="badge badge-success">📢 PUBLISHED</span>
                </div>
                <div class="application-content">
                    <p>
                        Latihan tambahan untuk persiapan turnamen basket regional
                        akan diadakan setiap hari Sabtu mulai tanggal 16 Maret.
                        Semua anggota tim inti wajib hadir tepat waktu di lapangan
                        basket pada pukul 07:00.
                    </p>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('turnamen_prep')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewAnnouncementStats('turnamen_prep')">
                        📊 Statistik
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="shareAnnouncement('turnamen_prep')">
                        🔗 Bagikan
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Dress Code untuk Turnamen
                        </h4>
                        <div class="application-meta">
                            <span>📅 13 Maret 2025</span>
                            <span>🏀 Klub Basket</span>
                            <span>👁️ 78 views</span>
                            <span>📌 Prioritas Normal</span>
                        </div>
                    </div>
                    <span class="badge badge-success">📢 PUBLISHED</span>
                </div>
                <div class="application-content">
                    <p>
                        Untuk turnamen mendatang, semua anggota tim wajib
                        menggunakan jersey resmi tim dan sepatu basket putih.
                        Mohon persiapkan kelengkapan sebelum hari H.
                    </p>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('dress_code')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewAnnouncementStats('dress_code')">
                        📊 Statistik
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="shareAnnouncement('dress_code')">
                        🔗 Bagikan
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Training Schedule Update
                        </h4>
                        <div class="application-meta">
                            <span>📅 12 Maret 2025</span>
                            <span>🏀 Klub Basket</span>
                            <span>👁️ 92 views</span>
                            <span>🚨 Prioritas Urgent</span>
                        </div>
                    </div>
                    <span class="badge badge-success">📢 PUBLISHED</span>
                </div>
                <div class="application-content">
                    <p>
                        Update jadwal latihan: mulai minggu depan latihan akan
                        dimulai pukul 15:30 (30 menit lebih awal). Mohon semua
                        anggota mengatur waktu dengan baik.
                    </p>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('schedule_update')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewAnnouncementStats('schedule_update')">
                        📊 Statistik
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="shareAnnouncement('schedule_update')">
                        🔗 Bagikan
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Recruitment Anggota Baru
                        </h4>
                        <div class="application-meta">
                            <span>📅 11 Maret 2025</span>
                            <span>🏀 Klub Basket</span>
                            <span>👁️ 156 views</span>
                            <span>📌 Prioritas Normal</span>
                        </div>
                    </div>
                    <span class="badge badge-success">📢 PUBLISHED</span>
                </div>
                <div class="application-content">
                    <p>
                        Buka pendaftaran anggota baru untuk klub basket semester
                        genap. Khusus untuk siswa kelas X dan XI yang memiliki
                        tinggi minimal 165 cm dan pengalaman bermain basket.
                    </p>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('recruitment')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewAnnouncementStats('recruitment')">
                        📊 Statistik
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="shareAnnouncement('recruitment')">
                        🔗 Bagikan
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Evaluasi Semester Ganjil
                        </h4>
                        <div class="application-meta">
                            <span>📅 10 Maret 2025</span>
                            <span>🏀 Klub Basket</span>
                            <span>👁️ 67 views</span>
                            <span>📌 Prioritas Normal</span>
                        </div>
                    </div>
                    <span class="badge badge-gray">📝 DRAFT</span>
                </div>
                <div class="application-content">
                    <p>
                        Evaluasi performa klub basket semester ganjil telah
                        selesai. Secara keseluruhan klub menunjukkan progress yang
                        baik dengan tingkat kehadiran 94% dan 7 prestasi yang
                        diraih.
                    </p>
                </div>
                <div class="application-actions">
                    <button class="btn btn-success btn-sm" onclick="publishAnnouncement('evaluasi_semester')">
                        📢 Publikasi
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('evaluasi_semester')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="deleteAnnouncement('evaluasi_semester')">
                        🗑️ Hapus
                    </button>
                </div>
            </div>

            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            Basketball Equipment Check
                        </h4>
                        <div class="application-meta">
                            <span>📅 09 Maret 2025</span>
                            <span>🏀 Klub Basket</span>
                            <span>👁️ 45 views</span>
                            <span>📌 Prioritas Normal</span>
                        </div>
                    </div>
                    <span class="badge badge-success">📢 PUBLISHED</span>
                </div>
                <div class="application-content">
                    <p>
                        Pengecekan kelengkapan peralatan basket akan dilakukan
                        setiap awal bulan. Pastikan semua anggota membawa sepatu
                        basket yang layak dan dalam kondisi baik.
                    </p>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement('equipment_check')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewAnnouncementStats('equipment_check')">
                        📊 Statistik
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="shareAnnouncement('equipment_check')">
                        🔗 Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
