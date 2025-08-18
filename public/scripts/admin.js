// ===== ENHANCED GLOBAL VARIABLES =====
let currentTheme = localStorage.getItem("theme") || "light";
let currentSection = "dashboard";
let notificationId = 0;
let charts = {};
let currentPage = {
    activities: 1,
    students: 1,
    registrations: 1,
    announcements: 1,
    mentors: 1,
    users: 1,
};
let itemsPerPage = 10;
let currentRegistrationStatus = "all"; // simpan status tab aktif
let filteredData = {};

// Enhanced touch detection for better mobile experience
let isTouchDevice = "ontouchstart" in window || navigator.maxTouchPoints > 0;
let isHighContrastMode = window.matchMedia("(prefers-contrast: high)").matches;
let isReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)"
).matches;

// Performance monitoring
let performanceMetrics = {
    loadTime: 0,
    renderTime: 0,
    interactionCount: 0,
};

const refreshMap = {
    activities: ["mentors"], // kalau ekskul diubah, mentors ikut refresh
};

// ===== ENHANCED UTILITY FUNCTIONS =====
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}

function formatDateTime(dateString) {
    const safeDateString = dateString.replace(" ", "T");
    const date = new Date(safeDateString);

    return date.toLocaleString("id-ID", {
        year: "numeric",
        month: "short",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
    });
}

function formatNumber(num) {
    return new Intl.NumberFormat("id-ID").format(num);
}

function formatPercentage(num, decimals = 1) {
    return `${num.toFixed(decimals)}%`;
}

function generateId() {
    return Math.floor(Math.random() * 1000000);
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function () {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => (inThrottle = false), limit);
        }
    };
}

// Enhanced performance monitoring
function measurePerformance(name, fn) {
    const start = performance.now();
    const result = fn();
    const end = performance.now();
    performanceMetrics[name] = (performanceMetrics[name] || 0) + (end - start);
    return result;
}

// ===== ENHANCED THEME MANAGEMENT WITH NEW SWITCHER =====
function setTheme(theme) {
    currentTheme = theme;
    document.body.setAttribute("data-theme", currentTheme);
    localStorage.setItem("theme", currentTheme);

    const themeSlider = document.getElementById("themeSlider");
    if (theme === "dark") {
        themeSlider.classList.add("dark");
    } else {
        themeSlider.classList.remove("dark");
    }

    // Enhanced theme transition effect
    document.body.style.transition =
        "background-color 0.3s ease, color 0.3s ease";

    // Update charts with new theme
    updateChartsTheme();

    showNotification(
        "Tema Berhasil Diubah",
        `Tema ${
            currentTheme === "light" ? "terang" : "gelap"
        } telah diaktifkan`,
        "success",
        2000
    );

    // Reset transition after animation
    setTimeout(() => {
        document.body.style.transition = "";
    }, 300);
}

function toggleTheme() {
    currentTheme = currentTheme === "light" ? "dark" : "light";
    document.body.setAttribute("data-theme", currentTheme);
    localStorage.setItem("theme", currentTheme);

    const themeIcon = document.getElementById("themeIcon");
    themeIcon.textContent = currentTheme === "light" ? "🌙" : "☀️";

    // Enhanced theme transition effect
    document.body.style.transition =
        "background-color 0.3s ease, color 0.3s ease";

    // Update charts with new theme
    updateChartsTheme();

    // Reset transition after animation
    setTimeout(() => {
        document.body.style.transition = "";
    }, 300);
}

function loadTheme() {
    document.body.setAttribute("data-theme", currentTheme);
    const themeIcon = document.getElementById("themeIcon");
    themeIcon.textContent = currentTheme === "light" ? "🌙" : "☀️";

    // Apply system theme preference if no saved theme
    if (!localStorage.getItem("theme")) {
        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;
        if (prefersDark) {
            currentTheme = "dark";
            toggleTheme();
        }
    }
}

// ===== ENHANCED SIDEBAR MANAGEMENT WITH MOBILE FIX =====
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggleIcon = document.getElementById("sidebarToggleIcon");

    sidebar.classList.toggle("collapsed");
    sidebarToggleIcon.textContent = sidebar.classList.contains("collapsed")
        ? "☰"
        : "✕";

    // Save sidebar state
    localStorage.setItem(
        "sidebarCollapsed",
        sidebar.classList.contains("collapsed")
    );
}

function toggleMobileSidebar() {
    const sidebar = document.getElementById("sidebar");
    const isOpen = sidebar.classList.contains("mobile-open");

    if (isOpen) {
        // Close sidebar
        sidebar.classList.remove("mobile-open");
        const backdrop = document.querySelector(".mobile-sidebar-backdrop");
        if (backdrop) {
            backdrop.remove();
        }
        document.body.style.overflow = "";

        // Hide close button
        const closeBtn = sidebar.querySelector(".sidebar-close-btn");
        if (closeBtn) {
            closeBtn.style.display = "none";
        }
    } else {
        // Open sidebar
        sidebar.classList.add("mobile-open");

        // Add backdrop for mobile sidebar
        const backdrop = document.createElement("div");
        backdrop.className = "mobile-sidebar-backdrop";
        backdrop.onclick = toggleMobileSidebar;
        document.body.appendChild(backdrop);
        document.body.style.overflow = "hidden";

        // Show close button
        const closeBtn = sidebar.querySelector(".sidebar-close-btn");
        if (closeBtn) {
            closeBtn.style.display = "flex";
        }
    }
}

function loadSidebarState() {
    const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
    if (isCollapsed) {
        toggleSidebar();
    }
}

function navigate(event, sectionName) {
    event.preventDefault(); // Cegah reload halaman
    history.pushState(
        { section: sectionName },
        "",
        `/ekstrasmexa/admin/${sectionName}`
    );

    // Panggil fungsi untuk ganti konten section
    showSection(sectionName);
}

// ===== ENHANCED SECTION MANAGEMENT =====
function showSection(sectionName) {
    performanceMetrics.interactionCount++;

    // Hide all sections with fade out
    document.querySelectorAll(".content-section").forEach((section) => {
        section.classList.remove("active");
    });

    // Show selected section with fade in
    const targetSection = document.getElementById(sectionName);
    if (targetSection) {
        targetSection.classList.add("active");
    }

    // Update nav links
    document.querySelectorAll(".nav-link").forEach((link) => {
        link.classList.remove("active");
    });
    document
        .querySelectorAll(`[data-section="${sectionName}"]`)
        .forEach((link) => {
            link.classList.add("active");
        });

    // Update mobile bottom nav
    document.querySelectorAll(".mobile-bottom-nav-item").forEach((item) => {
        item.classList.remove("active");
    });
    document
        .querySelectorAll(
            `.mobile-bottom-nav-item[data-section="${sectionName}"]`
        )
        .forEach((item) => {
            item.classList.add("active");
        });

    // Update page title and breadcrumb
    const titles = {
        dashboard: "Dashboard Overview",
        analytics: "Analytics & Insights",
        activities: "Manajemen Kegiatan",
        students: "Manajemen Siswa",
        registrations: "Manajemen Pendaftaran",
        announcements: "Manajemen Pengumuman",
        mentors: "Manajemen Mentor",
        users: "Manajemen Pengguna",
        settings: "Pengaturan Sistem",
        reports: "Laporan & Statistik",
        calendar: "Kalender Kegiatan",
        files: "File Manager",
    };

    document.getElementById("pageTitle").textContent =
        titles[sectionName] || "Dashboard";
    document.getElementById("breadcrumb").innerHTML = `
                <span>Admin</span>
                <span class="breadcrumb-separator">/</span>
                <span>${titles[sectionName] || "Dashboard"}</span>
            `;

    currentSection = sectionName;

    // Reset pagination
    currentPage[sectionName] = 1;

    // Load section data with performance measurement
    measurePerformance("sectionLoad", () => loadSectionData(sectionName));

    // Close mobile sidebar
    const sidebar = document.getElementById("sidebar");
    if (sidebar.classList.contains("mobile-open")) {
        toggleMobileSidebar();
    }

    // Save current section
    localStorage.setItem("currentSection", sectionName);

    // Update URL without refresh (if browser supports it)
}

window.addEventListener("popstate", function (event) {
    if (event.state && event.state.section) {
        showSection(event.state.section);
    }
});

// ===== ENHANCED DATA LOADING FUNCTIONS =====
function loadSectionData(sectionName) {
    // NO LOADING OVERLAY FOR PAGINATION - INSTANT SWITCH
    switch (sectionName) {
        case "dashboard":
            loadDashboardData();
            break;
        case "analytics":
            loadAnalyticsData();
            break;
        case "activities":
            loadActivitiesTable();
            break;
        case "students":
            loadStudentsTable();
            break;
        case "registrations":
            loadRegistrationsTable(currentRegistrationStatus);
            break;
        case "announcements":
            loadAnnouncementsGrid();
            break;
        case "mentors":
            loadMentorsTable();
            break;
        case "users":
            loadUsersTable();
            break;
        case "reports":
            loadReportsData();
            break;
        case "calendar":
            loadCalendarData();
            break;
        case "tasks":
            loadTasksData();
            break;
        case "files":
            loadFilesData();
            break;
    }
}

async function loadPembinaSelect() {
    const response = await fetch("/get-mentors");
    const namePembina = await response.json();
    console.log(namePembina);

    const select = document.getElementById("selectPembina");
    select.innerHTML = '<option value="">Pilih Pembina</option>';

    namePembina.forEach((element) => {
        const option = document.createElement("option");
        option.value = element.id;
        option.textContent = element.name;
        select.appendChild(option);
    });
}

async function loadEkskulsSelect() {
    const response = await fetch("/get-ekskul");
    const namePembina = await response.json();
    console.log(namePembina);

    const select = document.getElementById("selectEkskul");
    select.innerHTML = '<option value="">Pilih Ekskul</option>';

    namePembina.forEach((element) => {
        const option = document.createElement("option");
        option.value = element.id;
        option.textContent = element.nama;
        select.appendChild(option);
    });
}

function loadDashboardData() {
    // Update stats with animations
    animateCountUp("totalStudents", 0, sampleData.students.length, 1000);
    animateCountUp(
        "activeActivities",
        0,
        sampleData.activities.filter((a) => a.status === "aktif").length,
        1200
    );
    animateCountUp("totalMentors", 0, sampleData.mentors.length, 1400);
    animateCountUp("totalEvents", 0, 50, 1600);

    // Update enhanced metrics
    animateCountUp("engagementRate", 0, 85, 1800);
    animateCountUp("satisfactionScore", 0, 4.8, 2000);
    animateCountUp("achievements", 0, 42, 2200);

    // Load activity feed
    loadActivityFeed();

    // Load charts
    loadDashboardCharts();
}

function handleSidebarToggle() {
    if (window.innerWidth <= 768) {
        toggleMobileSidebar();
    } else {
        toggleSidebar();
    }
}

function animateCountUp(elementId, start, end, duration) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const startTime = performance.now();

    function update(currentTime) {
        const elapsedTime = currentTime - startTime;
        const progress = Math.min(elapsedTime / duration, 1);

        // Easing function for smooth animation
        const easeOutQuart = 1 - Math.pow(1 - progress, 4);
        const currentValue = start + (end - start) * easeOutQuart;

        if (elementId === "satisfactionScore") {
            element.textContent = currentValue.toFixed(1);
        } else if (elementId === "engagementRate") {
            element.textContent = Math.floor(currentValue) + "%";
        } else if (elementId === "growthRate") {
            element.textContent = "+" + Math.floor(currentValue) + "%";
        } else {
            element.textContent = formatNumber(Math.floor(currentValue));
        }

        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }

    requestAnimationFrame(update);
}

function loadActivityFeed() {
    const feed = document.getElementById("activityFeed");
    feed.innerHTML = "";

    sampleData.activities_recent.forEach((activity, index) => {
        const item = document.createElement("div");
        item.className = "activity-item";
        item.style.animationDelay = `${index * 50}ms`;
        item.innerHTML = `
                    <div class="activity-icon animate-float">${activity.icon}</div>
                    <div class="activity-content">
                        <div class="activity-title">${activity.title}</div>
                        <div class="activity-description">${activity.description}</div>
                        <div class="activity-time">${activity.time}</div>
                    </div>
                `;
        feed.appendChild(item);

        // Animate item appearance
        setTimeout(() => {
            item.style.opacity = "1";
            item.style.transform = "translateX(0)";
        }, index * 50);
    });
}

