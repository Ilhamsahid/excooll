@extends('layouts.admin')
@section('content')
    @include('admin.dashboard.overview')
    @include('admin.dashboard.analytics')
    @include('admin.data.ekskul')
    @include('admin.data.siswa')
    @include('admin.data.pendaftaran')
    @include('admin.data.pengumuman')
    @include('admin.data.pembina')
    @include('admin.data.pengguna')

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
    Jl. Pendidikan No. 123, Jakarta Pusat, DKI Jakarta 10110</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Maksimal Siswa per Kegiatan</label>
                        <input type="number" class="form-input" value="50" min="1" required />
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
                        <input type="text" class="form-input" value="2024/2025" required />
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
                  ">
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
                <button class="btn btn-primary hover-lift" onclick="generateReport('activities')">
                    <span>📊</span>
                    <span>Laporan Kegiatan</span>
                </button>
                <button class="btn btn-success hover-lift" onclick="generateReport('students')">
                    <span>👥</span>
                    <span>Laporan Siswa</span>
                </button>
                <button class="btn btn-warning hover-lift" onclick="generateReport('participation')">
                    <span>📈</span>
                    <span>Laporan Partisipasi</span>
                </button>
                <button class="btn btn-info hover-lift" onclick="generateReport('attendance')">
                    <span>📅</span>
                    <span>Laporan Kehadiran</span>
                </button>
                <button class="btn btn-secondary hover-lift" onclick="generateReport('mentors')">
                    <span>👨‍🏫</span>
                    <span>Laporan Mentor</span>
                </button>
                <button class="btn btn-danger hover-lift" onclick="generateReport('financial')">
                    <span>💰</span>
                    <span>Laporan Keuangan</span>
                </button>
            </div>

            <div class="chart-container extra-large hover-lift" style="margin-top: var(--space-8)">
                <canvas id="reportsChart"></canvas>
            </div>
        </div>
    </section>

    @include('admin.layouts.bottom-nav')
    @include('admin.forms.activity-modal')
    @include('admin.forms.student-modal')
    @include('admin.forms.announcements-modal')
    @include('admin.forms.mentor-modal')
    @include('admin.forms.user-modal')

    @include('admin.data.modal.activity-detail')
    @include('admin.data.modal.student-detail')
    @include('admin.data.modal.registration-detail')
    @include('admin.data.modal.announcement-detail')
    @include('admin.data.modal.pembina-detail')
    @include('admin.data.modal.delete')

    <div id="notificationContainer" class="notification-container"></div>
@endsection