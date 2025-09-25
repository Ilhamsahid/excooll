<!-- Activities Section -->
<section id="activities" class="content-section">
    <div class="card card-elevated">
        <div class="card-header">
            <div>
                <h3 class="card-title">Activities - Klub Basket</h3>
                <p class="card-subtitle">
                    Kelola dan pantau kegiatan ekstrakurikuler basket
                </p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm" onclick="exportActivities()">
                    📊 Export Kegiatan
                </button>
                <button class="btn btn-primary" onclick="addActivity('activityModal')">
                    ➕ Buat Kegiatan
                </button>
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
                <label class="form-label">Status Kegiatan</label>
                <select class="form-select" id="activityStatusFilter" onchange="filterActivities()">
                    <option value="">Semua Status</option>
                    <option value="upcoming">Akan Datang</option>
                    <option value="ongoing">Sedang Berlangsung</option>
                    <option value="done">Selesai</option>
                </select>
            </div>
            <div style="flex: 1; min-width: 300px">
                <label class="form-label">Cari Kegiatan</label>
                <input type="text" class="form-input" placeholder="Cari nama kegiatan..." id="activitySearchInput"
                    oninput="filterActivities()" />
            </div>
        </div>

        <!-- Activities Grid -->
        <div class="applications-grid" id="loadActivitiesGrid">
        </div>

        <div class="pagination" id="activitiesPagination"></div>
    </div>
</section>
