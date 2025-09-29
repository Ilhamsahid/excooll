// ===== GLOBAL VARIABLES =====
let currentTheme = localStorage.getItem("theme") || "light";
let currentSection = "dashboard";
let notificationId = 0;
let charts = {};
let currentPage = {
    students: 1,
    announcements: 1,
    applications: 1,
    activities: 1,
};

let selectedFiles = [];

let galleryData = [
    {
        type: "image",
        src: "https://images.pexels.com/photos/1752757/pexels-photo-1752757.jpeg",
        title: "Latihan Shooting Drill",
        description:
            "Sesi latihan intensif untuk meningkatkan akurasi shooting para anggota klub basket. Latihan dilakukan dengan berbagai variasi posisi dan jarak.",
        date: "15 Mar 2025",
        author: "Ahmad Surya",
    },
    {
        type: "image",
        src: "https://images.pexels.com/photos/1544966/pexels-photo-1544966.jpeg",
        title: "Team Building Exercise",
        description:
            "Kegiatan team building untuk mempererat kerja sama antar anggota tim. Dilakukan sebelum memulai latihan inti.",
        date: "14 Mar 2025",
        author: "Ahmad Surya",
    },
    {
        type: "video",
        src: "https://images.pexels.com/photos/1752775/pexels-photo-1752775.jpeg",
        title: "Highlight Pertandingan",
        description:
            "Video highlight dari pertandingan friendly match melawan SMAN 8. Tim berhasil menang dengan skor 78-65.",
        date: "13 Mar 2025",
        author: "Ahmad Surya",
    },
    {
        type: "image",
        src: "https://images.pexels.com/photos/1884574/pexels-photo-1884574.jpeg",
        title: "Penyerahan Trophy",
        description:
            "Momen penyerahan trophy juara 1 turnamen basket regional. Kebanggaan untuk seluruh anggota klub basket.",
        date: "10 Mar 2025",
        author: "Ahmad Surya",
    },
    {
        type: "image",
        src: "https://images.pexels.com/photos/2834914/pexels-photo-2834914.jpeg",
        title: "Latihan Defense",
        description:
            "Sesi latihan khusus untuk meningkatkan kemampuan defense. Focus pada positioning dan timing untuk intercept.",
        date: "08 Mar 2025",
        author: "Ahmad Surya",
    },
    {
        type: "image",
        src: "https://images.pexels.com/photos/1510106/pexels-photo-1510106.jpeg",
        title: "Foto Tim Lengkap",
        description:
            "Foto bersama seluruh anggota klub basket beserta para pelatih. Diambil setelah pencapaian juara regional.",
        date: "05 Mar 2025",
        author: "Ahmad Surya",
    },
];
let currentStatus = "all";
let objT = {};
let filteredData = {};
let itemsPerPage = 10;
let currentDate = null;
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let selectedDate = null;

const keyMap = {
    nama: "name",
    email: "email",
    no_tel: "pembina_profile.no_telephone",
    deskripsi: "pembina_profile.deskripsi",
    jenis_kelamin: "pembina_profile.jenis_kelamin",
    alamat: "pembina_profile.alamat",
};

const studentsData = {
    ahmad_rizki: {
        name: "Ahmad Rizki Pratama",
        nisn: "0012345678",
        class: "XI IPA 2",
        email: "ahmad.rizki@student.school.id",
        phone: "+62 812-1234-5678",
        position: "Point Guard",
        status: "Tim Inti",
        attendanceRate: 96,
        totalSessions: 50,
        presentCount: 48,
        lateCount: 2,
        absentCount: 0,
        recentAttendance: [
            {
                date: "2025-03-15",
                status: "present",
                time: "15:25",
                activity: "Latihan Basket Reguler",
            },
            {
                date: "2025-03-14",
                status: "present",
                time: "15:30",
                activity: "Latihan Shooting",
            },
            {
                date: "2025-03-13",
                status: "late",
                time: "15:45",
                activity: "Latihan Fisik",
                notes: "Terlambat 15 menit",
            },
            {
                date: "2025-03-12",
                status: "present",
                time: "15:28",
                activity: "Latihan Taktik",
            },
            {
                date: "2025-03-11",
                status: "present",
                time: "15:30",
                activity: "Latihan Reguler",
            },
        ],
    },
};

// ===== UTILITY FUNCTIONS =====
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}

function formatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleTimeString("id-ID", {
        hour: "2-digit",
        minute: "2-digit",
    });
}

function generateId() {
    return Math.floor(Math.random() * 1000000);
}

// ===== THEME MANAGEMENT =====
function toggleTheme() {
    currentTheme = currentTheme === "light" ? "dark" : "light";
    document.body.setAttribute("data-theme", currentTheme);
    localStorage.setItem("theme", currentTheme);

    const themeIcon = document.getElementById("themeIcon");
    themeIcon.textContent = currentTheme === "light" ? "🌙" : "☀️";

    updateChartsTheme();
    showNotification(
        "Tema Berhasil Diubah",
        `Tema ${
            currentTheme === "light" ? "terang" : "gelap"
        } telah diaktifkan`,
        "success"
    );
}

function loadTheme() {
    document.body.setAttribute("data-theme", currentTheme);
    const themeIcon = document.getElementById("themeIcon");
    themeIcon.textContent = currentTheme === "light" ? "🌙" : "☀️";
}

// ===== SIDEBAR MANAGEMENT =====
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggleIcon = document.getElementById("sidebarToggleIcon");

    sidebar.classList.toggle("collapsed");
    sidebarToggleIcon.textContent = sidebar.classList.contains("collapsed")
        ? "☰"
        : "✕";

    localStorage.setItem(
        "sidebarCollapsed",
        sidebar.classList.contains("collapsed")
    );
}

function toggleMobileSidebar() {
    const sidebar = document.getElementById("sidebar");
    const isOpen = sidebar.classList.contains("mobile-open");

    if (isOpen) {
        sidebar.classList.remove("mobile-open");
        const backdrop = document.querySelector(".mobile-sidebar-backdrop");
        if (backdrop) {
            backdrop.remove();
        }
        document.body.style.overflow = "";
    } else {
        sidebar.classList.add("mobile-open");
        const backdrop = document.createElement("div");
        backdrop.className = "mobile-sidebar-backdrop";
        backdrop.onclick = toggleMobileSidebar;
        document.body.appendChild(backdrop);
        document.body.style.overflow = "hidden";
    }
}

function handleSidebarToggle() {
    if (window.innerWidth <= 768) {
        toggleMobileSidebar();
    } else {
        toggleSidebar();
    }
}

function loadSidebarState() {
    const isCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
    if (isCollapsed) {
        toggleSidebar();
    }
}

function navigate(event, sectionName) {
    event.preventDefault();
    history.pushState(
        { section: sectionName },
        "",
        `/ekstrasmexa/pembina/${sectionName}`
    );

    showSection(sectionName);
}

window.addEventListener("popstate", function (event) {
    if (event.state && event.state.section) {
        showSection(event.state.section);
    }
});

// ===== SECTION MANAGEMENT =====
function showSection(sectionName) {
    // Remove active class from all sections and navigation
    document.querySelectorAll(".content-section").forEach((section) => {
        section.classList.remove("active");
    });

    document.querySelectorAll(".nav-link").forEach((link) => {
        link.classList.remove("active");
    });

    document.querySelectorAll(".mobile-bottom-nav-item").forEach((item) => {
        item.classList.remove("active");
    });

    // Add active class to target section and navigation
    const targetSection = document.getElementById(sectionName);
    if (targetSection) {
        targetSection.classList.add("active");
    }

    document
        .querySelectorAll(`[data-section="${sectionName}"]`)
        .forEach((link) => {
            link.classList.add("active");
        });

    // Update page title and breadcrumb
    const titles = {
        dashboard: "Dashboard Pembina",
        profile: "Profile Pembina",
        calendar: "Calendar - " + pembina.ekskul_dibina[0].nama,
        attendance: "Attendance - " + pembina.ekskul_dibina[0].nama,
        activities: "Activities - " + pembina.ekskul_dibina[0].nama,
        gallery: "Galleries - " + pembina.ekskul_dibina[0].nama,
        announcements: "Announcements - " + pembina.ekskul_dibina[0].nama,
        students: "Students - " + pembina.ekskul_dibina[0].nama,
        applications: "Aplikasi Siswa",
    };

    document.getElementById("pageTitle").textContent =
        titles[sectionName] || "Dashboard";
    document.getElementById("breadcrumb").innerHTML = `
                <span>EkstraKu</span>
                <span class="breadcrumb-separator">/</span>
                <span>${titles[sectionName] || "Dashboard"}</span>
            `;

    currentSection = sectionName;

    // Load section-specific data
    loadSectionData(sectionName);

    // Close mobile sidebar if open
    const sidebar = document.getElementById("sidebar");
    if (sidebar.classList.contains("mobile-open")) {
        toggleMobileSidebar();
    }

    // Store current section
    localStorage.setItem("currentSection", sectionName);
}

// ===== DATA LOADING FUNCTIONS =====
function loadSectionData(sectionName) {
    switch (sectionName) {
        case "dashboard":
            loadDashboardData();
            break;
        case "calendar":
            loadCalendar();
            break;
        case "attendance":
            loadAttendanceChart();
            break;
        case "activities":
            loadActivitiesData();
            break;
        case "announcements":
            loadAnnouncementsData();
            break;
        case "students":
            loadStudentsData();
            break;
        case "applications":
            loadApplicationsData();
            break;
    }
}

function loadDashboardData() {
    // Animate counters with Klub Basket specific data
    document.getElementById(
        "namaDashboard"
    ).innerText = `Selamat Datang, ${pembina.name}! 👋`;
    document.getElementById(
        "deskripsiDashboard"
    ).innerText = `Kelola ekstrakurikuler ${pembina.ekskul_dibina[0].nama} dengan mudah dan pantau perkembangan siswa secara real-time`;
    document.getElementById(
        "cardEkskul"
    ).textContent = `Total siswa ${pembina.ekskul_dibina[0].nama}`;

    animateCounter("totalStudents", pembina.ekskul_dibina[0].siswa_count);
    animateCounter("totalActivities", 12);
    animateCounter("achievements", 7);

    loadDashboardCharts();
}

