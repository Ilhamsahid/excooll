<!-- Gallery Section -->
<section id="gallery" class="content-section">
    <div class="card card-elevated">
        <div class="gallery-header">
            <div>
                <h3 class="gallery-title">Activity Gallery</h3>
                <p class="gallery-subtitle">
                    Galeri foto dan video kegiatan ekstrakurikuler klub basket
                </p>
            </div>
            <div class="gallery-controls">
                <button class="btn btn-secondary btn-sm" onclick="exportGallery()">
                    📊 Export
                </button>
                <button class="btn btn-primary" onclick="toggleGalleryForm()">
                    📷 Upload Media
                </button>
            </div>
        </div>

        <!-- Gallery Upload Form -->
        <div class="gallery-upload-form" id="galleryUploadForm">
            <div class="gallery-form-header">
                <h4 class="gallery-form-title">Upload Media Kegiatan</h4>
                <button class="gallery-form-toggle" onclick="toggleGalleryForm()" id="galleryFormToggle">
                    ✕ Tutup Form
                </button>
            </div>

            <div class="gallery-form-content active" id="galleryFormContent">
                <form id="galleryForm" onsubmit="handleGallerySubmit(event)">
                    <input type="hidden" name="activity_id" value="1" />
                    <input type="hidden" name="uploaded_by" value="Ahmad Surya" />

                    <div class="gallery-form-row">
                        <div class="gallery-form-group">
                            <label class="gallery-form-label">Judul Media</label>
                            <input type="text" class="gallery-form-input" name="title" required
                                placeholder="Contoh: Latihan Shooting Drill" />
                        </div>
                        <div class="gallery-form-group">
                            <label class="gallery-form-label">Tanggal Kegiatan</label>
                            <input type="date" class="gallery-form-input" name="activity_date" required />
                        </div>
                    </div>

                    <div class="gallery-form-group full-width">
                        <label class="gallery-form-label">Deskripsi</label>
                        <textarea class="gallery-form-textarea" name="description" rows="4"
                            placeholder="Deskripsikan kegiatan atau momen yang diabadikan dalam media ini..."></textarea>
                    </div>

                    <div class="gallery-form-group full-width" >
                        <label class="gallery-form-label">Upload Media (Foto/Video)</label>
                        <div class="gallery-file-upload" id="galleryFileUpload"
                            onclick="document.getElementById('galleryFileInput').click()">
                            <div class="gallery-file-upload-icon">📷</div>
                            <div class="gallery-file-upload-text">
                                Klik atau drag & drop untuk upload media
                            </div>
                            <div class="gallery-file-upload-subtext">
                                Mendukung: JPG, PNG, GIF, MP4, MOV (Max 10MB per file)
                            </div>
                            <input type="file" class="gallery-file-input" id="galleryFileInput" name="media"
                                multiple accept="image/*,video/*" onchange="handleFileSelect()" />
                        </div>
                    </div>

                    <div class="gallery-form-actions">
                        <div class="gallery-selected-files" id="selectedFiles"></div>
                        <div>
                            <button type="button" class="btn btn-secondary" onclick="resetGalleryForm()">
                                🗑️ Reset Form
                            </button>
                            <button type="submit" class="btn btn-primary">
                                📤 Upload Media
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div style="margin-top: var(--space-6); margin-bottom: var(--space-4); display: flex; gap: var(--space-4); flex-wrap: wrap; align-items: end;">
            <label class="form-label">Kegiatan</label>
            <select class="form-select" id="studentStatusFilter" onchange="filterStudents()">
                <option value="">Semua Kegiatan</option>
                <option value="active">Aktif</option>
                <option value="inactive">Tidak Aktif</option>
                <option value="core">Tim Inti</option>
            </select>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" id="galleryGrid">
            <!-- Sample gallery items -->
            <div class="gallery-item" onclick="openLightbox(0)">
                <div class="gallery-item-media">
                    <img src="https://images.pexels.com/photos/1752757/pexels-photo-1752757.jpeg" alt="Latihan Basket"
                        class="gallery-item-image" />
                    <div class="gallery-item-overlay"></div>
                </div>
                <div class="gallery-item-content">
                    <h4 class="gallery-item-title">Latihan Shooting Drill</h4>
                    <p class="gallery-item-description">
                        Sesi latihan intensif untuk meningkatkan akurasi shooting para anggota klub basket.
                        Latihan dilakukan dengan berbagai variasi posisi dan jarak.
                    </p>
                    <div class="gallery-item-meta">
                        <div class="gallery-item-date">
                            <span>📅</span>
                            <span>15 Mar 2025</span>
                        </div>
                        <div class="gallery-item-author">
                            <span>👤</span>
                            <span>Ahmad Surya</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" onclick="openLightbox(1)">
                <div class="gallery-item-media">
                    <img src="https://images.pexels.com/photos/1544966/pexels-photo-1544966.jpeg" alt="Team Training"
                        class="gallery-item-image" />
                    <div class="gallery-item-overlay"></div>
                </div>
                <div class="gallery-item-content">
                    <h4 class="gallery-item-title">Team Building Exercise</h4>
                    <p class="gallery-item-description">
                        Kegiatan team building untuk mempererat kerja sama antar anggota tim. Dilakukan sebelum
                        memulai latihan inti.
                    </p>
                    <div class="gallery-item-meta">
                        <div class="gallery-item-date">
                            <span>📅</span>
                            <span>14 Mar 2025</span>
                        </div>
                        <div class="gallery-item-author">
                            <span>👤</span>
                            <span>Ahmad Surya</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" onclick="openLightbox(2)">
                <div class="gallery-item-media">
                    <video class="gallery-item-video"
                        poster="https://images.pexels.com/photos/1752775/pexels-photo-1752775.jpeg" muted>
                        <source src="#" type="video/mp4" />
                    </video>
                    <div class="gallery-item-overlay">
                        <div class="gallery-item-play-icon">▶</div>
                    </div>
                </div>
                <div class="gallery-item-content">
                    <h4 class="gallery-item-title">Highlight Pertandingan</h4>
                    <p class="gallery-item-description">
                        Video highlight dari pertandingan friendly match melawan SMAN 8. Tim berhasil menang
                        dengan skor 78-65.
                    </p>
                    <div class="gallery-item-meta">
                        <div class="gallery-item-date">
                            <span>📅</span>
                            <span>13 Mar 2025</span>
                        </div>
                        <div class="gallery-item-author">
                            <span>👤</span>
                            <span>Ahmad Surya</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" onclick="openLightbox(3)">
                <div class="gallery-item-media">
                    <img src="https://images.pexels.com/photos/1884574/pexels-photo-1884574.jpeg" alt="Award Ceremony"
                        class="gallery-item-image" />
                    <div class="gallery-item-overlay"></div>
                </div>
                <div class="gallery-item-content">
                    <h4 class="gallery-item-title">Penyerahan Trophy</h4>
                    <p class="gallery-item-description">
                        Momen penyerahan trophy juara 1 turnamen basket regional. Kebanggaan untuk seluruh
                        anggota klub basket.
                    </p>
                    <div class="gallery-item-meta">
                        <div class="gallery-item-date">
                            <span>📅</span>
                            <span>10 Mar 2025</span>
                        </div>
                        <div class="gallery-item-author">
                            <span>👤</span>
                            <span>Ahmad Surya</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" onclick="openLightbox(4)">
                <div class="gallery-item-media">
                    <img src="https://images.pexels.com/photos/2834914/pexels-photo-2834914.jpeg"
                        alt="Practice Session" class="gallery-item-image" />
                    <div class="gallery-item-overlay"></div>
                </div>
                <div class="gallery-item-content">
                    <h4 class="gallery-item-title">Latihan Defense</h4>
                    <p class="gallery-item-description">
                        Sesi latihan khusus untuk meningkatkan kemampuan defense. Focus pada positioning dan
                        timing untuk intercept.
                    </p>
                    <div class="gallery-item-meta">
                        <div class="gallery-item-date">
                            <span>📅</span>
                            <span>08 Mar 2025</span>
                        </div>
                        <div class="gallery-item-author">
                            <span>👤</span>
                            <span>Ahmad Surya</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-item" onclick="openLightbox(5)">
                <div class="gallery-item-media">
                    <img src="https://images.pexels.com/photos/1510106/pexels-photo-1510106.jpeg" alt="Team Photo"
                        class="gallery-item-image" />
                    <div class="gallery-item-overlay"></div>
                </div>
                <div class="gallery-item-content">
                    <h4 class="gallery-item-title">Foto Tim Lengkap</h4>
                    <p class="gallery-item-description">
                        Foto bersama seluruh anggota klub basket beserta para pelatih. Diambil setelah
                        pencapaian juara regional.
                    </p>
                    <div class="gallery-item-meta">
                        <div class="gallery-item-date">
                            <span>📅</span>
                            <span>05 Mar 2025</span>
                        </div>
                        <div class="gallery-item-author">
                            <span>👤</span>
                            <span>Ahmad Surya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