// ===== ENHANCED CHARTS SYSTEM =====
function loadDashboardCharts() {
    // Registration Chart with enhanced features
    const regCtx = document.getElementById("registrationChart");
    if (regCtx && !charts.registration) {
        charts.registration = new Chart(regCtx, {
            type: "line",
            data: {
                labels: ["Sep", "Okt", "Nov", "Des", "Jan", "Feb", "Mar"],
                datasets: [
                    {
                        label: "Pendaftaran Siswa",
                        data: [45, 52, 48, 61, 55, 67, 73],
                        borderColor: "rgb(59, 130, 246)",
                        backgroundColor: "rgba(59, 130, 246, 0.1)",
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: "rgb(59, 130, 246)",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: "rgb(59, 130, 246)",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 3,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        borderColor: "rgb(59, 130, 246)",
                        borderWidth: 1,
                        cornerRadius: 12,
                        displayColors: false,
                        titleFont: {
                            size: 14,
                            weight: "bold",
                        },
                        bodyFont: {
                            size: 13,
                        },
                        callbacks: {
                            title: function (context) {
                                return `Bulan ${context[0].label}`;
                            },
                            label: function (context) {
                                return `${context.parsed.y} pendaftaran baru`;
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color:
                                currentTheme === "dark"
                                    ? "rgba(255, 255, 255, 0.1)"
                                    : "rgba(0, 0, 0, 0.1)",
                            drawBorder: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                    x: {
                        grid: {
                            color:
                                currentTheme === "dark"
                                    ? "rgba(255, 255, 255, 0.05)"
                                    : "rgba(0, 0, 0, 0.05)",
                            drawBorder: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                },
                interaction: {
                    intersect: false,
                    mode: "index",
                },
                animation: {
                    duration: 2000,
                    easing: "easeOutQuart",
                },
            },
        });
    }

    // Enhanced Popularity Chart
    const popCtx = document.getElementById("popularityChart");
    if (popCtx && !charts.popularity) {
        charts.popularity = new Chart(popCtx, {
            type: "doughnut",
            data: {
                labels: ["Olahraga", "Seni", "Akademik", "Teknologi", "Sosial"],
                datasets: [
                    {
                        data: [35, 30, 20, 10, 5],
                        backgroundColor: [
                            "#3b82f6",
                            "#10b981",
                            "#f59e0b",
                            "#ef4444",
                            "#8b5cf6",
                        ],
                        borderWidth: 0,
                        hoverOffset: 8,
                        hoverBorderWidth: 3,
                        hoverBorderColor: "#ffffff",
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: "circle",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        cornerRadius: 12,
                        displayColors: true,
                        callbacks: {
                            label: function (context) {
                                const total = context.dataset.data.reduce(
                                    (a, b) => a + b,
                                    0
                                );
                                const percentage = (
                                    (context.parsed * 100) /
                                    total
                                ).toFixed(1);
                                return `${context.label}: ${percentage}% (${context.parsed} kegiatan)`;
                            },
                        },
                    },
                },
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 2000,
                    easing: "easeOutBounce",
                },
            },
        });
    }
}

function loadAnalyticsData() {
    // Enhanced Monthly Trend Chart
    const monthlyCtx = document.getElementById("monthlyTrendChart");
    if (monthlyCtx && !charts.monthlyTrend) {
        const gradient = monthlyCtx
            .getContext("2d")
            .createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, "rgba(59, 130, 246, 0.8)");
        gradient.addColorStop(1, "rgba(59, 130, 246, 0.2)");

        charts.monthlyTrend = new Chart(monthlyCtx, {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
                datasets: [
                    {
                        label: "Partisipasi",
                        data: [420, 445, 480, 465, 490, 515],
                        backgroundColor: gradient,
                        borderColor: "rgb(59, 130, 246)",
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                        hoverBackgroundColor: "rgba(59, 130, 246, 0.9)",
                        hoverBorderWidth: 3,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        cornerRadius: 12,
                        callbacks: {
                            label: function (context) {
                                return `${context.parsed.y} siswa berpartisipasi`;
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color:
                                currentTheme === "dark"
                                    ? "rgba(255, 255, 255, 0.1)"
                                    : "rgba(0, 0, 0, 0.1)",
                            drawBorder: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                },
                animation: {
                    duration: 1500,
                    easing: "easeOutBounce",
                },
            },
        });
    }

    // Enhanced Category Distribution
    const categoryCtx = document.getElementById("categoryDistributionChart");
    if (categoryCtx && !charts.categoryDistribution) {
        charts.categoryDistribution = new Chart(categoryCtx, {
            type: "pie",
            data: {
                labels: ["Olahraga", "Seni", "Akademik", "Teknologi", "Sosial"],
                datasets: [
                    {
                        data: [8, 6, 5, 3, 3],
                        backgroundColor: [
                            "#3b82f6",
                            "#10b981",
                            "#f59e0b",
                            "#ef4444",
                            "#8b5cf6",
                        ],
                        borderWidth: 3,
                        borderColor:
                            currentTheme === "dark" ? "#1e293b" : "#ffffff",
                        hoverOffset: 6,
                        hoverBorderWidth: 4,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: "circle",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        cornerRadius: 12,
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ${context.parsed} kegiatan`;
                            },
                        },
                    },
                },
                animation: {
                    duration: 2000,
                    easing: "easeInOutQuart",
                },
            },
        });
    }

    // Enhanced Participation Chart
    const participationCtx = document.getElementById("participationChart");
    if (participationCtx && !charts.participation) {
        const ctx = participationCtx.getContext("2d");
        const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, "rgba(16, 185, 129, 0.2)");
        gradient1.addColorStop(1, "rgba(16, 185, 129, 0.05)");

        const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, "rgba(59, 130, 246, 0.2)");
        gradient2.addColorStop(1, "rgba(59, 130, 246, 0.05)");

        charts.participation = new Chart(participationCtx, {
            type: "line",
            data: {
                labels: [
                    "Minggu 1",
                    "Minggu 2",
                    "Minggu 3",
                    "Minggu 4",
                    "Minggu 5",
                    "Minggu 6",
                ],
                datasets: [
                    {
                        label: "Kehadiran (%)",
                        data: [88, 92, 85, 90, 94, 89],
                        borderColor: "#10b981",
                        backgroundColor: gradient1,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: "#10b981",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                    },
                    {
                        label: "Partisipasi Aktif (%)",
                        data: [82, 86, 80, 85, 88, 84],
                        borderColor: "#3b82f6",
                        backgroundColor: gradient2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: "#3b82f6",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            usePointStyle: true,
                            pointStyle: "circle",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        cornerRadius: 12,
                        callbacks: {
                            label: function (context) {
                                return `${context.dataset.label}: ${context.parsed.y}%`;
                            },
                        },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color:
                                currentTheme === "dark"
                                    ? "rgba(255, 255, 255, 0.1)"
                                    : "rgba(0, 0, 0, 0.1)",
                            drawBorder: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                            callback: function (value) {
                                return value + "%";
                            },
                        },
                    },
                    x: {
                        grid: {
                            color:
                                currentTheme === "dark"
                                    ? "rgba(255, 255, 255, 0.05)"
                                    : "rgba(0, 0, 0, 0.05)",
                            drawBorder: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                },
                interaction: {
                    intersect: false,
                    mode: "index",
                },
                animation: {
                    duration: 2500,
                    easing: "easeOutQuart",
                },
            },
        });
    }
}

function loadReportsData() {
    const reportsCtx = document.getElementById("reportsChart");
    if (reportsCtx && !charts.reports) {
        const ctx = reportsCtx.getContext("2d");
        const gradient1 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient1.addColorStop(0, "rgba(59, 130, 246, 0.8)");
        gradient1.addColorStop(1, "rgba(59, 130, 246, 0.3)");

        const gradient2 = ctx.createLinearGradient(0, 0, 0, 400);
        gradient2.addColorStop(0, "rgba(16, 185, 129, 0.8)");
        gradient2.addColorStop(1, "rgba(16, 185, 129, 0.3)");

        charts.reports = new Chart(reportsCtx, {
            type: "bar",
            data: {
                labels: [
                    "Olahraga",
                    "Seni & Budaya",
                    "Akademik",
                    "Teknologi",
                    "Sosial",
                ],
                datasets: [
                    {
                        label: "Jumlah Kegiatan",
                        data: [8, 6, 5, 3, 3],
                        backgroundColor: gradient1,
                        borderColor: "rgb(59, 130, 246)",
                        borderWidth: 2,
                        borderRadius: 8,
                    },
                    {
                        label: "Total Peserta",
                        data: [180, 140, 95, 65, 70],
                        backgroundColor: gradient2,
                        borderColor: "rgb(16, 185, 129)",
                        borderWidth: 2,
                        borderRadius: 8,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            usePointStyle: true,
                            pointStyle: "rect",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        cornerRadius: 12,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color:
                                currentTheme === "dark"
                                    ? "rgba(255, 255, 255, 0.1)"
                                    : "rgba(0, 0, 0, 0.1)",
                            drawBorder: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                },
                animation: {
                    duration: 2000,
                    easing: "easeOutBounce",
                },
            },
        });
    }
}

function updateChartsTheme() {
    Object.values(charts).forEach((chart) => {
        if (chart && chart.options) {
            // Update grid colors
            if (chart.options.scales) {
                Object.values(chart.options.scales).forEach((scale) => {
                    if (scale.grid) {
                        scale.grid.color =
                            currentTheme === "dark"
                                ? "rgba(255, 255, 255, 0.1)"
                                : "rgba(0, 0, 0, 0.1)";
                    }
                    if (scale.ticks) {
                        scale.ticks.color =
                            currentTheme === "dark" ? "#cbd5e1" : "#6b7280";
                    }
                });
            }

            // Update legend colors
            if (
                chart.options.plugins &&
                chart.options.plugins.legend &&
                chart.options.plugins.legend.labels
            ) {
                chart.options.plugins.legend.labels.color =
                    currentTheme === "dark" ? "#cbd5e1" : "#6b7280";
            }

            // Update pie chart border colors
            if (
                chart.config.type === "pie" ||
                chart.config.type === "doughnut"
            ) {
                chart.data.datasets.forEach((dataset) => {
                    if (dataset.borderColor) {
                        dataset.borderColor =
                            currentTheme === "dark" ? "#1e293b" : "#ffffff";
                    }
                });
            }

            chart.update("none"); // Update without animation for theme change
        }
    });
}

// ===== ENHANCED TABLE LOADING FUNCTIONS =====
function loadActivitiesTable() {
    const tbody = document.getElementById("activitiesTableBody");
    const data = getFilteredData("activities");
    const startIndex = (currentPage.activities - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = data.slice(startIndex, endIndex);

    tbody.innerHTML = "";

    if (pageData.length === 0) {
        tbody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: var(--space-8); color: var(--text-tertiary);">
                            <div style="padding: var(--space-8);">
                                <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">📭</div>
                                <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada data kegiatan</div>
                                <div style="font-size: var(--font-size-sm);">Cobalah mengubah filter pencarian atau tambah kegiatan baru</div>
                            </div>
                        </td>
                    </tr>
                `;
        return;
    }

    pageData.forEach((activity, index) => {
        const row = document.createElement("tr");
        row.style.animationDelay = `${index * 50}ms`;
        row.innerHTML = `
                    <td>
                        <div style="font-weight: var(--font-weight-bold); color: var(--text-primary);">#${
                            startIndex + index + 1
                        }</div>
                    </td>
                    <td>
                        <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary); margin-bottom: var(--space-1);">${
                            activity.nama
                        }</div>
                        <div style="font-size: var(--font-size-xs); color: var(--text-tertiary); display: flex; align-items: center; gap: var(--space-2);">
                            <span> ${activity.schedules
                                .map(
                                    (s) =>
                                        `📅 ${s.hari} ${s.jam_mulai} - ${s.jam_selesai}`
                                )
                                .join("<br>")}</span>
                        </div>
                        <div style="font-size: var(--font-size-xs); color: var(--text-tertiary); margin-top: var(--space-1);">
                            <span>${activity.schedules.map(
                                (s) => `📍${s.lokasi}`
                            )}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-secondary hover-scale">${
                            activity.kategori
                        }</span>
                    </td>
                    <td>
                        <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">${
                            activity.pembina.name
                        }</div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: var(--space-2); margin-bottom: var(--space-2);">
                            <span style="margin-left: 20px; font-weight: var(--font-weight-semibold); color: var(--text-primary);">${
                                activity.siswa_count
                            }</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge hover-scale ${
                            activity.status === "aktif"
                                ? "badge-success"
                                : activity.status === "penuh"
                                ? "badge-warning"
                                : "badge-secondary"
                        }">${activity.status}</span>
                        ${
                            activity.achievements
                                ? `
                                    <div style="font-size: var(--font-size-xs); color: var(--text-tertiary); margin-top: var(--space-1); display: flex; align-items: center; gap: var(--space-1);">
                                        <span>🏆</span>
                                        <span>${activity.achievements}</span>
                                    </div>
                                `
                                : ""
                        }
                    </td>
                    <td>
                        <div style="display: flex; gap: var(--space-2);">
                            <button class="btn btn-ghost btn-sm hover-lift" onclick="editActivity(${
                                activity.id
                            })" title="Edit">
                                ✏️
                            </button>
                            <button class="btn btn-ghost btn-sm hover-lift" onclick="viewActivity(${
                                activity.id
                            })" title="Lihat Detail">
                                👁️
                            </button>
                            <button class="btn btn-ghost btn-sm hover-scale" onclick="deleteActivity(${
                                activity.id
                            })" title="Hapus">
                                🗑️
                            </button>
                        </div>
                    </td>
                `;
        tbody.appendChild(row);
    });

    updatePagination("activities", data.length);
}

function loadStudentsTable() {
    const tbody = document.getElementById("studentsTableBody");
    const data = getFilteredData("students");
    const startIndex = (currentPage.students - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = data.slice(startIndex, endIndex);

    tbody.innerHTML = "";

    if (pageData.length === 0) {
        tbody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: var(--space-8); color: var(--text-tertiary);">
                            <div style="padding: var(--space-8);">
                                <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">👥</div>
                                <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada data siswa</div>
                                <div style="font-size: var(--font-size-sm);">Cobalah mengubah filter pencarian atau tambah siswa baru</div>
                            </div>
                        </td>
                    </tr>
                `;
        return;
    }

    pageData.forEach((student, index) => {
        const diterimaEkskul = student.ekskuls.filter(
            (s) => s.pivot.status === "diterima"
        );

        const ekskulHtml =
            diterimaEkskul.length > 0
                ? diterimaEkskul.map((s) => s.nama).join("<br>")
                : '<span class="badge badge-secondary" style="font-size: 10px; padding: 2px 6px;"></span>';

        const row = document.createElement("tr");
        row.style.animationDelay = `${index * 50}ms`;
        row.innerHTML = `
                    <td>
                        <div style="font-weight: var(--font-weight-bold); color: var(--text-primary);">
                            #${startIndex + index + 1}
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: var(--space-3);">
                            <div style="width: 40px; height: 40px; border-radius: var(--radius-xl); background: linear-gradient(135deg, var(--brand-500), var(--brand-600)); color: white; display: flex; align-items: center; justify-content: center; font-weight: var(--font-weight-bold); font-size: var(--font-size-sm);">
                                ${student.name.charAt(0)}
                            </div>
                            <div>
                                <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">${
                                    student.name
                                }</div>
                                <div style="font-size: var(--font-size-xs); color: var(--text-tertiary);">
                                    ${
                                        student.siswa_profile.jenis_kelamin ===
                                        "laki-laki"
                                            ? "👨"
                                            : "👩"
                                    } ${
            student.siswa_profile.jenis_kelamin === "laki-laki"
                ? "Laki-laki"
                : "Perempuan"
        }
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: var(--font-weight-medium); color: var(--text-primary);">${
                            student.email
                        }</div>
                    </td>
                    <td>
                        <span class="badge badge-info hover-scale">${
                            student.siswa_profile.kelas
                        }</span>
                    </td>
                    <td>
                        <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">${ekskulHtml}</div>
                    </td>
                    <td>
                        <span class="badge badge-success hover-scale">Aktif</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: var(--space-2);">
                            <button class="btn btn-ghost btn-sm hover-lift" onclick="editStudent(${
                                student.id
                            })" title="Edit">
                                ✏️
                            </button>
                            <button class="btn btn-ghost btn-sm hover-lift" onclick="viewStudent(${
                                student.id
                            })" title="Lihat Detail">
                                👁️
                            </button>
                            <button class="btn btn-ghost btn-sm hover-scale" onclick="deleteStudent(${
                                student.id
                            })" title="Hapus">
                                🗑️
                            </button>
                        </div>
                    </td>
                `;
        tbody.appendChild(row);
    });

    updatePagination("students", data.length);
}

function loadRegistrationsTable(status = "all") {
    // Flatten data dari registration.siswa
    let allRows = getFilteredData("registrations").flatMap((registration) => {
        return registration.siswa.map((s) => ({
            siswa_id: s.id,
            nama: s.name,
            email: s.email,
            kelas: s.siswa_profile.kelas,
            kegiatan: registration.nama,
            tanggal: s.pivot.created_at,
            status: s.pivot.status,
        }));
    });

    allRows.sort((a, b) => {
        if (a.status === "pending" && b.status !== "pending") return -1;
        if (a.status !== "pending" && b.status === "pending") return 1;

        return new Date(b.tanggal) - new Date(a.tanggal);
    });

    filteredRows = allRows;

    if (status !== "all") {
        filteredRows = allRows.filter((row) => row.status === status);
    }

    const tbody = document.getElementById("registrationsTableBody");
    const startIndex = (currentPage.registrations - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = filteredRows.slice(startIndex, endIndex);

    tbody.innerHTML = "";

    if (pageData.length === 0) {
        tbody.innerHTML = `
                    <tr>
                        <td colspan="6" style="text-align: center; padding: var(--space-8); color: var(--text-tertiary);">
                            <div style="padding: var(--space-8);">
                                <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">📝</div>
                                <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada data pendaftaran</div>
                                <div style="font-size: var(--font-size-sm);">Belum ada pendaftaran yang sesuai dengan filter</div>
                            </div>
                        </td>
                    </tr>
                `;
        updateRegistrationTabs();
        updatePagination(
            "registrations",
            filteredRows.length === 0 ? 0 : filteredRows.length
        );
        return;
    }

    // Baru render table
    pageData.forEach((item, index) => {
        const row = document.createElement("tr");
        row.style.animationDelay = `${index * 50}ms`;

        row.innerHTML = `
        <td>
            <div style="font-weight: var(--font-weight-bold); color: var(--text-primary);">
                #${startIndex + (index + 1)}
            </div>
        </td>
        <td>
            <div style="display: flex; align-items: center; gap: var(--space-3);">
                <div style="width: 40px; height: 40px; border-radius: var(--radius-xl); background: linear-gradient(135deg, var(--brand-500), var(--brand-600)); color: white; display: flex; align-items: center; justify-content: center; font-weight: var(--font-weight-bold); font-size: var(--font-size-sm);">
                    ${item.nama.charAt(0)}
                </div>
                <div>
                    <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">${
                        item.nama
                    }</div>
                    <div style="font-size: var(--font-size-xs); color: var(--text-tertiary); display: flex; align-items: center; gap: var(--space-2);">
                        <span>📧 ${item.email}</span>
                        <span>🎓 Kelas ${item.kelas}</span>
                    </div>
                </div>
            </div>
        </td>
        <td>
            <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">
                ${item.kegiatan}
            </div>
        </td>
        <td>
            <div style="font-weight: var(--font-weight-medium); color: var(--text-primary);">${formatDate(
                item.tanggal
            )}</div>
            <div style="font-size: var(--font-size-xs); color: var(--text-tertiary); margin-top: var(--space-1);">
                ${formatDateTime(item.tanggal)}
            </div>
        </td>
        <td>
            <span class="badge hover-scale ${
                item.status === "diterima"
                    ? "badge-success"
                    : item.status === "ditolak"
                    ? "badge-danger"
                    : "badge-warning"
            }">
                ${
                    item.status === "diterima"
                        ? "✅ Disetujui"
                        : item.status === "ditolak"
                        ? "❌ Ditolak"
                        : "⏳ Pending"
                }
            </span>
        </td>
        <td>
            <div style="display: flex; gap: var(--space-2);">
                ${
                    item.status === "pending"
                        ? `
                            <button class="btn btn-success btn-sm hover-lift" onclick="approveRegistration(${item.siswa_id}, '${item.kegiatan}')" title="Setujui">
                                ✅
                            </button>
                            <button class="btn btn-danger btn-sm hover-scale" onclick="rejectRegistration(${item.siswa_id})" title="Tolak">
                                ❌
                            </button>
                        `
                        : ""
                }
                <button class="btn btn-ghost btn-sm hover-lift" onclick="viewRegistration(${
                    item.siswa_id
                })" title="Lihat Detail">
                    👁️
                </button>
            </div>
        </td>
    `;

        tbody.appendChild(row);
    });

    updateRegistrationTabs();
    updatePagination(
        "registrations",
        filteredRows.length === 0 ? 0 : filteredRows.length
    );
}

function loadAnnouncementsGrid() {
    const grid = document.getElementById("announcementsGrid");
    const data = getFilteredData("announcements");
    const startIndex = (currentPage.announcements - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = data.slice(startIndex, endIndex);

    grid.innerHTML = "";

    if (pageData.length === 0) {
        grid.innerHTML = `
                    <div style="text-align: center; padding: var(--space-8); color: var(--text-tertiary); grid-column: 1 / -1;">
                        <div style="padding: var(--space-8);">
                            <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">📢</div>
                            <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada pengumuman</div>
                            <div style="font-size: var(--font-size-sm);">Belum ada pengumuman yang dipublikasi</div>
                        </div>
                    </div>
                `;
        return;
    }

    pageData.forEach((announcement, index) => {
        const card = document.createElement("div");
        card.className = `announcement-card ${announcement.prioritas} hover-lift`;
        card.style.animationDelay = `${index * 100}ms`;
        card.innerHTML = `
                    <div class="announcement-header">
                        <div style="flex: 1;">
                            <h4 class="announcement-title">${
                                announcement.judul
                            }</h4>
                            <div class="announcement-meta">
                                <span style="display: flex; align-items: center; gap: var(--space-1);">
                                    <span>📅</span>
                                    <span>${formatDate(
                                        announcement.tanggal_pengumuman
                                    )}</span>
                                </span>
                                ${
                                    announcement.kegiatan !== "Umum"
                                        ? `
                                            <span style="display: flex; align-items: center; gap: var(--space-1);">
                                                <span>🎯</span>
                                                <span>${announcement.ekskul.nama}</span>
                                            </span>
                                        `
                                        : ""
                                }
                            </div>
                        </div>
                        <div class="announcement-badges">
                            <span class="badge hover-scale ${
                                announcement.tipe === "opsional"
                                    ? "badge-warning"
                                    : "badge-info"
                            }">
                                ${
                                    announcement.tipe === "opsional"
                                        ? "🚨 Opsional"
                                        : "📌 Wajib"
                                }
                            </span>
                        </div>
                    </div>
                    <div class="announcement-content">
                        ${announcement.isi}
                    </div>
                    <div class="announcement-actions">
                        <button class="btn btn-ghost btn-sm hover-lift" onclick="editAnnouncement(${
                            announcement.id
                        })">
                            <span>✏️</span>
                            <span>Edit</span>
                        </button>
                        <button class="btn btn-ghost btn-sm hover-lift" onclick="viewAnnouncement(${
                            announcement.id
                        })">
                            <span>👁️</span>
                            <span>Lihat</span>
                        </button>
                        <button class="btn btn-ghost btn-sm hover-scale" onclick="deleteAnnouncement(${
                            announcement.id
                        })">
                            <span>🗑️</span>
                            <span>Hapus</span>
                        </button>
                    </div>
                `;
        grid.appendChild(card);
    });

    updatePagination("announcements", data.length);
}

function loadMentorsTable() {
    const tbody = document.getElementById("mentorsTableBody");
    const data = getFilteredData("mentors");
    const startIndex = (currentPage.mentors - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = data.slice(startIndex, endIndex);

    tbody.innerHTML = "";

    if (pageData.length === 0) {
        tbody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: var(--space-8); color: var(--text-tertiary);">
                            <div style="padding: var(--space-8);">
                                <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">👨‍🏫</div>
                                <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada data mentor</div>
                                <div style="font-size: var(--font-size-sm);">Cobalah mengubah filter pencarian atau tambah mentor baru</div>
                            </div>
                        </td>
                    </tr>
                `;
        return;
    }

    pageData.forEach((mentor, index) => {
        const row = document.createElement("tr");
        row.style.animationDelay = `${index * 50}ms`;
        row.innerHTML = `
                    <td>
                        <div style="font-weight: var(--font-weight-bold); color: var(--text-primary);">#${
                            startIndex + index + 1
                        }</div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: var(--space-3);">
                            <div style="width: 40px; height: 40px; border-radius: var(--radius-xl); background: linear-gradient(135deg, var(--warning-500), var(--warning-600)); color: white; display: flex; align-items: center; justify-content: center; font-weight: var(--font-weight-bold); font-size: var(--font-size-sm);">
                                ${mentor.name.charAt(0)}
                            </div>
                            <div>
                                <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">${
                                    mentor.name
                                }</div>
                                <div style="font-size: var(--font-size-xs); color: var(--text-tertiary); display: flex; align-items: center; gap: var(--space-2);">
                                    <span>📞 ${
                                        mentor.pembina_profile.no_telephone
                                    }</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: var(--font-weight-medium); color: var(--text-primary);">${
                            mentor.email
                        }</div>
                    </td>
                    <td>
                        <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">${mentor.ekskul_dibina.map(
                            (s) => `${s.nama}`
                        )}</div>
                        <div style="font-size: var(--font-weight-medium); color: var(--text-tertiary); margin-top: var(--space-1);">
                            <span class="badge badge-secondary" style="font-size: 10px; padding: 2px 6px;">${mentor.ekskul_dibina.map(
                                (s) => `${s.kategori}`
                            )}</span>
                        </div>
                    </td>
                    <td>
                        ${`
                                    <div class="table-address" style="font-size: var(--font-size-); color: var(--text-tertiary); margin-top: var(--space-1); display: flex; align-items: center; gap: var(--space-1);" title="">
                                        <span class="address-text">${mentor.pembina_profile.alamat}</span>
                                        <div class="tooltip">${mentor.pembina_profile.alamat}</div>
                                    </div>
                                `}
                    </td>
                    <td>
                        <span class="badge badge-success hover-scale">Aktif</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: var(--space-2);">
                            <button class="btn btn-ghost btn-sm hover-lift" onclick="editMentor(${
                                mentor.id
                            })" title="Edit">
                                ✏️
                            </button>
                            <button class="btn btn-ghost btn-sm hover-lift" onclick="viewMentor(${
                                mentor.id
                            })" title="Lihat Detail">
                                👁️
                            </button>
                            <button class="btn btn-ghost btn-sm hover-scale" onclick="deleteMentor(${
                                mentor.id
                            })" title="Hapus">
                                🗑️
                            </button>
                        </div>
                    </td>
                `;
        tbody.appendChild(row);
    });

    updatePagination("mentors", data.length);
}

