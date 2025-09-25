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
                <div class="stat-number" id="statusAll" style="font-size: var(--font-size-2xl)">
                    47
                </div>
                <div class="stat-label">Total Aplikasi</div>
            </div>
            <div class="stat-card warning" style="padding: var(--space-4)">
                <div class="stat-number" id="statusPending" style="font-size: var(--font-size-2xl)">
                    15
                </div>
                <div class="stat-label">Pending Review</div>
            </div>
            <div class="stat-card success" style="padding: var(--space-4)">
                <div class="stat-number" id="statusApproved" style="font-size: var(--font-size-2xl)">
                    28
                </div>
                <div class="stat-label">Disetujui</div>
            </div>
            <div class="stat-card error" style="padding: var(--space-4)">
                <div class="stat-number" id="statusRejected" style="font-size: var(--font-size-2xl)">
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
            <button class="btn btn-ghost" id="appApproved" onclick="filterApplications('diterima')">
                Disetujui (28)
            </button>
            <button class="btn btn-ghost" id="appRejected" onclick="filterApplications('ditolak')">
                Ditolak (4)
            </button>
        </div>

        <div class="applications-grid" id="applicationsGrid">
        </div>

        <div class="pagination" id="applicationsPagination"></div>
</section>