function animateCounter(elementId, targetValue, duration = 1000) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const startValue = 0;
    const increment = targetValue / (duration / 16);
    let currentValue = startValue;

    const timer = setInterval(() => {
        currentValue += increment;
        if (currentValue >= targetValue) {
            element.textContent = targetValue;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(currentValue);
        }
    }, 16);
}

function loadDashboardCharts() {
    const performanceCtx = document.getElementById("performanceChart");
    if (performanceCtx && !charts.performance) {
        charts.performance = new Chart(performanceCtx, {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
                datasets: [
                    {
                        label: "Tingkat Kehadiran Klub Basket (%)",
                        data: [88, 92, 89, 94, 91, 95],
                        borderColor: "#0d9488",
                        backgroundColor: "rgba(13, 148, 136, 0.1)",
                        tension: 0.4,
                        fill: true,
                    },
                    {
                        label: "Engagement Score (%)",
                        data: [82, 86, 84, 88, 87, 90],
                        borderColor: "#f97316",
                        backgroundColor: "rgba(249, 115, 22, 0.1)",
                        tension: 0.4,
                        fill: true,
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
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                        },
                    },
                    x: {
                        grid: {
                            color:
                                currentTheme === "dark"
                                    ? "rgba(255, 255, 255, 0.05)"
                                    : "rgba(0, 0, 0, 0.05)",
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                        },
                    },
                },
            },
        });
    }
}

function loadAttendanceChart() {
    const attendanceCtx = document.getElementById("attendanceChart");
    if (attendanceCtx && !charts.attendance) {
        charts.attendance = new Chart(attendanceCtx, {
            type: "bar",
            data: {
                labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"],
                datasets: [
                    {
                        label: "Hadir",
                        data: [78, 80, 75, 82, 79, 70, 65],
                        backgroundColor: "#10b981",
                    },
                    {
                        label: "Terlambat",
                        data: [5, 3, 6, 2, 4, 8, 10],
                        backgroundColor: "#f59e0b",
                    },
                    {
                        label: "Tidak Hadir",
                        data: [2, 2, 4, 1, 2, 7, 10],
                        backgroundColor: "#ef4444",
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
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                        ticks: {
                            color:
                                currentTheme === "dark" ? "#cbd5e1" : "#6b7280",
                        },
                    },
                },
            },
        });
    }
}