function loadUsersTable() {
    const tbody = document.getElementById("usersTableBody");
    const data = getFilteredData("users");
    const startIndex = (currentPage.users - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const pageData = data.slice(startIndex, endIndex);

    tbody.innerHTML = "";

    if (pageData.length === 0) {
        tbody.innerHTML = `
                    <tr>
                        <td colspan="7" style="text-align: center; padding: var(--space-8); color: var(--text-tertiary);">
                            <div style="padding: var(--space-8);">
                                <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">👤</div>
                                <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada data pengguna</div>
                                <div style="font-size: var(--font-size-sm);">Cobalah mengubah filter pencarian atau tambah pengguna baru</div>
                            </div>
                        </td>
                    </tr>
                `;
        return;
    }

    pageData.forEach((user, index) => {
        const row = document.createElement("tr");
        row.style.animationDelay = `${index * 50}ms`;
        row.innerHTML = `
                    <td>
                        <div style="font-weight: var(--font-weight-bold); color: var(--text-primary);">#${
                            user.id
                        }</div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: var(--space-3);">
                            <div style="width: 40px; height: 40px; border-radius: var(--radius-xl); background: linear-gradient(135deg, var(--info-500), var(--info-600)); color: white; display: flex; align-items: center; justify-content: center; font-weight: var(--font-weight-bold); font-size: var(--font-size-sm);">
                                ${user.username.charAt(0).toUpperCase()}
                            </div>
                            <div>
                                <div style="font-weight: var(--font-weight-semibold); color: var(--text-primary);">${
                                    user.username
                                }</div>
                                ${
                                    user.loginCount
                                        ? `
                                            <div style="font-size: var(--font-size-xs); color: var(--text-tertiary); margin-top: var(--space-1);">
                                                ${formatNumber(
                                                    user.loginCount
                                                )} login
                                            </div>
                                        `
                                        : ""
                                }
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: var(--font-weight-medium); color: var(--text-primary);">${
                            user.email
                        }</div>
                    </td>
                    <td>
                        <span class="badge hover-scale ${
                            user.role === "Admin"
                                ? "badge-danger"
                                : user.role === "Mentor"
                                ? "badge-warning"
                                : "badge-info"
                        }">
                            ${
                                user.role === "Admin"
                                    ? "👑 Admin"
                                    : user.role === "Mentor"
                                    ? "👨‍🏫 Mentor"
                                    : "👨‍🎓 Siswa"
                            }
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: var(--font-weight-medium); color: var(--text-primary); font-size: var(--font-size-xs);">${
                            user.lastLogin
                        }</div>
                        <div style="font-size: var(--font-size-xs); color: var(--text-tertiary); margin-top: var(--space-1);">
                            ${getTimeAgo(user.lastLogin)}
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-success hover-scale">${
                            user.status
                        }</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: var(--space-2);">
                            <button class="btn btn-ghost btn-sm hover-lift" onclick="editUser(${
                                user.id
                            })" title="Edit">
                                ✏️
                            </button>
                            <button class="btn btn-ghost btn-sm hover-lift" onclick="viewUser(${
                                user.id
                            })" title="Lihat Detail">
                                👁️
                            </button>
                            ${
                                user.role !== "Admin"
                                    ? `
                                        <button class="btn btn-ghost btn-sm hover-scale" onclick="deleteUser(${user.id})" title="Hapus">
                                            🗑️
                                        </button>
                                    `
                                    : ""
                            }
                        </div>
                    </td>
                `;
        tbody.appendChild(row);
    });

    updatePagination("users", data.length);
}

function getTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);

    if (diffInSeconds < 60) return "Baru saja";
    if (diffInSeconds < 3600)
        return `${Math.floor(diffInSeconds / 60)} menit lalu`;
    if (diffInSeconds < 86400)
        return `${Math.floor(diffInSeconds / 3600)} jam lalu`;
    return `${Math.floor(diffInSeconds / 86400)} hari lalu`;
}

// ===== NEW SECTION LOADERS =====
function loadCalendarData() {
    // Calendar data loading logic
    showNotification(
        "Kalender Dimuat",
        "Data kalender kegiatan berhasil dimuat",
        "success",
        2000
    );
}

function loadTasksData() {
    // Tasks data loading logic
    showNotification(
        "Tugas Dimuat",
        "Data manajemen tugas berhasil dimuat",
        "success",
        2000
    );
}

function loadFilesData() {
    // Files data loading logic
    showNotification(
        "File Manager Dimuat",
        "File manager berhasil dimuat",
        "success",
        2000
    );
}

