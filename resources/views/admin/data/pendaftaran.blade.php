<section id="registrations" class="content-section">
    <div class="card card-elevated hover-lift">
        <div class="card-header">
            <div>
                <h3 class="card-title text-gradient-primary">
                    Manajemen Pendaftaran
                </h3>
                <p class="card-subtitle">Kelola pendaftaran siswa baru</p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm hover-scale" onclick="exportRegistrations()">
                    <span>📊</span>
                    <span>Export</span>
                </button>
                <button class="btn btn-success btn-sm hover-lift" onclick="approveAllPending()">
                    <span>✅</span>
                    <span>Setujui Semua</span>
                </button>
            </div>
        </div>

        <div class="tabs-container">
            <button class="tab-btn active hover-scale" onclick="filterRegistrationsByStatus('all')" id="regTabAll">
                Semua (0)
            </button>
            <button class="tab-btn hover-scale" onclick="filterRegistrationsByStatus('pending')" id="regTabPending">
                Pending (1)
            </button>
            <button class="tab-btn hover-scale" onclick="filterRegistrationsByStatus('diterima')" id="regTabDiterima">
                Disetujui (0)
            </button>
            <button class="tab-btn hover-scale" onclick="filterRegistrationsByStatus('ditolak')" id="regTabDitolak">
                Ditolak (0)
            </button>
        </div>

        <div class="table-container">
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Siswa</th>
                            <th>Kegiatan</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="registrationsTableBody"></tbody>
                </table>
            </div>
        </div>

        <div class="pagination" id="registrationsPagination"></div>
    </div>
</section>