function loadStudentsData() {
    const body = document.getElementById("loadStudentsGrid");
    const data = filteredData.students != null ? filteredData.students : siswa;
    itemsPerPage = 8;
    body.innerHTML = "";

    //hitung range data
    const start = (currentPage.students - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedData = data.slice(start, end);

    if (paginatedData.length === 0) {
        body.innerHTML = `
                    <div>
                        <div colspan="7" style="text-align: center; padding: var(--space-8); color: var(--text-tertiary);">
                            <div style="padding: var(--space-8);">
                                <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">👥</div>
                                <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada data siswa</div>
                                <div style="font-size: var(--font-size-sm);">Cobalah mengubah filter pencarian atau tambah siswa baru</div>
                            </div>
                        </div>
                    </div>
                `;
        renderPagination("students", paginatedData.length);
        return;
    }

    paginatedData.forEach((student, index) => {
        let studentCard = `
            <div class="student-card">
                <div class="student-header">
                    <div class="student-avatar">AV</div>
                    <div class="student-info">
                        <div class="student-name">${student.name}</div>
                        <div class="student-meta">
                            <span>📚 ${student.siswa_profile.kelas}</span>
                            <span>🆔 ${student.siswa_profile.nisn}</span>
                            ${
                                student.status == "aktif"
                                    ? `<span class="badge badge-success">Aktif</span>`
                                    : `<span class="badge badge-danger">Nonaktif</span>`
                            }
                        </div>
                    </div>
                </div>
                <div style="margin: var(--space-4) 0; font-size: var(--font-size-sm); color: var(--text-secondary);">
                    📧 ${student.email}<br />
                    📞 ${student.siswa_profile.no_telephone ?? "-"}<br />
                    ${
                        student.siswa_profile.jenis_kelamin == "laki-laki"
                            ? "👨 laki-laki"
                            : "👩 perempuan"
                    }<br />
                    📍 ${student.siswa_profile.alamat ?? "-"}
                </div>
                <div class="student-actions">
                    <button class="btn btn-ghost btn-sm" onclick="viewStudentDetail('${
                        student.id
                    }')">
                        👁️ Detail
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="editStudent('${
                        student.id
                    }')">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('${
                        student.id
                    }')">
                        💬 Kontak
                    </button>
                </div>
            </div>

        `;

        body.innerHTML += studentCard;
    });

    renderPagination("students", data.length);
}

function loadApplicationsData(status = "all") {
    const body = document.getElementById("applicationsGrid");
    let data = filteredData.applications
        ? filteredData.applications
        : pendaftaran;
    itemsPerPage = 9;
    body.innerHTML = "";

    realData = data;
    if (status !== "all") {
        data = data.filter((app) => app.pivot.status === status);
    }

    const start = (currentPage.applications - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedData = data.slice(start, end);
    console.log(data);

    if (paginatedData.length == 0) {
        body.innerHTML = `
            <div colspan="6" style="text-align: center; padding: var(--space-8); color: var(--text-tertiary);">
                <div style="padding: var(--space-8);">
                    <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">📝</div>
                    <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada data pendaftaran</div>
                    <div style="font-size: var(--font-size-sm);">Belum ada pendaftaran yang sesuai dengan filter</div>
                </div>
            </div>
        `;
    }

    paginatedData.forEach((application, index) => {
        let status = application.pivot.status;
        let setStatus =
            status == "pending"
                ? "pending"
                : status == "diterima"
                ? "approved"
                : "rejected";
        let setBadge =
            status == "pending"
                ? "warning"
                : status == "diterima"
                ? "success"
                : "danger";

        let applicationCard = `
            <div class="application-card ${setStatus}">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">${application.name}</h4>
                        <div class="application-meta">
                            <span>📧 ${application.email}</span>
                            <span>🎓 Kelas ${
                                application.siswa_profile.kelas
                            }</span>
                            <span>🏀 ${
                                pembina.ekskul_dibina[0].nama ?? "-"
                            }</span>
                            <span>📅 ${application.pivot.created_at.substr(
                                0,
                                10
                            )}</span>
                        </div>
                    </div>
                    <span class="badge badge-${setBadge}">⏳ ${setStatus}</span>
                </div>
                <div class="application-content">
                    <div style="margin-bottom: var(--space-3)">
                        <strong>Alasan bergabung:</strong><br />
                        <p>${
                            application.pivot.alasan ??
                            "Tidak ada alasan bergabung"
                        }</p>
                    </div>
                    <div>
                        <strong>Pengalaman sebelumnya:</strong><br />
                        <p>${
                            application.pivot.exp_before ??
                            "Tidak ada pengalaman sebelumnya"
                        }</p>
                    </div>
                </div>
                <div class="application-actions">
                    <button style="display: ${
                        status == "pending" ? "flex" : "none"
                    }" class="btn btn-success btn-sm" onclick="handleApplication(${
            application.id
        }, 'diterima')">
                        ✅ Setujui
                    </button>
                    <button style="display: ${
                        status == "pending" ? "flex" : "none"
                    }" class="btn btn-danger btn-sm" onclick="handleApplication(${
            application.id
        }, 'ditolak')">
                        ❌ Tolak
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="contactStudent('ahmad_rizki')">
                        💬 Kontak
                    </button>
                </div>
            </div>
        `;

        body.innerHTML += applicationCard;
    });

    updateRegistrationTabs(realData);
    renderPagination("applications", data.length);
}

function loadAnnouncementsData() {
    const body = document.getElementById("loadAnnouncements");
    const data = filteredData.announcements
        ? filteredData.announcements
        : announc;
    itemsPerPage = 9;
    body.innerHTML = "";

    const start = (currentPage.announcements - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedData = data.slice(start, end);

    if (paginatedData.length == 0) {
        body.innerHTML = `
            <div style="text-align: center; padding: var(--space-8); color: var(--text-tertiary); grid-column: 1 / -1;">
                <div style="padding: var(--space-8);">
                    <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">📢</div>
                    <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada pengumuman</div>
                    <div style="font-size: var(--font-size-sm);">Belum ada pengumuman yang dipublikasi</div>
                </div>
            </div>
        `;
        renderPagination("announcements", data.length);
        return;
    }

    paginatedData.forEach((announc, index) => {
        let announcCard = `
            <div class="application-card">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            ${announc.judul}
                        </h4>
                        <div class="application-meta">
                            <span>📅 ${formatDate(
                                announc.tanggal_pengumuman
                            )}</span>
                            <span>🏀 ${pembina.ekskul_dibina[0].nama}</span>
                        </div>
                    </div>
                    <span class="badge badge-success">📢 ${announc.tipe}</span>
                </div>
                <div class="application-content">
                    <p>
                        ${announc.isi}
                    </p>
                </div>
                <div class="application-actions">
                    <button class="btn btn-ghost btn-sm" onclick="editAnnouncement(${
                        announc.id
                    })">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewAnnouncementStats(${
                        announc.id
                    })">
                        📊 Detail
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="deleteAnnouncement(${
                        announc.id
                    })">
                        🗑️ Delete
                    </button>
                </div>
            </div>
        `;

        body.innerHTML += announcCard;
    });

    renderPagination("announcements", data.length);
}

function loadActivitiesData() {
    const body = document.getElementById("loadActivitiesGrid");
    const data = filteredData.activities ? filteredData.activities : kegiatan;

    itemsPerPage = 9;
    body.innerHTML = "";

    const start = (currentPage.activities - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedData = data.slice(start, end);

    if (paginatedData.length == 0) {
        body.innerHTML = `
            <div style="text-align: center; padding: var(--space-8); color: var(--text-tertiary); grid-column: 1 / -1;">
                <div style="padding: var(--space-8);">
                    <div style="font-size: var(--font-size-4xl); margin-bottom: var(--space-4); opacity: 0.5;">🎪</div>
                    <div style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--space-2);">Tidak ada kegiatan</div>
                    <div style="font-size: var(--font-size-sm);">Belum ada kegiatan yang dipublikasi</div>
                </div>
            </div>
        `;
        renderPagination("activities", data.length);
        return;
    }

    paginatedData.forEach((activity, index) => {
        const setStatus =
            activity.status == "upcoming"
                ? "📅 Akan Datang"
                : activity.status == "ongoing"
                ? "🔄 Sedang Berlangsung"
                : "✅ Selesai";
        const setBadge =
            activity.status == "upcoming"
                ? "warning"
                : activity.status == "ongoing"
                ? "info"
                : "success";
        const setButton =
            activity.status == "upcoming"
                ? "▶️ Mulai"
                : activity.status == "ongoing"
                ? "⏹️ Selesai"
                : "🔗 Bagikan";
        const setButtonCss =
            activity.status == "upcoming"
                ? "success"
                : activity.status == "ongoing"
                ? "warning"
                : "ghost";

        let activityCard = `
            <div class="application-card ${
                activity.status == "done" ? "approved" : ""
            }">
                <div class="application-header">
                    <div>
                        <h4 class="application-student">
                            ${activity.judul}
                        </h4>
                        <div class="application-meta">
                            <span>🎯 ${pembina.ekskul_dibina[0].nama}</span>
                            <span>📅 ${formatDate(activity.tanggal)}</span>
                            <span>⏰ ${activity.jam_mulai} - ${
            activity.jam_selesai
        }</span>
                            <span>📍 ${activity.lokasi}</span>
                        </div>
                    </div>
                    <span class="badge badge-${setBadge}">${setStatus}</span>
                </div>
                <div class="application-content">
                    <p>
                        ${activity.deskripsi}
                    </p>
                </div>
                <div class="application-actions">
                    <button style="display: ${
                        activity.status == "ongoing" ||
                        activity.status == "done"
                            ? "none"
                            : "block"
                    }" class="btn btn-ghost btn-sm" onclick="editActivity(${
            activity.id
        })">
                        ✏️ Edit
                    </button>
                    <button class="btn btn-ghost btn-sm" onclick="viewActivityDetails(${
                        activity.id
                    })">
                        👁️ Detail
                    </button>
                    <button style="display: ${
                        activity.status == "done" ? "block" : "none"
                    }" class="btn btn-ghost btn-sm" onclick="viewActivityDetails(${
            activity.id
        })">
                        📷 Galeri
                    </button>
                    <button style="display: ${
                        activity.status == "ongoing" ||
                        activity.status == "done"
                            ? "none"
                            : "block"
                    }" class="btn btn-ghost btn-sm" onclick="deleteActivity(${
            activity.id
        })">
                        🗑️ Hapus
                    </button>
                    <button class="btn btn-${setButtonCss} btn-sm" onclick="handleActivity(${
            activity.id
        })">
                        ${setButton}
                    </button>
                </div>
            </div>
        `;

        body.innerHTML += activityCard;
    });

    renderPagination("activities", data.length);
}

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

function renderPagination(type, totalItems) {
    const pagination = document.getElementById(`${type}Pagination`);
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    const current = currentPage[type];

    if (totalPages <= 1) {
        pagination.innerHTML = "";
        return;
    }

    let paginationHTML = "";

    paginationHTML += `
        <button class="pagination-btn hover-lift" ${
            current === 1 ? "disabled" : ""
        } onclick="changePage('${type}', ${current - 1})">
            ‹ Sebelumnya
        </button>
    `;

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

    paginationHTML += `
        <button class="pagination-btn hover-lift" ${
            current === totalPages ? "disabled" : ""
        } onclick="changePage('${type}', ${current + 1})">
            Selanjutnya ›
        </button>
    `;

    const startItem = (current - 1) * itemsPerPage + 1;
    const endItem = Math.min(current * itemsPerPage, totalItems);
    paginationHTML += `
            <div class="pagination-info">
                Menampilkan ${formatNumber(startItem)}-${formatNumber(
        endItem
    )} dari ${formatNumber(totalItems)} data
            </div>
    `;

    pagination.innerHTML = paginationHTML;
}

async function handleApplication(id, status) {
    const idx = pendaftaran.findIndex((p) => p.id === id);
    let siswaDaftar = pendaftaran[idx];

    // perubahan front end
    siswaDaftar.pivot.status = status;
    showNotification(
        "Pendaftaran Berhasil",
        "Pendaftaran telah disetujui",
        "success"
    );
    loadApplicationsData(currentStatus);
    if (status === "diterima") siswa.unshift(siswaDaftar);

    // perubahan back end
    await fetch(`/pendaftaran/${status}`, {
        method: "PUT", // pakai PUT karena update
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            idUser: id,
            idEkskul: pembina.ekskul_dibina[0].id,
        }),
    });
}

function formatNumber(num) {
    return new Intl.NumberFormat("id-ID").format(num);
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

function updateChartsTheme() {
    Object.values(charts).forEach((chart) => {
        if (chart && chart.options) {
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

            if (
                chart.options.plugins &&
                chart.options.plugins.legend &&
                chart.options.plugins.legend.labels
            ) {
                chart.options.plugins.legend.labels.color =
                    currentTheme === "dark" ? "#cbd5e1" : "#6b7280";
            }

            chart.update("none");
        }
    });
}

// ===== ENHANCED CALENDAR FUNCTIONS =====
function loadCalendar() {
    generateCalendar(currentMonth, currentYear);

    currentDate = currentDate
        ? currentDate
        : new Date().toISOString().split("T")[0];
    showSchedulesForDate(currentDate);
}

function generateCalendar(month, year) {
    const monthNames = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];

    // Update calendar title
    document.getElementById(
        "currentMonth"
    ).textContent = `${monthNames[month]} ${year}`;

    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const firstDayWeek = firstDay.getDay();
    const daysInMonth = lastDay.getDate();

    let calendarDays = document.getElementById("calendarDays");
    if (!calendarDays) {
        calendarDays = document.createElement("div");
        calendarDays.id = "calendarDays";
        calendarDays.style.gridColumn = "1 / -1";
        calendarDays.style.display = "contents";
        document.querySelector(".calendar-grid").appendChild(calendarDays);
    }
    calendarDays.innerHTML = "";

    // Add empty cells for days before the first day of the month
    for (let i = 0; i < firstDayWeek; ) {
        const emptyDay = document.createElement("div");
        emptyDay.className = "calendar-day other-month";
        const prevMonth = month === 0 ? 11 : month - 1;
        const prevYear = month === 0 ? year - 1 : year;
        const prevMonthLastDay = new Date(prevYear, prevMonth + 1, 0).getDate();
        emptyDay.textContent = prevMonthLastDay - firstDayWeek + i + 1;
        calendarDays.appendChild(emptyDay);
        i++;
    }

    // Add days of the current month
    const today = new Date();
    for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement("div");
        dayElement.className = "calendar-day";
        dayElement.textContent = day;

        const currentDate = new Date(year, month, day);
        const dateString = `${year}-${String(month + 1).padStart(
            2,
            "0"
        )}-${String(day).padStart(2, "0")}`;

        // Check if it's today
        if (currentDate.toDateString() === today.toDateString()) {
            dayElement.classList.add("today");
        }

        // Check if there are schedules for this date
        if (ekskulSchedules[dateString]) {
            dayElement.classList.add("has-schedule");
        }

        dayElement.onclick = () => selectDate(dateString, dayElement);
        calendarDays.appendChild(dayElement);
    }

    // Add empty cells for days after the last day of the month
    const totalCells = Math.ceil((firstDayWeek + daysInMonth) / 7) * 7;
    const remainingCells = totalCells - (firstDayWeek + daysInMonth);
    for (let i = 1; i <= remainingCells; i++) {
        const emptyDay = document.createElement("div");
        emptyDay.className = "calendar-day other-month";
        emptyDay.textContent = i;
        calendarDays.appendChild(emptyDay);
    }
}

function selectDate(dateString, dayElement) {
    // Remove previous selection
    document.querySelectorAll(".calendar-day").forEach((day) => {
        day.classList.remove("selected");
    });

    // Add selection to clicked date
    dayElement.classList.add("selected");
    selectedDate = dateString;
    currentDate = selectedDate;

    // Show schedules for selected date
    showSchedulesForDate(dateString);
}

function showSchedulesForDate(dateString) {
    const schedules = ekskulSchedules[dateString];
    const scheduleContainer = document.getElementById("selectedDateSchedule");

    if (schedules) {
        const formattedDate = formatDate(dateString);
        const dayName = new Date(dateString).toLocaleDateString("id-ID", {
            weekday: "long",
        });

        scheduleContainer.innerHTML = `
                    <h4 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); margin-bottom: var(--space-6); color: var(--text-primary);">
                        📅 Jadwal ${dayName}, ${formattedDate}
                    </h4>
                    <div class="schedule-cards">
                        ${schedules
                            .map(
                                (schedule) => `
                            <div class="schedule-card">
                                <div class="schedule-time">${schedule.jam_mulai} - ${schedule.jam_selesai}</div>
                                <div class="schedule-activity">${schedule.judul}</div>
                                <div class="schedule-location">📍 ${schedule.lokasi}</div>
                                <div class="schedule-participants">👥 ${pembina.ekskul_dibina[0].siswa_count} siswa terdaftar • ${schedule.present} hadir</div>
                                <div class="schedule-actions">
                                    <button class="btn btn-ghost btn-sm" onclick="editSchedule(${schedule.id})" title="Edit Jadwal">✏️</button>
                                    <button class="btn btn-ghost btn-sm" onclick="takeAttendance(${schedule.id})" title="Catat Absensi">✅</button>
                                    <button class="btn btn-ghost btn-sm" onclick="viewScheduleDetails(${schedule.id})" title="Lihat Detail">👁️</button>
                                    <button class="btn btn-ghost btn-sm" onclick="deleteSchedule(${schedule.id})" title="Hapus Jadwal">🗑️</button>
                                </div>
                            </div>
                        `
                            )
                            .join("")}
                    </div>
                `;
    } else {
        const formattedDate = formatDate(dateString);
        const dayName = new Date(dateString).toLocaleDateString("id-ID", {
            weekday: "long",
        });

        scheduleContainer.innerHTML = `
                    <h4 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); margin-bottom: var(--space-6); color: var(--text-primary);">
                        📅 Jadwal ${dayName}, ${formattedDate}
                    </h4>
                    <div style="text-align: center; padding: var(--space-8); color: var(--text-secondary);">
                        <div style="font-size: var(--font-size-6xl); margin-bottom: var(--space-4);">📅</div>
                        <h3 style="margin-bottom: var(--space-2);">Tidak Ada Jadwal</h3>
                        <p>Belum ada kegiatan yang dijadwalkan untuk tanggal ini.</p>
                        <button class="btn btn-primary" style="margin-top: var(--space-4);" onclick="addSchedule('scheduleModal')">
                            ➕ Tambah Jadwal
                        </button>
                    </div>
                `;
    }
}

function previousMonth() {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    generateCalendar(currentMonth, currentYear);
}

function nextMonth() {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    generateCalendar(currentMonth, currentYear);
}

function goToToday() {
    const today = new Date();
    currentMonth = today.getMonth();
    currentYear = today.getFullYear();
    generateCalendar(currentMonth, currentYear);

    // Auto-select today
    const todayString = today.toISOString().split("T")[0];
    setTimeout(() => {
        const todayElement = document.querySelector(".calendar-day.today");
        if (todayElement) {
            selectDate(todayString, todayElement);
        }
    }, 100);
}

// ===== FILTER FUNCTIONS =====
function filterAttendance(status) {
    // Remove active class from all buttons
    document.querySelectorAll('[id^="attendance"]').forEach((btn) => {
        btn.classList.remove("active");
    });

    // Add active class to clicked button
    const targetBtn = document.getElementById(
        "attendance" + status.charAt(0).toUpperCase() + status.slice(1)
    );
    if (targetBtn) {
        targetBtn.classList.add("active");
    }

    // Filter attendance cards
    const cards = document.querySelectorAll(".attendance-card");
    cards.forEach((card) => {
        const statusElement = card.querySelector(".attendance-status");
        if (status === "all") {
            card.style.display = "block";
        } else {
            const cardStatus =
                statusElement && statusElement.classList.contains(status);
            card.style.display = cardStatus ? "block" : "none";
        }
    });

    showSection("attendance");
}

function viewAttendanceProfile(studentId) {
    const student = studentsData[studentId];
    if (!student) {
        showNotification("Error", "Data siswa tidak ditemukan", "error");
        return;
    }

    const content = document.getElementById("attendanceProfileContent");
    content.innerHTML = `
          <div style="text-align: center; margin-bottom: var(--space-6);">
            <div style="width: 80px; height: 80px; border-radius: var(--radius-2xl); background: linear-gradient(135deg, var(--primary-600), var(--primary-500)); display: flex; align-items: center; justify-content: center; color: white; font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin: 0 auto var(--space-4); box-shadow: var(--shadow-lg);">
              ${student.name
                  .split(" ")
                  .map((n) => n[0])
                  .join("")}
            </div>
            <h3 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--text-primary); margin-bottom: var(--space-2);">
              ${student.name}
            </h3>
            <p style="color: var(--text-secondary); margin-bottom: var(--space-4);">
              ${student.class} • ${student.nisn} • ${student.position}
            </p>
            <span class="badge badge-${
                student.status === "Tim Inti"
                    ? "success"
                    : student.status === "Reserve"
                    ? "warning"
                    : "primary"
            }">${student.status}</span>
          </div>

          <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: var(--space-3); margin-bottom: var(--space-6);">
            <div class="stat-card success" style="padding: var(--space-3); margin: 0;">
              <div class="stat-number" style="font-size: var(--font-size-xl);">${
                  student.attendanceRate
              }%</div>
              <div class="stat-label" style="font-size: var(--font-size-xs);">Tingkat Kehadiran</div>
            </div>
            <div class="stat-card" style="padding: var(--space-3); margin: 0;">
              <div class="stat-number" style="font-size: var(--font-size-xl);">${
                  student.presentCount
              }</div>
              <div class="stat-label" style="font-size: var(--font-size-xs);">Total Hadir</div>
            </div>
            <div class="stat-card warning" style="padding: var(--space-3); margin: 0;">
              <div class="stat-number" style="font-size: var(--font-size-xl);">${
                  student.lateCount
              }</div>
              <div class="stat-label" style="font-size: var(--font-size-xs);">Terlambat</div>
            </div>
            <div class="stat-card error" style="padding: var(--space-3); margin: 0;">
              <div class="stat-number" style="font-size: var(--font-size-xl);">${
                  student.absentCount
              }</div>
              <div class="stat-label" style="font-size: var(--font-size-xs);">Tidak Hadir</div>
            </div>
          </div>

          <div style="margin-bottom: var(--space-6);">
            <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); margin-bottom: var(--space-4); color: var(--text-primary);">
              📊 Riwayat Absensi Terbaru
            </h4>
            <div style="max-height: 300px; overflow-y: auto;">
              ${student.recentAttendance
                  .map(
                      (record) => `
                <div class="activity-item" style="margin-bottom: var(--space-2);">
                  <div class="activity-icon" style="width: 40px; height: 40px; font-size: var(--font-size-sm);">
                    ${
                        record.status === "present"
                            ? "✅"
                            : record.status === "late"
                            ? "⏰"
                            : "❌"
                    }
                  </div>
                  <div class="activity-content">
                    <div class="activity-title">${record.activity}</div>
                    <div class="activity-description">
                      ${formatDate(record.date)} • ${
                          record.time || "Tidak hadir"
                      }
                      ${record.notes ? ` • ${record.notes}` : ""}
                    </div>
                    <div class="activity-time">
                      <span class="badge badge-${
                          record.status === "present"
                              ? "success"
                              : record.status === "late"
                              ? "warning"
                              : "danger"
                      }">
                        ${
                            record.status === "present"
                                ? "HADIR"
                                : record.status === "late"
                                ? "TERLAMBAT"
                                : "TIDAK HADIR"
                        }
                      </span>
                    </div>
                  </div>
                </div>
              `
                  )
                  .join("")}
            </div>
          </div>

          <div style="display: flex; gap: var(--space-4); justify-content: center; margin-top: var(--space-6);">
            <button class="btn btn-primary" onclick="editAttendanceRecord('${studentId}')">
              ✏️ Edit Absensi
            </button>
            <button class="btn btn-secondary" onclick="contactStudent('${studentId}')">
              💬 Kontak Siswa
            </button>
          </div>
        `;

    openModal("attendanceProfileModal");
}