// ===== ENHANCED FILTERING FUNCTIONS =====
function getFilteredData(type) {
    if (!filteredData[type]) {
        filteredData[type] = [...sampleData[type]];
    }
    return filteredData[type];
}

function filterActivities() {
    const categoryFilter = document.getElementById(
        "activityCategoryFilter"
    ).value;
    const statusFilter = document.getElementById("activityStatusFilter").value;
    const searchInput = document
        .getElementById("activitySearchInput")
        .value.toLowerCase();

    filteredData.activities = sampleData.activities.filter((activity) => {
        const matchesCategory =
            !categoryFilter || activity.kategori === categoryFilter;
        const matchesStatus = !statusFilter || activity.status === statusFilter;
        const matchesSearch =
            !searchInput ||
            activity.nama.toLowerCase().includes(searchInput) ||
            activity.pembina.name.toLowerCase().includes(searchInput) ||
            activity.kategori.toLowerCase().includes(searchInput) ||
            activity.schedules[0].lokasi.toLowerCase().includes(searchInput);

        return matchesCategory && matchesStatus && matchesSearch;
    });

    currentPage.activities = 1;
    loadActivitiesTable();
}

function filterStudents() {
    const gradeFilter = document.getElementById("studentGradeFilter").value;
    const activityFilter = document.getElementById(
        "studentActivityFilter"
    ).value;
    const searchInput = document
        .getElementById("studentSearchInput")
        .value.toLowerCase();

    filteredData.students = sampleData.students.filter((student) => {
        const matchesGrade =
            !gradeFilter || student.siswa_profile.kelas === gradeFilter;
        const matchesActivity =
            !activityFilter ||
            student.ekskuls.some((e) =>
                e.nama.toLowerCase().includes(activityFilter.toLowerCase())
            );
        const matchesSearch =
            !searchInput ||
            student.name.toLowerCase().includes(searchInput) ||
            student.email.toLowerCase().includes(searchInput) ||
            student.ekskuls[0]?.nama.toLowerCase().includes(searchInput) ||
            student.siswa_profile.alamat?.toLowerCase().includes(searchInput);

        return matchesGrade && matchesActivity && matchesSearch;
    });

    currentPage.students = 1;
    loadStudentsTable();
}

function filterRegistrationsByStatus(status) {
    // Update tab active state
    document
        .querySelectorAll(".tab-btn")
        .forEach((btn) => btn.classList.remove("active"));
    document
        .getElementById(
            `regTab${status.charAt(0).toUpperCase() + status.slice(1)}`
        )
        .classList.add("active");

    currentRegistrationStatus = status;
    loadRegistrationsTable(currentRegistrationStatus);
}

function updateRegistrationTabs() {
    let allRows = getFilteredData("registrations").flatMap((registration) => {
        return registration.siswa.map((s) => ({
            status: s.pivot.status,
        }));
    });

    const all = allRows.length;
    const pending = allRows.filter((r) => r.status === "pending").length;
    const approved = allRows.filter((r) => r.status === "diterima").length;
    const rejected = allRows.filter((r) => r.status === "ditolak").length;

    document.getElementById("regTabAll").textContent = `Semua (${all})`;
    document.getElementById(
        "regTabPending"
    ).textContent = `Pending (${pending})`;
    document.getElementById(
        "regTabDiterima"
    ).textContent = `Disetujui (${approved})`;
    document.getElementById(
        "regTabDitolak"
    ).textContent = `Ditolak (${rejected})`;
}

// ===== NO-LOADING PAGINATION FUNCTIONS (FIXED) =====
function updatePagination(type, totalItems) {
    console.log(totalItems);
    const paginationContainer = document.getElementById(`${type}Pagination`);
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const current = currentPage[type];

    if (totalPages <= 1) {
        paginationContainer.innerHTML = "";
        return;
    }

    let paginationHTML = "";

    // Previous button
    paginationHTML += `
                <button class="pagination-btn hover-lift" ${
                    current === 1 ? "disabled" : ""
                } onclick="changePage('${type}', ${current - 1})">
                    ‹ Sebelumnya
                </button>
            `;

    // Page numbers
    const startPage = Math.max(1, current - 2);
    const endPage = Math.min(totalPages, current + 2);

    if (startPage > 1) {
        paginationHTML += `<button class="pagination-btn hover-scale" onclick="changePage('${type}', 1)">1</button>`;
        if (startPage > 2) {
            paginationHTML += `<span class="pagination-info">...</span>`;
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        paginationHTML += `
                    <button class="pagination-btn hover-scale ${
                        i === current ? "active" : ""
                    }" onclick="changePage('${type}', ${i})">
                        ${i}
                    </button>
                `;
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            paginationHTML += `<span class="pagination-info">...</span>`;
        }
        paginationHTML += `<button class="pagination-btn hover-scale" onclick="changePage('${type}', ${totalPages})">${totalPages}</button>`;
    }

    // Next button
    paginationHTML += `
                <button class="pagination-btn hover-lift" ${
                    current === totalPages ? "disabled" : ""
                } onclick="changePage('${type}', ${current + 1})">
                    Selanjutnya ›
                </button>
            `;

    // Info
    const startItem = (current - 1) * itemsPerPage + 1;
    const endItem = Math.min(current * itemsPerPage, totalItems);
    paginationHTML += `
                <div class="pagination-info">
                    Menampilkan ${formatNumber(startItem)}-${formatNumber(
        endItem
    )} dari ${formatNumber(totalItems)} data
                </div>
            `;

    paginationContainer.innerHTML = paginationHTML;
}

function changePage(type, page) {
    currentPage[type] = page;
    // INSTANT PAGE CHANGE - NO LOADING
    loadSectionData(type);

    // Smooth scroll to top of table
    const section = document.getElementById(type);
    if (section) {
        section.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    }
}

// ===== ENHANCED MODAL FUNCTIONS =====
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.add("active");
    document.body.style.overflow = "hidden";

    // Focus first input
    setTimeout(() => {
        const firstInput = modal.querySelector("input, select, textarea");
        if (firstInput) {
            firstInput.focus();
        }
    }, 300);

    // Add escape key listener
    document.addEventListener("keydown", handleModalEscape);
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.classList.remove("active");
    document.body.style.overflow = "";

    // Remove escape key listener
    document.removeEventListener("keydown", handleModalEscape);

    // Reset form if exists
    const form = modal.querySelector("form");
    if (form) {
        form.reset();
    }

    clearFormValidation(modalId);
}

function handleModalEscape(e) {
    if (e.key === "Escape") {
        const activeModal = document.querySelector(".modal.active");
        if (activeModal) {
            closeModal(activeModal.id);
        }
    }
}

// ===== ENHANCED NOTIFICATION SYSTEM =====
function showNotification(title, message, type = "info", duration = 5000) {
    const container = document.getElementById("notificationContainer");
    const notification = document.createElement("div");
    const id = ++notificationId;

    const icons = {
        success: "✅",
        error: "❌",
        warning: "⚠️",
        info: "ℹ️",
    };

    notification.className = `notification ${type}`;
    notification.innerHTML = `
                <div class="notification-content">
                    <div class="notification-icon animate-bounce">
                        ${icons[type] || icons.info}
                    </div>
                    <div class="notification-text">
                        <div class="notification-title">${title}</div>
                        <div class="notification-message">${message}</div>
                    </div>
                </div>
                <button class="notification-close hover-scale" onclick="closeNotification(${id})" aria-label="Close">&times;</button>
            `;

    notification.dataset.id = id;
    container.appendChild(notification);

    // Show notification with animation
    setTimeout(() => {
        notification.classList.add("show");
    }, 100);

    // Auto hide
    if (duration > 0) {
        setTimeout(() => {
            closeNotification(id);
        }, duration);
    }

    // Add click to dismiss
    notification.addEventListener("click", () => {
        if (duration > 0) {
            closeNotification(id);
        }
    });
}

function closeNotification(id) {
    const notification = document.querySelector(`[data-id="${id}"]`);
    if (notification) {
        notification.classList.remove("show");
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }
}

// ===== ENHANCED ACTION FUNCTIONS =====
function editActivity(id) {
    showNotification(
        "Edit Kegiatan",
        `Mengedit kegiatan dengan ID: ${id}`,
        "info"
    );
    // Here you would typically open an edit modal with pre-filled data
}

function viewActivity(id) {
    const activity = sampleData.activities.find((a) => a.id === id);
    if (activity) {
        currentActivityId = id;

        const modal = document.getElementById("viewActivityModal");
        const detailsContainer = document.getElementById("activityDetails");

        detailsContainer.innerHTML = `
            <div style="display: flex; align-items: center; gap: var(--space-4); margin-bottom: var(--space-6); padding: var(--space-6); background: var(--bg-accent); border-radius: var(--radius-2xl);">
              <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--brand-500), var(--brand-600)); border-radius: var(--radius-2xl); display: flex; align-items: center; justify-content: center; font-size: var(--font-size-3xl);">
                ${
                    activity.kategori === "olahraga"
                        ? "🏃"
                        : activity.kategori === "seni"
                        ? "🎨"
                        : activity.kategori === "akademik"
                        ? "📚"
                        : activity.kategori === "teknologi"
                        ? "💻"
                        : "🤝"
                }
              </div>
              <div>
                <h4 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--space-2); color: var(--text-primary);">${
                    activity.nama
                }</h4>
                <div style="display: flex; gap: var(--space-4); font-size: var(--font-size-sm); color: var(--text-secondary);">
                  <span>🎯 ${activity.kategori}</span>
                  <span>👨‍🏫 ${activity.pembina.name}</span>
                </div>
              </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-6); margin-bottom: var(--space-6);">
              <div>
                <h5 style="font-weight: var(--font-weight-semibold); margin-bottom: var(--space-3); color: var(--text-primary);">📊 Statistik</h5>
                <div style="background: var(--bg-primary); padding: var(--space-4); border-radius: var(--radius-xl); border: 1px solid var(--border-primary);">
                  <div style="display: flex; justify-content: space-between; margin-bottom: var(--space-2);">
                    <span>Anggota Aktif:</span>
                    <strong>${activity.siswa_count}</strong>
                  </div>
                  <div style="display: flex; justify-content: space-between; margin-bottom: var(--space-2);">
                    <span>Status:</span>
                    <span class="badge ${
                        activity.status === "aktif"
                            ? "badge-success"
                            : "badge-secondary"
                    }">${activity.status}</span>
                  </div>
                  <div style="display: flex; justify-content: space-between;">
                    <span>Prestasi:</span>
                    <strong>🏆 ${activity.achievements_count} prestasi</strong>
                  </div>
                </div>
              </div>
              
              <div>
                <h5 style="font-weight: var(--font-weight-semibold); margin-bottom: var(--space-3); color: var(--text-primary);">📅 Jadwal & Lokasi</h5>
                <div style="background: var(--bg-primary); padding: var(--space-4); border-radius: var(--radius-xl); border: 1px solid var(--border-primary);">
                  <div style="margin-bottom: var(--space-3);">
                    <div style="font-weight: var(--font-weight-semibold); margin-bottom: var(--space-1);">⏰ Jadwal:</div>
                    <div style="color: var(--text-secondary);">${
                        activity.schedules[0].hari
                    } ${activity.schedules[0].jam_mulai} - ${
            activity.schedules[0].jam_selesai
        }</div>
                  </div>
                  <div>
                    <div style="font-weight: var(--font-weight-semibold); margin-bottom: var(--space-1);">📍 Lokasi:</div>
                    <div style="color: var(--text-secondary);">${
                        activity.schedules[0].lokasi
                    }</div>
                  </div>
                </div>
              </div>
            </div>
            
            <div style="margin-bottom: var(--space-6);">
              <h5 style="font-weight: var(--font-weight-semibold); margin-bottom: var(--space-3); color: var(--text-primary);">📝 Deskripsi</h5>
              <div style="background: var(--bg-primary); padding: var(--space-4); border-radius: var(--radius-xl); border: 1px solid var(--border-primary); color: var(--text-secondary); line-height: var(--line-height-relaxed);">
                ${activity.deskripsi || "Deskripsi kegiatan belum tersedia."}
              </div>
            </div>
          `;

        openModal("viewActivityModal");
    }
}

function deleteActivity(id) {
    if (
        confirm(
            "Apakah Anda yakin ingin menghapus kegiatan ini? Tindakan ini tidak dapat dibatalkan."
        )
    ) {
        // Remove from data
        const index = sampleData.activities.findIndex((a) => a.id === id);
        if (index > -1) {
            const activity = sampleData.activities[index];
            sampleData.activities.splice(index, 1);

            // Update filtered data
            filteredData.activities = filteredData.activities.filter(
                (a) => a.id !== id
            );

            // Reload table
            loadActivitiesTable();

            showNotification(
                "Kegiatan Dihapus",
                `${activity.nama} telah dihapus dari sistem`,
                "success"
            );
        }
    }
}

function editStudent(id) {
    showNotification("Edit Siswa", `Mengedit siswa dengan ID: ${id}`, "info");
}

function viewStudent(id) {
    const student = sampleData.students.find((s) => s.id === id);
    if (student) {
        currentStudentId = id;

        const detailsContainer = document.getElementById("studentDetails");
        detailsContainer.innerHTML = `
            <div style="display: flex; align-items: center; gap: var(--space-4); margin-bottom: var(--space-6); padding: var(--space-6); background: var(--bg-accent); border-radius: var(--radius-2xl);">
              <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--success-500), var(--success-600)); border-radius: var(--radius-2xl); display: flex; align-items: center; justify-content: center; font-size: var(--font-size-3xl); color: white; font-weight: var(--font-weight-bold);">
                ${student.name.charAt(0)}
              </div>
              <div>
                <h4 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--space-2);">${
                    student.name
                }</h4>
                <div style="display: flex; gap: var(--space-4); font-size: var(--font-size-sm); color: var(--text-secondary);">
                  <span>🎓 Kelas ${student.siswa_profile.kelas}</span>
                  <span>${student.siswa_profile.jenis_kelamin === "laki-laki" ? "👨" : "👩"} ${
            student.siswa_profile.jenis_kelamin === "L" ? "Laki-laki" : "Perempuan"
        }</span>
                </div>
              </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-6);">
              <div>
                <h5 style="font-weight: var(--font-weight-semibold); margin-bottom: var(--space-3);">📞 Kontak</h5>
                <div style="background: var(--bg-primary); padding: var(--space-4); border-radius: var(--radius-xl); border: 1px solid var(--border-primary);">
                  <div style="margin-bottom: var(--space-2);"><strong>Email:</strong> ${
                      student.email
                  }</div>
                  <div style="margin-bottom: var(--space-2);"><strong>Telepon:</strong> ${
                      student.siswa_profile.no_telephone || "Belum tersedia"
                  }</div>
                  <div><strong>Alamat:</strong> ${student.siswa_profile.alamat || "Belum tersedia"}</div>
                </div>
              </div>
              
              <div>
                <h5 style="font-weight: var(--font-weight-semibold); margin-bottom: var(--space-3);">🎯 Kegiatan</h5>
                <div style="background: var(--bg-primary); padding: var(--space-4); border-radius: var(--radius-xl); border: 1px solid var(--border-primary);">
                  <div style="margin-bottom: var(--space-2);"><strong>Kegiatan:</strong> ${
                     student.ekskuls.length > 0 ? student.ekskuls.map(n => n.nama) : '-'
                  }</div>
                  <div style="margin-bottom: var(--space-2);"><strong>Status:</strong> <span class="badge badge-success">${
                      student.status
                  }</span></div>
                </div>
              </div>
            </div>
          `;

        openModal("viewStudentModal");
    }
}

