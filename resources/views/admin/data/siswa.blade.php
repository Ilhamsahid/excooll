<section id="students" class="content-section">
    <div class="card card-elevated hover-lift">
        <div class="card-header">
            <div>
                <h3 class="card-title text-gradient-primary">
                    Manajemen Siswa
                </h3>
                <p class="card-subtitle">Kelola data siswa dan partisipasi</p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm hover-scale" onclick="exportStudents()">
                    <span>📊</span>
                    <span>Export</span>
                </button>
                <button class="btn btn-primary hover-lift" onclick="openModal('addStudentModal')">
                    <span>➕</span>
                    <span>Tambah Siswa</span>
                </button>
            </div>
        </div>

        <div class="filters-section">
            <div class="filter-group">
                <label class="form-label">Kelas</label>
                <select class="form-select" id="studentGradeFilter" onchange="filterStudents()">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k }}">{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label class="form-label">Kegiatan</label>
                <select class="form-select" id="studentActivityFilter" onchange="filterStudents()">
                    <option value="">Semua Ekstra</option>
                    @foreach ($ekstra as $eks)
                        <option value="{{ $eks->nama }}">{{ $eks->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group search">
                <label class="form-label">Pencarian</label>
                <input type="text" class="form-input" placeholder="Cari siswa..." id="studentSearchInput"
                    oninput="filterStudents()" />
            </div>
        </div>

        <div class="table-container">
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelas</th>
                            <th>Kegiatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="studentsTableBody"></tbody>
                </table>
            </div>
        </div>

        <div class="pagination" id="studentsPagination"></div>
    </div>
</section>