function editAttendanceRecord(studentId) {
    const student = studentsData[studentId];
    if (!student) {
        showNotification("Error", "Data siswa tidak ditemukan", "error");
        return;
    }

    // Close attendance profile modal if open
    closeModal("attendanceProfileModal");

    // Populate edit form with student data
    document.getElementById("editStudentName").value = student.name;
    document.getElementById("editAttendanceDate").value = new Date()
        .toISOString()
        .split("T")[0];
    document.getElementById("editActivityName").value =
        "Latihan Basket Reguler";

    // Get current attendance status from the most recent record
    const latestRecord = student.recentAttendance[0];
    if (latestRecord) {
        document.getElementById("editAttendanceStatus").value =
            latestRecord.status;
        document.getElementById("editArrivalTime").value =
            latestRecord.time || "";
        document.getElementById("editAttendanceNotes").value =
            latestRecord.notes || "";

        if (latestRecord.status === "late" && latestRecord.time) {
            const scheduledTime = new Date(`2025-03-15 15:30:00`);
            const arrivalTime = new Date(`2025-03-15 ${latestRecord.time}:00`);
            const lateMinutes = Math.max(
                0,
                (arrivalTime - scheduledTime) / (1000 * 60)
            );
            document.getElementById("editLateMinutes").value =
                Math.round(lateMinutes);
        }
    }

    // Store student ID for form submission
    document.getElementById("editAttendanceForm").dataset.studentId = studentId;

    openModal("editAttendanceModal");
}

