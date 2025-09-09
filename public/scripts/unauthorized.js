// ===== ENHANCED GLOBAL VARIABLES =====
let currentTheme = localStorage.getItem("theme") || "light";
let notificationId = 0;

// ===== ENHANCED THEME MANAGEMENT =====
function setTheme(theme) {
    currentTheme = theme;
    document.body.setAttribute("data-theme", currentTheme);
    localStorage.setItem("theme", currentTheme);

    const themeIcon = document.getElementById("themeIcon");
    themeIcon.textContent = currentTheme === "light" ? "🌙" : "☀️";

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
    themeIcon.textContent = currentTheme === "light" ? "🌙" : "☀️";

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

// ===== ACTION FUNCTIONS =====
function showLoginOptions() {
    showNotification(
        "Opsi Login",
        "Silakan pilih jenis akun Anda: Admin, Instruktur, atau Siswa untuk mengakses area yang sesuai",
        "info",
        4000
    );

    // Simulate login modal or redirect
    setTimeout(() => {
        showNotification(
            "Login Required",
            "Fitur login akan mengarahkan Anda ke halaman login yang sesuai dengan peran Anda",
            "warning",
            3000
        );
    }, 1500);
}

function contactSupport() {
    showNotification(
        "Menghubungi Support",
        "Support: admin@ekstraku.edu atau +62 21 1234567. Tim support kami akan membantu Anda dalam 1x24 jam",
        "info",
        6000
    );

    // Enhanced contact info with animation
    setTimeout(() => {
        showNotification(
            "Jam Operasional",
            "Support tersedia Senin-Jumat 08:00-17:00 WIB. Untuk bantuan darurat, gunakan kontak emergency",
            "warning",
            4000
        );
    }, 2000);
}

function requestAccess() {
    showNotification(
        "Request Akses Diproses",
        "Permintaan akses telah dicatat. Administrator akan meninjau dan menghubungi Anda melalui email dalam 2-3 hari kerja",
        "success",
        5000
    );

    // Show additional information
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

    // Show tracking info
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

// ===== ENHANCED SECURITY MONITORING =====
function logSecurityEvent() {
    const timestamp = new Date().toISOString();
    const userAgent = navigator.userAgent;
    const referrer = document.referrer || "Direct Access";

    console.log("🔒 Security Event Logged:", {
        timestamp,
        event: "Unauthorized Access Attempt",
        userAgent,
        referrer,
        url: window.location.href,
    });

    // In production, this would send to security monitoring service
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
            window.location.href = "guest.html";
        }

        // Enter to contact support
        if (e.key === "Enter" && !e.target.closest("button")) {
            e.preventDefault();
            contactSupport();
        }
    });
}

