
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
                        @foreach ($getKelas as $class)
                            <option value="{{ $class }}">{{ $class }}</option>
                        @endforeach
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
                <div class="students-grid" id="loadStudentsGrid">
                </div>

                <div class="pagination" id="studentsPagination"></div>
        </div>
    </section>