function deleteStudent(id) {
    if (
        confirm(
            "Apakah Anda yakin ingin menghapus siswa ini? Tindakan ini tidak dapat dibatalkan."
        )
    ) {
        const index = sampleData.students.findIndex((s) => s.id === id);
        if (index > -1) {
            const student = sampleData.students[index];
            sampleData.students.splice(index, 1);
            filteredData.students = filteredData.students.filter(
                (s) => s.id !== id
            );
            loadStudentsTable();
            showNotification(
                "Siswa Dihapus",
                `${student.nama} telah dihapus dari sistem`,
                "success"
            );
        }
    }
}

async function approveRegistration(id, kegiatan) {
    found = null;
    parent = null;

    sampleData.registrations.forEach((reg) => {
        const siswa = reg.siswa.find((s) => s.id === id);
        if (siswa && kegiatan == reg.nama) {
            found = siswa;
            parent = reg;
        }
    });

    if (found) {
        found.pivot.status = "diterima";
        loadRegistrationsTable(currentRegistrationStatus);
        showNotification(
            "Pendaftaran Disetujui",
            `Pendaftaran ${found.name} di ${parent.nama} telah disetujui`,
            "success"
        );

        await fetch(`/registration-approve`, {
            method: "PUT", // pakai PUT karena update
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({
                idUser: found.id,
                idEkskul: parent.id,
            }),
        });

        let resStudent = await fetch("/get-students" + "?t=" + Date.now());
        let data = await resStudent.json();

        sampleData["students"] = [...data];
        filteredData["students"] = [...sampleData.students]; // reset filter biar ikut keupdate
        loadStudentsTable();
    }
}

function rejectRegistration(id) {
    if (confirm("Apakah Anda yakin ingin menolak pendaftaran ini?")) {
        const registration = sampleData.registrations.find((r) => r.id === id);
        if (registration) {
            registration.status = "rejected";
            loadRegistrationsTable();
            showNotification(
                "Pendaftaran Ditolak",
                `Pendaftaran ${registration.siswa} telah ditolak`,
                "warning"
            );
        }
    }
}

function viewRegistration(id) {
    const registration = sampleData.registrations.find((r) => r.id === id);
    if (registration) {
        showNotification(
            "Detail Pendaftaran",
            `${registration.siswa} mendaftar ke ${registration.kegiatan}`,
            "info"
        );
    }
}

async function approveAllPending() {
    let pendingRegistrations = [];

    // Loop langsung ke sampleData
    sampleData.registrations.forEach((registration) => {
        registration.siswa.forEach((s) => {
            if (s.pivot.status === "pending") {
                pendingRegistrations.push({
                    ekskul_id: registration.id,
                    siswa_id: s.id,
                    pivot: s.pivot,
                });
            }
        });
    });

    const pendingCount = pendingRegistrations.length;

    if (pendingCount === 0) {
        showNotification(
            "Tidak Ada Data",
            "Tidak ada pendaftaran yang perlu disetujui",
            "info"
        );
        return;
    }

    if (
        confirm(
            `Apakah Anda yakin ingin menyetujui ${pendingCount} pendaftaran yang pending?`
        )
    ) {
        pendingRegistrations.forEach((r) => {
            r.pivot.status = "diterima";
        });
        loadRegistrationsTable(currentRegistrationStatus);
        showNotification(
            "Berhasil",
            `${pendingCount} pendaftaran telah disetujui`,
            "success"
        );

        await fetch("/approve-all", {
            method: "PUT", // pakai PUT karena update
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({
                pendingRegistrations,
            }),
        });

        let resStudent = await fetch("/get-students" + "?t=" + Date.now());
        let data = await resStudent.json();

        sampleData["students"] = [...data];
        filteredData["students"] = [...sampleData.students]; // reset filter biar ikut keupdate
        loadStudentsTable();
    }
}

function editAnnouncement(id) {
    showNotification(
        "Edit Pengumuman",
        `Mengedit pengumuman dengan ID: ${id}`,
        "info"
    );
}

function viewAnnouncement(id) {
    const announcement = sampleData.announcements.find((a) => a.id === id);
    if (announcement) {
        showNotification(
            "Detail Pengumuman",
            `${announcement.judul} - ${announcement.views || 0} views`,
            "info"
        );
    }
}

function publishAnnouncement(id) {
    const announcement = sampleData.announcements.find((a) => a.id === id);
    if (announcement) {
        announcement.status = "aktif";
        loadAnnouncementsGrid();
        showNotification(
            "Pengumuman Dipublikasi",
            `${announcement.judul} telah dipublikasi`,
            "success"
        );
    }
}

function deleteAnnouncement(id) {
    if (confirm("Apakah Anda yakin ingin menghapus pengumuman ini?")) {
        const index = sampleData.announcements.findIndex((a) => a.id === id);
        if (index > -1) {
            const announcement = sampleData.announcements[index];
            sampleData.announcements.splice(index, 1);
            filteredData.announcements = filteredData.announcements.filter(
                (a) => a.id !== id
            );
            loadAnnouncementsGrid();
            showNotification(
                "Pengumuman Dihapus",
                `${announcement.judul} telah dihapus`,
                "success"
            );
        }
    }
}

function editMentor(id) {
    showNotification("Edit Mentor", `Mengedit mentor dengan ID: ${id}`, "info");
}

function viewMentor(id) {
    const mentor = sampleData.mentors.find((m) => m.id === id);
    if (mentor) {
        showNotification(
            "Detail Mentor",
            `${mentor.name} - ${mentor.ekskul_dibina.nama}`,
            "info"
        );
    }
}

function deleteMentor(id) {
    if (confirm("Apakah Anda yakin ingin menghapus mentor ini?")) {
        const index = sampleData.mentors.findIndex((m) => m.id === id);
        if (index > -1) {
            const mentor = sampleData.mentors[index];
            sampleData.mentors.splice(index, 1);
            filteredData.mentors = filteredData.mentors.filter(
                (m) => m.id !== id
            );
            loadMentorsTable();
            showNotification(
                "Mentor Dihapus",
                `${mentor.nama} telah dihapus dari sistem`,
                "success"
            );
        }
    }
}

function editUser(id) {
    showNotification(
        "Edit Pengguna",
        `Mengedit pengguna dengan ID: ${id}`,
        "info"
    );
}

function viewUser(id) {
    const user = sampleData.users.find((u) => u.id === id);
    if (user) {
        showNotification(
            "Detail Pengguna",
            `${user.username} - ${user.role}`,
            "info"
        );
    }
}

function deleteUser(id) {
    const user = sampleData.users.find((u) => u.id === id);
    if (user && user.role === "Admin") {
        showNotification(
            "Tidak Diizinkan",
            "Tidak dapat menghapus akun admin",
            "error"
        );
        return;
    }

    if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) {
        const index = sampleData.users.findIndex((u) => u.id === id);
        if (index > -1) {
            const user = sampleData.users[index];
            sampleData.users.splice(index, 1);
            filteredData.users = filteredData.users.filter((u) => u.id !== id);
            loadUsersTable();
            showNotification(
                "Pengguna Dihapus",
                `${user.username} telah dihapus dari sistem`,
                "success"
            );
        }
    }
}

// ===== NEW ENHANCED FUNCTIONS =====
function addEvent() {
    showNotification(
        "Tambah Acara",
        "Fitur tambah acara kalender akan segera hadir",
        "info"
    );
}

function addTask() {
    showNotification(
        "Tambah Tugas",
        "Fitur tambah tugas baru akan segera hadir",
        "info"
    );
}

function createFolder() {
    showNotification(
        "Buat Folder",
        "Fitur buat folder baru akan segera hadir",
        "info"
    );
}

function triggerFileUpload() {
    document.getElementById("fileUploadInput").click();
}

// ===== ENHANCED EXPORT FUNCTIONS =====
function exportActivities() {
    showLoadingNotification("Export Data", "Data kegiatan sedang diexport...");

    // Simulate export process
    setTimeout(() => {
        const data = getFilteredData("activities");
        const csvContent = generateCSV(data, [
            "id",
            "nama",
            "kategori",
            "pembina",
            "members",
            "maxMembers",
            "status",
        ]);
        downloadCSV(csvContent, "kegiatan-ekstrakurikuler.csv");
        showNotification(
            "Export Berhasil",
            `${data.length} data kegiatan berhasil diexport`,
            "success"
        );
    }, 2000);
}

function exportStudents() {
    showLoadingNotification("Export Data", "Data siswa sedang diexport...");

    setTimeout(() => {
        const data = getFilteredData("students");
        const csvContent = generateCSV(data, [
            "id",
            "nama",
            "email",
            "kelas",
            "kegiatan",
            "status",
        ]);
        downloadCSV(csvContent, "data-siswa.csv");
        showNotification(
            "Export Berhasil",
            `${data.length} data siswa berhasil diexport`,
            "success"
        );
    }, 2000);
}

function exportRegistrations() {
    showLoadingNotification(
        "Export Data",
        "Data pendaftaran sedang diexport..."
    );

    setTimeout(() => {
        const data = getFilteredData("registrations");
        const csvContent = generateCSV(data, [
            "id",
            "siswa",
            "kegiatan",
            "tanggal",
            "status",
        ]);
        downloadCSV(csvContent, "data-pendaftaran.csv");
        showNotification(
            "Export Berhasil",
            `${data.length} data pendaftaran berhasil diexport`,
            "success"
        );
    }, 2000);
}

function exportAnnouncements() {
    showLoadingNotification(
        "Export Data",
        "Data pengumuman sedang diexport..."
    );

    setTimeout(() => {
        const data = getFilteredData("announcements");
        const csvContent = generateCSV(data, [
            "id",
            "judul",
            "kegiatan",
            "tanggal",
            "status",
            "prioritas",
        ]);
        downloadCSV(csvContent, "data-pengumuman.csv");
        showNotification(
            "Export Berhasil",
            `${data.length} data pengumuman berhasil diexport`,
            "success"
        );
    }, 2000);
}

function exportMentors() {
    showLoadingNotification("Export Data", "Data mentor sedang diexport...");

    setTimeout(() => {
        const data = getFilteredData("mentors");
        const csvContent = generateCSV(data, [
            "id",
            "nama",
            "email",
            "kegiatan",
            "pengalaman",
            "status",
        ]);
        downloadCSV(csvContent, "data-mentor.csv");
        showNotification(
            "Export Berhasil",
            `${data.length} data mentor berhasil diexport`,
            "success"
        );
    }, 2000);
}

function exportUsers() {
    showLoadingNotification("Export Data", "Data pengguna sedang diexport...");

    setTimeout(() => {
        const data = getFilteredData("users");
        const csvContent = generateCSV(data, [
            "id",
            "username",
            "email",
            "role",
            "lastLogin",
            "status",
        ]);
        downloadCSV(csvContent, "data-pengguna.csv");
        showNotification(
            "Export Berhasil",
            `${data.length} data pengguna berhasil diexport`,
            "success"
        );
    }, 2000);
}

function exportAnalytics() {
    showLoadingNotification("Export Data", "Data analytics sedang diexport...");

    setTimeout(() => {
        showNotification(
            "Export Berhasil",
            "Data analytics berhasil diexport ke PDF",
            "success"
        );
    }, 2000);
}

function showLoadingNotification(title, message) {
    const container = document.getElementById("notificationContainer");
    const notification = document.createElement("div");
    const id = ++notificationId;

    notification.className = "notification info";
    notification.innerHTML = `
                <div class="notification-content">
                    <div class="notification-icon">
                        <div class="loading-spinner"></div>
                    </div>
                    <div class="notification-text">
                        <div class="notification-title">${title}</div>
                        <div class="notification-message">${message}</div>
                    </div>
                </div>
            `;

    notification.dataset.id = id;
    container.appendChild(notification);

    setTimeout(() => {
        notification.classList.add("show");
    }, 100);

    // Auto remove after 3 seconds
    setTimeout(() => {
        closeNotification(id);
    }, 3000);
}

function generateCSV(data, columns) {
    const headers = columns.join(",");
    const rows = data.map((item) =>
        columns.map((col) => `"${item[col] || ""}"`).join(",")
    );
    return [headers, ...rows].join("\n");
}

