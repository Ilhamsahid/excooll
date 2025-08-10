@extends('layouts.admin')
@section('content')
    @include('admin.dashboard.overview')
    @include('admin.dashboard.analytics')
    @include('admin.data.ekskul')
    @include('admin.data.siswa')

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
                    Semua (24)
                </button>
                <button class="tab-btn hover-scale" onclick="filterRegistrationsByStatus('pending')" id="regTabPending">
                    Pending (12)
                </button>
                <button class="tab-btn hover-scale" onclick="filterRegistrationsByStatus('approved')"
                    id="regTabApproved">
                    Disetujui (8)
                </button>
                <button class="tab-btn hover-scale" onclick="filterRegistrationsByStatus('rejected')"
                    id="regTabRejected">
                    Ditolak (4)
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

    @include('admin.data.pengumuman')

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
                                <th>Pengalaman</th>
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
                    <button class="btn btn-primary hover-lift" onclick="openModal('addUserModal')">
                        <span>➕</span>
                        <span>Tambah Pengguna</span>
                    </button>
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
                                <th>Last Login</th>
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

    <section id="settings" class="content-section">
        <div class="card card-elevated hover-lift">
            <div class="card-header">
                <div>
                    <h3 class="card-title text-gradient-primary">
                        Pengaturan Sistem
                    </h3>
                    <p class="card-subtitle">Konfigurasi sistem dan preferensi</p>
                </div>
            </div>

            <form id="settingsForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-input" value="SMA Negeri 1 Jakarta" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Kontak</label>
                        <input type="email" class="form-input" value="admin@ekstraku.edu" required />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Telepon</label>
                        <input type="tel" class="form-input" value="+62 21 1234567" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Website</label>
                        <input type="url" class="form-input" value="https://sma1jakarta.sch.id" required />
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Sekolah</label>
                    <textarea class="form-textarea" required>
