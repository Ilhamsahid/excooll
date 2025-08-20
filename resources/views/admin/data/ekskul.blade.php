<section id="activities" class="content-section">
    <div class="card card-elevated hover-lift">
        <div class="card-header">
            <div>
                <h3 class="card-title text-gradient-primary">
                    Manajemen Kegiatan
                </h3>
                <p class="card-subtitle">
                    Kelola semua kegiatan ekstrakurikuler
                </p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm hover-scale" onclick="exportActivities()">
                    <span>📊</span>
                    <span>Export</span>
                </button>
                <button class="btn btn-primary hover-lift" onclick="addActivityModal('addActivityModal')">
                    <span>➕</span>
                    <span>Tambah Kegiatan</span>
                </button>
            </div>
        </div>

        <div class="filters-section">
            <div class="filter-group">
                <label class="form-label">Kategori</label>
                <select class="form-select" id="activityCategoryFilter" onchange="filterActivities()">
                    <option value="">Semua Kategori</option>
                    <option value="olahraga">Olahraga</option>
                    <option value="seni">Seni & Budaya</option>
                    <option value="akademik">Akademik</option>
                    <option value="teknologi">Teknologi</option>
                    <option value="sosial">Sosial</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="form-label">Status</label>
                <select class="form-select" id="activityStatusFilter" onchange="filterActivities()">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-aktif</option>
                    <option value="penuh">Penuh</option>
                </select>
            </div>
            <div class="filter-group search">
                <label class="form-label">Pencarian</label>
                <input type="text" class="form-input" placeholder="Cari kegiatan..." id="activitySearchInput"
                    oninput="filterActivities()" />
            </div>
        </div>

        <div class="table-container">
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kegiatan</th>
                            <th>Kategori</th>
                            <th>Pembina</th>
                            <th>Anggota</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="activitiesTableBody"></tbody>
                </table>
            </div>
        </div>

        <div class="pagination" id="activitiesPagination"></div>
    </div>
</section>