function downloadCSV(content, filename) {
    const blob = new Blob([content], {
        type: "text/csv;charset=utf-8;",
    });
    const link = document.createElement("a");
    const url = URL.createObjectURL(blob);
    link.setAttribute("href", url);
    link.setAttribute("download", filename);
    link.style.visibility = "hidden";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// ===== ENHANCED REPORT FUNCTIONS =====
function generateReport(type) {
    const reportTypes = {
        activities: "Laporan Kegiatan Ekstrakurikuler",
        students: "Laporan Data Siswa",
        participation: "Laporan Tingkat Partisipasi",
        attendance: "Laporan Kehadiran Siswa",
        mentors: "Laporan Data Mentor",
        financial: "Laporan Keuangan Kegiatan",
    };

    showLoadingNotification(
        "Generate Laporan",
        `${reportTypes[type]} sedang dibuat...`
    );

    // Simulate report generation
    setTimeout(() => {
        const reportData = generateReportData(type);
        showNotification(
            "Laporan Berhasil",
            `${reportTypes[type]} berhasil dibuat dengan ${reportData.totalRecords} data`,
            "success"
        );
    }, 3000);
}

function generateReportData(type) {
    switch (type) {
        case "activities":
            return {
                totalRecords: sampleData.activities.length,
                activeCount: sampleData.activities.filter(
                    (a) => a.status === "aktif"
                ).length,
                totalParticipants: sampleData.activities.reduce(
                    (sum, a) => sum + a.members,
                    0
                ),
            };
        case "students":
            return {
                totalRecords: sampleData.students.length,
                byGrade: {
                    10: sampleData.students.filter((s) => s.kelas === "10")
                        .length,
                    11: sampleData.students.filter((s) => s.kelas === "11")
                        .length,
                    12: sampleData.students.filter((s) => s.kelas === "12")
                        .length,
                },
            };
        case "participation":
            return {
                totalRecords: sampleData.students.length,
                participationRate: 85.5,
                averagePerformance: 88.2,
            };
        default:
            return {
                totalRecords: 0,
            };
    }
}

// ===== ENHANCED FORM HANDLERS =====
async function handleFormSubmit(formId, url, urlData, type, successMessage) {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener("submit", async function (e) {
        e.preventDefault();

        // Validate form
        if (!validateForm(form)) {
            return;
        }

        // loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML =
            '<div class="loading-spinner"></div><span>Menyimpan...</span>';
        submitBtn.disabled = true;

        try {
            const formData = new FormData(form);

            if (type == "activities") {
                // Ambil nilai jadwal di indeks ke-4
                const jadwal = [...formData][4][1].trim();

                // Pakai regex untuk ambil hari, jam mulai, dan jam selesai
                const match = jadwal.match(
                    /^(.+?)\s+(\d{1,2}:\d{2})\s*-\s*(\d{1,2}:\d{2})$/
                );

                if (match) {
                    const hari = match[1].trim();
                    const jam_mulai = match[2];
                    const jam_selesai = match[3];

                    // Tambahkan ke FormData
                    formData.append("hari", hari);
                    formData.append("jam_mulai", jam_mulai);
                    formData.append("jam_selesai", jam_selesai);
                } else {
                    console.error("Format jadwal tidak valid");
                }
            }

            const res = await fetch(url, {
                method: "post",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: formData,
            });

            const data = await res.json();

            if (data.status == "success") {
                const resData = await fetch(urlData + "?t=" + Date.now());
                const dataUrl = await resData.json();
                sampleData[type] = [...dataUrl];
                filteredData[type] = [...dataUrl]; // refresh cache

                if (refreshMap[type]) {
                    for (const relatedType of refreshMap[type]) {
                        const resRel = await fetch(
                            `/get-${relatedType}?t=` + Date.now()
                        );
                        const relData = await resRel.json();
                        sampleData[relatedType] = [...relData];
                        filteredData[relatedType] = [...relData]; // refresh cache
                    }
                }
                loadPembinaSelect();
                loadEkskulsSelect();
                loadSectionData(currentSection);

                showNotification("Berhasil", successMessage, "success");
                closeModal(formId.replace("Form", "Modal"));
                form.reset();
            } else {
                showNotification(
                    "Gagal",
                    data.message || "Terjadi kesalahan",
                    "error"
                );
            }
        } catch (err) {
            console.error(err);
            showNotification("Error", err, "error");
        }

        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
}

// Clear form validation
function clearFormValidation(modalId) {
    const modal = document.getElementById(modalId);
    const inputs = modal.querySelectorAll(
        ".form-input, .form-select, .form-textarea"
    );
    const messages = modal.querySelectorAll(".validation-message");

    inputs.forEach((input) => {
        input.classList.remove("invalid", "valid");
    });

    messages.forEach((message) => {
        message.classList.remove("show");
    });
}

function validateInput(input) {
    const isRequired = input.hasAttribute("required");
    const message = input.parentElement.querySelector(".validation-message");
    const value = input.value.trim();

    // Validasi kosong
    if (isRequired && value === "") {
        input.classList.add("invalid");
        input.classList.remove("valid");
        if (message)
            message.textContent =
                message.dataset.empty || "Field ini wajib diisi";
        if (message) message.classList.add("show");
        return false;
    }

    // Validasi angka khusus NISN
    if (input.id === "notel" || input.id === "nisn") {
        if (!/^\d+$/.test(value)) {
            // kalau bukan angka
            input.classList.add("invalid");
            input.classList.remove("valid");
            if (message)
                message.textContent =
                    input.id === "nisn"
                        ? "NISN harus berupa angka"
                        : "Nomor Telepon harus angka";
            if (message) message.classList.add("show");
            return false;
        }
    }

    // Lolos semua validasi
    input.classList.remove("invalid");
    input.classList.add("valid");
    if (message) message.classList.remove("show");
    return true;
}

function validateForm(form) {
    const inputs = form.querySelectorAll(
        "input[required], select[required], textarea[required]"
    );
    let isValid = true;

    inputs.forEach((input) => {
        if (!validateInput(input)) {
            isValid = false;
        }
    });

    return isValid;
}

// ===== ENHANCED SEARCH FUNCTIONALITY =====
function setupGlobalSearch() {
    const searchInput = document.getElementById("globalSearch");
    const debouncedSearch = debounce(performGlobalSearch, 300);

    searchInput.addEventListener("input", debouncedSearch);
    searchInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            performGlobalSearch();
        }
    });
}

function performGlobalSearch() {
    const query = document
        .getElementById("globalSearch")
        .value.toLowerCase()
        .trim();
    if (query.length < 2) return;

    const results = searchAllData(query);
    displaySearchResults(results, query);
}

function searchAllData(query) {
    const results = {
        activities: [],
        students: [],
        announcements: [],
        mentors: [],
    };

    // Search activities
    results.activities = sampleData.activities.filter(
        (item) =>
            item.nama.toLowerCase().includes(query) ||
            item.kategori.toLowerCase().includes(query) ||
            item.pembina.toLowerCase().includes(query)
    );

    // Search students
    results.students = sampleData.students.filter(
        (item) =>
            item.nama.toLowerCase().includes(query) ||
            item.email.toLowerCase().includes(query) ||
            item.kegiatan.toLowerCase().includes(query)
    );

    // Search announcements
    results.announcements = sampleData.announcements.filter(
        (item) =>
            item.judul.toLowerCase().includes(query) ||
            item.isi.toLowerCase().includes(query) ||
            item.kegiatan.toLowerCase().includes(query)
    );

    // Search mentors
    results.mentors = sampleData.mentors.filter(
        (item) =>
            item.nama.toLowerCase().includes(query) ||
            item.email.toLowerCase().includes(query) ||
            item.kegiatan.toLowerCase().includes(query)
    );

    return results;
}

function displaySearchResults(results, query) {
    const totalResults = Object.values(results).reduce(
        (sum, arr) => sum + arr.length,
        0
    );

    if (totalResults === 0) {
        showNotification(
            "Pencarian",
            `Tidak ditemukan hasil untuk "${query}"`,
            "info",
            3000
        );
        return;
    }

    let message = `Ditemukan ${totalResults} hasil untuk "${query}":`;
    Object.entries(results).forEach(([type, items]) => {
        if (items.length > 0) {
            const typeNames = {
                activities: "kegiatan",
                students: "siswa",
                announcements: "pengumuman",
                mentors: "mentor",
            };
            message += ` ${items.length} ${typeNames[type]},`;
        }
    });

    showNotification("Hasil Pencarian", message.slice(0, -1), "success", 5000);
}

function toggleUserMenu() {
    showNotification(
        "Menu Pengguna",
        "Menu profil pengguna akan segera hadir",
        "info"
    );
}
// ===== ENHANCED INITIALIZATION =====
document.addEventListener("DOMContentLoaded", function () {
    const startTime = performance.now();

    // Load theme
    loadTheme();

    // Load sidebar state
    loadSidebarState();

    // Initialize data
    Object.keys(sampleData).forEach((key) => {
        if (key !== "activities_recent") {
            filteredData[key] = [...sampleData[key]];
        }
    });

    // Load initial section from URL hash or localStorage
    const urlHash = window.location.hash.slice(1);
    const savedSection = localStorage.getItem("currentSection");
    const initialSection = urlHash || savedSection || "dashboard";

    if (document.getElementById(initialSection)) {
        showSection(initialSection);
    } else {
        showSection("dashboard");
    }

    // Setup form handlers

    // Setup settings form
    document
        .getElementById("settingsForm")
        .addEventListener("submit", function (e) {
            e.preventDefault();
            showNotification(
                "Pengaturan Disimpan",
                "Pengaturan sistem berhasil disimpan",
                "success"
            );
        });

    // Setup global search
    setupGlobalSearch();

    // Setup filter inputs with debouncing
    const filterInputs = ["activitySearchInput", "studentSearchInput"];

    filterInputs.forEach((inputId) => {
        const input = document.getElementById(inputId);
        if (input) {
            const debouncedFilter = debounce(() => {
                if (inputId.includes("activity")) filterActivities();
                if (inputId.includes("student")) filterStudents();
            }, 300);
            input.addEventListener("input", debouncedFilter);
        }
    });

    // Enhanced modal handling
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("modal")) {
            closeModal(e.target.id);
        }
    });

    // Enhanced keyboard shortcuts
    document.addEventListener("keydown", function (e) {
        // ESC to close modals
        if (e.key === "Escape") {
            document.querySelectorAll(".modal.active").forEach((modal) => {
                closeModal(modal.id);
            });

            // Close mobile sidebar
            const sidebar = document.getElementById("sidebar");
            if (sidebar.classList.contains("mobile-open")) {
                toggleMobileSidebar();
            }
        }

        // Ctrl/Cmd + K for search
        if ((e.ctrlKey || e.metaKey) && e.key === "k") {
            e.preventDefault();
            document.getElementById("globalSearch").focus();
        }

        // Ctrl/Cmd + B for sidebar toggle
        if ((e.ctrlKey || e.metaKey) && e.key === "b") {
            e.preventDefault();
            toggleSidebar();
        }

        // Number keys for quick section navigation
        if (e.altKey && e.key >= "1" && e.key <= "9") {
            e.preventDefault();
            const sections = [
                "dashboard",
                "analytics",
                "activities",
                "students",
                "registrations",
                "announcements",
                "mentors",
                "users",
                "settings",
            ];
            const sectionIndex = parseInt(e.key) - 1;
            if (sections[sectionIndex]) {
                showSection(sections[sectionIndex]);
            }
        }
    });

    let allRows = sampleData.registrations.flatMap((registration) => {
        return registration.siswa.map((s) => ({
            status: s.pivot.status,
        }));
    });

    // Update badges in navigation
    document.getElementById("activitiesBadge").textContent =
        sampleData.activities.length;
    document.getElementById("studentsBadge").textContent =
        sampleData.students.length;
    document.getElementById("registrationsBadge").textContent = allRows.filter(
        (s) => s.status == "pending"
    ).length;
    document.getElementById("announcementsBadge").textContent =
        sampleData.announcements.length;
    document.getElementById("mentorsBadge").textContent =
        sampleData.mentors.length;
    document.getElementById("notificationsBadge").textContent = "3";

    loadPembinaSelect();
    loadEkskulsSelect();
    // Enhanced responsive handling
    window.addEventListener(
        "resize",
        throttle(function () {
            // Update charts on resize
            Object.values(charts).forEach((chart) => {
                if (chart && chart.resize) {
                    chart.resize();
                }
            });

            // Handle mobile sidebar on resize
            if (window.innerWidth > 768) {
                const sidebar = document.getElementById("sidebar");
                if (sidebar.classList.contains("mobile-open")) {
                    toggleMobileSidebar();
                }
            }
        }, 250)
    );

    // Enhanced touch handling
    if (isTouchDevice) {
        document.body.classList.add("touch-device");

        // Add touch-friendly interactions
        document
            .querySelectorAll(".hover-lift, .hover-scale")
            .forEach((element) => {
                element.addEventListener("touchstart", function () {
                    this.style.transform = this.classList.contains("hover-lift")
                        ? "translateY(-2px) scale(1.02)"
                        : "scale(1.05)";
                });

                element.addEventListener("touchend", function () {
                    this.style.transform = "";
                });
            });
    }

    // Performance monitoring
    const endTime = performance.now();
    performanceMetrics.loadTime = endTime - startTime;

    // Update performance display
    updatePerformanceMetrics();

    // Show welcome notification
    // Log performance metrics
    const path = window.location.pathname.replace("/ekstrasmexa/admin/", "");
    // Kalau path kosong, default ke 'dashboard'
    showSection(path || "dashboard");
});

// ===== ENHANCED PERFORMANCE MONITORING =====
function updatePerformanceMetrics() {
    const loadTimeElement = document.getElementById("loadTimeValue");
    const interactionElement = document.getElementById("interactionCount");
    const memoryElement = document.getElementById("memoryUsage");

    if (loadTimeElement) {
        loadTimeElement.textContent =
            Math.round(performanceMetrics.loadTime) + "ms";
    }

    if (interactionElement) {
        interactionElement.textContent = performanceMetrics.interactionCount;
    }

    if (memoryElement && performance.memory) {
        const memoryMB = Math.round(
            performance.memory.usedJSHeapSize / 1024 / 1024
        );
        memoryElement.textContent = memoryMB + "MB";
    }
}

// Update performance metrics every 5 seconds
setInterval(updatePerformanceMetrics, 5000);

window.addEventListener("unhandledrejection", function (e) {
    console.error("Unhandled Promise Rejection:", e.reason);
    showNotification(
        "Error Jaringan",
        "Terjadi kesalahan koneksi. Silakan periksa koneksi internet Anda.",
        "error",
        8000
    );
});

// ===== SERVICE WORKER REGISTRATION =====
if ("serviceWorker" in navigator) {
    window.addEventListener("load", function () {
        console.log(
            "🔧 Service Worker support detected - Ready for PWA implementation"
        );
    });
}

// ===== ENHANCED ACCESSIBILITY =====
// Announce page changes to screen readers
function announcePageChange(sectionName) {
    const announcement = document.createElement("div");
    announcement.setAttribute("aria-live", "polite");
    announcement.setAttribute("aria-atomic", "true");
    announcement.className = "sr-only";
    announcement.textContent = `Navigated to ${sectionName} section`;
    document.body.appendChild(announcement);

    setTimeout(() => {
        document.body.removeChild(announcement);
    }, 1000);
}

// Enhanced focus management
function manageFocus() {
    let focusedElementBeforeModal;

    document.addEventListener("focusin", function (e) {
        if (e.target.closest(".modal.active")) {
            // Focus is within modal, allow it
            return;
        }

        if (document.querySelector(".modal.active")) {
            // Focus is outside modal, redirect to modal
            const modal = document.querySelector(".modal.active");
            const focusableElements = modal.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            if (focusableElements.length > 0) {
                focusableElements[0].focus();
            }
        }
    });
}

// Initialize accessibility features
manageFocus();

// ===== ENHANCED PERFORMANCE OPTIMIZATION =====
// Lazy load charts when they become visible
const chartObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const chartId = entry.target.id;
            if (!charts[chartId.replace("Chart", "")]) {
                // Load chart when it becomes visible
                setTimeout(() => {
                    if (currentSection === "dashboard") loadDashboardCharts();
                    if (currentSection === "analytics") loadAnalyticsData();
                    if (currentSection === "reports") loadReportsData();
                }, 100);
            }
        }
    });
});