function viewActivityDetails(activityId) {
    const activity = activitiesData[activityId];
    if (!activity) {
        showNotification("Error", "Data kegiatan tidak ditemukan", "error");
        return;
    }

    const content = document.getElementById("activityDetailsContent");
    content.innerHTML = `
          <div style="margin-bottom: var(--space-6);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--space-4); flex-wrap: wrap; gap: var(--space-3);">
              <div>
                <h3 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--text-primary); margin-bottom: var(--space-2);">
                  ${activity.name}
                </h3>
                <div style="display: flex; gap: var(--space-3); flex-wrap: wrap; margin-bottom: var(--space-3);">
                  <span class="badge badge-primary">${activity.category}</span>
                  <span class="badge badge-info">${activity.level}</span>
                  <span class="badge badge-${
                      activity.status === "completed"
                          ? "success"
                          : activity.status === "ongoing"
                          ? "warning"
                          : "gray"
                  }">${activity.status.toUpperCase()}</span>
                </div>
              </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-4); margin-bottom: var(--space-6);">
              <div>
                <strong>📅 Tanggal:</strong><br>
                ${activity.date}
              </div>
              <div>
                <strong>⏰ Waktu:</strong><br>
                ${activity.time}
              </div>
              <div>
                <strong>📍 Lokasi:</strong><br>
                ${activity.location}
              </div>
              <div>
                <strong>👥 Peserta:</strong><br>
                ${activity.participants} siswa
              </div>
              <div>
                <strong>💰 Budget:</strong><br>
                ${activity.budget}
              </div>
              <div>
                <strong>👨‍🏫 PIC:</strong><br>
                ${activity.pic}
              </div>
            </div>

            <div style="margin-bottom: var(--space-6);">
              <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); margin-bottom: var(--space-3); color: var(--text-primary);">
                📝 Deskripsi Kegiatan
              </h4>
              <p style="color: var(--text-secondary); line-height: var(--line-height-relaxed);">
                ${activity.description}
              </p>
            </div>

            ${
                activity.requirements
                    ? `
              <div style="margin-bottom: var(--space-6);">
                <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); margin-bottom: var(--space-3); color: var(--text-primary);">
                  📋 Persyaratan
                </h4>
                <ul style="color: var(--text-secondary); padding-left: var(--space-4);">
                  ${activity.requirements
                      .map(
                          (req) =>
                              `<li style="margin-bottom: var(--space-1);">${req}</li>`
                      )
                      .join("")}
                </ul>
              </div>
            `
                    : ""
            }

            ${
                activity.schedule
                    ? `
              <div style="margin-bottom: var(--space-6);">
                <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); margin-bottom: var(--space-3); color: var(--text-primary);">
                  ⏰ Jadwal Kegiatan
                </h4>
                <div style="display: grid; gap: var(--space-2);">
                  ${activity.schedule
                      .map(
                          (item) => `
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: var(--space-3); background: var(--bg-accent); border-radius: var(--radius-lg);">
                      <span style="font-weight: var(--font-weight-semibold); color: var(--primary-600);">${item.time}</span>
                      <span style="color: var(--text-secondary);">${item.activity}</span>
                    </div>
                  `
                      )
                      .join("")}
                </div>
              </div>
            `
                    : ""
            }

            ${
                activity.result
                    ? `
              <div style="margin-bottom: var(--space-6);">
                <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); margin-bottom: var(--space-3); color: var(--text-primary);">
                  🏆 Hasil Pertandingan
                </h4>
                <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: var(--space-3);">
                  <div class="stat-card success" style="padding: var(--space-3); margin: 0;">
                    <div class="stat-number" style="font-size: var(--font-size-xl);">${
                        activity.result.score
                    }</div>
                    <div class="stat-label" style="font-size: var(--font-size-xs);">Skor Final</div>
                  </div>
                  <div class="stat-card" style="padding: var(--space-3); margin: 0;">
                    <div class="stat-number" style="font-size: var(--font-size-xl);">${
                        activity.result.mvp
                    }</div>
                    <div class="stat-label" style="font-size: var(--font-size-xs);">MVP</div>
                  </div>
                  <div class="stat-card secondary" style="padding: var(--space-3); margin: 0;">
                    <div class="stat-number" style="font-size: var(--font-size-xl);">${
                        activity.result.audience
                    }</div>
                    <div class="stat-label" style="font-size: var(--font-size-xs);">Penonton</div>
                  </div>
                </div>
                ${
                    activity.highlights
                        ? `
                  <div style="margin-top: var(--space-4);">
                    <strong>📈 Highlights:</strong>
                    <ul style="margin-top: var(--space-2); color: var(--text-secondary); padding-left: var(--space-4);">
                      ${activity.highlights
                          .map(
                              (highlight) =>
                                  `<li style="margin-bottom: var(--space-1);">${highlight}</li>`
                          )
                          .join("")}
                    </ul>
                  </div>
                `
                        : ""
                }
              </div>
            `
                    : ""
            }

            ${
                activity.materials
                    ? `
              <div style="margin-bottom: var(--space-6);">
                <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); margin-bottom: var(--space-3); color: var(--text-primary);">
                  📚 Materi Workshop
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--space-3);">
                  ${activity.materials
                      .map(
                          (material) => `
                    <div style="padding: var(--space-3); background: var(--bg-accent); border-radius: var(--radius-lg); text-align: center;">
                      <span style="color: var(--text-secondary);">${material}</span>
                    </div>
                  `
                      )
                      .join("")}
                </div>
              </div>
            `
                    : ""
            }

            <div style="display: flex; gap: var(--space-4); justify-content: center; margin-top: var(--space-8); flex-wrap: wrap;">
              <button class="btn btn-primary" onclick="editActivity('${activityId}')">
                ✏️ Edit Kegiatan
              </button>
              ${
                  activity.status === "upcoming"
                      ? `
                <button class="btn btn-success" onclick="startActivity('${activityId}')">
                  ▶️ Mulai Kegiatan
                </button>
              `
                      : ""
              }
              ${
                  activity.status === "ongoing"
                      ? `
                <button class="btn btn-warning" onclick="endActivity('${activityId}')">
                  ⏹️ Selesaikan
                </button>
              `
                      : ""
              }
              <button class="btn btn-secondary" onclick="shareActivity('${activityId}')">
                🔗 Bagikan
              </button>
            </div>
          </div>
        `;

    openModal("activityDetailsModal");
}

function openLightbox(index) {
    currentLightboxIndex = index;
    const modal = document.getElementById("lightboxModal");
    const data = galleryData[index];

    // Update content
    document.getElementById("lightboxTitle").textContent = data.title;
    document.getElementById("lightboxDescription").textContent =
        data.description;
    document.getElementById(
        "lightboxMeta"
    ).textContent = `📅 ${data.date} • 👤 ${data.author}`;
    document.getElementById("lightboxCounter").textContent = `${index + 1} / ${
        galleryData.length
    }`;

    // Show appropriate media
    const image = document.getElementById("lightboxImage");
    const video = document.getElementById("lightboxVideo");

    if (data.type === "image") {
        image.src = data.src;
        image.style.display = "block";
        video.style.display = "none";
    } else if (data.type === "video") {
        video.src = data.src;
        video.style.display = "block";
        image.style.display = "none";
    }

    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeLightbox() {
    const modal = document.getElementById("lightboxModal");
    modal.classList.remove("active");
    document.body.style.overflow = "";

    // Pause video if playing
    const video = document.getElementById("lightboxVideo");
    if (video.style.display !== "none") {
        video.pause();
    }
}

function previousMedia() {
    if (currentLightboxIndex > 0) {
        openLightbox(currentLightboxIndex - 1);
    }
}

function nextMedia() {
    if (currentLightboxIndex < galleryData.length - 1) {
        openLightbox(currentLightboxIndex + 1);
    }
}

function deleteActivity(activityId) {
    const activity = kegiatan.find((k) => k.id === activityId);

    getElementValue(
        ["nameObject", "deleteObjectName"],
        ["Apakah Anda yakin ingin menghapus kegiatan ini?", activity.judul]
    );

    openModal("deleteModal");

    const form = document.getElementById("deleteForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(
            activityId,
            form,
            `/kegiatan`,
            "DELETE",
            kegiatan,
            "activities"
        );
    };
}

async function handleActivity(activityId) {
    const activity = kegiatan.find((a) => a.id == activityId);

    // perubahan front end
    if (activity.status == "upcoming") {
        activity.status = "ongoing";
    } else if (activity.status == "ongoing") {
        activity.status = "done";
    }

    showNotification(
        `Kegiatan ${activity.status == "ongoing" ? "Dimulai" : "Selesai"}`,
        `Kegiatan dengan nama ${
            activity.status == "ongoing"
                ? `${activity.judul} telah dimulai`
                : `${activity.judul} telah selesai`
        }`,
        "info"
    );

    loadActivitiesData();

    // Perubahan Backend
    await fetch(`/kegiatan/${activity.status}`, {
        method: "PUT", // pakai PUT karena update
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
        },
        body: JSON.stringify({
            id: activityId,
            status: activity.status,
        }),
    });
}

function filterActivities() {
    const statusFilterActivity = document.getElementById(
        "activityStatusFilter"
    ).value;
    const searchTerm = document
        .getElementById("activitySearchInput")
        .value.toLowerCase();

    filteredData.activities = kegiatan.filter((activity) => {
        const statusFilter =
            statusFilterActivity === "" ||
            activity.status === statusFilterActivity;

        const matchSearch =
            searchTerm === "" ||
            activity.judul.toLowerCase().includes(searchTerm);

        return statusFilter && matchSearch;
    });

    currentPage.activities = 1;
    loadActivitiesData();
}

function filterStudents() {
    const classFilter = document.getElementById("studentClassFilter").value;
    const statusFilter = document.getElementById("studentStatusFilter").value;
    const searchTerm = document
        .getElementById("studentSearchInput")
        .value.toLowerCase();

    filteredData.students = siswa.filter((student) => {
        const matchClass =
            classFilter === "" || student.siswa_profile.kelas === classFilter;

        const matchStatus =
            statusFilter === "" || student.status === statusFilter;

        const matchSearch =
            searchTerm === "" ||
            student.name.toLowerCase().includes(searchTerm) ||
            student.siswa_profile.nisn.includes(searchTerm);

        return matchClass && matchStatus && matchSearch;
    });

    currentPage.students = 1;
    loadStudentsData();
}

function filterApplications(status) {
    let tempStatus =
        status == "diterima"
            ? "approved"
            : status == "ditolak"
            ? "rejected"
            : status;
    // Remove active class from all buttons
    document.querySelectorAll('#applications [id^="app"]').forEach((btn) => {
        btn.classList.remove("active");
    });

    // Add active class to clicked button
    document
        .getElementById(
            "app" + tempStatus.charAt(0).toUpperCase() + tempStatus.slice(1)
        )
        .classList.add("active");

    // Filter application cards
    currentPage.applications = 1;
    currentStatus = status;

    loadApplicationsData(status);
}

