// ===== ENHANCED GLOBAL VARIABLES =====
let currentTheme = localStorage.getItem("theme") || "light";
let notificationId = 0;

// ===== ENHANCED THEME MANAGEMENT =====
function setTheme(theme) {
    currentTheme = theme;
    document.body.setAttribute("data-theme", currentTheme);
    localStorage.setItem("theme", currentTheme);

    const themeIcon = document.getElementById("themeIcon");
    const themeIconMobile = document.getElementById("themeIconMobile");

    if (themeIcon)
        themeIcon.textContent = currentTheme === "light" ? "🌙" : "☀️";
    if (themeIconMobile)
        themeIconMobile.textContent = currentTheme === "light" ? "🌙" : "☀️";

    // Enhanced theme transition effect
    document.body.style.transition = "all 0.3s ease";

    showNotification(
        "Tema Berhasil Diubah",
        `Tema ${
            currentTheme === "light" ? "terang" : "gelap"
        } telah diaktifkan`,
        "success",
        2000
    );

    setTimeout(() => {
        document.body.style.transition = "";
    }, 300);
}

function toggleTheme() {
    const newTheme = currentTheme === "light" ? "dark" : "light";
    setTheme(newTheme);
}

function loadTheme() {
    document.body.setAttribute("data-theme", currentTheme);
    const themeIcon = document.getElementById("themeIcon");
    const themeIconMobile = document.getElementById("themeIconMobile");

    if (themeIcon)
        themeIcon.textContent = currentTheme === "light" ? "🌙" : "☀️";
    if (themeIconMobile)
        themeIconMobile.textContent = currentTheme === "light" ? "🌙" : "☀️";

    // Apply system theme preference if no saved theme
    if (!localStorage.getItem("theme")) {
        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;
        if (prefersDark) {
            setTheme("dark");
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

    return id;
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

// ===== DESKTOP SPECIFIC FUNCTIONS =====
function updateCurrentTime() {
    const timeElement = document.getElementById("currentTime");
    if (timeElement) {
        const now = new Date();
        const timeString = now.toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
        });
        timeElement.textContent = timeString;
    }
}

function updateConnectionStatus() {
    const statusElement = document.getElementById("connectionStatus");
    if (statusElement) {
        statusElement.textContent = navigator.onLine ? "Online" : "Offline";
    }
}

// ===== ACTION FUNCTIONS =====
function contactSupport() {
    showNotification(
        "Menghubungi Support",
        "Support: admin@ekstraku.edu atau +62 21 1234567. Tim support kami akan membantu Anda dalam 1x24 jam",
        "info",
        6000
    );

    setTimeout(() => {
        showNotification(
            "Jam Operasional",
            "Support tersedia Senin-Jumat 08:00-17:00 WIB. Untuk bantuan darurat, gunakan kontak emergency",
            "warning",
            4000
        );
    }, 2000);
}

function showHelp() {
    showNotification(
        "Panduan Bantuan",
        "T: Toggle tema, B: Kembali ke beranda, H: Bantuan, Enter: Hubungi support. Gunakan navigasi untuk akses cepat",
        "info",
        6000
    );
}

function showPrivacy() {
    showNotification(
        "Kebijakan Privasi",
        "EkstraKu berkomitmen melindungi privasi dan data pengguna sesuai dengan standar keamanan terbaik",
        "info",
        5000
    );
}

function showTerms() {
    showNotification(
        "Syarat Layanan",
        "Silakan baca syarat dan ketentuan penggunaan sistem EkstraKu sebelum melakukan registrasi",
        "info",
        4000
    );
}

function requestAccess() {
    showNotification(
        "Request Akses Diproses",
        "Permintaan akses telah dicatat. Administrator akan meninjau dan menghubungi Anda melalui email dalam 2-3 hari kerja",
        "success",
        5000
    );

    setTimeout(() => {
        showNotification(
            "Informasi Request",
            "Pastikan email yang Anda berikan valid dan aktif untuk menerima konfirmasi akses",
            "info",
            4000
        );
    }, 2500);
}

function reportIssue() {
    showNotification(
        "Laporan Masalah Terkirim",
        "Terima kasih! Laporan masalah akses telah diterima. Tim teknis akan segera menginvestigasi dan menghubungi Anda",
        "warning",
        5000
    );

    setTimeout(() => {
        const reportId =
            "RPT-" + Math.random().toString(36).substr(2, 9).toUpperCase();
        showNotification(
            "Nomor Laporan",
            `ID Laporan: ${reportId}. Simpan nomor ini untuk pelacakan status laporan Anda`,
            "info",
            6000
        );
    }, 2000);
}

// ===== ENHANCED KEYBOARD SHORTCUTS =====
function setupKeyboardShortcuts() {
    document.addEventListener("keydown", function (e) {
        // ESC to show help
        if (e.key === "Escape") {
            showNotification(
                "Bantuan Keyboard",
                "Tekan H untuk bantuan, T untuk toggle tema, B untuk kembali ke beranda",
                "info",
                4000
            );
        }

        // H for help
        if (e.key.toLowerCase() === "h") {
            e.preventDefault();
            showHelp();
        }

        // T for theme toggle
        if (e.key.toLowerCase() === "t") {
            e.preventDefault();
            toggleTheme();
        }

        // B for back to home
        if (e.key.toLowerCase() === "b") {
            e.preventDefault();
            goHome();
        }

        // Enter to contact support
        if (e.key === "Enter" && !e.target.closest("button")) {
            e.preventDefault();
            contactSupport();
        }
    });
}

// ===== ENHANCED MOBILE DETECTION AND OPTIMIZATION =====
function detectMobileAndOptimize() {
    const isMobile = window.innerWidth <= 767;
    const isTablet = window.innerWidth > 767 && window.innerWidth <= 1023;
    const isTouchDevice =
        "ontouchstart" in window || navigator.maxTouchPoints > 0;

    if (isTouchDevice) {
        document.body.classList.add("touch-device");

        // Add ripple effect for touch devices
        document.addEventListener("touchstart", function (e) {
            const target = e.target.closest(".btn, .theme-toggle");
            if (!target) return;

            const rect = target.getBoundingClientRect();
            const x = e.touches[0].clientX - rect.left;
            const y = e.touches[0].clientY - rect.top;

            const ripple = document.createElement("span");
            ripple.style.cssText = `
                        position: absolute;
                        border-radius: 50%;
                        background-color: rgba(255, 255, 255, 0.6);
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        pointer-events: none;
                        left: ${x}px;
                        top: ${y}px;
                        width: 40px;
                        height: 40px;
                        margin-left: -20px;
                        margin-top: -20px;
                    `;

            target.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    }

    console.log("📱 Device Detection:", {
        isMobile,
        isTablet,
        isTouchDevice,
        width: window.innerWidth,
        height: window.innerHeight,
    });
}

// ===== ENHANCED ERROR HANDLING =====
window.addEventListener("error", function (e) {
    console.error("🚨 JavaScript Error:", e.error);
    showNotification(
        "Terjadi Kesalahan",
        "Terjadi kesalahan pada halaman ini. Tim teknis telah diberi tahu dan akan segera memperbaikinya.",
        "error",
        6000
    );
});

window.addEventListener("unhandledrejection", function (e) {
    console.error("🚨 Unhandled Promise Rejection:", e.reason);
    showNotification(
        "Error Koneksi",
        "Terjadi kesalahan koneksi. Silakan periksa koneksi internet Anda dan coba lagi.",
        "error",
        8000
    );
});

function checkDevice() {
    const isDesktop = window.innerWidth >= 1024;
    if (isDesktop) {
        document.getElementById("mobilenav").style.display = "none";
    } else {
        document.getElementById("mobilenav").style.display = "flex";
    }
}

// ===== INITIALIZATION =====
document.addEventListener("DOMContentLoaded", function () {
    checkDevice();

    window.addEventListener("resize", checkDevice);
    console.log("🚀 Initializing Enhanced EkstraKu Unauthorized Page...");

    const startTime = performance.now();

    // Load theme
    loadTheme();

    // Setup keyboard shortcuts
    setupKeyboardShortcuts();

    // Detect and optimize for mobile
    detectMobileAndOptimize();

    // Start time updates for desktop
    updateCurrentTime();
    setInterval(updateCurrentTime, 1000);

    // Monitor connection status
    updateConnectionStatus();
    window.addEventListener("online", function () {
        updateConnectionStatus();
        showNotification(
            "Koneksi Restored",
            "Koneksi internet telah pulih. Semua fitur sekarang tersedia kembali.",
            "success",
            3000
        );
    });

    window.addEventListener("offline", function () {
        updateConnectionStatus();
        showNotification(
            "Koneksi Terputus",
            "Koneksi internet terputus. Beberapa fitur mungkin tidak tersedia.",
            "error",
            5000
        );
    });

    // Enhanced responsive handling
    window.addEventListener("resize", function () {
        detectMobileAndOptimize();
    });

    const endTime = performance.now();
    console.log(
        `✅ Enhanced page initialized successfully in ${Math.round(
            endTime - startTime
        )}ms`
    );


    // Add ripple animation CSS
    const rippleStyle = document.createElement("style");
    rippleStyle.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
    document.head.appendChild(rippleStyle);
});

// ===== MEMORY CLEANUP =====
window.addEventListener("beforeunload", function () {
    console.log("🧹 Cleaning up resources before page unload");
});
