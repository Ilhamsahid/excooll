<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <title>EkstraKu Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3"></script>
    <link rel="stylesheet" href="{{ asset('styles/admin.css') }}">
</head>

<body>
    <div class="admin-layout">
        @include('admin.layouts.sidebar')
        <main class="main-content">
            @include('admin.layouts.header')

            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
    <script>

        // ===== ENHANCED SAMPLE DATA =====
        const sampleData = {
            activities:  @json($ekstra) ,
            students: @json($siswa),
            registrations: @json($pendaftaran),
            announcements: @json($pengumuman),
            mentors: @json($pembina),
            users: [{
                    id: 1,
                    username: "admin",
                    email: "admin@ekstraku.edu",
                    role: "Admin",
                    lastLogin: "2024-03-15 10:30",
                    status: "aktif",
                    loginCount: 1245,
                    permissions: ["all"],
                },
                {
                    id: 2,
                    username: "johnson",
                    email: "johnson@school.edu",
                    role: "Mentor",
                    lastLogin: "2024-03-15 09:15",
                    status: "aktif",
                    loginCount: 523,
                    permissions: ["activities", "students"],
                },
                {
                    id: 3,
                    username: "ahmad.rizki",
                    email: "ahmad.rizki@student.edu",
                    role: "Siswa",
                    lastLogin: "2024-03-15 08:45",
                    status: "aktif",
                    loginCount: 189,
                    permissions: ["profile"],
                },
                {
                    id: 4,
                    username: "anderson",
                    email: "anderson@school.edu",
                    role: "Mentor",
                    lastLogin: "2024-03-14 16:20",
                    status: "aktif",
                    loginCount: 678,
                    permissions: ["activities", "students"],
                },
                {
                    id: 5,
                    username: "siti.nur",
                    email: "siti.nur@student.edu",
                    role: "Siswa",
                    lastLogin: "2024-03-14 14:30",
                    status: "aktif",
                    loginCount: 156,
                    permissions: ["profile"],
                },
                {
                    id: 6,
                    username: "dr.smith",
                    email: "smith@school.edu",
                    role: "Mentor",
                    lastLogin: "2024-03-14 11:45",
                    status: "aktif",
                    loginCount: 789,
                    permissions: ["activities", "students"],
                },
                {
                    id: 7,
                    username: "budi.santoso",
                    email: "budi.santoso@student.edu",
                    role: "Siswa",
                    lastLogin: "2024-03-13 15:20",
                    status: "aktif",
                    loginCount: 234,
                    permissions: ["profile"],
                },
                {
                    id: 8,
                    username: "wilson",
                    email: "wilson@school.edu",
                    role: "Mentor",
                    lastLogin: "2024-03-13 13:10",
                    status: "aktif",
                    loginCount: 456,
                    permissions: ["activities", "students"],
                },
                {
                    id: 9,
                    username: "maya.sari",
                    email: "maya.sari@student.edu",
                    role: "Siswa",
                    lastLogin: "2024-03-13 09:30",
                    status: "aktif",
                    loginCount: 167,
                    permissions: ["profile"],
                },
                {
                    id: 10,
                    username: "davis",
                    email: "davis@school.edu",
                    role: "Mentor",
                    lastLogin: "2024-03-12 17:45",
                    status: "aktif",
                    loginCount: 612,
                    permissions: ["activities", "students"],
                },
            ],
            activities_recent: [{
                    icon: "👥",
                    title: "Siswa baru mendaftar",
                    description: "Ahmad Rizki mendaftar ke Klub Basket",
                    time: "10 menit yang lalu",
                    type: "success",
                    category: "registration",
                },
                {
                    icon: "📢",
                    title: "Pengumuman dipublikasi",
                    description: "Pengumuman turnamen basket telah dipublikasi",
                    time: "30 menit yang lalu",
                    type: "info",
                    category: "announcement",
                },
                {
                    icon: "✅",
                    title: "Pendaftaran disetujui",
                    description: "5 pendaftaran baru telah disetujui",
                    time: "1 jam yang lalu",
                    type: "success",
                    category: "approval",
                },
                {
                    icon: "👨‍🏫",
                    title: "Mentor baru ditambahkan",
                    description: "Dr. Tech bergabung sebagai pembina robotika",
                    time: "2 jam yang lalu",
                    type: "warning",
                    category: "mentor",
                },
                {
                    icon: "📊",
                    title: "Laporan bulanan",
                    description: "Laporan partisipasi bulan Maret telah dibuat",
                    time: "3 jam yang lalu",
                    type: "info",
                    category: "report",
                },
                {
                    icon: "🎯",
                    title: "Kegiatan diperbarui",
                    description: "Jadwal Komunitas Drama telah diperbarui",
                    time: "4 jam yang lalu",
                    type: "warning",
                    category: "update",
                },
                {
                    icon: "🔔",
                    title: "Notifikasi sistem",
                    description: "Backup data berhasil dilakukan",
                    time: "5 jam yang lalu",
                    type: "success",
                    category: "system",
                },
                {
                    icon: "📝",
                    title: "Pendaftaran baru",
                    description: "Siti Nurhaliza mendaftar ke Komunitas Drama",
                    time: "6 jam yang lalu",
                    type: "info",
                    category: "registration",
                },
                {
                    icon: "🏆",
                    title: "Prestasi baru",
                    description: "Tim Debat meraih juara 1 tingkat kota",
                    time: "1 hari yang lalu",
                    type: "success",
                    category: "achievement",
                },
                {
                    icon: "📅",
                    title: "Jadwal diperbarui",
                    description: "Jadwal latihan Band Musik diubah",
                    time: "1 hari yang lalu",
                    type: "warning",
                    category: "schedule",
                },
            ],
        };
        console.log(sampleData)
    </script>

    <script src="{{ asset('scripts/admin.js') }}"></script>
</body>

</html>