function updateRegistrationTabs(registrations) {
    const all = registrations.length;
    const pending = registrations.filter(
        (r) => r.pivot.status === "pending"
    ).length;
    const approved = registrations.filter(
        (r) => r.pivot.status === "diterima"
    ).length;
    const rejected = registrations.filter(
        (r) => r.pivot.status === "ditolak"
    ).length;

    document.getElementById("appAll").textContent = `Semua (${all})`;
    document.getElementById("appPending").textContent = `Pending (${pending})`;
    document.getElementById(
        "appApproved"
    ).textContent = `Disetujui (${approved})`;
    document.getElementById(
        "appRejected"
    ).textContent = `Ditolak (${rejected})`;

    getElementValue(
        ["statusAll", "statusPending", "statusApproved", "statusRejected"],
        [all, pending, approved, rejected]
    );
}

// ===== MODAL FUNCTIONS =====
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add("active");
        document.body.style.overflow = "hidden";

        // Set current date for attendance modal
        if (modalId === "attendanceModal") {
            const today = new Date().toISOString().split("T")[0];
            document.getElementById("attendanceDate").value = today;
        }

        setTimeout(() => {
            const firstInput = modal.querySelector("input, select, textarea");
            if (firstInput) {
                firstInput.focus();
            }
        }, 300);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove("active");
        document.body.style.overflow = "";

        const form = modal.querySelector("form");
        if (form) {
            form.reset();
        }

        // Reset attendance buttons
        if (modalId === "attendanceModal") {
            document
                .querySelectorAll(
                    '[id^="present_"], [id^="late_"], [id^="absent_"]'
                )
                .forEach((btn) => {
                    btn.style.opacity = "0.5";
                    btn.style.transform = "scale(1)";
                });
        }
    }
}

function editProfileModal(modalName) {
    getElementValue(
        [
            "nameProfileForm",
            "jkProfile",
            "noTelProfileForm",
            "emailProfileForm",
            "alamatProfileForm",
            "deskripsiProfileForm",
        ],
        [
            pembina.name,
            pembina.pembina_profile.jenis_kelamin,
            pembina.pembina_profile.no_telephone,
            pembina.email,
            pembina.pembina_profile.alamat,
            pembina.pembina_profile.deskripsi,
        ]
    );

    openModal(modalName);

    const form = document.getElementById("profileForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(pembina.id, form, `/pembina`, "PUT", null, "profile");
    };
}

function addSchedule(modalName) {
    const today = new Date().toISOString().split("T")[0]; // "2025-09-18"
    const date = selectedDate ? selectedDate : today;
    getElementValue(["tanggal"], [date]);

    openModal(modalName);

    const form = document.getElementById("scheduleForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(
            null,
            form,
            `/jadwal`,
            "POST",
            ekskulSchedules,
            "schedules"
        );
    };
}

function addStudent(modalName) {
    openModal(modalName);

    const form = document.getElementById("studentForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(null, form, `/siswa`, "POST", siswa, "siswa");
    };
}

function addAnnouncement(modalName) {
    openModal(modalName);

    const form = document.getElementById("announcementForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(
            null,
            form,
            `/pengumuman`,
            "POST",
            announc,
            "pengumuman"
        );
    };
}

function addActivity(modalName) {
    openModal(modalName);

    const form = document.getElementById("activityForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(null, form, `/kegiatan`, "POST", kegiatan, "kegiatan");
    };
}

function handleAnnouncementSubmit(event) {
    event.preventDefault();
    showNotification(
        "Pengumuman Dipublikasi",
        "Pengumuman klub basket berhasil dipublikasi",
        "success"
    );
    closeModal("announcementModal");
}

function handleActivitySubmit(event) {
    event.preventDefault();
    showNotification(
        "Kegiatan Dibuat",
        "Kegiatan klub basket berhasil dibuat",
        "success"
    );
    closeModal("activityModal");
}

function handleAttendanceSubmit(event) {
    event.preventDefault();
    showNotification(
        "Absensi Disimpan",
        "Data absensi klub basket berhasil disimpan",
        "success"
    );
    closeModal("attendanceModal");
}

function handleStudentSubmit(event) {
    event.preventDefault();
    showNotification(
        "Siswa Ditambahkan",
        "Siswa baru berhasil ditambahkan ke klub basket",
        "success"
    );
    closeModal("addStudentModal");
}

function handleQuickAnnouncementSubmit(event) {
    event.preventDefault();
    showNotification(
        "Pengumuman Dipublikasi",
        "Pengumuman cepat berhasil dipublikasi",
        "success"
    );
    closeModal("createAnnouncementModal");
}

async function handleFormSubmit(id, form, url, method, obj, type) {
    if (!form) return;

    if (id) url += `/${id}`;

    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    try {
        const formData = new FormData(form);
        const keyOfData = [...formData.keys()];
        const valueOfData = [...formData].map((item) => item[1]);
        const fullForm = Object.fromEntries(formData.entries());
        const dataObj = {
            id: id,
            keys: keyOfData,
            value: valueOfData,
            entries: fullForm,
        };

        if (type == "profile") updatePembinaFromForm(formData, pembina);
        let originalMethod = method;
        if (["PUT", "PATCH", "DELETE"].includes(method)) {
            formData.append("_method", method);
            formData.append("id", id);
            if (type == "profile") formData.append("status", "aktif");
            method = "POST";
        }

        updateLocalData(dataObj, type, obj, originalMethod);
        closeModal(form.getAttribute("id").replace("Form", "Modal"));
        loadSectionData(currentSection);
        showNotification(
            "Berhasil",
            "selamat pembina berhasil diperbarui",
            "success"
        );

        const res = await fetch(url, {
            method,
            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
                Accept: "application/json", // <-- tambahin ini
            },
            body: formData,
        });

        if (!res.ok) {
            const errorData = await res.json().catch(() => ({}));
            // tampilkan error lebih rapi
            console.group("🚨 Error dari Laravel");
            console.error("Pesan :", errorData.message || "Tidak ada pesan");
            console.error("Exception :", errorData.exception || "-");
            console.error("File :", errorData.file || "-");
            console.error("Line :", errorData.line || "-");
            console.groupEnd();
            return;
        }

        const data = await res.json();

        if (data.status == "success") {
            if (originalMethod != "DELETE" && type != "schedules") {
                sync(obj, data.item, originalMethod);
            }
        }
    } catch (e) {
        console.log(e);
    }
}

function sync(obj, data, method) {
    if (method == "PUT") {
        idx = obj.findIndex((o) => o.id == objT.id);
        obj[idx] = data;
    } else if (method == "POST") {
        obj[0] = data;
    }
    loadSectionData(currentSection);
}

// fungsi set nested path (ga bikin object baru kalau udah ada)
function setNested(obj, path, value) {
    const keys = path.split(".");
    let current = obj;

    for (let i = 0; i < keys.length - 1; i++) {
        const k = keys[i];
        if (!(k in current)) current[k] = {};
        current = current[k];
    }

    current[keys[keys.length - 1]] = value;
}

// update pembina langsung dari FormData
function updatePembinaFromForm(formData, pembina) {
    for (const [key, value] of formData.entries()) {
        if (keyMap[key]) {
            setNested(pembina, keyMap[key], value);
        }
    }
    return pembina;
}

function getElementValue(nameId, value) {
    for (let i = 0; i < nameId.length; i++) {
        const el = document.getElementById(nameId[i]);
        if (!el) continue;

        if ("value" in el) {
            el.value = value[i];
        } else {
            el.textContent = value[i];
        }
    }
}

function getElementValueByClass(classNames, value) {
    for (let i = 0; i < classNames.length; i++) {
        const element = document.querySelectorAll(`.${classNames[i]}`);
        if (!element) continue;

        element.forEach((el) => {
            if ("value" in el) {
                el.value = value[i];
            } else {
                el.textContent = value[i];
            }
        });
    }
}

function getTempData(key, value) {
    obj = {};
    for (let i = 0; i < key.length; i++) {
        let parts = key[i].split(".");
        let current = obj;

        for (let j = 0; j < parts.length; j++) {
            let part = parts[j];

            if (j === parts.length - 1) {
                current[part] = value[i];
            } else {
                if (!current[part]) current[part] = {};
                current = current[part];
            }
        }
    }

    return obj;
}