Jl. Pendidikan No. 123, Jakarta Pusat, DKI Jakarta 10110</textarea
                  >
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label class="form-label"
                      >Maksimal Siswa per Kegiatan</label
                    >
                    <input
                      type="number"
                      class="form-input"
                      value="50"
                      min="1"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Periode Pendaftaran</label>
                    <select class="form-select" required>
                      <option value="always">Selalu Terbuka</option>
                      <option value="semester">Per Semester</option>
                      <option value="yearly">Per Tahun</option>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group">
                    <label class="form-label">Tahun Ajaran</label>
                    <input
                      type="text"
                      class="form-input"
                      value="2024/2025"
                      required
                    />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Semester</label>
                    <select class="form-select" required>
                      <option value="1">Semester 1</option>
                      <option value="2">Semester 2</option>
                    </select>
                  </div>
                </div>

                <div
                  style="
                    display: flex;
                    gap: var(--space-4);
                    justify-content: flex-end;
                    margin-top: var(--space-8);
                  "
                >
                  <button type="button" class="btn btn-secondary hover-scale">
                    <span>🔄</span>
                    <span>Reset</span>
                  </button>
                  <button type="submit" class="btn btn-primary hover-lift">
                    <span>💾</span>
                    <span>Simpan Pengaturan</span>
                  </button>
                </div>
              </form>
            </div>
          </section>

          <section id="reports" class="content-section">
            <div class="card card-elevated hover-lift">
              <div class="card-header">
                <div>
                  <h3 class="card-title text-gradient-primary">
                    Laporan & Statistik
                  </h3>
                  <p class="card-subtitle">Generate dan download laporan</p>
                </div>
              </div>

              <div class="quick-actions-grid">
                <button
                  class="btn btn-primary hover-lift"
                  onclick="generateReport('activities')"
                >
                  <span>📊</span>
                  <span>Laporan Kegiatan</span>
                </button>
                <button
                  class="btn btn-success hover-lift"
                  onclick="generateReport('students')"
                >
                  <span>👥</span>
                  <span>Laporan Siswa</span>
                </button>
                <button
                  class="btn btn-warning hover-lift"
                  onclick="generateReport('participation')"
                >
                  <span>📈</span>
                  <span>Laporan Partisipasi</span>
                </button>
                <button
                  class="btn btn-info hover-lift"
                  onclick="generateReport('attendance')"
                >
                  <span>📅</span>
                  <span>Laporan Kehadiran</span>
                </button>
                <button
                  class="btn btn-secondary hover-lift"
                  onclick="generateReport('mentors')"
                >
                  <span>👨‍🏫</span>
                  <span>Laporan Mentor</span>
                </button>
                <button
                  class="btn btn-danger hover-lift"
                  onclick="generateReport('financial')"
                >
                  <span>💰</span>
                  <span>Laporan Keuangan</span>
                </button>
              </div>

              <div
                class="chart-container extra-large hover-lift"
                style="margin-top: var(--space-8)"
              >
                <canvas id="reportsChart"></canvas>
              </div>
            </div>
          </section>

          <!-- NEW ENHANCED SECTIONS -->
          <section id="calendar" class="content-section">
            <div class="card card-elevated hover-lift">
              <div class="card-header">
                <div>
                  <h3 class="card-title text-gradient-primary">
                    Kalender Kegiatan
                  </h3>
                  <p class="card-subtitle">Jadwal lengkap kegiatan dan acara</p>
                </div>
                <div class="card-actions">
                  <button
                    class="btn btn-primary btn-sm hover-lift"
                    onclick="addEvent()"
                  >
                    <span>➕</span>
                    <span>Tambah Acara</span>
                  </button>
                </div>
              </div>

              <div class="enhanced-calendar">
                <div class="calendar-header">
                  <h3 class="calendar-title">Maret 2025</h3>
                  <div class="calendar-nav">
                    <button class="calendar-nav-btn">‹</button>
                    <button class="calendar-nav-btn">›</button>
                  </div>
                </div>
                <div class="calendar-grid">
                  <div class="calendar-day-header">Min</div>
                  <div class="calendar-day-header">Sen</div>
                  <div class="calendar-day-header">Sel</div>
                  <div class="calendar-day-header">Rab</div>
                  <div class="calendar-day-header">Kam</div>
                  <div class="calendar-day-header">Jum</div>
                  <div class="calendar-day-header">Sab</div>

                  <!-- Calendar days will be populated by JavaScript -->
                  <div class="calendar-day other-month">26</div>
                  <div class="calendar-day other-month">27</div>
                  <div class="calendar-day other-month">28</div>
                  <div class="calendar-day">1</div>
                  <div class="calendar-day">2</div>
                  <div class="calendar-day">3</div>
                  <div class="calendar-day">4</div>
                  <div class="calendar-day">5</div>
                  <div class="calendar-day">6</div>
                  <div class="calendar-day">7</div>
                  <div class="calendar-day">8</div>
                  <div class="calendar-day">9</div>
                  <div class="calendar-day">10</div>
                  <div class="calendar-day">11</div>
                  <div class="calendar-day">12</div>
                  <div class="calendar-day">13</div>
                  <div class="calendar-day">14</div>
                  <div class="calendar-day today">15</div>
                  <div class="calendar-day">16</div>
                  <div class="calendar-day">17</div>
                  <div class="calendar-day">18</div>
                  <div class="calendar-day">19</div>
                  <div class="calendar-day">20</div>
                  <div class="calendar-day">21</div>
                  <div class="calendar-day">22</div>
                  <div class="calendar-day">23</div>
                  <div class="calendar-day">24</div>
                  <div class="calendar-day">25</div>
                  <div class="calendar-day">26</div>
                  <div class="calendar-day">27</div>
                  <div class="calendar-day">28</div>
                  <div class="calendar-day">29</div>
                  <div class="calendar-day">30</div>
                  <div class="calendar-day">31</div>
                  <div class="calendar-day other-month">1</div>
                </div>
              </div>
            </div>
          </section>

          <section id="files" class="content-section">
            <div class="card card-elevated hover-lift">
              <div class="card-header">
                <div>
                  <h3 class="card-title text-gradient-primary">File Manager</h3>
                  <p class="card-subtitle">Kelola file dan dokumen sistem</p>
                </div>
                <div class="card-actions">
                  <button
                    class="btn btn-secondary btn-sm hover-scale"
                    onclick="createFolder()"
                  >
                    <span>📁</span>
                    <span>Buat Folder</span>
                  </button>
                </div>
              </div>

              <div class="enhanced-file-upload" onclick="triggerFileUpload()">
                <div class="file-upload-icon">📁</div>
                <div class="file-upload-text">
                  Drop files here or click to upload
                </div>
                <div class="file-upload-subtext">
                  Supported formats: PDF, DOC, XLS, JPG, PNG (Max 10MB)
                </div>
                <input
                  type="file"
                  class="file-upload-input"
                  id="fileUploadInput"
                  multiple
                />
              </div>

              <div class="file-list" id="fileList">
                <div class="file-item">
                  <div class="file-icon">📄</div>
                  <div class="file-info">
                    <div class="file-name">Laporan Kegiatan Maret 2025.pdf</div>
                    <div class="file-size">2.5 MB • Uploaded 2 hours ago</div>
                  </div>
                  <button class="file-remove">×</button>
                </div>
                <div class="file-item">
                  <div class="file-icon">📊</div>
                  <div class="file-info">
                    <div class="file-name">Data Siswa 2025.xlsx</div>
                    <div class="file-size">1.8 MB • Uploaded 1 day ago</div>
                  </div>
                  <button class="file-remove">×</button>
                </div>
                <div class="file-item">
                  <div class="file-icon">🖼️</div>
                  <div class="file-info">
                    <div class="file-name">Logo Sekolah.png</div>
                    <div class="file-size">512 KB • Uploaded 3 days ago</div>
                  </div>
                  <button class="file-remove">×</button>
                </div>
              </div>
            </div>
          </section>
    <nav class="mobile-bottom-nav">
      <div class="mobile-bottom-nav-items">
        <a
          href="#"
          class="mobile-bottom-nav-item active hover-scale"
          onclick="showSection('dashboard')"
          data-section="dashboard"
        >
          <span class="mobile-bottom-nav-icon">📊</span>
          <span>Dashboard</span>
        </a>
        <a
          href="#"
          class="mobile-bottom-nav-item hover-scale"
          onclick="showSection('activities')"
          data-section="activities"
        >
          <span class="mobile-bottom-nav-icon">🎯</span>
          <span>Kegiatan</span>
        </a>
        <a
          href="#"
          class="mobile-bottom-nav-item hover-scale"
          onclick="showSection('students')"
          data-section="students"
        >
          <span class="mobile-bottom-nav-icon">👥</span>
          <span>Siswa</span>
        </a>
        <a
          href="#"
          class="mobile-bottom-nav-item hover-scale"
          onclick="showSection('registrations')"
          data-section="registrations"
        >
          <span class="mobile-bottom-nav-icon">📝</span>
          <span>Daftar</span>
        </a>
        <a
          href="#"
          class="mobile-bottom-nav-item hover-scale"
          onclick="showSection('settings')"
          data-section="settings"
        >
          <span class="mobile-bottom-nav-icon">⚙️</span>
          <span>Setting</span>
        </a>
      </div>
    </nav>

    <!-- Enhanced Modals with Improved Design -->
    <div id="addActivityModal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title text-gradient-primary">
            Tambah Kegiatan Baru
          </h3>
          <button
            class="close-btn hover-scale"
            onclick="closeModal('addActivityModal')"
            aria-label="Close"
          >
            &times;
          </button>
        </div>

        <form id="addActivityForm">
          <div class="form-group">
            <label class="form-label">Nama Kegiatan</label>
            <input
              type="text"
              class="form-input"
              required
              placeholder="Masukkan nama kegiatan"
            />
          </div>

          <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea
              class="form-textarea"
              required
              placeholder="Deskripsi kegiatan"
            ></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="olahraga">Olahraga</option>
                            <option value="seni">Seni & Budaya</option>
                            <option value="akademik">Akademik</option>
                            <option value="teknologi">Teknologi</option>
                            <option value="sosial">Sosial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Pembina</label>
                        <select class="form-select" required>
                            <option value="">Pilih Pembina</option>
                            <option value="1">Pelatih Johnson</option>
                            <option value="2">Ibu Anderson</option>
                            <option value="3">Dr. Smith</option>
                            <option value="4">Pak Wilson</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Maksimal Anggota</label>
                        <input type="number" class="form-input" min="1" value="30" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-aktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Jadwal</label>
                    <input type="text" class="form-input" placeholder="Contoh: Senin, Rabu, Jumat 15:30-17:00"
                        required />
                </div>

                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-input" placeholder="Lokasi kegiatan" required />
                </div>

                <div
                    style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                    <button type="button" class="btn btn-secondary hover-scale"
                        onclick="closeModal('addActivityModal')">
                        <span>❌</span>
                        <span>Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary hover-lift">
                        <span>💾</span>
                        <span>Simpan Kegiatan</span>
                    </button>
                </div>
            </form>
        </div>
        </div>

        <div id="addStudentModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-gradient-primary">Tambah Siswa Baru</h3>
                    <button class="close-btn hover-scale" onclick="closeModal('addStudentModal')" aria-label="Close">
                        &times;
                    </button>
                </div>

                <form id="addStudentForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-input" required placeholder="Nama lengkap siswa" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" required placeholder="email@student.edu" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <select class="form-select" required>
                                <option value="">Pilih Kelas</option>
                                <option value="10">Kelas 10</option>
                                <option value="11">Kelas 11</option>
                                <option value="12">Kelas 12</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-input" required placeholder="+62 812 3456 7890" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-textarea" required placeholder="Alamat lengkap siswa"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-input" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div
                        style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                        <button type="button" class="btn btn-secondary hover-scale"
                            onclick="closeModal('addStudentModal')">
                            <span>❌</span>
                            <span>Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary hover-lift">
                            <span>💾</span>
                            <span>Simpan Siswa</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="addAnnouncementModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-gradient-primary">
                        Buat Pengumuman Baru
                    </h3>
                    <button class="close-btn hover-scale" onclick="closeModal('addAnnouncementModal')"
                        aria-label="Close">
                        &times;
                    </button>
                </div>

                <form id="addAnnouncementForm">
                    <div class="form-group">
                        <label class="form-label">Judul Pengumuman</label>
                        <input type="text" class="form-input" required placeholder="Judul pengumuman" />
                    </div>

                    <div class="form-group">
                        <label class="form-label">Isi Pengumuman</label>
                        <textarea class="form-textarea" rows="6" required placeholder="Isi pengumuman..."></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kegiatan Terkait</label>
                            <select class="form-select">
                                <option value="">Pengumuman Umum</option>
                                <option value="1">Klub Basket</option>
                                <option value="2">Komunitas Drama</option>
                                <option value="3">Olimpiade Sains</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Prioritas</label>
                            <select class="form-select" required>
                                <option value="normal">Normal</option>
                                <option value="tinggi">Tinggi</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Tanggal Publikasi</label>
                            <input type="datetime-local" class="form-input" required />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-select" required>
                                <option value="draft">Draft</option>
                                <option value="published">Publikasi Sekarang</option>
                                <option value="scheduled">Jadwalkan</option>
                            </select>
                        </div>
                    </div>

                    <div
                        style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                        <button type="button" class="btn btn-secondary hover-scale"
                            onclick="closeModal('addAnnouncementModal')">
                            <span>❌</span>
                            <span>Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary hover-lift">
                            <span>📢</span>
                            <span>Publikasi Pengumuman</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="addMentorModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-gradient-primary">Tambah Mentor Baru</h3>
                    <button class="close-btn hover-scale" onclick="closeModal('addMentorModal')" aria-label="Close">
                        &times;
                    </button>
                </div>

                <form id="addMentorForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-input" required placeholder="Nama lengkap mentor" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" required placeholder="email@school.edu" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Keahlian</label>
                            <select class="form-select" required>
                                <option value="">Pilih Keahlian</option>
                                <option value="olahraga">Olahraga</option>
                                <option value="seni">Seni & Budaya</option>
                                <option value="akademik">Akademik</option>
                                <option value="teknologi">Teknologi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pengalaman (Tahun)</label>
                            <input type="number" class="form-input" min="0" required placeholder="0" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="tel" class="form-input" required placeholder="+62 812 3456 7890" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-select" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non-aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bio/Deskripsi</label>
                        <textarea class="form-textarea" required placeholder="Deskripsi singkat tentang mentor"></textarea>
                    </div>

                    <div
                        style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                        <button type="button" class="btn btn-secondary hover-scale"
                            onclick="closeModal('addMentorModal')">
                            <span>❌</span>
                            <span>Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary hover-lift">
                            <span>💾</span>
                            <span>Simpan Mentor</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="addUserModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-gradient-primary">
                        Tambah Pengguna Baru
                    </h3>
                    <button class="close-btn hover-scale" onclick="closeModal('addUserModal')" aria-label="Close">
                        &times;
                    </button>
                </div>

                <form id="addUserForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-input" required placeholder="username" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" required placeholder="email@domain.com" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-input" required placeholder="Password" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-input" required placeholder="Konfirmasi Password" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <select class="form-select" required>
                                <option value="">Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="mentor">Mentor</option>
                                <option value="student">Siswa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-select" required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non-aktif</option>
                            </select>
                        </div>
                    </div>

                    <div
                        style="
              display: flex;
              gap: var(--space-4);
              justify-content: flex-end;
              margin-top: var(--space-8);
            ">
                        <button type="button" class="btn btn-secondary hover-scale"
                            onclick="closeModal('addUserModal')">
                            <span>❌</span>
                            <span>Batal</span>
                        </button>
                        <button type="submit" class="btn btn-primary hover-lift">
                            <span>💾</span>
                            <span>Simpan Pengguna</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="notificationContainer" class="notification-container"></div>

        <!-- PERFORMANCE METRICS DISPLAY -->
        <div class="performance-metrics" id="performanceMetrics" style="display: none">
            <div class="performance-metric">
                <span>Load Time:</span>
                <span id="loadTimeValue">0ms</span>
            </div>
            <div class="performance-metric">
                <span>Interactions:</span>
                <span id="interactionCount">0</span>
            </div>
            <div class="performance-metric">
                <span>Memory:</span>
                <span id="memoryUsage">0MB</span>
            </div>
        </div>
    @endsection
