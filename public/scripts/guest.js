// Pagination state
const paginationState = {
    activities: { currentPage: 1, itemsPerPage: 6, isLoading: false },
    announcements: { currentPage: 1, itemsPerPage: 4, isLoading: false },
    recentActivities: { currentPage: 1, itemsPerPage: 4, isLoading: false },
};

// Notification System
let notificationId = 0;

function showNotification(title, message, type = "success", duration = 4000) {
    const container = document.getElementById("notificationContainer");
    const id = ++notificationId;

    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.id = `notification-${id}`;

    let icon = "✅";
    if (type === "error") icon = "❌";
    else if (type === "warning") icon = "⚠️";
    else if (type === "info") icon = "ℹ️";

    notification.innerHTML = `
                <div class="notif-content">
                    <span class="notification-icon">${icon}</span>
                    <div class="notification-text">
                        <div class="notification-title">${title}</div>
                        <div class="notification-message">${message}</div>
                    </div>
                </div>
                <button class="notification-close" onclick="hideNotification('${id}')">&times;</button>
                <div class="notification-progress"></div>
            `;

    container.appendChild(notification);

    // Trigger animation
    setTimeout(() => {
        notification.classList.add("show");
    }, 100);

    // Auto hide
    setTimeout(() => {
        hideNotification(id);
    }, duration);

    return id;
}