function updateLocalData(dataObj, type, obj, method) {
    if (type == "profile") {
        getElementValueByClass(dataObj.keys, dataObj.value);
    } else {
        if (method == "POST") {
            if (type == "schedules") {
                if (!obj[dataObj.entries["tanggal"]]) {
                    obj[dataObj.entries["tanggal"]] = [];
                }

                dataObj.entries.id = latestId += 1;
                obj[dataObj.entries["tanggal"]].push(dataObj.entries);
            } else if (type == "students") {
                latestIdUser++;

                objT = getTempData(
                    [
                        "id",
                        "name",
                        "email",
                        "status",
                        "siswa_profile.jenis_kelamin",
                        "siswa_profile.nisn",
                        "siswa_profile.no_telephone",
                        "siswa_profile.kelas",
                        "siswa_profile.alamat",
                    ],
                    [
                        latestIdUser,
                        dataObj.entries.nama,
                        dataObj.entries.email,
                        "aktif",
                        dataObj.entries.j_kel,
                        dataObj.entries.nisn,
                        dataObj.entries.no_tel,
                        dataObj.entries.kelas,
                        dataObj.entries.alamat,
                    ]
                );

                obj.unshift(objT);
            } else {
                if (type == "pengumuman")
                    dataObj.entries["tanggal_pengumuman"] =
                        dataObj.entries.tanggal;

                obj.unshift(dataObj.entries);
            }
        } else if (method == "PUT") {
            if (type == "schedules") {
                for (let tanggal in obj) {
                    let idx = obj[tanggal].findIndex((s) => s.id == dataObj.id);
                    if (idx != -1) {
                        obj[tanggal][idx] = dataObj.entries;
                        return;
                    }
                }
            } else if (type == "students") {
                console.log(dataObj.id);

                objT = getTempData(
                    [
                        "id",
                        "name",
                        "email",
                        "status",
                        "siswa_profile.jenis_kelamin",
                        "siswa_profile.nisn",
                        "siswa_profile.no_telephone",
                        "siswa_profile.kelas",
                        "siswa_profile.alamat",
                    ],
                    [
                        dataObj.id,
                        dataObj.entries.nama,
                        dataObj.entries.email,
                        "aktif",
                        dataObj.entries.j_kel,
                        dataObj.entries.nisn,
                        dataObj.entries.no_tel,
                        dataObj.entries.kelas,
                        dataObj.entries.alamat,
                    ]
                );

                let idx = obj.findIndex((s) => s.id == dataObj.id);
                if (idx != -1) {
                    obj[idx] = objT;
                    if (filteredData[type] && filteredData[type].length > 0) {
                        let idxf = filteredData[type].findIndex(
                            (s) => s.id == dataObj.id
                        );
                        if (idxf != -1) filteredData[type][idxf] = objT;
                    }
                    return;
                }
            } else {
                let idx = obj.findIndex((o) => o.id == dataObj.id);
                dataObj.entries["id"] = dataObj.id;
                if (idx != -1) {
                    if (type == "pengumuman")
                        dataObj.entries["tanggal_pengumuman"] =
                            dataObj.entries.tanggal;
                    obj[idx] = dataObj.entries;
                    if (filteredData[type] && filteredData[type].length > 0) {
                        let idxf = filteredData[type].findIndex(
                            (s) => s.id == dataObj.id
                        );
                        if (idxf != -1) filteredData[type][idxf] = obj[idx];
                    }
                    return;
                }
            }
        } else if (method == "DELETE") {
            console.log(method);
            if (type == "schedules") {
                for (let tanggal in obj) {
                    if (Array.isArray(obj[tanggal])) {
                        obj[tanggal] = obj[tanggal].filter(
                            (s) => s.id != dataObj.id
                        );

                        if (obj[tanggal].length == 0) {
                            delete obj[tanggal];
                        }
                    }
                }
            } else {
                let idx = obj.findIndex((o) => o.id == dataObj.id);
                if (idx !== -1) {
                    obj.splice(idx, 1); // hapus item di tempat
                }
            }
        }
    }
}

function markAttendance(studentIndex, status) {
    // Remove active state from all buttons for this student
    ["present", "late", "absent"].forEach((s) => {
        const btn = document.getElementById(`${s}_${studentIndex}`);
        if (btn) {
            btn.style.opacity = "0.5";
            btn.style.transform = "scale(1)";
        }
    });

    // Set active state for selected status
    const selectedBtn = document.getElementById(`${status}_${studentIndex}`);
    if (selectedBtn) {
        selectedBtn.style.opacity = "1";
        selectedBtn.style.transform = "scale(1.1)";
    }
}

