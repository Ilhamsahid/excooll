<section id="applications" class="content-section">
    <div class="card card-elevated">
        <div class="card-header">
            <div>
                <h3 class="card-title">Aplikasi Siswa</h3>
                <p class="card-subtitle">
                    Review dan kelola aplikasi pendaftaran ekstrakurikuler
                </p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm" onclick="exportApplications()">
                    📊 Export
                </button>
                <button class="btn btn-success" onclick="approveAllPending()">
                    ✅ Setujui Semua Pending
                </button>
            </div>
        </div>

        <!-- Application Summary Stats -->
        <div class="stats-grid"
            style="
                  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                  gap: var(--space-4);
                  margin-bottom: var(--space-6);
                ">
            <div class="stat-card" style="padding: var(--space-4)">
                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                    47
                </div>
                <div class="stat-label">Total Aplikasi</div>
            </div>
            <div class="stat-card warning" style="padding: var(--space-4)">
                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                    15
                </div>
                <div class="stat-label">Pending Review</div>
            </div>
            <div class="stat-card success" style="padding: var(--space-4)">
                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                    28
                </div>
                <div class="stat-label">Disetujui</div>
            </div>
            <div class="stat-card error" style="padding: var(--space-4)">
                <div class="stat-number" style="font-size: var(--font-size-2xl)">
                    4
                </div>
                <div class="stat-label">Ditolak</div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div
            style="
                  display: flex;
                  gap: var(--space-2);
                  margin-bottom: var(--space-6);
                  flex-wrap: wrap;
                ">
            <button class="btn btn-ghost active" id="appAll" onclick="filterApplications('all')">
                Semua (47)
            </button>
            <button class="btn btn-ghost" id="appPending" onclick="filterApplications('pending')">
                Pending (15)
            </button>
            <button class="btn btn-ghost" id="appApproved" onclick="filterApplications('approved')">
                Disetujui (28)
            </button>
            <button class="btn btn-ghost" id="appRejected" onclick="filterApplications('rejected')">
                Ditolak (4)
            </button>
        </div>

        <div class="applications-grid" id="applicationsGrid">
            <!-- Pending Applications -->
            <div class="application-card pending">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">Ahmad Rizki Pratama</h4>
                        <div class="application-meta">
                            <span>📧 ahmad.rizki@student.school.id</span>
                            <span>🎓 Kelas XI IPA 2</span>
                            <span>🏀 Klub Basket</span>
                            <span>📅 13 Maret 2025</span>
                        </div>
                    </div>
                    <span class="badge badge-warning">⏳ PENDING</span>
                </div>
                <div class="application-content">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Alasan bergabung:</strong><br />
                        Saya sangat menyukai olahraga basket sejak SMP. Saya ingin
                        mengembangkan skill bermain basket dan belajar tentang
                        kerjasama tim. Saya juga ingin berkontribusi untuk membawa
                        prestasi bagi sekolah.
                    </div>
                    <div>
                        <strong>Pengalaman sebelumnya:</strong><br />
                        Pernah bermain di tim basket SMP selama 2 tahun, posisi
                        Point Guard. Juara 2 tournament basket antar SMP tingkat
                        kota.
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-success btn-sm" onclick="approveApplication('ahmad_rizki')">
                        ✅ Setujui
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="rejectApplication('ahmad_rizki')">
                        ❌ Tolak
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('ahmad_rizki')">
                        💬 Kontak
                    </button>
                </div>
            </div>

            <div class="application-card pending">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">Sari Indah Sari</h4>
                        <div class="application-meta">
                            <span>📧 sari.indah@student.school.id</span>
                            <span>🎓 Kelas X IPS 1</span>
                            <span>🎭 Drama Club</span>
                            <span>📅 12 Maret 2025</span>
                        </div>
                    </div>
                    <span class="badge badge-warning">⏳ PENDING</span>
                </div>
                <div class="application-content">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Alasan bergabung:</strong><br />
                        Saya tertarik dengan dunia akting dan ingin mengembangkan
                        kemampuan public speaking. Drama club akan membantu saya
                        lebih percaya diri tampil di depan umum.
                    </div>
                    <div>
                        <strong>Pengalaman sebelumnya:</strong><br />
                        Pernah ikut drama sekolah di SMP sebagai pemeran utama.
                        Suka menonton teater dan film.
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-success btn-sm" onclick="approveApplication('sari_indah')">
                        ✅ Setujui
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="rejectApplication('sari_indah')">
                        ❌ Tolak
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('sari_indah')">
                        💬 Kontak
                    </button>
                </div>
            </div>

            <!-- Approved Applications -->
            <div class="application-card approved">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">Budi Santoso</h4>
                        <div class="application-meta">
                            <span>📧 budi.santoso@student.school.id</span>
                            <span>🎓 Kelas XII IPA 3</span>
                            <span>🤖 Klub Robotik</span>
                            <span>📅 10 Maret 2025</span>
                        </div>
                    </div>
                    <span class="badge badge-success">✅ DISETUJUI</span>
                </div>
                <div class="application-content">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Alasan bergabung:</strong><br />
                        Sangat tertarik dengan teknologi robotik dan AI. Ingin
                        mengembangkan skill programming dan engineering untuk
                        persiapan kuliah teknik.
                    </div>
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Pengalaman sebelumnya:</strong><br />
                        Sudah belajar programming Python dan C++. Pernah membuat
                        robot sederhana menggunakan Arduino.
                    </div>
                    <div
                        style="
                        font-size: var(--font-size-xs);
                        color: var(--text-tertiary);
                      ">
                        <strong>Disetujui oleh:</strong> Ahmad Surya •
                        <strong>Tanggal:</strong> 11 Maret 2025
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="viewStudentProfile('budi_santoso')">
                        👤 Profil
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewStudentActivity('budi_santoso')">
                        📊 Aktivitas
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('budi_santoso')">
                        💬 Kontak
                    </button>
                </div>
            </div>

            <div class="application-card pending">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">Maya Sari Dewi</h4>
                        <div class="application-meta">
                            <span>📧 maya.sari@student.school.id</span>
                            <span>🎓 Kelas XI IPS 2</span>
                            <span>🇬🇧 English Club</span>
                            <span>📅 11 Maret 2025</span>
                        </div>
                    </div>
                    <span class="badge badge-warning">⏳ PENDING</span>
                </div>
                <div class="application-content">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Alasan bergabung:</strong><br />
                        Ingin meningkatkan kemampuan bahasa Inggris untuk
                        persiapan TOEFL dan kuliah luar negeri. Tertarik dengan
                        program debate dan public speaking.
                    </div>
                    <div>
                        <strong>Pengalaman sebelumnya:</strong><br />
                        TOEFL score 485, sering menonton film berbahasa Inggris,
                        pernah ikut English speech contest tingkat sekolah.
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-success btn-sm" onclick="approveApplication('maya_sari')">
                        ✅ Setujui
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="rejectApplication('maya_sari')">
                        ❌ Tolak
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('maya_sari')">
                        💬 Kontak
                    </button>
                </div>
            </div>

            <div class="application-card pending">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">Andi Pratama</h4>
                        <div class="application-meta">
                            <span>📧 andi.pratama@student.school.id</span>
                            <span>🎓 Kelas XII IPA 1</span>
                            <span>📸 Fotografi Club</span>
                            <span>📅 09 Maret 2025</span>
                        </div>
                    </div>
                    <span class="badge badge-warning">⏳ PENDING</span>
                </div>
                <div class="application-content">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Alasan bergabung:</strong><br />
                        Hobi fotografi sejak kecil, ingin belajar teknik fotografi
                        yang lebih advanced dan bergabung dalam dokumentasi acara
                        sekolah.
                    </div>
                    <div>
                        <strong>Pengalaman sebelumnya:</strong><br />
                        Memiliki kamera DSLR Canon 80D, sering foto landscape dan
                        street photography, pernah menang lomba foto tingkat kota.
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-success btn-sm" onclick="approveApplication('andi_pratama')">
                        ✅ Setujui
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="rejectApplication('andi_pratama')">
                        ❌ Tolak
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('andi_pratama')">
                        💬 Kontak
                    </button>
                </div>
            </div>

            <!-- Rejected Application -->
            <div class="application-card rejected">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">Rina Wati</h4>
                        <div class="application-meta">
                            <span>📧 rina.wati@student.school.id</span>
                            <span>🎓 Kelas X IPA 3</span>
                            <span>⛺ Pramuka</span>
                            <span>📅 08 Maret 2025</span>
                        </div>
                    </div>
                    <span class="badge badge-danger">❌ DITOLAK</span>
                </div>
                <div class="application-content">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Alasan bergabung:</strong><br />
                        Ingin belajar tentang kepemimpinan dan kegiatan alam
                        terbuka melalui pramuka.
                    </div>
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Pengalaman sebelumnya:</strong><br />
                        Belum pernah ikut pramuka sebelumnya, tapi tertarik dengan
                        kegiatan outdoor.
                    </div>
                    <div
                        style="
                        font-size: var(--font-size-xs);
                        color: var(--error-600);
                      ">
                        <strong>Alasan ditolak:</strong> Kuota sudah penuh untuk
                        tahun ini • <strong>Tanggal:</strong> 09 Maret 2025
                    </div>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="reconsiderApplication('rina_wati')">
                        🔄 Pertimbangkan Ulang
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('rina_wati')">
                        💬 Kontak
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