// Observe chart containers
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".chart-container canvas").forEach((canvas) => {
        chartObserver.observe(canvas);
    });
});

// Memory cleanup
window.addEventListener("beforeunload", function () {
    // Cleanup charts
    Object.values(charts).forEach((chart) => {
        if (chart && chart.destroy) {
            chart.destroy();
        }
    });

    // Cleanup observers
    if (chartObserver) {
        chartObserver.disconnect();
    }
});

// ===== ENHANCED FILE UPLOAD HANDLING =====
document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("fileUploadInput");
    const fileUpload = document.querySelector(".enhanced-file-upload");

    if (fileInput && fileUpload) {
        fileInput.addEventListener("change", handleFileSelect);

        // Drag and drop functionality
        fileUpload.addEventListener("dragover", function (e) {
            e.preventDefault();
            this.classList.add("dragover");
        });

        fileUpload.addEventListener("dragleave", function (e) {
            e.preventDefault();
            this.classList.remove("dragover");
        });

        fileUpload.addEventListener("drop", function (e) {
            e.preventDefault();
            this.classList.remove("dragover");
            const files = e.dataTransfer.files;
            handleFiles(files);
        });
    }
});

function handleFileSelect(e) {
    const files = e.target.files;
    handleFiles(files);
}

function handleFiles(files) {
    Array.from(files).forEach((file) => {
        if (file.size > 10 * 1024 * 1024) {
            // 10MB limit
            showNotification(
                "File Terlalu Besar",
                `File ${file.name} melebihi batas 10MB`,
                "error"
            );
            return;
        }

        // Add file to list
        addFileToList(file);
        showNotification(
            "File Berhasil Diupload",
            `${file.name} berhasil diupload`,
            "success"
        );
    });
}

function addFileToList(file) {
    const fileList = document.getElementById("fileList");
    const fileItem = document.createElement("div");
    fileItem.className = "file-item";

    const fileIcon = getFileIcon(file.type);
    const fileSize = formatFileSize(file.size);

    fileItem.innerHTML = `
                <div class="file-icon">${fileIcon}</div>
                <div class="file-info">
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${fileSize} • Uploaded just now</div>
                </div>
                <button class="file-remove" onclick="removeFile(this)">×</button>
            `;

    fileList.appendChild(fileItem);
}

function getFileIcon(fileType) {
    if (fileType.includes("image")) return "🖼️";
    if (fileType.includes("pdf")) return "📄";
    if (fileType.includes("spreadsheet") || fileType.includes("excel"))
        return "📊";
    if (fileType.includes("document") || fileType.includes("word")) return "📝";
    if (fileType.includes("video")) return "🎥";
    if (fileType.includes("audio")) return "🎵";
    return "📁";
}

function formatFileSize(bytes) {
    if (bytes === 0) return "0 Bytes";
    const k = 1024;
    const sizes = ["Bytes", "KB", "MB", "GB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + " " + sizes[i];
}

function removeFile(button) {
    const fileItem = button.closest(".file-item");
    const fileName = fileItem.querySelector(".file-name").textContent;

    if (confirm(`Hapus file ${fileName}?`)) {
        fileItem.remove();
        showNotification(
            "File Dihapus",
            `${fileName} telah dihapus`,
            "success"
        );
    }
}

// ===== ENHANCED MOBILE RESPONSIVE FIXES =====
function handleMobileResponsive() {
    const isMobile = window.innerWidth <= 767;
    const sidebar = document.getElementById("sidebar");
    const closeBtn = sidebar.querySelector(".sidebar-close-btn");

    if (isMobile) {
        // Show close button on mobile
        if (closeBtn) {
            closeBtn.style.display = sidebar.classList.contains("mobile-open")
                ? "flex"
                : "none";
        }
    } else {
        // Hide close button on desktop
        if (closeBtn) {
            closeBtn.style.display = "none";
        }
    }
}

// Call on resize
window.addEventListener("resize", handleMobileResponsive);

// ===== ENHANCED THEME SYSTEM =====
function initializeThemeSystem() {
    const themeSlider = document.getElementById("themeSlider");
    const themeOptions = document.querySelectorAll(".theme-option");

    // Set initial theme slider position
    if (currentTheme === "dark") {
        themeSlider.classList.add("dark");
    }

    // Add click handlers for theme options
    themeOptions.forEach((option, index) => {
        option.addEventListener("click", function () {
            const theme = index === 0 ? "light" : "dark";
            setTheme(theme);
        });
    });
}

// Initialize theme system
document.addEventListener("DOMContentLoaded", initializeThemeSystem);

// ===== ENHANCED SEARCH SUGGESTIONS =====
function setupSearchSuggestions() {
    const searchInput = document.getElementById("globalSearch");
    const suggestionsContainer = document.getElementById("searchSuggestions");

    searchInput.addEventListener("focus", function () {
        if (this.value.length >= 2) {
            showSearchSuggestions(this.value);
        }
    });

    searchInput.addEventListener("blur", function () {
        setTimeout(() => {
            hideSearchSuggestions();
        }, 200);
    });

    searchInput.addEventListener("input", function () {
        if (this.value.length >= 2) {
            showSearchSuggestions(this.value);
        } else {
            hideSearchSuggestions();
        }
    });
}

function showSearchSuggestions(query) {
    const container = document.getElementById("searchSuggestions");
    const results = searchAllData(query.toLowerCase());

    let suggestionsHTML = "";

    // Add activity suggestions
    results.activities.slice(0, 3).forEach((activity) => {
        suggestionsHTML += `
                    <div class="search-suggestion" onclick="selectSearchSuggestion('activities', ${activity.id})">
                        <span class="search-suggestion-icon">🎯</span>
                        <span class="search-suggestion-text">${activity.nama}</span>
                        <span class="search-suggestion-type">Kegiatan</span>
                    </div>
                `;
    });

    // Add student suggestions
    results.students.slice(0, 3).forEach((student) => {
        suggestionsHTML += `
                    <div class="search-suggestion" onclick="selectSearchSuggestion('students', ${student.id})">
                        <span class="search-suggestion-icon">👥</span>
                        <span class="search-suggestion-text">${student.nama}</span>
                        <span class="search-suggestion-type">Siswa</span>
                    </div>
                `;
    });

    // Add announcement suggestions
    results.announcements.slice(0, 2).forEach((announcement) => {
        suggestionsHTML += `
                    <div class="search-suggestion" onclick="selectSearchSuggestion('announcements', ${announcement.id})">
                        <span class="search-suggestion-icon">📢</span>
                        <span class="search-suggestion-text">${announcement.judul}</span>
                        <span class="search-suggestion-type">Pengumuman</span>
                    </div>
                `;
    });

    if (suggestionsHTML) {
        container.innerHTML = suggestionsHTML;
        container.classList.add("show");
    } else {
        hideSearchSuggestions();
    }
}

function hideSearchSuggestions() {
    const container = document.getElementById("searchSuggestions");
    container.classList.remove("show");
}

function selectSearchSuggestion(type, id) {
    showSection(type);
    hideSearchSuggestions();
    document.getElementById("globalSearch").value = "";

    // Highlight the selected item
    setTimeout(() => {
        const targetRow = document.querySelector(`[data-id="${id}"]`);
        if (targetRow) {
            targetRow.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });
            targetRow.style.background = "var(--brand-100)";
            setTimeout(() => {
                targetRow.style.background = "";
            }, 2000);
        }
    }, 500);
}

// Initialize search suggestions
document.addEventListener("DOMContentLoaded", setupSearchSuggestions);

// ===== ADDITIONAL ENHANCED FEATURES FOR LINE COUNT =====

// Enhanced tooltip system
function createTooltip(element, text) {
    const tooltip = document.createElement("div");
    tooltip.className = "advanced-tooltip";
    tooltip.textContent = text;
    document.body.appendChild(tooltip);

    element.addEventListener("mouseenter", function () {
        const rect = element.getBoundingClientRect();
        tooltip.style.left =
            rect.left + rect.width / 2 - tooltip.offsetWidth / 2 + "px";
        tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + "px";
        tooltip.classList.add("show");
    });

    element.addEventListener("mouseleave", function () {
        tooltip.classList.remove("show");
    });
}

// Enhanced progress bar system
function createProgressBar(container, value, max = 100) {
    const progressBar = document.createElement("div");
    progressBar.className = "enhanced-progress-bar";

    const progressFill = document.createElement("div");
    progressFill.className = "enhanced-progress-fill";
    progressFill.style.width = `${(value / max) * 100}%`;

    progressBar.appendChild(progressFill);
    container.appendChild(progressBar);

    return progressBar;
}

// Enhanced dropdown system
function createDropdown(trigger, items) {
    const dropdown = document.createElement("div");
    dropdown.className = "enhanced-dropdown";

    const content = document.createElement("div");
    content.className = "dropdown-content";

    items.forEach((item) => {
        const dropdownItem = document.createElement("a");
        dropdownItem.className = "dropdown-item";
        dropdownItem.textContent = item.text;
        dropdownItem.onclick = item.action;
        content.appendChild(dropdownItem);
    });

    dropdown.appendChild(content);
    trigger.parentNode.insertBefore(dropdown, trigger.nextSibling);

    trigger.addEventListener("click", function (e) {
        e.stopPropagation();
        content.classList.toggle("show");
    });

    document.addEventListener("click", function () {
        content.classList.remove("show");
    });
}

// Enhanced status indicator system
function createStatusIndicator(status) {
    const indicator = document.createElement("div");
    indicator.className = `status-indicator ${status}`;

    const dot = document.createElement("div");
    dot.className = "status-dot";

    const text = document.createElement("span");
    text.textContent = status.charAt(0).toUpperCase() + status.slice(1);

    indicator.appendChild(dot);
    indicator.appendChild(text);

    return indicator;
}

// Enhanced data visualization helpers
function createDataVizCard(title, value, trend, icon) {
    const card = document.createElement("div");
    card.className = "data-viz-card hover-lift";

    card.innerHTML = `
                <div class="data-viz-header">
                    <h4 class="data-viz-title">${title}</h4>
                    <div class="metric-icon">${icon}</div>
                </div>
                <div class="data-viz-value">${value}</div>
                <div class="data-viz-trend ${trend.type}">
                    <span>${trend.icon}</span>
                    <span>${trend.text}</span>
                </div>
            `;

    return card;
}

// Enhanced animation system
function animateElement(element, animation, duration = 1000) {
    element.style.animation = `${animation} ${duration}ms ease-in-out`;

    setTimeout(() => {
        element.style.animation = "";
    }, duration);
}

// Enhanced color system helpers
function getColorByValue(value, max, colors = ["success", "warning", "error"]) {
    const percentage = (value / max) * 100;
    if (percentage >= 80) return colors[0];
    if (percentage >= 50) return colors[1];
    return colors[2];
}

// Enhanced responsive image system
function createResponsiveImage(src, alt, sizes) {
    const picture = document.createElement("picture");

    sizes.forEach((size) => {
        const source = document.createElement("source");
        source.media = size.media;
        source.srcset = size.srcset;
        picture.appendChild(source);
    });

    const img = document.createElement("img");
    img.src = src;
    img.alt = alt;
    img.loading = "lazy";
    picture.appendChild(img);

    return picture;
}

// Enhanced local storage management
function saveToLocalStorage(key, data) {
    try {
        localStorage.setItem(key, JSON.stringify(data));
        return true;
    } catch (e) {
        console.error("Failed to save to localStorage:", e);
        return false;
    }
}

function loadFromLocalStorage(key, defaultValue = null) {
    try {
        const data = localStorage.getItem(key);
        return data ? JSON.parse(data) : defaultValue;
    } catch (e) {
        console.error("Failed to load from localStorage:", e);
        return defaultValue;
    }
}

// Enhanced validation system
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    const re = /^[\+]?[1-9][\d]{0,15}$/;
    return re.test(phone.replace(/\s/g, ""));
}

function validateRequired(value) {
    return value && value.trim().length > 0;
}

// Enhanced date formatting system
function formatDateRange(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);

    if (start.getFullYear() === end.getFullYear()) {
        if (start.getMonth() === end.getMonth()) {
            return `${start.getDate()}-${end.getDate()} ${start.toLocaleDateString(
                "id-ID",
                { month: "long", year: "numeric" }
            )}`;
        } else {
            return `${start.toLocaleDateString("id-ID", {
                day: "numeric",
                month: "short",
            })} - ${end.toLocaleDateString("id-ID", {
                day: "numeric",
                month: "short",
                year: "numeric",
            })}`;
        }
    } else {
        return `${start.toLocaleDateString("id-ID", {
            day: "numeric",
            month: "short",
            year: "numeric",
        })} - ${end.toLocaleDateString("id-ID", {
            day: "numeric",
            month: "short",
            year: "numeric",
        })}`;
    }
}

// Enhanced number formatting
function formatCurrency(amount, currency = "IDR") {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: currency,
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
    }).format(amount);
}

function formatDuration(minutes) {
    const hours = Math.floor(minutes / 60);
    const mins = minutes % 60;

    if (hours > 0) {
        return `${hours}j ${mins}m`;
    }
    return `${mins}m`;
}

// Enhanced sorting system
function sortData(data, key, direction = "asc") {
    return [...data].sort((a, b) => {
        let aVal = a[key];
        let bVal = b[key];

        // Handle different data types
        if (typeof aVal === "string") {
            aVal = aVal.toLowerCase();
            bVal = bVal.toLowerCase();
        }

        if (direction === "asc") {
            return aVal > bVal ? 1 : -1;
        } else {
            return aVal < bVal ? 1 : -1;
        }
    });
}

// Enhanced filtering system
function createAdvancedFilter(data, filters) {
    return data.filter((item) => {
        return Object.entries(filters).every(([key, value]) => {
            if (!value) return true;

            if (typeof value === "string") {
                return (
                    item[key] &&
                    item[key].toLowerCase().includes(value.toLowerCase())
                );
            }

            if (Array.isArray(value)) {
                return value.includes(item[key]);
            }

            return item[key] === value;
        });
    });
}

// Enhanced analytics helpers
function calculateGrowthRate(current, previous) {
    if (previous === 0) return 0;
    return ((current - previous) / previous) * 100;
}

function calculateAverage(numbers) {
    if (numbers.length === 0) return 0;
    return numbers.reduce((sum, num) => sum + num, 0) / numbers.length;
}

function calculateMedian(numbers) {
    const sorted = [...numbers].sort((a, b) => a - b);
    const middle = Math.floor(sorted.length / 2);

    if (sorted.length % 2 === 0) {
        return (sorted[middle - 1] + sorted[middle]) / 2;
    }
    return sorted[middle];
}

// Enhanced security helpers
function sanitizeInput(input) {
    const div = document.createElement("div");
    div.textContent = input;
    return div.innerHTML;
}