function hideNotification(id) {
    const notification = document.getElementById(`notification-${id}`);
    if (notification) {
        notification.classList.remove("show");
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
}

// Theme Toggle
function toggleTheme() {
    const body = document.body;
    const themeToggles = document.querySelectorAll(".theme-toggle");
    const mobileThemeIcon = document.getElementById("mobileThemeIcon");

    if (body.getAttribute("data-theme") === "dark") {
        body.removeAttribute("data-theme");
        themeToggles.forEach((toggle) => {
            if (toggle.textContent.includes("Ganti")) {
                toggle.innerHTML = "<span>🌙</span> Ganti Tema";
            } else {
                toggle.textContent = "🌙";
            }
        });
        if (mobileThemeIcon) mobileThemeIcon.textContent = "🌙";
        localStorage.setItem("theme", "light");
    } else {
        body.setAttribute("data-theme", "dark");
        themeToggles.forEach((toggle) => {
            if (toggle.textContent.includes("Ganti")) {
                toggle.innerHTML = "<span>☀️</span> Ganti Tema";
            } else {
                toggle.textContent = "☀️";
            }
        });
        if (mobileThemeIcon) mobileThemeIcon.textContent = "☀️";
        localStorage.setItem("theme", "dark");
    }
}

// Load saved theme
function loadTheme() {
    const savedTheme = localStorage.getItem("theme");
    const themeToggles = document.querySelectorAll(".theme-toggle");
    const mobileThemeIcon = document.getElementById("mobileThemeIcon");

    if (savedTheme === "dark") {
        document.body.setAttribute("data-theme", "dark");
        themeToggles.forEach((toggle) => {
            if (toggle.textContent.includes("Ganti")) {
                toggle.innerHTML = "<span>☀️</span> Ganti Tema";
            } else {
                toggle.textContent = "☀️";
            }
        });
        if (mobileThemeIcon) mobileThemeIcon.textContent = "☀️";
    } else {
        document.body.setAttribute("data-theme", "light"); // tambahin ini
        themeToggles.forEach((toggle) => {
            if (toggle.textContent.includes("Ganti")) {
                toggle.innerHTML = "<span>🌙</span> Ganti Tema";
            } else {
                toggle.textContent = "🌙";
            }
        });
        if (mobileThemeIcon) mobileThemeIcon.textContent = "🌙";
    }
}

// Mobile Menu
function toggleMobileMenu() {
    const mobileNav = document.getElementById("mobileNav");
    mobileNav.classList.toggle("active");
}

function closeMobileMenu() {
    const mobileNav = document.getElementById("mobileNav");
    mobileNav.classList.remove("active");
}

// Modal Functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    clearFormValidation(modalId);

    // Reset form saat modal dibuka
    const forms = modal.querySelectorAll("form");
    forms.forEach((form) => form.reset());

    const inputs = modal.querySelectorAll("input");
    inputs.forEach((input) => input.classList.remove("invalid"));

    const errorForm = modal.querySelector("#errorForm");
    if (errorForm) errorForm.style.display = "none";

    modal.classList.add("active");
    document.body.style.overflow = "hidden";
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove("active");
    document.body.style.overflow = "auto";

    clearFormValidation(modalId);
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

// Close modal when clicking outside
window.onclick = function (event) {
    if (
        event.target.classList.contains("modal") ||
        event.target.classList.contains("modal-profile")
    ) {
        const modalId = event.target.id;
        event.target.classList.remove("active");
        document.body.style.overflow = "auto";
        clearFormValidation(modalId);
    }
};

function handleClickOutside(event) {
    const profileTrigger = document.querySelector(".profile-trigger");
    const profileDropdown = document.getElementById("profileDropdown");

    if (profileTrigger && profileDropdown) {
        if (
            !profileTrigger.contains(event.target) &&
            !profileDropdown.contains(event.target)
        ) {
            closeProfileDropdown();
        }
    }
}

// FAQ Toggle
function toggleFAQ(button) {
    const answer = button.nextElementSibling;
    const icon = button.querySelector("span");

    if (answer.classList.contains("active")) {
        answer.classList.remove("active");
        icon.textContent = "+";
    } else {
        // Close all other FAQs
        document
            .querySelectorAll(".faq-answer")
            .forEach((ans) => ans.classList.remove("active"));
        document
            .querySelectorAll(".faq-question span")

            .forEach((ic) => (ic.textContent = "+"));

        // Open this FAQ
        answer.classList.add("active");
        icon.textContent = "−";
    }
}

function getKelas(kelas, jurusan, jumlahKelas) {
    arr = [];

    for (let i = 0; i < kelas.length; i++) {
        for (let j = 0; j < jurusan.length; j++) {
            for (let k = 0; k < jumlahKelas[j]; k++) {
                arr.push(kelas[i] + " " + jurusan[j] + " " + (k + 1));
            }
        }
    }

    return arr;
}

// Form validation
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
    if (input.id === "registerNisn" || input.id === "studentPhone") {
        console.log(input.id);
        if (!/^\d+$/.test(value)) {
            // kalau bukan angka
            input.classList.add("invalid");
            input.classList.remove("valid");
            if (message)
                message.textContent =
                    input.id === "registerNisn"
                        ? "NISN harus berupa angka"
                        : "Nomor Telepon harus angka";
            if (message) message.classList.add("show");
            return false;
        }
    }

    if (input.id === "classStudent") {
        const allowed = getKelas(
            ["X", "XI", "XII"],
            ["RPL", "BD", "MP", "AK", "LP"],
            [2, 4, 4, 3, 2]
        );
        const inputc = document
            .getElementById("classStudent")
            .value.trim()
            .toUpperCase();

        if (!allowed.includes(inputc)) {
            input.classList.add("invalid");
            input.classList.remove("valid");
            if (message)
                message.textContent =
                    "Pastikan Kelas benar dan ada contoh: X RPL 1, XI RPL 1, XII RPL 1";
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

function showLoginRequired() {
    openModal("loginRequiredModal");
}

// Load More Items Function
async function loadMoreItems(section) {
    const state = paginationState[section];
    if (state.isLoading) return;

    state.isLoading = true;
    const loadMoreBtn = document.getElementById(
        `loadMore${section.charAt(0).toUpperCase() + section.slice(1)}`
    );
    const spinner = loadMoreBtn.querySelector(".loading-spinner");
    const btnText = loadMoreBtn.childNodes[2]; // Get text node

    // Show loading state
    spinner.style.display = "inline-block";
    loadMoreBtn.disabled = true;

    let responseEkskul = window.currentUser
        ? await fetch("/json/true", {
              headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-TOKEN": document
                      .querySelector('meta[name="csrf-token"]')
                      .getAttribute("content"),
              },
          })
        : "";

    let dataEkskul = window.currentUser ? await responseEkskul.json() : "";

    // Simulate loading delay
    setTimeout(() => {
        state.currentPage++;

        if (section === "activities") {
            loadActivities(dataEkskul);
        } else if (section === "announcements") {
            loadAnnouncements();
        } else if (section === "recentActivities") {
            loadRecentActivities();
        }

        // Hide loading state
        spinner.style.display = "none";
        loadMoreBtn.disabled = false;
        state.isLoading = false;

        showNotification(
            "Berhasil!",
            `Lebih banyak ${
                section === "activities"
                    ? "kegiatan"
                    : section === "announcements"
                    ? "pengumuman"
                    : "kegiatan terbaru"
            } telah dimuat.`,
            "info",
            2000
        );
    }, 1000);
}

// Create skeleton loading cards
function createSkeletonCard() {
    const skeletonCard = document.createElement("div");
    skeletonCard.className = "skeleton-card";
    skeletonCard.innerHTML = `
                <div class="skeleton-line short"></div>
                <div class="skeleton-line long"></div>
                <div class="skeleton-line medium"></div>
                <div class="skeleton-line long"></div>
                <div class="skeleton-line short"></div>
            `;
    return skeletonCard;
}

// Load Activities with pagination
// function loadActivities(ekskulUser) {
//     if (window.currentUser) {
//         index = 0;
//         for (let i = 0; i < sampleActivities.length; i++) {
//             if (index < ekskulUser.length && sampleActivities[i].id == ekskulUser[index].id) {
//                 sampleActivities[i] = -1;
//                 index += 1;
//             }
//         }

//         temp = [];
//         for (let i = 0; i < ekskulUser.length; i++) {
//             temp[i] = sampleActivities[i];
//             sampleActivities[i] = ekskulUser[i];
//         }

//         tmp = [];
//         index = 0;
//         for (let i = 0; i < sampleActivities.length; i++) {
//             if (i > ekskulUser.length - 1) {
//                 tmp[index] = sampleActivities[i];
//                 index++;
//             }
//         }

//         newActivity = temp;

//         index = 0;
//         length = newActivity.length;
//         while (index < tmp.length) {
//             newActivity[length] = tmp[index];
//             length++;
//             index++;
//         }

//         index = 0;
//         length = ekskulUser.length;
//         while (index < newActivity.length) {
//             sampleActivities[length] = newActivity[index];
//             length++;
//             index++;
//         }
//     }
//     const grid = document.getElementById("activitiesGrid");
//     const state = paginationState.activities;
//     const startIndex = 0;
//     const endIndex = state.currentPage * state.itemsPerPage;
//     const itemsToShow = sampleActivities.slice(startIndex, endIndex);
//     const totalItems = sampleActivities.length;

//     // Clear existing cards
//     grid.innerHTML = "";

//         console.log(sampleActivities);
//     // Add cards with staggered animation
//     itemsToShow.forEach((activity, index) => {
//         const card = document.createElement("div");
//         card.className = "card";

//         let buttonClass = window.currentUser
//             ? "btn btn-primary"
//             : "btn btn-disabled";
//         let buttonText = window.currentUser
//             ? "✨ Bergabung dengan Kegiatan"
//             : "🔒 Login untuk Bergabung";
//         let buttonAction = window.currentUser
//             ? `joinActivity(${activity.id}, '${activity.nama}')`
//             : `showLoginRequired()`;

//         if (activity == ekskulUser[index]) {
//             buttonClass = "btn btn-success";
//             buttonText = "Kelola Ekskul Saya";
//             buttonAction = "";
//         }

//         if (activity != -1) {
//             card.innerHTML = `
//                     <div class="card-header">
//                         <div>
//                             <h3 class="card-title">${activity.nama}</h3>
//                         </div>
//                         <span class="badge badge-success">Aktif</span>
//                     </div>
//                     <p class="card-description">${activity.deskripsi}</p>
//                     <div class="card-meta">
//                         <span>👨‍🏫 ${activity.pembina.name}</span>
//                         <span>👥 ${activity.siswa_count} anggota</span>
//                     </div>
//                     <div class="card-actions">
//                         <button class="${buttonClass}" style="width: 100%;" onclick="${buttonAction}">
//                             ${buttonText}
//                         </button>
//                     </div>
//                 `;

//             // Add staggered animation
//             setTimeout(() => {
//                 card.classList.add("show");
//             }, index * 100);

//             grid.appendChild(card);
//         }
//     });

//     // Update counter
//     const counter = document.getElementById("activitiesCounter");
//     counter.textContent = `Menampilkan ${Math.min(
//         endIndex,
//         totalItems
//     )} dari ${totalItems} kegiatan`;

//     // Show/hide load more button
//     const loadMoreBtn = document.getElementById("loadMoreActivities");
//     if (endIndex < totalItems) {
//         loadMoreBtn.style.display = "flex";
//     } else {
//         loadMoreBtn.style.display = "none";
//     }
// }

// MAP
// function loadActivities(ekskulUser) {
//     if (window.currentUser) {
//         const ekskulUserIds = ekskulUser.map((a) => a.id);
//         const filteredActivities = sampleActivities.filter(
//             (a) => !ekskulUserIds.includes(a.id)
//         );

//         // Gabungkan ekskulUser di awal list
//         sampleActivities = [...ekskulUser, ...filteredActivities];
//     }

//     const grid = document.getElementById("activitiesGrid");
//     const state = paginationState.activities;
//     const startIndex = 0;
//     const endIndex = state.currentPage * state.itemsPerPage;
//     const itemsToShow = sampleActivities.slice(startIndex, endIndex);
//     const totalItems = sampleActivities.length;

//     grid.innerHTML = "";

//     itemsToShow.forEach((activity, index) => {
//         const card = document.createElement("div");
//         card.className = "card";

//         let isUserActivity = window.currentUser && ekskulUser.some((a) => a.id === activity.id);

//         let buttonClass = isUserActivity
//             ? "btn btn-success"
//             : window.currentUser
//             ? "btn btn-primary"
//             : "btn btn-disabled";

//         let buttonText = isUserActivity
//             ? "Kelola Ekskul Saya"
//             : window.currentUser
//             ? "✨ Bergabung dengan Kegiatan"
//             : "🔒 Login untuk Bergabung";

//         let buttonAction = isUserActivity
//             ? ""
//             : window.currentUser
//             ? `joinActivity(${activity.id}, '${activity.nama}')`
//             : `showLoginRequired()`;

//         card.innerHTML = `
//             <div class="card-header">
//                 <div>
//                     <h3 class="card-title">${activity.nama}</h3>
//                 </div>
//                 <span class="badge badge-success">Aktif</span>
//             </div>
//             <p class="card-description">${activity.deskripsi}</p>
//             <div class="card-meta">
//                 <span>👨‍🏫 ${activity.pembina.name}</span>
//                 <span>👥 ${activity.siswa_count} anggota</span>
//             </div>
//             <div class="card-actions">
//                 <button class="${buttonClass}" style="width: 100%;" onclick="${buttonAction}">
//                     ${buttonText}
//                 </button>
//             </div>
//         `;

//         setTimeout(() => {
//             card.classList.add("show");
//         }, index * 100);

//         grid.appendChild(card);
//     });

//     // Update counter
//     const counter = document.getElementById("activitiesCounter");
//     counter.textContent = `Menampilkan ${Math.min(endIndex, totalItems)} dari ${totalItems} kegiatan`;

//     // Show/hide load more button
//     const loadMoreBtn = document.getElementById("loadMoreActivities");
//     loadMoreBtn.style.display = endIndex < totalItems ? "flex" : "none";
// }

// FOR
function loadActivities(ekskulUser) {
    if (window.currentUser && ekskulUser != null) {
        const ekskulUserIds = [];
        for (let i = 0; i < ekskulUser.length; i++) {
            ekskulUserIds.push(ekskulUser[i].id);
        }

        const otherActivities = [];
        for (let i = 0; i < sampleActivities.length; i++) {
            let isUserActivity = false;
            for (let j = 0; j < ekskulUserIds.length; j++) {
                if (sampleActivities[i].id === ekskulUserIds[j]) {
                    isUserActivity = true;
                    break;
                }
            }
            if (!isUserActivity) {
                otherActivities.push(sampleActivities[i]);
            }
        }

        // Gabungkan: ekskulUser di depan, lainnya di belakang
        sampleActivities = [];
        for (let i = 0; i < ekskulUser.length; i++) {
            sampleActivities.push(ekskulUser[i]);
        }
        for (let i = 0; i < otherActivities.length; i++) {
            sampleActivities.push(otherActivities[i]);
        }
    }

    const grid = document.getElementById("activitiesGrid");
    const state = paginationState.activities;
    const startIndex = 0;
    const endIndex = state.currentPage * state.itemsPerPage;
    const itemsToShow = [];
    const totalItems = sampleActivities.length;

    for (let i = startIndex; i < endIndex && i < totalItems; i++) {
        itemsToShow.push(sampleActivities[i]);
    }

    // Clear grid
    grid.innerHTML = "";
    const title = document.getElementById("errorTitle");
    const message = document.getElementById("errorMessage");

    title.textContent =
        window.currentUser?.role != "admin"
            ? "Batas Maksimal Ekskul"
            : "Akses Ditolak";
    message.textContent =
        window.currentUser?.role != "admin"
            ? "Kamu hanya bisa mengikuti maksimal 3 ekskul. Silakan keluar dari salah satu ekskul sebelum bergabung ke yang baru."
            : "Admin tidak diperkenankan untuk bergabung ke ekstrakurikuler";

    for (let i = 0; i < itemsToShow.length; i++) {
        const activity = itemsToShow[i];
        const card = document.createElement("div");
        card.className = "card";

        // Cek apakah activity ini milik user
        let isMyEkskul = false;
        for (let j = 0; j < ekskulUser.length; j++) {
            if (activity.id === ekskulUser[j].id) {
                isMyEkskul = true;
                break;
            }
        }

        let buttonClass = isMyEkskul
            ? "btn btn-success"
            : window.currentUser
            ? ekskulUser.length >= 3 || window.currentUser.role == "admin"
                ? "btn btn-disabled"
                : "btn btn-primary"
            : "btn btn-disabled";

        let buttonText = isMyEkskul
            ? "✨ Kelola Ekskul Saya"
            : window.currentUser
            ? ekskulUser.length >= 3 || window.currentUser.role == "admin"
                ? "🔒 Akses Terbatas"
                : "✨ Bergabung dengan Kegiatan"
            : "🔒 Login untuk Bergabung";

        let buttonAction = isMyEkskul
            ? ""
            : window.currentUser
            ? ekskulUser.length >= 3 || window.currentUser.role == "admin"
                ? `openModal('errorModal')`
                : `joinActivity(${activity.id}, '${activity.nama}')`
            : `showLoginRequired()`;

        card.innerHTML = `
            <div class="card-header">
                <div>
                    <h3 class="card-title">${activity.nama}</h3>
                </div>
                <span class="badge badge-success">Aktif</span>
            </div>
            <p class="card-description">${activity.deskripsi}</p>
            <div class="card-meta">
                <span>👨‍🏫 ${activity.pembina.name}</span>
                <span>👥 ${activity.siswa_count} anggota</span>
            </div>
            <div class="card-actions">
                <button class="${buttonClass}" style="width: 100%;" onclick="${buttonAction}">
                    ${buttonText}
                </button>
            </div>
        `;

        setTimeout(() => {
            card.classList.add("show");
        }, i * 100);

        grid.appendChild(card);
    }

    // Update counter
    const counter = document.getElementById("activitiesCounter");
    counter.textContent = `Menampilkan ${Math.min(
        endIndex,
        totalItems
    )} dari ${totalItems} kegiatan`;

    // Show/hide load more button
    const loadMoreBtn = document.getElementById("loadMoreActivities");
    loadMoreBtn.style.display = endIndex < totalItems ? "flex" : "none";
}

// Load Announcements with pagination
function loadAnnouncements() {
    const grid = document.getElementById("announcementsGrid");
    const state = paginationState.announcements;
    const startIndex = 0;
    const endIndex = state.currentPage * state.itemsPerPage;
    const itemsToShow = sampleAnnouncements.slice(startIndex, endIndex);
    const totalItems = sampleAnnouncements.length;

    // Clear existing cards
    grid.innerHTML = "";

    // Add cards with staggered animation
    itemsToShow.forEach((announcement, index) => {
        const card = document.createElement("div");
        card.className = "card";
        card.innerHTML = `
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">${announcement.judul}</h3>
                        </div>
                        <span class="badge">${announcement.ekskul.nama}</span>
                    </div>
                    <p class="card-description">${announcement.isi}</p>
                    <div class="card-meta">
                        <span>📅 ${new Date(
                            announcement.tanggal_pengumuman
                        ).toLocaleDateString("id-ID", {
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                        })}</span>
                        <span>📢 Pengumuman</span>
                    </div>
                `;

        // Add staggered animation
        setTimeout(() => {
            card.classList.add("show");
        }, index * 100);

        grid.appendChild(card);
    });

    // Update counter
    const counter = document.getElementById("announcementsCounter");
    counter.textContent = `Menampilkan ${Math.min(
        endIndex,
        totalItems
    )} dari ${totalItems} pengumuman`;

    // Show/hide load more button
    const loadMoreBtn = document.getElementById("loadMoreAnnouncements");
    if (endIndex < totalItems) {
        loadMoreBtn.style.display = "flex";
    } else {
        loadMoreBtn.style.display = "none";
    }
}

// Load Recent Activities with pagination
function loadRecentActivities() {
    const grid = document.getElementById("recentActivitiesGrid");
    const state = paginationState.recentActivities;
    const startIndex = 0;
    const endIndex = state.currentPage * state.itemsPerPage;
    const itemsToShow = sampleRecentActivities.slice(startIndex, endIndex);
    const totalItems = sampleRecentActivities.length;

    // Clear existing cards
    grid.innerHTML = "";

    // Add cards with staggered animation
    itemsToShow.forEach((activity, index) => {
        const card = document.createElement("div");
        card.className = "card";
        card.innerHTML = `
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">${activity.judul}</h3>
                        </div>
                        <span class="badge badge-warning">${
                            activity.ekskul.nama
                        }</span>
                    </div>
                    <p class="card-description">${activity.deskripsi}</p>
                    <div class="card-meta">
                        <span>📅 ${new Date(
                            activity.tanggal
                        ).toLocaleDateString("id-ID", {
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                        })}</span>
                        <span>🎯 Kegiatan</span>
                    </div>
                `;

        // Add staggered animation
        setTimeout(() => {
            card.classList.add("show");
        }, index * 100);

        grid.appendChild(card);
    });

    // Update counter
    const counter = document.getElementById("recentActivitiesCounter");
    counter.textContent = `Menampilkan ${Math.min(
        endIndex,
        totalItems
    )} dari ${totalItems} kegiatan`;

    // Show/hide load more button
    const loadMoreBtn = document.getElementById("loadMoreRecentActivities");
    if (endIndex < totalItems) {
        loadMoreBtn.style.display = "flex";
    } else {
        loadMoreBtn.style.display = "none";
    }
}

// Join Activity Function
function joinActivity(activityId, activityName) {
    document.getElementById("idEkskul").setAttribute("value", activityId);
    document
        .getElementById("selectedActivity")
        .setAttribute("value", activityName);
    document
        .getElementById("studentName")
        .setAttribute("value", window.currentUser.name);
    document
        .getElementById("studentEmail")
        .setAttribute("value", window.currentUser.email);
    document
        .getElementById("classStudent")
        .setAttribute("value", window.currentUser?.siswa_profile?.kelas ?? "");
    document
        .getElementById("studentPhone")
        .setAttribute(
            "value",
            window.currentUser?.siswa_profile?.no_telephone ?? ""
        );
    document
        .getElementById("studentAddress")
        .setAttribute("value", window.currentUser?.siswa_profile?.alamat ?? "");

    openModal("joinActivityModal");
}

function updateUIProfile() {
    document.getElementById("hero").style.display = "none";
    const isMobile = window.innerWidth <= 768; // bisa kamu sesuaikan breakpoint-nya

    document.getElementById("guestNav").style.display = "none";
    document.getElementById("profileNav").style.display = isMobile
        ? "none"
        : "flex";

    if (!isMobile) {
        const name = window.currentUser.name ?? "User";
        const role = window.currentUser.role ?? "-";
        const email = window.currentUser.email ?? "-";

        document.getElementById("userAvatar").textContent = name
            .charAt(0)
            .toUpperCase();
        document.getElementById("userName").textContent = name;
        document.getElementById("userRole").textContent = role;
        document.getElementById("dropdownAvatar").textContent = name
            .charAt(0)
            .toUpperCase();
        document.getElementById("dropdownName").textContent = name;
        document.getElementById("dropdownEmail").textContent = email;
        document.getElementById("dropdownRole").textContent = role;
    }
}

function updateMobileUIProfile() {
    if (!window.currentUser) {
        document.getElementById("loginButton").style.display = "block";
        document.getElementById("registerButton").style.display = "block";
        document.getElementById("logoutButton").style.display = "none";

        document
            .getElementById("accountBtn")
            .setAttribute("onclick", "openModal('loginModal')");
        document.getElementById("mobileUserSection").style.display = "none";
    } else {
        document.getElementById("loginButton").style.display = "none";
        document.getElementById("registerButton").style.display = "none";
        document.getElementById("logoutButton").style.display = "block";

        document
            .getElementById("accountBtn")
            .setAttribute("onclick", "openProfileModal()");
        document.getElementById("mobileUserSection").style.display = "grid";
    }
}

function switchProfileTab(tabName) {
    // Remove active class from all tabs and contents
    document.querySelectorAll(".profile-tab").forEach((tab) => {
        tab.classList.remove("active");
    });
    document.querySelectorAll(".profile-tab-content").forEach((content) => {
        content.classList.remove("active");
    });

    // Add active class to clicked tab and corresponding content
    event.target.classList.add("active");
    const tabContent = document.getElementById(tabName + "Tab");
    if (tabContent) {
        tabContent.classList.add("active");
    }
}

function toggleProfileDropdown() {
    const dropdown = document.getElementById("profileDropdown");
    const isShowing = dropdown.classList.contains("show");

    // Close other dropdowns
    closeAllDropdowns();

    if (!isShowing) {
        dropdown.classList.add("show");
        // Add click outside listener
        setTimeout(() => {
            document.addEventListener("click", handleClickOutside);
        }, 0);
    }
}

function closeAllDropdowns() {
    document.querySelectorAll(".profile-dropdown").forEach((dropdown) => {
        dropdown.classList.remove("show");
    });
    document.removeEventListener("click", handleClickOutside);
}

function closeProfileDropdown() {
    const dropdown = document.getElementById("profileDropdown");
    dropdown.classList.remove("show");
}

function handleClickOutside(event) {
    const profileTrigger = document.querySelector(".profile-trigger");
    const profileDropdown = document.getElementById("profileDropdown");

    if (profileTrigger && profileDropdown) {
        if (
            !profileTrigger.contains(event.target) &&
            !profileDropdown.contains(event.target)
        ) {
            closeProfileDropdown();
        }
    }
}

function markAllNotificationsAsRead() {
    // Animate notification items
    document
        .querySelectorAll(".notification-item.unread")
        .forEach((item, index) => {
            setTimeout(() => {
                item.classList.remove("unread");
                item.style.transform = "scale(0.98)";
                setTimeout(() => {
                    item.style.transform = "scale(1)";
                }, 150);
            }, index * 100);
        });

    // Hide notification badge with animation
    const badge = document.getElementById("notificationBadge");
    if (badge) {
        badge.style.transform = "scale(0)";
        setTimeout(() => {
            badge.style.display = "none";
        }, 300);
    }

    showNotification(
        "Berhasil!",
        "Semua notifikasi telah ditandai sebagai dibaca.",
        "success",
        2000
    );
}

function showLogoutConfirmation() {
    closeProfileDropdown();
    openModal("logoutModal");
}

async function getNewCsrfToken() {
    let res = await fetch("/csrf-token");
    let data = await res.json();
    document
        .querySelector('meta[name="csrf-token"]')
        .setAttribute("content", data.csrf_token);
}

function toggleGuestNav() {
    const isMobile = window.innerWidth <= 768;
    document.getElementById("guestNav").style.display = isMobile
        ? "none"
        : "flex";
}

async function confirmLogout() {
    // Show loading state on button
    const logoutBtn = document.querySelector("#logoutModal .btn-danger");
    const originalText = logoutBtn.innerHTML;
    logoutBtn.innerHTML = '<span class="loading-spinner"></span> Keluar...';
    logoutBtn.disabled = true;

    let response = await fetch("/logout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        credentials: "include", // penting kalau pakai session Laravel
    });

    let data = await response.json();

    if (data.status === "success") {
        window.ekskulsUser = [];
        currentUser = null;
        await getNewCsrfToken();
        closeModal("logoutModal");
        document.getElementById("hero").style.display = "flex";
        document.getElementById("profileNav").style.display = "none";
        toggleGuestNav();
        showNotification(
            "Berhasil Keluar!",
            "Anda telah berhasil keluar dari sistem. Terima kasih telah menggunakan EkstraKu!",
            "info"
        );

        logoutBtn.innerHTML = originalText;
        logoutBtn.disabled = false;

        loadActivities(window.ekskulsUser);

        // Scroll to top with smooth animation
        window.scrollTo({ top: 0, behavior: "smooth" });
        updateMobileUIProfile();
    } else {
        alert("Gagal logout: " + data.message);
    }
}

function formatTanggalIndo(datetime) {
    const date = new Date(datetime);
    const bulanIndo = [
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

    const tanggal = date.getUTCDate();
    const bulan = bulanIndo[date.getUTCMonth()];
    const tahun = date.getUTCFullYear();

    return `${tanggal} ${bulan} ${tahun}`;
}

function openProfileModal() {
    closeProfileDropdown();
    openModal("profileModal");
    loadProfileData();
    loadActivityCardProfile();
}

function loadProfileData() {
    // profile detail
    document.getElementById("profileName").textContent =
        window.currentUser.name;
    document.getElementById("profileEmail").textContent =
        window.currentUser.email;
    document.getElementById("profileRole").textContent =
        window.currentUser.role;
    document.getElementById("countActivities").textContent =
        window.currentUser.ekskuls.length;
    document.getElementById("totalActivities").textContent =
        window.currentUser.ekskuls.length;

    document.getElementById("profileFullName").textContent =
        window.currentUser.name;
    document.getElementById("profileEmailValue").textContent =
        window.currentUser.email;
    document.getElementById("classProfile").textContent =
        window.currentUser?.siswa_profile?.kelas ?? "-";
    document.getElementById("nis").textContent =
        window.currentUser?.siswa_profile?.nisn ?? "-";
    document.getElementById("date").textContent =
        formatTanggalIndo(window.currentUser.siswa_profile.created_at) ?? "-";

    document.getElementById("telephone-info").textContent =
        window.currentUser?.siswa_profile?.no_telephone ?? "-";
    document.getElementById("alamat-info").textContent =
        window.currentUser?.siswa_profile?.alamat ?? "-";
}

async function loadActivityCardProfile() {
    const grid = document.getElementById("activitiesTab");
    let responseEkskul = await fetch("/json/true", {
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    });

    let dataEkskul = await responseEkskul.json();
    const itemsToShow = dataEkskul;

    grid.innerHTML = "";

    itemsToShow.forEach((activity) => {
        const card = document.createElement("div");
        card.className = "activity-card";

        card.innerHTML = `
            <div class="activity-card-header">
                <div class="activity-card-title">${activity.nama}</div>
                <div class="activity-status">Aktif</div>
            </div>
            <div class="activity-card-meta">
                <span>👨‍🏫 ${activity.pembina.name}</span>
                <span>📅 Bergabung: 15 Jan 2024</span>
                <span>👥 ${activity.siswa_count} Anggota</span>
            </div>
            <div class="activity-card-description">
                ${activity.deskripsi}
            </div>
        `;

        grid.appendChild(card);
    });
}

// Form Handlers
document
    .getElementById("loginForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();

        if (!validateForm(this)) return;

        document.getElementById("errorForm").style.display = "none";

        const email = document.getElementById("loginEmail").value;
        const password = document.getElementById("loginPassword").value;
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;

        submitBtn.innerHTML = '<span class="loading-spinner"></span> Masuk...';
        submitBtn.disabled = true;

        let response = await fetch("/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            credentials: "include",
            body: JSON.stringify({ email, password }),
        });

        let data = await response.json();

        if (data.status === "success") {
            await getNewCsrfToken();
            window.currentUser = data.user;

            // Untuk user biasa, misal load data dan update UI secara dinamis
            let responseEkskul = await fetch("/json/true", {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            });

            let dataEkskul = await responseEkskul.json();

            if (data.user.role === "admin") {
                sessionStorage.setItem(
                    "dataEkskul",
                    JSON.stringify(dataEkskul)
                );
                sessionStorage.setItem("isAdminLogin", "true");
                sessionStorage.setItem("loginSuccessUI", "pending");

                window.location.href = "/ekstrasmexa/admin/dashboard";
            } else {
                showNotification(
                    "Berhasil Masuk!",
                    `Selamat datang kembali! Login berhasil untuk: ${email}`
                );

                closeModal("loginModal");
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                e.target.reset();
                clearFormValidation("loginModal");

                loadActivities(dataEkskul);
                updateUIProfile();
                updateMobileUIProfile();
            }
        } else {
            // Jika gagal login
            const inputs = document.querySelectorAll("#loginForm input");
            inputs.forEach((input) => input.classList.add("invalid"));

            setTimeout(() => {
                document.getElementById("errorForm").style.display = "flex";
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 500);
        }
    });

window.addEventListener("pageshow", (event) => {
    // Cek kalau ada flag loginSuccessUI pending
    if (sessionStorage.getItem("loginSuccessUI") === "pending") {
        loadTheme();
        // Jalankan kode UI yang kamu mau, contoh:
        closeModal("loginModal");

        const submitBtn = document.querySelector(
            "#loginForm button[type='submit']"
        );
        if (submitBtn) {
            submitBtn.innerHTML = "Masuk"; // atau originalText yang kamu simpan
            submitBtn.disabled = false;
        }

        const loginForm = document.getElementById("loginForm");
        if (loginForm) loginForm.reset();

        clearFormValidation("loginModal");

        // Ambil dataEkskul dari sessionStorage
        const dataEkskulStr = sessionStorage.getItem("dataEkskul");
        if (dataEkskulStr) {
            const dataEkskul = JSON.parse(dataEkskulStr);
            loadActivities(dataEkskul);
            updateUIProfile();
            updateMobileUIProfile();
        }

        // Setelah selesai, hapus flag supaya gak berulang terus
        sessionStorage.removeItem("loginSuccessUI");
    }
});

document
    .getElementById("registerForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();

        if (!validateForm(this)) {
            return;
        }

        const inputs = document.querySelectorAll("#registerForm input");
        const name = document.getElementById("registerName").value;
        const nisn = document.getElementById("registerNisn").value;
        const email = document.getElementById("registerEmail").value;
        const password = document.getElementById("registerPassword").value;
        const confirmPassword =
            document.getElementById("confirmPassword").value;

        const nisnInput = document.getElementById("registerNisn");

        if (password !== confirmPassword) {
            showNotification(
                "Kesalahan!",
                "Kata sandi tidak cocok! Silakan coba lagi.",
                "error"
            );
            return;
        }

        // Add loading state
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML =
            '<span class="loading-spinner"></span> Membuat akun...';
        submitBtn.disabled = true;

        let response = await fetch("/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                name,
                nisn,
                email,
                password,
            }),
        });

        let data = await response.json();

        console.log(data.user);

        if (data.status == "success") {
            let responseEkskul = await fetch("/json/true", {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            });

            let dataEkskul = await responseEkskul.json();

            window.currentUser = data.user;
            showNotification(
                "Pendaftaran Berhasil!",
                `🎉 Selamat datang di EkstraKu, ${name}! Akun Anda telah berhasil dibuat. Sekarang Anda dapat menjelajahi dan bergabung dengan kegiatan!`
            );
            closeModal("registerModal");
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            e.target.reset();
            clearFormValidation("registerModal");

            loadActivities(dataEkskul); // atau redirect ke halaman dashboard jika perlu

            updateUIProfile();
        } else {
            if (data.status == "nisnError") {
                nisnInput.classList.add("invalid");
                const validationMessage = nisnInput
                    .closest(".form-group")
                    .querySelector(".validation-message");
                validationMessage.textContent = data.message;
                validationMessage.classList.add("show");
            } else {
                inputs.forEach((input) => {
                    input.classList.add("invalid");
                });
            }

            document.getElementById("errorForm").style.display = "flex";
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });

