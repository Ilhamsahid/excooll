<section id="profile" class="content-section">
    <div class="profile-card">
        <div class="profile-avatar">{{ strtoupper(substr($pembina->name, 0, 2)) }}</div>
        <div class="profile-info">
            <h2 class="profile-name nama" id="nameProfile">{{ $pembina->name }}</h2>
            <p class="profile-role">
                Pembina {{ $pembina->ekskulDibina[0]->nama }} • Email: <span class="email">{{ $pembina->email }}</span>
            </p>
            <div
                style="
                    margin: var(--space-4) 0;
                    display: flex;
                    gap: var(--space-4);
                    justify-content: center;
                    flex-wrap: wrap;
                  ">
                <span class="badge badge-primary">{{ $pembina->ekskulDibina[0]->nama }}</span>
                <span class="badge badge-success">✅ {{ $pembina->status }}</span>
                <span class="badge badge-info">📞 {{ $pembina->pembinaProfile->no_telephone }}</span>
            </div>
        </div>
    </div>

    <div class="card card-elevated">
        <div class="card-header">
            <div>
                <h3 class="card-title">Informasi Profile</h3>
                <p class="card-subtitle">Kelola data pribadi dan kontak</p>
            </div>
            <div class="card-actions">
                <button class="btn btn-primary" onclick="editProfileModal('profileModal')">
                    ✏️ Edit Profile
                </button>
            </div>
        </div>

        <div
            style="
                  display: grid;
                  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                  gap: var(--space-6);
                ">
            <div>
                <h4
                    style="
                      font-size: var(--font-size-lg);
                      font-weight: var(--font-weight-bold);
                      margin-bottom: var(--space-4);
                      color: var(--text-primary);
                    ">
                    Data Pribadi
                </h4>
                <div style="space-y: var(--space-3)">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Nama Lengkap:</strong><br />
                        <span class="nama">{{ $pembina->name }}</span>
                    </div>
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Deskripsi: </strong><br />
                        <span class="deskripsi">{{ $pembina->pembinaProfile->deskripsi }}</span>
                    </div>
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Jenis Kelamin:</strong><br />
                        <span class="jenis_kelamin">{{ $pembina->pembinaProfile->jenis_kelamin }}</span>
                    </div>
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Alamat:</strong><br />
                        <span class="alamat">{{ $pembina->pembinaProfile->alamat }}</span>
                    </div>
                </div>
            </div>

            <div>
                <h4
                    style="
                      font-size: var(--font-size-lg);
                      font-weight: var(--font-weight-bold);
                      margin-bottom: var(--space-4);
                      color: var(--text-primary);
                    ">
                    Kontak & Pendidikan
                </h4>
                <div style="space-y: var(--space-3)">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>No. Telepon:</strong><br />
                        <span class="no_tel">{{ $pembina->pembinaProfile->no_telephone }}</span>
                    </div>
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Email:</strong><br />
                        <span class="email">{{ $pembina->email }}</span>
                    </div>
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Ekstrakurikuler yang Dibina:</strong><br />
                        <span class="badge badge-primary" id="ekskulDibina">{{ $pembina->ekskulDibina[0]->nama }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
