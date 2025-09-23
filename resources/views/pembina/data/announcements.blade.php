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
                <button class="btn btn-primary" onclick="addAnnouncement('announcementModal')">
                    📢 Buat Pengumuman
                </button>
            </div>
        </div>

        <div class="applications-grid" id="loadAnnouncements">

        </div>

        <div class="pagination" id="announcementsPagination"></div>
    </div>
</section>