document
    .getElementById("joinActivityForm")
    .addEventListener("submit", async function (e) {
        e.preventDefault();

        if (!validateForm(this)) {
            return;
        }

        const activityId = document.getElementById("idEkskul").value;
        const activityName = document.getElementById("selectedActivity").value;
        const studentName = document.getElementById("studentName").value;
        const studentEmail = document.getElementById("studentEmail").value;
        const studentClass = document.getElementById("classStudent").value;
        const studentTelephone = document.getElementById("studentPhone").value;
        const studentAddress = document.getElementById("studentAddress").value;
        const whyJoin = document.getElementById("whyJoin").value;

        // Add loading state
        const submitBtn = e.target.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML =
            '<span class="loading-spinner"></span> Mengirim...';
        submitBtn.disabled = true;

        let response = await fetch("/join-ekskul", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({
                ekskulId: activityId,
                studentName,
                studentEmail,
                studentTelephone,
                studentClass,
                studentAddress,
                whyJoin,
            }),
        });

        let data = await response.json();

        console.log(data);
        if (data.status == "success") {
            window.currentUser = data.user;
            let responseEkskul = await fetch("/json/true", {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            });

            let dataEkskul = await responseEkskul.json();

            showNotification(
                "Aplikasi Berhasil Dikirim!",
                `🎉 Aplikasi berhasil dikirim untuk ${activityName}! Mentor kami akan meninjau aplikasi Anda dan menghubungi dalam 2-3 hari kerja. Bersiaplah untuk memulai perjalanan bersama kami!`
            );
            closeModal("joinActivityModal");
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            e.target.reset();
            clearFormValidation("joinActivityModal");

            loadActivities(dataEkskul);
            updateUIProfile();
        } else {
            document.getElementById("errorTitle").textContent = data.title;
            document.getElementById("errorMessage").textContent = data.message;
            openModal("errorModal");
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            e.target.reset();
            clearFormValidation("joinActivityModal");
        }
    });

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});

