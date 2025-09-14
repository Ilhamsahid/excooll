
    <section id="students" class="content-section">
        <div class="card card-elevated">
            <div class="card-header">
                <div>
                    <h3 class="card-title">Students - Klub Basket</h3>
                    <p class="card-subtitle">
                        Kelola dan pantau siswa anggota klub basket
                    </p>
                </div>
                <div class="card-actions">
                    <button class="btn btn-secondary btn-sm" onclick="exportStudents()">
                        📊 Export Data
                    </button>
                    <button class="btn btn-primary" onclick="openModal('addStudentModal')">
                        ➕ Tambah Siswa
                    </button>
                </div>
            </div>

            <!-- Student Summary Stats -->
            <div class="stats-grid"
                style="
                  grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                  gap: var(--space-4);
                  margin-bottom: var(--space-8);
                ">
                <div class="stat-card" style="padding: var(--space-4)">
                    <div class="stat-icon"
                        style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                        👥
                    </div>
                    <div class="stat-number" style="font-size: var(--font-size-2xl)">
                        85
                    </div>
                    <div class="stat-label">Total Anggota</div>
                </div>
                <div class="stat-card success" style="padding: var(--space-4)">
                    <div class="stat-icon"
                        style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                        🏀
                    </div>
                    <div class="stat-number" style="font-size: var(--font-size-2xl)">
                        12
                    </div>
                    <div class="stat-label">Tim Inti</div>
                </div>
                <div class="stat-card warning" style="padding: var(--space-4)">
                    <div class="stat-icon"
                        style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                        📈
                    </div>
                    <div class="stat-number" style="font-size: var(--font-size-2xl)">
                        94.2%
                    </div>
                    <div class="stat-label">Avg. Kehadiran</div>
                </div>
                <div class="stat-card secondary" style="padding: var(--space-4)">
                    <div class="stat-icon"
                        style="
                      width: 48px;
                      height: 48px;
                      font-size: var(--font-size-lg);
                    ">
                        🆕
                    </div>
                    <div class="stat-number" style="font-size: var(--font-size-2xl)">
                        15
                    </div>
                    <div class="stat-label">Anggota Baru</div>
                </div>
            </div>

            <!-- Filter Section -->
            <div
                style="
                  display: flex;
                  gap: var(--space-4);
                  margin-bottom: var(--space-6);
                  flex-wrap: wrap;
                  align-items: end;
                ">
                <div style="min-width: 200px">
                    <label class="form-label">Filter Kelas</label>
                    <select class="form-select" id="studentClassFilter" onchange="filterStudents()">
                        <option value="">Semua Kelas</option>
                        <option value="X">Kelas X</option>
                        <option value="XI">Kelas XI</option>
                        <option value="XII">Kelas XII</option>
                    </select>
                </div>
                <div style="min-width: 200px">
                    <label class="form-label">Status Anggota</label>
                    <select class="form-select" id="studentStatusFilter" onchange="filterStudents()">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                        <option value="core">Tim Inti</option>
                    </select>
                </div>
                <div style="flex: 1; min-width: 300px">
                    <label class="form-label">Cari Siswa</label>
                    <input type="text" class="form-input" placeholder="Cari nama siswa atau NISN..."
                        id="studentSearchInput" oninput="filterStudents()" />
                </div>
            </div>

            <!-- Students Grid -->
            <div class="students-grid" id="studentsGrid">
                <div class="student-card">
                    <div class="student-header">
                        <div class="student-avatar">AR</div>
                        <div class="student-info">
                            <div class="student-name">Ahmad Rizki Pratama</div>
                            <div class="student-meta">
                                <span>📚 XI IPA 2</span>
                                <span>🆔 0012345678</span>
                                <span class="badge badge-success">Tim Inti</span>
                            </div>
                        </div>
                    </div>
                    <div class="student-stats">
                        <div class="student-stat">
                            <div class="student-stat-number">96%</div>
                            <div class="student-stat-label">Kehadiran</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">4.2</div>
                            <div class="student-stat-label">Rating</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">PG</div>
                            <div class="student-stat-label">Posisi</div>
                        </div>
                    </div>
                    <div
                        style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                        📧 ahmad.rizki@student.school.id<br />
                        📞 +62 812-1234-5678<br />
                        📍 Jakarta Selatan
                    </div>
                    <div class="student-actions">
                        <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('ahmad_rizki')">
                            👁️ Detail
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="editStudent('ahmad_rizki')">
                            ✏️ Edit
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="contactStudent('ahmad_rizki')">
                            💬 Kontak
                        </button>
                    </div>
                </div>

                <div class="student-card">
                    <div class="student-header">
                        <div class="student-avatar">BS</div>
                        <div class="student-info">
                            <div class="student-name">Budi Santoso</div>
                            <div class="student-meta">
                                <span>📚 XII IPA 3</span>
                                <span>🆔 0012345679</span>
                                <span class="badge badge-success">Tim Inti</span>
                            </div>
                        </div>
                    </div>
                    <div class="student-stats">
                        <div class="student-stat">
                            <div class="student-stat-number">92%</div>
                            <div class="student-stat-label">Kehadiran</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">4.5</div>
                            <div class="student-stat-label">Rating</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">C</div>
                            <div class="student-stat-label">Posisi</div>
                        </div>
                    </div>
                    <div
                        style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                        📧 budi.santoso@student.school.id<br />
                        📞 +62 813-2345-6789<br />
                        📍 Jakarta Timur
                    </div>
                    <div class="student-actions">
                        <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('budi_santoso')">
                            👁️ Detail
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="editStudent('budi_santoso')">
                            ✏️ Edit
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="contactStudent('budi_santoso')">
                            💬 Kontak
                        </button>
                    </div>
                </div>

                <div class="student-card">
                    <div class="student-header">
                        <div class="student-avatar">AP</div>
                        <div class="student-info">
                            <div class="student-name">Andi Pratama</div>
                            <div class="student-meta">
                                <span>📚 XII IPA 1</span>
                                <span>🆔 0012345680</span>
                                <span class="badge badge-warning">Reserve</span>
                            </div>
                        </div>
                    </div>
                    <div class="student-stats">
                        <div class="student-stat">
                            <div class="student-stat-number">88%</div>
                            <div class="student-stat-label">Kehadiran</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">3.8</div>
                            <div class="student-stat-label">Rating</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">SF</div>
                            <div class="student-stat-label">Posisi</div>
                        </div>
                    </div>
                    <div
                        style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                        📧 andi.pratama@student.school.id<br />
                        📞 +62 814-3456-7890<br />
                        📍 Jakarta Barat
                    </div>
                    <div class="student-actions">
                        <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('andi_pratama')">
                            👁️ Detail
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="editStudent('andi_pratama')">
                            ✏️ Edit
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="contactStudent('andi_pratama')">
                            💬 Kontak
                        </button>
                    </div>
                </div>

                <div class="student-card">
                    <div class="student-header">
                        <div class="student-avatar">DS</div>
                        <div class="student-info">
                            <div class="student-name">Dino Saputra</div>
                            <div class="student-meta">
                                <span>📚 XI IPA 1</span>
                                <span>🆔 0012345681</span>
                                <span class="badge badge-success">Tim Inti</span>
                            </div>
                        </div>
                    </div>
                    <div class="student-stats">
                        <div class="student-stat">
                            <div class="student-stat-number">98%</div>
                            <div class="student-stat-label">Kehadiran</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">4.7</div>
                            <div class="student-stat-label">Rating</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">PF</div>
                            <div class="student-stat-label">Posisi</div>
                        </div>
                    </div>
                    <div
                        style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                        📧 dino.saputra@student.school.id<br />
                        📞 +62 815-4567-8901<br />
                        📍 Jakarta Pusat
                    </div>
                    <div class="student-actions">
                        <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('dino_saputra')">
                            👁️ Detail
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="editStudent('dino_saputra')">
                            ✏️ Edit
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="contactStudent('dino_saputra')">
                            💬 Kontak
                        </button>
                    </div>
                </div>

                <div class="student-card">
                    <div class="student-header">
                        <div class="student-avatar">EW</div>
                        <div class="student-info">
                            <div class="student-name">Eko Wijaya</div>
                            <div class="student-meta">
                                <span>📚 X IPA 2</span>
                                <span>🆔 0012345682</span>
                                <span class="badge badge-primary">Anggota Baru</span>
                            </div>
                        </div>
                    </div>
                    <div class="student-stats">
                        <div class="student-stat">
                            <div class="student-stat-number">85%</div>
                            <div class="student-stat-label">Kehadiran</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">3.5</div>
                            <div class="student-stat-label">Rating</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">SG</div>
                            <div class="student-stat-label">Posisi</div>
                        </div>
                    </div>
                    <div
                        style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                        📧 eko.wijaya@student.school.id<br />
                        📞 +62 816-5678-9012<br />
                        📍 Jakarta Selatan
                    </div>
                    <div class="student-actions">
                        <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('eko_wijaya')">
                            👁️ Detail
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="editStudent('eko_wijaya')">
                            ✏️ Edit
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="contactStudent('eko_wijaya')">
                            💬 Kontak
                        </button>
                    </div>
                </div>

                <div class="student-card">
                    <div class="student-header">
                        <div class="student-avatar">FA</div>
                        <div class="student-info">
                            <div class="student-name">Farid Ahmad</div>
                            <div class="student-meta">
                                <span>📚 XI IPS 1</span>
                                <span>🆔 0012345683</span>
                                <span class="badge badge-warning">Reserve</span>
                            </div>
                        </div>
                    </div>
                    <div class="student-stats">
                        <div class="student-stat">
                            <div class="student-stat-number">90%</div>
                            <div class="student-stat-label">Kehadiran</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">4.0</div>
                            <div class="student-stat-label">Rating</div>
                        </div>
                        <div class="student-stat">
                            <div class="student-stat-number">PG</div>
                            <div class="student-stat-label">Posisi</div>
                        </div>
                    </div>
                    <div
                        style="
                      margin: var(--space-4) 0;
                      font-size: var(--font-size-sm);
                      color: var(--text-secondary);
                    ">
                        📧 farid.ahmad@student.school.id<br />
                        📞 +62 817-6789-0123<br />
                        📍 Jakarta Utara
                    </div>
                    <div class="student-actions">
                        <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('farid_ahmad')">
                            👁️ Detail
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="editStudent('farid_ahmad')">
                            ✏️ Edit
                        </button>
                        <button class="btn btn-ghost btn-sm" onclick="contactStudent('farid_ahmad')">
                            💬 Kontak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>