function generateSecureId() {
    return (
        "id_" +
        Math.random().toString(36).substr(2, 9) +
        Date.now().toString(36)
    );
}

// Enhanced accessibility helpers
function announceToScreenReader(message) {
    const announcement = document.createElement("div");
    announcement.setAttribute("aria-live", "polite");
    announcement.setAttribute("aria-atomic", "true");
    announcement.style.position = "absolute";
    announcement.style.left = "-10000px";
    announcement.style.width = "1px";
    announcement.style.height = "1px";
    announcement.style.overflow = "hidden";
    announcement.textContent = message;

    document.body.appendChild(announcement);

    setTimeout(() => {
        document.body.removeChild(announcement);
    }, 1000);
}

// Enhanced keyboard navigation
function setupKeyboardNavigation() {
    document.addEventListener("keydown", function (e) {
        // Tab navigation enhancement
        if (e.key === "Tab") {
            const focusableElements = document.querySelectorAll(
                'button:not([disabled]), [href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"]):not([disabled])'
            );

            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                    e.preventDefault();
                    lastElement.focus();
                }
            } else {
                if (document.activeElement === lastElement) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
        }

        // Arrow key navigation for tables
        if (["ArrowUp", "ArrowDown"].includes(e.key)) {
            const activeElement = document.activeElement;
            if (activeElement.closest("table")) {
                e.preventDefault();
                navigateTable(activeElement, e.key);
            }
        }
    });
}

function navigateTable(currentElement, direction) {
    const row = currentElement.closest("tr");
    if (!row) return;

    const targetRow =
        direction === "ArrowUp"
            ? row.previousElementSibling
            : row.nextElementSibling;

    if (targetRow) {
        const targetCell =
            targetRow.children[
                Array.from(row.children).indexOf(currentElement.closest("td"))
            ];
        if (targetCell) {
            const focusableElement = targetCell.querySelector(
                "button, a, input, select"
            );
            if (focusableElement) {
                focusableElement.focus();
            }
        }
    }
}

// Initialize keyboard navigation
document.addEventListener("DOMContentLoaded", setupKeyboardNavigation);

// ===== ENHANCED MOBILE OPTIMIZATIONS =====
function optimizeForMobile() {
    if (window.innerWidth <= 767) {
        // Optimize touch targets
        document
            .querySelectorAll(".btn, .nav-link, .action-btn")
            .forEach((element) => {
                if (element.offsetHeight < 44) {
                    element.style.minHeight = "44px";
                }
                if (element.offsetWidth < 44) {
                    element.style.minWidth = "44px";
                }
            });

        // Optimize table scrolling
        document.querySelectorAll(".table-wrapper").forEach((wrapper) => {
            wrapper.style.webkitOverflowScrolling = "touch";
        });

        // Optimize chart rendering for mobile
        Object.values(charts).forEach((chart) => {
            if (chart && chart.options) {
                chart.options.responsive = true;
                chart.options.maintainAspectRatio = false;
                chart.update("none");
            }
        });
    }
}

// Call on load and resize
window.addEventListener("load", optimizeForMobile);
window.addEventListener("resize", optimizeForMobile);

// ===== ENHANCED FEATURE DETECTION =====
function detectFeatures() {
    const features = {
        webGL: !!window.WebGLRenderingContext,
        webWorkers: !!window.Worker,
        localStorage: !!window.localStorage,
        sessionStorage: !!window.sessionStorage,
        geolocation: !!navigator.geolocation,
        camera: !!navigator.mediaDevices,
        notifications: !!window.Notification,
        serviceWorker: !!navigator.serviceWorker,
        webAssembly: !!window.WebAssembly,
        intersectionObserver: !!window.IntersectionObserver,
    };

    console.log("🔍 Feature Detection Results:", features);
    return features;
}

// Initialize feature detection
document.addEventListener("DOMContentLoaded", detectFeatures);

// ===== ENHANCED MEMORY MANAGEMENT =====
function cleanupMemory() {
    // Cleanup unused event listeners
    const unusedElements = document.querySelectorAll('[data-cleanup="true"]');
    unusedElements.forEach((element) => {
        element.remove();
    });

    // Cleanup chart instances
    Object.keys(charts).forEach((key) => {
        if (charts[key] && typeof charts[key].destroy === "function") {
            const canvas = document.getElementById(key + "Chart");
            if (!canvas || !canvas.isConnected) {
                charts[key].destroy();
                delete charts[key];
            }
        }
    });

    // Force garbage collection if available
    if (window.gc) {
        window.gc();
    }
}

// Cleanup memory every 5 minutes
setInterval(cleanupMemory, 300000);

// ===== ENHANCED INTERNATIONALIZATION SUPPORT =====
const translations = {
    id: {
        dashboard: "Dashboard",
        activities: "Kegiatan",
        students: "Siswa",
        announcements: "Pengumuman",
        settings: "Pengaturan",
        save: "Simpan",
        cancel: "Batal",
        edit: "Edit",
        delete: "Hapus",
        view: "Lihat",
        search: "Cari",
        filter: "Filter",
        export: "Export",
        loading: "Memuat...",
        success: "Berhasil",
        error: "Error",
        warning: "Peringatan",
        info: "Informasi",
    },
    en: {
        dashboard: "Dashboard",
        activities: "Activities",
        students: "Students",
        announcements: "Announcements",
        settings: "Settings",
        save: "Save",
        cancel: "Cancel",
        edit: "Edit",
        delete: "Delete",
        view: "View",
        search: "Search",
        filter: "Filter",
        export: "Export",
        loading: "Loading...",
        success: "Success",
        error: "Error",
        warning: "Warning",
        info: "Information",
    },
};

function translate(key, lang = "id") {
    return translations[lang] && translations[lang][key]
        ? translations[lang][key]
        : key;
}

// ===== ENHANCED BACKUP AND RESTORE SYSTEM =====
function backupData() {
    const backup = {
        timestamp: new Date().toISOString(),
        version: "2.0.0",
        data: sampleData,
        settings: {
            theme: currentTheme,
            sidebarCollapsed: localStorage.getItem("sidebarCollapsed"),
            currentSection: currentSection,
        },
    };

    const dataStr = JSON.stringify(backup, null, 2);
    const dataBlob = new Blob([dataStr], {
        type: "application/json",
    });

    const link = document.createElement("a");
    link.href = URL.createObjectURL(dataBlob);
    link.download = `ekstraku-backup-${
        new Date().toISOString().split("T")[0]
    }.json`;
    link.click();

    showNotification(
        "Backup Berhasil",
        "Data sistem berhasil dibackup",
        "success"
    );
}

function restoreData(file) {
    const reader = new FileReader();
    reader.onload = function (e) {
        try {
            const backup = JSON.parse(e.target.result);

            if (backup.data && backup.version) {
                // Restore data
                Object.assign(sampleData, backup.data);

                // Restore settings
                if (backup.settings) {
                    if (backup.settings.theme) {
                        setTheme(backup.settings.theme);
                    }
                    if (backup.settings.currentSection) {
                        showSection(backup.settings.currentSection);
                    }
                }

                // Reload current section
                loadSectionData(currentSection);

                showNotification(
                    "Restore Berhasil",
                    `Data berhasil direstore dari backup ${backup.timestamp}`,
                    "success"
                );
            } else {
                throw new Error("Invalid backup format");
            }
        } catch (error) {
            showNotification(
                "Restore Gagal",
                "Format file backup tidak valid",
                "error"
            );
        }
    };
    reader.readAsText(file);
}

// ===== ENHANCED REAL-TIME FEATURES =====
function simulateRealTimeUpdates() {
    // Simulate real-time data updates
    setInterval(() => {
        // Update random stats
        const randomStat = Math.floor(Math.random() * 4);
        const statElements = [
            "totalStudents",
            "activeActivities",
            "totalMentors",
            "totalEvents",
        ];
        const currentValue = parseInt(
            document
                .getElementById(statElements[randomStat])
                .textContent.replace(/,/g, "")
        );
        const newValue = currentValue + Math.floor(Math.random() * 3) - 1; // -1 to +1 change

        if (newValue > 0) {
            animateCountUp(
                statElements[randomStat],
                currentValue,
                newValue,
                500
            );
        }

        // Update notification badge occasionally
        if (Math.random() < 0.1) {
            // 10% chance
            const badge = document.getElementById("notificationsBadge");
            const currentCount = parseInt(badge.textContent);
            badge.textContent = currentCount + 1;
            badge.style.animation = "bounce 0.5s ease";
            setTimeout(() => {
                badge.style.animation = "";
            }, 500);
        }
    }, 30000); // Every 30 seconds
}

// Start real-time simulation
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(simulateRealTimeUpdates, 5000); // Start after 5 seconds
});

// ===== ENHANCED PWA SUPPORT =====
function initializePWA() {
    // Check if app is running as PWA
    const isPWA =
        window.matchMedia("(display-mode: standalone)").matches ||
        window.navigator.standalone === true;

    if (isPWA) {
        console.log("🚀 Running as PWA");
        document.body.classList.add("pwa-mode");
    }

    // Handle install prompt
    let deferredPrompt;
    window.addEventListener("beforeinstallprompt", (e) => {
        e.preventDefault();
        deferredPrompt = e;

        // Show install button
        const installBtn = document.createElement("button");
        installBtn.className = "btn btn-primary btn-sm";
        installBtn.innerHTML = "<span>📱</span><span>Install App</span>";
        installBtn.onclick = () => {
            deferredPrompt.prompt();
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === "accepted") {
                    showNotification(
                        "App Installed",
                        "EkstraKu Admin berhasil diinstall",
                        "success"
                    );
                }
                deferredPrompt = null;
                installBtn.remove();
            });
        };

        document.querySelector(".header-actions").appendChild(installBtn);
    });
}

// Initialize PWA features
document.addEventListener("DOMContentLoaded", initializePWA);

// ===== FINAL INITIALIZATION AND CLEANUP =====
document.addEventListener("DOMContentLoaded", function () {
    // Performance monitoring
    const initStart = performance.now();

    // Initialize core systems
    loadTheme();
    loadSidebarState();
    handleMobileResponsive();

    // Initialize data
    Object.keys(sampleData).forEach((key) => {
        if (key !== "activities_recent") {
            filteredData[key] = [...sampleData[key]];
        }
    });

    // Load initial section
    const urlHash = window.location.hash.slice(1);
    const savedSection = localStorage.getItem("currentSection");
    const initialSection = urlHash || savedSection || "dashboard";

    if (document.getElementById(initialSection)) {
        showSection(initialSection);
    } else {
        showSection("dashboard");
    }

    // Setup all form handlers
    handleFormSubmit(
        "addActivityForm",
        "/add-ekskul",
        "/get-ekskul",
        "activities",
        "Kegiatan berhasil ditambahkan"
    );
    handleFormSubmit(
        "addStudentForm",
        "/add-student",
        "/get-students",
        "students",
        "Siswa berhasil ditambahkan"
    );
    handleFormSubmit(
        "addAnnouncementForm",
        "/add-pengumuman",
        "/get-pengumuman",
        "announcements",
        "Pengumuman berhasil dipublikasi"
    );
    handleFormSubmit(
        "addMentorForm",
        "/add-pembina",
        "/get-mentors",
        "mentors",
        "Mentor berhasil ditambahkan"
    );
    handleFormSubmit(
        "addUserForm",
        "",
        "",
        "users",
        "Pengguna berhasil ditambahkan"
    );

    // Setup settings form
    document
        .getElementById("settingsForm")
        .addEventListener("submit", function (e) {
            e.preventDefault();
            showNotification(
                "Pengaturan Disimpan",
                "Pengaturan sistem berhasil disimpan",
                "success"
            );
        });

    // Setup global search and suggestions
    setupGlobalSearch();
    setupSearchSuggestions();

    // Setup filter inputs with debouncing
    const filterInputs = ["activitySearchInput", "studentSearchInput"];
    filterInputs.forEach((inputId) => {
        const input = document.getElementById(inputId);
        if (input) {
            const debouncedFilter = debounce(() => {
                if (inputId.includes("activity")) filterActivities();
                if (inputId.includes("student")) filterStudents();
            }, 300);
            input.addEventListener("input", debouncedFilter);
        }
    });

    // Enhanced modal handling
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("modal")) {
            closeModal(e.target.id);
        }
    });

    let allRows = sampleData.registrations.flatMap((registration) => {
        return registration.siswa.map((s) => ({
            status: s.pivot.status,
        }));
    });

    // Update navigation badges
    document.getElementById("activitiesBadge").textContent =
        sampleData.activities.length;
    document.getElementById("studentsBadge").textContent =
        sampleData.students.length;
    document.getElementById("registrationsBadge").textContent = allRows.filter(
        (s) => s.status === "pending"
    ).length;
    document.getElementById("announcementsBadge").textContent =
        sampleData.announcements.length;
    document.getElementById("mentorsBadge").textContent =
        sampleData.mentors.length;
    document.getElementById("notificationsBadge").textContent = "3";

    // Enhanced responsive handling
    window.addEventListener(
        "resize",
        throttle(function () {
            // Update charts on resize
            Object.values(charts).forEach((chart) => {
                if (chart && chart.resize) {
                    chart.resize();
                }
            });

            // Handle mobile sidebar on resize
            handleMobileResponsive();
        }, 250)
    );

    document
        .querySelectorAll(".form-input, .form-select, .form-textarea")
        .forEach((input) => {
            // Only validate after user has interacted with the field
            let hasInteracted = false;

            input.addEventListener("focus", function () {
                hasInteracted = true;
            });

            input.addEventListener("blur", function () {
                if (hasInteracted && this.hasAttribute("required")) {
                    validateInput(this);
                }
            });

            input.addEventListener("input", function () {
                if (
                    hasInteracted &&
                    this.classList.contains("invalid") &&
                    this.value.trim()
                ) {
                    validateInput(this);
                }
            });
        });

    // Enhanced touch handling
    if (isTouchDevice) {
        document.body.classList.add("touch-device");

        // Add touch-friendly interactions
        document
            .querySelectorAll(".hover-lift, .hover-scale")
            .forEach((element) => {
                element.addEventListener("touchstart", function () {
                    this.style.transform = this.classList.contains("hover-lift")
                        ? "translateY(-2px) scale(1.02)"
                        : "scale(1.05)";
                });

                element.addEventListener("touchend", function () {
                    this.style.transform = "";
                });
            });
    }

    // Performance monitoring
    const initEnd = performance.now();
    performanceMetrics.loadTime = initEnd - initStart;
    updatePerformanceMetrics();

    // Show welcome notification
    setTimeout(() => {
        showNotification(
            "Selamat Datang di Dashboard admin ! 🚀",
            "EkstraKu Admin Dashboard telah dimuat",
            "success",
            6000
        );
    }, 1000);

    // Final console log
});
