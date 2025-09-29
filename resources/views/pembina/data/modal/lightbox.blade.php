    <div id="lightboxModal" class="lightbox-modal">
        <div class="lightbox-content">
            <div class="lightbox-header">
                <div class="lightbox-info">
                    <h3 class="lightbox-title" id="lightboxTitle">Loading...</h3>
                    <p class="lightbox-description" id="lightboxDescription">Loading...</p>
                </div>
                <div class="lightbox-controls">
                    <button class="lightbox-control-btn" onclick="downloadMedia()" title="Download">
                        ⬇
                    </button>
                    <button class="lightbox-control-btn" onclick="shareMedia()" title="Share">
                        🔗
                    </button>
                    <button class="lightbox-control-btn" onclick="closeLightbox()" title="Close">
                        ✕
                    </button>
                </div>
            </div>

            <div class="lightbox-media-container">
                <img id="lightboxImage" class="lightbox-media" style="display: none;" />
                <video id="lightboxVideo" class="lightbox-media" controls style="display: none;"></video>

                <button class="lightbox-nav lightbox-nav-prev" onclick="previousMedia()" title="Previous">
                    ‹
                </button>
                <button class="lightbox-nav lightbox-nav-next" onclick="nextMedia()" title="Next">
                    ›
                </button>
            </div>

            <div class="lightbox-footer">
                <div class="lightbox-meta" id="lightboxMeta">
                    📅 15 Mar 2025 • 👤 Ahmad Surya
                </div>
                <div class="lightbox-counter" id="lightboxCounter">
                    1 / 6
                </div>
            </div>
        </div>
    </div>
