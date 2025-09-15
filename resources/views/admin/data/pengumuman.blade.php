<section id="announcements" class="content-section">
    <div class="card card-elevated hover-lift">
        <div class="card-header">
            <div>
                <h3 class="card-title text-gradient-primary">
                    Manajemen Pengumuman
                </h3>
                <p class="card-subtitle">Kelola pengumuman dan informasi</p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm hover-scale" onclick="exportAnnouncements()">
                    <span>📊</span>
                    <span>Export</span>
                </button>
                <button class="btn btn-primary hover-lift" onclick="addAnnouncementModal('addAnnouncementModal')">
                    <span>➕</span>
                    <span>Buat Pengumuman</span>
                </button>
            </div>
        </div>

        <div class="filters-section">
            <div class="filter-group">
                <label class="form-label">Kategori</label>
                <select class="form-select" id="categoryFilter" onchange="filterAnnouncements()">
                    <option value="">Semua Kategori</option>
                    <option value="olahraga">Olahraga</option>
                    <option value="seni">Seni & Budaya</option>
                    <option value="akademik">Akademik</option>
                    <option value="teknologi">Teknologi</option>
                    <option value="sosial">Sosial</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="form-label">Kegiatan</label>
                <select class="form-select" id="ekskulFilter" onchange="filterAnnouncements()">
                    <option value="">Semua Ekstra</option>
                    @foreach ($ekstra as $eks)
                        <option value="{{ $eks->nama }}">{{ $eks->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group search">
                <label class="form-label">Pencarian</label>
                <input type="text" class="form-input" placeholder="Cari judul pengumuman..." id="announcementSearchInput"
                    oninput="filterAnnouncements()" />
            </div>
        </div>

        <div class="announcements-grid" id="announcementsGrid"></div>

        <div class="pagination" id="announcementsPagination"></div>
    </div>
</section>