// Initialize
document.addEventListener("DOMContentLoaded", function () {
    loadTheme();
    loadActivities(window.ekskulsUser);
    loadAnnouncements();
    loadRecentActivities();
    toggleGuestNav();
    window.addEventListener("resize", toggleGuestNav);

    if (window.currentUser) {
        updateUIProfile(); // panggil SEKALI saat awal
        updateMobileUIProfile();
    }

    window.addEventListener("resize", () => {
        if (window.currentUser) {
            updateUIProfile();
        }
    });

    // Add intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = "running";
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll(".fade-in").forEach((el) => {
        observer.observe(el);
    });

    // Highlight active section in bottom nav
    updateActiveNavLink();
    window.addEventListener("scroll", updateActiveNavLink);

    // Add real-time form validation
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
});

// Update active nav link based on scroll position
function updateActiveNavLink() {
    const links = document.querySelectorAll(".bottom-nav-link");
    let activeLink = null;

    links.forEach((link) => {
        const sectionId = link.dataset.section;
        if (sectionId === "none") return;

        const section = document.getElementById(sectionId);
        if (!section) return;

        const rect = section.getBoundingClientRect();
        if (rect.top <= 200 && rect.bottom >= 200) {
            activeLink = link;
        }
    });

    links.forEach((link) => {
        link.classList.toggle("active", link === activeLink);
    });
}