// ===== NOTIFICATION SYSTEM =====
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
                    <span class="notification-icon">
                        ${icons[type] || icons.info}
                    </span>
                    <div class="notification-text">
                        <div class="notification-title">${title}</div>
                        <div class="notification-message">${message}</div>
                    </div>
                </div>
                <button class="notification-close" onclick="closeNotification(${id})" aria-label="Close">&times;</button>
            `;

    notification.dataset.id = id;
    container.appendChild(notification);

    setTimeout(() => {
        notification.classList.add("show");
    }, 100);

    if (duration > 0) {
        setTimeout(() => {
            closeNotification(id);
        }, duration);
    }
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

// ===== ACTION FUNCTIONS =====
function editSchedule(scheduleId) {
    let schedule;
    for (let tanggal in ekskulSchedules) {
        schedule = ekskulSchedules[tanggal].find((s) => s.id == scheduleId);
        if (schedule) break;
    }

    getElementValue(
        [
            "schedule_id",
            "judul",
            "tanggal",
            "jam_mulai",
            "jam_selesai",
            "lokasi",
            "deskripsi_jadwal",
        ],
        [
            scheduleId,
            schedule.judul,
            schedule.tanggal,
            schedule.jam_mulai,
            schedule.jam_selesai,
            schedule.lokasi,
            schedule.deskripsi,
        ]
    );

    openModal("scheduleModal");

    const form = document.getElementById("scheduleForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(
            scheduleId,
            form,
            `/jadwal`,
            "PUT",
            ekskulSchedules,
            "schedules"
        );
    };
}

function takeAttendance(scheduleId) {
    openModal("attendanceModal");
    showNotification(
        "Catat Absensi",
        `Mencatat absensi untuk kegiatan ID: ${scheduleId}`,
        "info"
    );
}

function viewScheduleDetails(scheduleId) {
    showNotification(
        "Detail Jadwal",
        `Melihat detail jadwal ID: ${scheduleId}`,
        "info"
    );
}

function deleteSchedule(scheduleId) {
    let schedule;
    for (let tanggal in ekskulSchedules) {
        schedule = ekskulSchedules[tanggal].find((s) => s.id == scheduleId);
        if (schedule) break;
    }

    getElementValue(
        ["nameObject", "deleteObjectName"],
        ["Apakah Anda yakin ingin menghapus jadwal ini?", schedule.judul]
    );

    const form = document.getElementById("deleteForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(
            scheduleId,
            form,
            `/jadwal`,
            "DELETE",
            ekskulSchedules,
            "schedules"
        );
    };
    openModal("deleteModal");
}

function editActivity(activityId) {
    const activity = kegiatan.find((a) => a.id == activityId);

    getElementValue(
        [
            "judulActivity",
            "deskripsi",
            "jam_mulaiActivity",
            "jam_selesaiActivity",
            "tanggalActivity",
            "lokasiActivity",
        ],
        [
            activity.judul,
            activity.deskripsi,
            activity.jam_mulai,
            activity.jam_selesai,
            activity.tanggal,
            activity.lokasi,
        ]
    );

    openModal("activityModal");

    const form = document.getElementById("activityForm");
    form.onsubmit = (e) => {
        e.preventDefault();

        handleFormSubmit(
            activityId,
            form,
            `/kegiatan`,
            "PUT",
            kegiatan,
            "activities"
        );
    };
}

function viewActivityDetails(activityId) {
    showNotification(
        "Detail Kegiatan",
        `Melihat detail: ${activityId}`,
        "info"
    );
}

function endActivity(activityId) {
    showNotification(
        "Kegiatan Selesai",
        `Kegiatan ${activityId} telah selesai`,
        "success"
    );
}

function deleteAnnouncement(announcementId) {
    const announcement = announc.find((a) => a.id == announcementId);

    getElementValue(
        ["nameObject", "deleteObjectName"],
        [
            "Apakah Anda yakin ingin menghapus Pengumuman ini?",
            announcement.judul,
        ]
    );

    openModal("deleteModal");

    const form = document.getElementById("deleteForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(
            announcementId,
            form,
            `/pengumuman`,
            "DELETE",
            announc,
            "pengumuman"
        );
    };
}

function viewStudentProfile(studentId) {
    showNotification("Profil Siswa", `Melihat profil: ${studentId}`, "info");
}

function viewStudentDetail(studentId) {
    showNotification(
        "Detail Siswa",
        `Melihat detail lengkap: ${studentId}`,
        "info"
    );
}

function editStudent(studentId) {
    const student = siswa.find((s) => s.id == studentId);

    getElementValue(
        ["name", "email", "class", "notel", "nisn", "j_kel", "alamat"],
        [
            student.name,
            student.email,
            student.siswa_profile.kelas,
            student.siswa_profile.no_telephone,
            student.siswa_profile.nisn,
            student.siswa_profile.jenis_kelamin,
            student.siswa_profile.alamat,
        ]
    );

    openModal("studentModal");

    const form = document.getElementById("studentForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(studentId, form, `/siswa`, "PUT", siswa, "students");
    };
}

function editAnnouncement(announcementId) {
    const announcement = announc.find((s) => s.id == announcementId);

    getElementValue(
        [
            "judulPengumuman",
            "isi",
            "tipe",
            "tanggalPengumuman",
            "lokasiPengumuman",
        ],
        [
            announcement.judul,
            announcement.isi,
            announcement.tipe,
            announcement.tanggal_pengumuman,
            announcement.lokasi,
        ]
    );

    openModal("announcementModal");

    const form = document.getElementById("announcementForm");
    form.onsubmit = (e) => {
        e.preventDefault();
        handleFormSubmit(
            announcementId,
            form,
            `/pengumuman`,
            "PUT",
            announc,
            "pengumuman"
        );
    };
}

function editAttendanceStatus(studentId) {
    showNotification(
        "Edit Absensi",
        `Mengedit status absensi: ${studentId}`,
        "info"
    );
}

function contactStudent(studentId) {
    showNotification("Kontak Siswa", `Menghubungi ${studentId}`, "info");
}

// ===== EXPORT FUNCTIONS =====
function exportSchedule() {
    showNotification(
        "Export Jadwal",
        "Jadwal klub basket sedang diexport...",
        "info"
    );
    setTimeout(() => {
        showNotification(
            "Export Berhasil",
            "Jadwal berhasil diexport ke PDF",
            "success"
        );
    }, 2000);
}

function exportAttendance() {
    showNotification(
        "Export Absensi",
        "Data absensi klub basket sedang diexport...",
        "info"
    );
    setTimeout(() => {
        showNotification(
            "Export Berhasil",
            "Data absensi berhasil diexport ke Excel",
            "success"
        );
    }, 2000);
}

function exportActivities() {
    showNotification(
        "Export Kegiatan",
        "Data kegiatan klub basket sedang diexport...",
        "info"
    );
    setTimeout(() => {
        showNotification(
            "Export Berhasil",
            "Data kegiatan berhasil diexport ke PDF",
            "success"
        );
    }, 2000);
}

function exportAnnouncements() {
    showNotification(
        "Export Pengumuman",
        "Data pengumuman klub basket sedang diexport...",
        "info"
    );
    setTimeout(() => {
        showNotification(
            "Export Berhasil",
            "Data pengumuman berhasil diexport ke PDF",
            "success"
        );
    }, 2000);
}

function exportStudents() {
    showNotification(
        "Export Data Siswa",
        "Data siswa klub basket sedang diexport...",
        "info"
    );
    setTimeout(() => {
        showNotification(
            "Export Berhasil",
            "Data siswa berhasil diexport ke Excel",
            "success"
        );
    }, 2000);
}

function exportAnalytics() {
    showNotification(
        "Export Analytics",
        "Data analytics klub basket sedang diexport...",
        "info"
    );
    setTimeout(() => {
        showNotification(
            "Export Berhasil",
            "Data analytics berhasil diexport ke PDF",
            "success"
        );
    }, 2000);
}

// ===== UTILITY FUNCTIONS =====
function toggleNotifications() {
    showNotification(
        "Notifikasi",
        "Panel notifikasi akan segera hadir",
        "info"
    );
}

function toggleUserMenu() {
    showNotification(
        "Menu Pengguna",
        "Menu profil pengguna akan segera hadir",
        "info"
    );
}

function saveDraft() {
    showNotification(
        "Draft Disimpan",
        "Pengumuman telah disimpan sebagai draft",
        "success"
    );
}

function toggleGalleryForm() {
    const form = document.getElementById("galleryUploadForm");
    const content = document.getElementById("galleryFormContent");
    const toggle = document.getElementById("galleryFormToggle");

    if (content.classList.contains("active")) {
        content.classList.remove("active");
        setTimeout(() => {
            form.style.display = "none";
        }, 300);
        toggle.textContent = "📷 Buka Form Upload";
    } else {
        form.style.display = "block";
        setTimeout(() => {
            content.classList.add("active");
        }, 10);
        toggle.textContent = "✕ Tutup Form";
    }
}

function handleFileSelect() {
    const input = document.getElementById("galleryFileInput");
    const filesContainer = document.getElementById("selectedFiles");
    const uploadArea = document.querySelector(".gallery-file-upload");

    // tambahin file baru ke array kita (bukan langsung pakai input.files)
    selectedFiles = [...selectedFiles, ...Array.from(input.files)];

    // reset input biar gak nambah duplikat waktu pilih ulang
    input.value = "";

    // kalau ada file, kasih class has-files
    if (selectedFiles.length > 0) {
        uploadArea.classList.add("has-files");
    } else {
        uploadArea.classList.remove("has-files");
    }

    // render ulang daftar file
    filesContainer.innerHTML = "";
    selectedFiles.forEach((file, index) => {
        const fileElement = document.createElement("div");
        fileElement.className = "gallery-selected-file";

        const span = document.createElement("span");
        span.textContent = file.name;

        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "gallery-selected-file-remove";
        btn.textContent = "✕";

        // tombol hapus
        btn.addEventListener("click", () => removeSelectedFile(index));

        fileElement.appendChild(span);
        fileElement.appendChild(btn);
        filesContainer.appendChild(fileElement);
    });

    updateUploadIcon();
}

function removeSelectedFile(index) {
    selectedFiles.splice(index, 1);
    handleFileSelect();
}

function updateFileInput() {
    const input = document.getElementById("galleryFileInput");
    const dataTransfer = new DataTransfer();

    selectedFiles.forEach((file) => {
        dataTransfer.items.add(file);
    });

    input.files = dataTransfer.files;
}

function updateUploadIcon() {
    const uploadArea = document.getElementById("galleryFileUpload");
    const icon = uploadArea.querySelector(".gallery-file-upload-icon");
    const text = uploadArea.querySelector(".gallery-file-upload-text");

    if (selectedFiles.length > 0) {
        icon.textContent = "📁";
        text.textContent = `${selectedFiles.length} file${
            selectedFiles.length > 1 ? "s" : ""
        } dipilih`;
        uploadArea.style.borderColor = "var(--primary-400)";
        uploadArea.style.background = "var(--primary-50)";
    } else {
        icon.textContent = "📷";
        text.textContent = "Klik atau drag & drop untuk upload media";
        uploadArea.style.borderColor = "";
        uploadArea.style.background = "";
    }
}

function handleGallerySubmit(event) {
    event.preventDefault();

    if (selectedFiles.length === 0) {
        showNotification(
            "Error",
            "Pilih minimal 1 file untuk diupload",
            "error"
        );
        return;
    }

    // Simulate upload process
    showNotification(
        "Mengupload...",
        "Media sedang diupload, mohon tunggu",
        "info"
    );

    setTimeout(() => {
        showNotification(
            "Upload Berhasil",
            `${selectedFiles.length} file berhasil diupload ke galeri`,
            "success"
        );
        resetGalleryForm();
        toggleGalleryForm();
    }, 2000);
}

function resetGalleryForm() {
    document.getElementById("galleryForm").reset();
    selectedFiles = [];
    document.getElementById("selectedFiles").innerHTML = "";
    updateUploadIcon();
}

// ===== ENHANCED LIGHTBOX FUNCTIONS =====
function openLightbox(index) {
    currentLightboxIndex = index;
    const modal = document.getElementById("lightboxModal");
    const data = galleryData[index];

    // Update content
    document.getElementById("lightboxTitle").textContent = data.title;
    document.getElementById("lightboxDescription").textContent =
        data.description;
    document.getElementById(
        "lightboxMeta"
    ).textContent = `📅 ${data.date} • 👤 ${data.author}`;
    document.getElementById("lightboxCounter").textContent = `${index + 1} / ${
        galleryData.length
    }`;

    // Show appropriate media
    const image = document.getElementById("lightboxImage");
    const video = document.getElementById("lightboxVideo");

    if (data.type === "image") {
        image.src = data.src;
        image.style.display = "block";
        video.style.display = "none";
    } else if (data.type === "video") {
        video.src = data.src;
        video.style.display = "block";
        image.style.display = "none";
    }

    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeLightbox() {
    const modal = document.getElementById("lightboxModal");
    modal.classList.remove("active");
    document.body.style.overflow = "";

    // Pause video if playing
    const video = document.getElementById("lightboxVideo");
    if (video.style.display !== "none") {
        video.pause();
    }
}

function previousMedia() {
    if (currentLightboxIndex > 0) {
        openLightbox(currentLightboxIndex - 1);
    }
}

function nextMedia() {
    if (currentLightboxIndex < galleryData.length - 1) {
        openLightbox(currentLightboxIndex + 1);
    }
}

function downloadMedia() {
    const data = galleryData[currentLightboxIndex];
    const link = document.createElement("a");
    link.href = data.src;
    link.download = data.title;
    link.click();

    showNotification("Download Dimulai", "Media sedang didownload", "info");
}

function shareMedia() {
    const data = galleryData[currentLightboxIndex];
    if (navigator.share) {
        navigator.share({
            title: data.title,
            text: data.description,
            url: data.src,
        });
    } else {
        copyAttendanceLink();
    }
}

// ===== SEARCH FUNCTIONALITY =====
function handleGlobalSearch() {
    const searchTerm = document
        .getElementById("globalSearch")
        .value.toLowerCase();
    if (searchTerm.length > 2) {
        showNotification("Pencarian", `Mencari: "${searchTerm}"`, "info");
    }
}

// ===== INITIALIZATION =====
document.addEventListener("DOMContentLoaded", function () {
    // Load theme and sidebar state
    loadTheme();
    loadSidebarState();

    const urlHash = window.location.hash.slice(1);
    const savedSection = localStorage.getItem("currentSection");
    const initialSection = urlHash || savedSection || "dashboard";

    if (document.getElementById(initialSection)) {
        showSection(initialSection);
    } else {
        showSection("dashboard");
    }

    let path = window.location.pathname.split("/").pop(); // ambil bagian terakhir URL
    if (path) {
        showSection(path);
    } else {
        showSection("dashboard"); // default
    }

    // Set up event listeners
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("modal")) {
            closeModal(e.target.id);
        }
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            document.querySelectorAll(".modal.active").forEach((modal) => {
                closeModal(modal.id);
            });

            const sidebar = document.getElementById("sidebar");
            if (sidebar.classList.contains("mobile-open")) {
                toggleMobileSidebar();
            }
        }

        // Keyboard shortcuts
        if ((e.ctrlKey || e.metaKey) && e.key === "k") {
            e.preventDefault();
            document.getElementById("globalSearch").focus();
        }

        if ((e.ctrlKey || e.metaKey) && e.key === "b") {
            e.preventDefault();
            handleSidebarToggle();
        }
    });

    // Handle window resize
    window.addEventListener("resize", function () {
        Object.values(charts).forEach((chart) => {
            if (chart && chart.resize) {
                chart.resize();
            }
        });

        if (window.innerWidth > 768) {
            const sidebar = document.getElementById("sidebar");
            if (sidebar.classList.contains("mobile-open")) {
                toggleMobileSidebar();
            }
        }
    });

    // Set up search functionality
    const globalSearch = document.getElementById("globalSearch");
    if (globalSearch) {
        globalSearch.addEventListener("input", handleGlobalSearch);
    }

    // Initialize calendar
    loadCalendar();

    // Show welcome notification
    setTimeout(() => {
        showNotification(
            "Dashboard Pembina Siap! 🏀",
            "Selamat datang di dashboard pembina Klub Basket. Kelola ekstrakurikuler dengan mudah dan efisien.",
            "success",
            6000
        );
    }, 1000);

    console.log(
        "✅ EkstraKu Pembina Dashboard (Klub Basket) fully initialized!"
    );
});
