<section id="analytics" class="content-section">
    <div class="card card-elevated hover-lift">
        <div class="card-header">
            <div>
                <h3 class="card-title text-gradient-primary">
                    Analytics & Insights
                </h3>
                <p class="card-subtitle">
                    Analisis mendalam tentang performa sistem
                </p>
            </div>
            <div class="card-actions">
                <button class="btn btn-secondary btn-sm hover-scale" onclick="exportAnalytics()">
                    <span>📊</span>
                    <span>Export Data</span>
                </button>
            </div>
        </div>

        <div
            style="
                  display: grid;
                  grid-template-columns: 1fr 1fr;
                  gap: var(--space-6);
                  margin-bottom: var(--space-6);
                ">
            <div class="chart-container hover-lift">
                <canvas id="monthlyTrendChart"></canvas>
            </div>
            <div class="chart-container hover-lift">
                <canvas id="categoryDistributionChart"></canvas>
            </div>
        </div>

        <div class="chart-container extra-large hover-lift">
            <canvas id="participationChart"></canvas>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-card hover-lift">
            <div class="stat-header">
                <div class="stat-icon animate-float">📈</div>
            </div>
            <div class="stat-number">85%</div>
            <div class="stat-label">Tingkat Partisipasi</div>
            <div class="stat-change positive hover-scale">
                <span class="stat-change-icon">↗</span>
                <span>+5% dari semester lalu</span>
            </div>
        </div>

        <div class="stat-card success hover-lift">
            <div class="stat-header">
                <div class="stat-icon animate-float">⭐</div>
            </div>
            <div class="stat-number">4.8</div>
            <div class="stat-label">Rating Kepuasan</div>
            <div class="stat-change positive hover-scale">
                <span class="stat-change-icon">↗</span>
                <span>+0.3 dari bulan lalu</span>
            </div>
        </div>

        <div class="stat-card warning hover-lift">
            <div class="stat-header">
                <div class="stat-icon animate-float">🎯</div>
            </div>
            <div class="stat-number">92%</div>
            <div class="stat-label">Tingkat Kehadiran</div>
            <div class="stat-change positive hover-scale">
                <span class="stat-change-icon">↗</span>
                <span>+2% dari bulan lalu</span>
            </div>
        </div>

        <div class="stat-card info hover-lift">
            <div class="stat-header">
                <div class="stat-icon animate-float">🏆</div>
            </div>
            <div class="stat-number">15</div>
            <div class="stat-label">Prestasi Dicapai</div>
            <div class="stat-change positive hover-scale">
                <span class="stat-change-icon">↗</span>
                <span>+3 prestasi baru</span>
            </div>
        </div>
    </div>
</section>