// Close mobile menu when clicking outside
document.addEventListener("click", function (event) {
    const mobileNav = document.getElementById("mobileNav");
    const mobileMenuBtn = document.querySelector(".mobile-menu-btn");

    if (
        !mobileNav.contains(event.target) &&
        !mobileMenuBtn.contains(event.target)
    ) {
        mobileNav.classList.remove("active");
    }
});

// Keyboard navigation support
document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
        // Close any open modals
        document.querySelectorAll(".modal.active").forEach((modal) => {
            const modalId = modal.id;
            modal.classList.remove("active");
            document.body.style.overflow = "auto";
            clearFormValidation(modalId);
        });

        // Close mobile menu
        closeMobileMenu();

        // Close any notifications
        document
            .querySelectorAll(".notification.show")
            .forEach((notification) => {
                const id = notification.id.replace("notification-", "");
                hideNotification(id);
            });
    }
});

// Ripple effect for touch devices
if ("ontouchstart" in window) {
    document.addEventListener("touchstart", function (e) {
        const target = e.target.closest(
            ".btn, .card, .mobile-nav-link, .bottom-nav-link"
        );
        if (!target) return;

        const rect = target.getBoundingClientRect();
        const x = e.touches[0].clientX - rect.left;
        const y = e.touches[0].clientY - rect.top;

        const ripple = document.createElement("span");
        ripple.className = "ripple";
        ripple.style.left = x + "px";
        ripple.style.top = y + "px";

        target.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
}
