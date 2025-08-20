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

        <div class="announcements-grid" id="announcementsGrid"></div>

        <div class="pagination" id="announcementsPagination"></div>
    </div>
</section>
