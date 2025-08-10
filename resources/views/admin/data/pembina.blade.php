<section id="mentors" class="content-section">
    <div class="card card-elevated hover-lift">
        <div class="card-header">
            <div>
                <h3 class="card-title text-gradient-primary">
                    Manajemen Mentor
                </h3>
                <p class="card-subtitle">Kelola data mentor dan pembina</p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm hover-scale" onclick="exportMentors()">
                    <span>📊</span>
                    <span>Export</span>
                </button>
                <button class="btn btn-primary hover-lift" onclick="openModal('addMentorModal')">
                    <span>➕</span>
                    <span>Tambah Mentor</span>
                </button>
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
                            <th>Kegiatan</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="mentorsTableBody"></tbody>
                </table>
            </div>
        </div>

        <div class="pagination" id="mentorsPagination"></div>
    </div>
</section>
