<section id="users" class="content-section">
    <div class="card card-elevated hover-lift">
        <div class="card-header">
            <div>
                <h3 class="card-title text-gradient-primary">
                    Manajemen Pengguna
                </h3>
                <p class="card-subtitle">Kelola akun pengguna sistem</p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm hover-scale" onclick="exportUsers()">
                    <span>📊</span>
                    <span>Export</span>
                </button>
                <button class="btn btn-primary hover-lift" onclick="addUserModal('addUserModal')">
                    <span>➕</span>
                    <span>Tambah Pengguna</span>
                </button>
            </div>
        </div>

        <div class="filters-section">
            <div class="filter-group">
                <label class="form-label">Role</label>
                <select class="form-select" id="roleFilter" onchange="filterUser()">
                    <option value="">Semua Role</option>
                    <option value="admin">Admin</option>
                    <option value="pembina">Pembina</option>
                    <option value="siswa">Siswa</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="form-label">Status</label>
                <select class="form-select" id="statusFilter" onchange="filterUser()">
                    <option value="">Semua status</option>
                    <option value="aktif">aktif</option>
                    <option value="nonaktif">nonaktif</option>
                </select>
            </div>
            <div class="filter-group search">
                <label class="form-label">Pencarian</label>
                <input type="text" class="form-input" placeholder="Cari users..." id="searchUser"
                    oninput="filterUser()" />
            </div>
        </div>

        <div class="table-container">
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody"></tbody>
                </table>
            </div>
        </div>

        <div class="pagination" id="usersPagination"></div>
    </div>
</section>