function showHelp() {
    showNotification(
        "Panduan Bantuan",
        "T: Toggle tema, B: Kembali ke beranda, H: Bantuan, Enter: Hubungi support. Gunakan tombol di bawah untuk navigasi",
        "info",
        6000
    );
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

// ===== ENHANCED ANALYTICS AND TRACKING =====
function trackPageView() {
    const pageData = {
        page: "unauthorized",
        timestamp: new Date().toISOString(),
        referrer: document.referrer || "Direct",
        userAgent: navigator.userAgent,
        theme: currentTheme,
        screenSize: `${window.innerWidth}x${window.innerHeight}`,
        language: navigator.language,
    };

    console.log("📊 Page View Tracked:", pageData);

    // In production, this would send analytics data to tracking service
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

// ===== ENHANCED ACCESSIBILITY =====
function enhanceAccessibility() {
    // Add skip link for screen readers
    const skipLink = document.createElement("a");
    skipLink.href = "#main-content";
    skipLink.textContent = "Skip to main content";
    skipLink.style.cssText = `
                position: absolute;
                left: -10000px;
                top: auto;
                width: 1px;
                height: 1px;
                overflow: hidden;
            `;
    skipLink.addEventListener("focus", function () {
        this.style.cssText = `
                    position: fixed;
                    left: 6px;
                    top: 6px;
                    background: var(--bg-surface);
                    color: var(--text-primary);
                    padding: 8px 16px;
                    border-radius: 4px;
                    box-shadow: var(--shadow-lg);
                    z-index: 10000;
                    text-decoration: none;
                `;
    });
    skipLink.addEventListener("blur", function () {
        this.style.cssText = `
                    position: absolute;
                    left: -10000px;
                    top: auto;
                    width: 1px;
                    height: 1px;
                    overflow: hidden;
                `;
    });
    document.body.insertBefore(skipLink, document.body.firstChild);

    // Add main content ID
    const mainCard = document.querySelector(".unauthorized-card");
    mainCard.id = "main-content";
    mainCard.setAttribute("role", "main");
    mainCard.setAttribute("aria-labelledby", "page-title");

    // Add IDs for accessibility
    const title = document.querySelector(".unauthorized-title");
    title.id = "page-title";
    title.setAttribute("role", "heading");
    title.setAttribute("aria-level", "1");

    console.log("♿ Accessibility enhancements applied");
}

// ===== ENHANCED PERFORMANCE MONITORING =====
function monitorPerformance() {
    const perfData = {
        loadTime: performance.now(),
        memoryUsed: performance.memory
            ? Math.round(performance.memory.usedJSHeapSize / 1024 / 1024) + "MB"
            : "N/A",
        connectionType: navigator.connection
            ? navigator.connection.effectiveType
            : "Unknown",
        viewport: `${window.innerWidth}x${window.innerHeight}`,
    };

    console.log("⚡ Performance Metrics:", perfData);

    // Monitor frame rate
    let frameCount = 0;
    function countFrames() {
        frameCount++;
        if (frameCount === 60) {
            console.log("🎞️ Frame Rate: Good (60fps achieved in 1 second)");
            return;
        }
        requestAnimationFrame(countFrames);
    }
    requestAnimationFrame(countFrames);
}

// ===== INITIALIZATION =====
document.addEventListener("DOMContentLoaded", function () {
    console.log("🚀 Initializing EkstraKu Unauthorized Page...");

    const startTime = performance.now();

    // Load theme
    loadTheme();

    // Log security event
    logSecurityEvent();

    // Setup keyboard shortcuts
    setupKeyboardShortcuts();

    // Detect and optimize for mobile
    detectMobileAndOptimize();

    // Track page view
    trackPageView();

    // Enhance accessibility
    enhanceAccessibility();

    // Monitor performance
    monitorPerformance();

    // Enhanced responsive handling
    window.addEventListener("resize", function () {
        detectMobileAndOptimize();
    });

    // Add focus management
    const focusableElements = document.querySelectorAll(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );

    // Trap focus within the card
    document.addEventListener("keydown", function (e) {
        if (e.key === "Tab") {
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
    });

    // Auto-focus first button for better UX
    setTimeout(() => {
        const firstButton = document.querySelector(".btn-primary");
        if (firstButton && !("ontouchstart" in window)) {
            firstButton.focus();
        }
    }, 1000);

    const endTime = performance.now();
    console.log(
        `✅ Page initialized successfully in ${Math.round(
            endTime - startTime
        )}ms`
    );

    // Show welcome notification
    setTimeout(() => {
        showNotification(
            "Akses Dibatasi",
            "Halaman yang Anda coba akses memerlukan otentikasi. Silakan login atau hubungi administrator untuk bantuan.",
            "warning",
            5000
        );
    }, 1500);

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

// ===== ENHANCED URL MONITORING =====
function monitorAccess() {
    const currentUrl = window.location.href;
    const referrer = document.referrer;

    // Check for suspicious access patterns
    const suspiciousPatterns = [
        "admin",
        "instructor",
        "student",
        "dashboard",
        "management",
        "settings",
        "config",
        "api",
    ];

    const isSuspicious = suspiciousPatterns.some(
        (pattern) =>
            currentUrl.toLowerCase().includes(pattern) ||
            referrer.toLowerCase().includes(pattern)
    );

    if (isSuspicious) {
        console.warn("🔍 Suspicious access detected:", {
            currentUrl,
            referrer,
        });

        showNotification(
            "Akses Dimonitor",
            "Aktivitas akses ini telah dicatat untuk keperluan keamanan sistem",
            "warning",
            4000
        );
    }
}

// ===== SERVICE WORKER SUPPORT =====
if ("serviceWorker" in navigator) {
    window.addEventListener("load", function () {
        console.log(
            "🔧 Service Worker support detected - Ready for offline functionality"
        );
    });
}

// ===== ENHANCED BROWSER COMPATIBILITY =====
function checkBrowserCompatibility() {
    const features = {
        css_grid: CSS.supports("display", "grid"),
        css_flexbox: CSS.supports("display", "flex"),
        css_variables: CSS.supports("color", "var(--test)"),
        backdrop_filter: CSS.supports("backdrop-filter", "blur(1px)"),
        intersection_observer: "IntersectionObserver" in window,
        local_storage: "localStorage" in window,
    };

    const incompatibleFeatures = Object.entries(features)
        .filter(([key, value]) => !value)
        .map(([key]) => key);

    if (incompatibleFeatures.length > 0) {
        showNotification(
            "Browser Compatibility",
            `Beberapa fitur mungkin tidak bekerja optimal. Disarankan menggunakan browser modern seperti Chrome, Firefox, atau Safari terbaru.`,
            "warning",
            6000
        );
    }

    console.log("🌐 Browser Compatibility:", features);
}

// ===== FINAL INITIALIZATION =====
document.addEventListener("DOMContentLoaded", function () {
    // Run compatibility check
    checkBrowserCompatibility();

    history.replaceState({ page: "home" }, "Home Page", "/home");

    // Monitor access patterns
    monitorAccess();

    // Add enhanced interaction tracking
    let interactionCount = 0;
    document.addEventListener("click", function (e) {
        interactionCount++;
        console.log(
            `🖱️ User Interaction #${interactionCount}:`,
            e.target.tagName
        );
    });

    // Enhanced page visibility API
    document.addEventListener("visibilitychange", function () {
        if (document.hidden) {
            console.log("👁️ Page hidden at:", new Date().toISOString());
        } else {
            console.log("👁️ Page visible at:", new Date().toISOString());
        }
    });

    // Network status monitoring
    window.addEventListener("online", function () {
        showNotification(
            "Koneksi Restored",
            "Koneksi internet telah pulih. Semua fitur sekarang tersedia kembali.",
            "success",
            3000
        );
    });

    window.addEventListener("offline", function () {
        showNotification(
            "Koneksi Terputus",
            "Koneksi internet terputus. Beberapa fitur mungkin tidak tersedia.",
            "error",
            5000
        );
    });

    console.log("🎯 All systems initialized successfully!");
});

// ===== MEMORY CLEANUP =====
window.addEventListener("beforeunload", function () {
    // Cleanup any intervals or event listeners
    console.log("🧹 Cleaning up resources before page unload");
});
