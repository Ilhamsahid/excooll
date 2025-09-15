<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Unauthorized | EkstraKu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Light Mode Colors - synchronized with guest.html */
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-card: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --accent: #3b82f6;
            --accent-hover: #2563eb;
            --accent-light: #dbeafe;

            /* Shadows */
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

            /* Gradients */
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-accent: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);

            /* Transitions */
            --transition-fast: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 0.5s cubic-bezier(0.4, 0, 0.2, 1);

            /* 404 specific colors */
            --glow-color: rgba(59, 130, 246, 0.2);
            --glow-secondary: rgba(139, 92, 246, 0.15);
        }

        [data-theme="dark"] {
            /* Enhanced Dark Mode Colors - synchronized with guest.html */
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-card: #1e293b;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --border: #334155;
            --accent: #60a5fa;
            --accent-hover: #93c5fd;
            --accent-light: #1e3a8a;

            /* Enhanced Dark Mode Shadows */
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.5), 0 1px 2px -1px rgb(0 0 0 / 0.5);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.5), 0 2px 4px -2px rgb(0 0 0 / 0.5);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.5), 0 4px 6px -4px rgb(0 0 0 / 0.5);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.5), 0 8px 10px -6px rgb(0 0 0 / 0.5);

            /* Enhanced Dark Mode Gradients */
            --gradient-primary: linear-gradient(135deg, #4c1d95 0%, #1e1b4b 100%);
            --gradient-accent: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);

            /* Enhanced 404 specific colors for dark mode */
            --glow-color: rgba(96, 165, 250, 0.4);
            --glow-secondary: rgba(156, 39, 176, 0.3);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            position: relative;
            transition: all var(--transition-slow);
        }

        /* Background glow effect - enhanced for dark mode */
        .glow-effect {
            position: absolute;
            right: 20%;
            top: 50%;
            transform: translateY(-50%);
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, var(--glow-color) 0%, var(--glow-secondary) 40%, transparent 70%);
            border-radius: 50%;
            animation: pulse-glow 3s ease-in-out infinite alternate;
            transition: all var(--transition-slow);
            z-index: 1;
        }

        @keyframes pulse-glow {
            0% {
                transform: translateY(-50%) scale(1);
                opacity: 0.6;
            }

            100% {
                transform: translateY(-50%) scale(1.1);
                opacity: 0.9;
            }
        }

        /* Modern Header - synchronized with guest.html */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all var(--transition-normal);
        }

        [data-theme="dark"] .header {
            background: rgba(15, 23, 42, 0.85);
            box-shadow: var(--shadow-md);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            position: relative;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 800;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.025em;
            position: relative;
            z-index: 10;
        }

        [data-theme="dark"] .logo {
            text-shadow: 0 0 15px rgba(96, 165, 250, 0.5);
        }

        /* Theme toggle - enhanced styling */
        .theme-toggle {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.75rem;
            cursor: pointer;
            color: var(--text-primary);
            transition: all var(--transition-fast);
            font-size: 1.1rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
        }

        .theme-toggle:hover {
            background-color: var(--bg-secondary);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        [data-theme="dark"] .theme-toggle {
            box-shadow: 0 0 10px rgba(96, 165, 250, 0.2);
        }

        [data-theme="dark"] .theme-toggle:hover {
            box-shadow: 0 0 15px rgba(96, 165, 250, 0.4);
        }

        /* Main content */
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 5;
            padding: 2rem 0;
        }

        .content {
            max-width: 1200px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .left-content {
            flex: 1;
            max-width: 500px;
        }

        .error-code {
            font-size: 4.5rem;
            font-weight: 900;
            color: var(--text-primary);
            letter-spacing: 0.2rem;
            margin-bottom: 0.5rem;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-shift 3s ease-in-out infinite alternate;
        }

        @keyframes gradient-shift {
            0% {
                filter: hue-rotate(0deg);
            }

            100% {
                filter: hue-rotate(20deg);
            }
        }

        .error-subtitle {
            font-size: 1.2rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .error-message {
            font-size: 1rem;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            color: var(--text-primary);
            text-decoration: none;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all var(--transition-normal);
            box-shadow: var(--shadow);
        }

        .back-button:hover {
            border-color: var(--accent);
            background: var(--accent);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .right-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* 3D Illustration - enhanced for dark mode */
        .illustration {
            position: relative;
            width: 300px;
            height: 300px;
        }

        .sphere {
            position: absolute;
            border-radius: 50%;
            animation: float 4s ease-in-out infinite;
            transition: all var(--transition-slow);
        }

        .main-sphere {
            width: 120px;
            height: 120px;
            background: var(--gradient-accent);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 20px 40px var(--glow-color);
        }

        [data-theme="dark"] .main-sphere {
            box-shadow: 0 20px 40px rgba(96, 165, 250, 0.4);
        }

        .small-sphere-1 {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ff4081 0%, #e91e63 100%);
            top: 20%;
            right: 20%;
            animation-delay: -1s;
            box-shadow: 0 15px 30px rgba(255, 64, 129, 0.3);
        }

        [data-theme="dark"] .small-sphere-1 {
            box-shadow: 0 15px 30px rgba(255, 64, 129, 0.5);
        }

        .small-sphere-2 {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ffeb3b 0%, #ffc107 100%);
            bottom: 30%;
            left: 10%;
            animation-delay: -2s;
            box-shadow: 0 10px 20px rgba(255, 235, 59, 0.3);
        }

        [data-theme="dark"] .small-sphere-2 {
            box-shadow: 0 10px 20px rgba(255, 235, 59, 0.5);
        }

        .small-sphere-3 {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #4caf50 0%, #388e3c 100%);
            top: 10%;
            left: 30%;
            animation-delay: -3s;
            box-shadow: 0 8px 16px rgba(76, 175, 80, 0.3);
        }

        [data-theme="dark"] .small-sphere-3 {
            box-shadow: 0 8px 16px rgba(76, 175, 80, 0.5);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Particles - enhanced for dark mode */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--accent);
            border-radius: 50%;
            animation: particle-float 6s ease-in-out infinite;
            opacity: 0.6;
        }

        [data-theme="dark"] .particle {
            background: var(--accent);
            opacity: 0.8;
            box-shadow: 0 0 8px var(--accent);
        }

        .particle:nth-child(1) {
            top: 15%;
            right: 25%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            top: 30%;
            left: 15%;
            animation-delay: 1s;
        }

        @keyframes particle-float {

            0%,
            100% {
                opacity: 0.3;
                transform: translateY(0px) scale(1);
            }

            50% {
                opacity: 1;
                transform: translateY(-30px) scale(1.2);
            }
        }

        /* Loading animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .content>* {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .left-content {
            animation-delay: 0.2s;
        }

        .right-content {
            animation-delay: 0.4s;
        }

        /* Responsive Design */
        @media (max-width: 968px) {
            .content {
                flex-direction: column;
                text-align: center;
                gap: 3rem;
            }

            .error-code {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            .content {
                padding: 0 1rem;
            }

            .error-code {
                font-size: 3rem;
            }

            .illustration {
                width: 250px;
                height: 250px;
            }

            .main-sphere {
                width: 100px;
                height: 100px;
            }

            .glow-effect {
                width: 300px;
                height: 300px;
                right: 10%;
            }
        }

        @media (max-width: 480px) {
            .error-code {
                font-size: 2.5rem;
            }

            .error-subtitle {
                font-size: 1rem;
            }

            .error-message {
                font-size: 0.9rem;
            }

            .illustration {
                width: 200px;
                height: 200px;
            }

            .back-button {
                padding: 0.7rem 1.2rem;
                font-size: 0.85rem;
            }
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-hover);
        }
    </style>
</head>

<body>
    <div class="glow-effect"></div>

    <!-- Modern Header with only logo and theme toggle -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <div class="logo">EkstraKu</div>
                <button class="theme-toggle" onclick="toggleTheme()" aria-label="Ganti tema">🌙</button>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="content">
            <div class="left-content">
                <h1 class="error-code">403</h1>
                <p class="error-subtitle">Akses Terlarang</p>
                <p class="error-message">
                    Maaf, halaman yang Anda cari tidak diizinkan. Area
                    yang Anda coba akses hanya tersedia untuk pengguna dengan hak
                    akses khusus seperti Administrator, Instruktur, atau Siswa
                    terdaftar. Mari kembali ke halaman utama dan jelajahi konten menarik lainnya.
                </p>
                <a href="{{ request()->user() ? route('dashboard.' . request()->user()->role, 'dashboard') : route('ekstrasmexa') }}"
                    class="back-button">
                    <span>←</span> Kembali ke Beranda
                </a>
            </div>

            <div class="right-content">
                <div class="illustration">
                    <div class="sphere main-sphere"></div>
                    <div class="sphere small-sphere-1"></div>
                    <div class="sphere small-sphere-2"></div>
                    <div class="sphere small-sphere-3"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                    <div class="particle"></div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Theme management - synchronized with guest.html
        function toggleTheme() {
            const body = document.body;
            const themeToggle = document.querySelector('.theme-toggle');

            if (body.getAttribute('data-theme') === 'dark') {
                body.removeAttribute('data-theme');
                themeToggle.textContent = '🌙';
                localStorage.setItem('theme', 'light');
            } else {
                body.setAttribute('data-theme', 'dark');
                themeToggle.textContent = '☀️';
                localStorage.setItem('theme', 'dark');
            }
        }

        // Load saved theme
        function loadTheme() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (prefersDark ? 'dark' : 'light');
            const themeToggle = document.querySelector('.theme-toggle');

            if (theme === 'dark') {
                document.body.setAttribute('data-theme', 'dark');
                themeToggle.textContent = '☀️';
            } else {
                document.body.removeAttribute('data-theme');
                themeToggle.textContent = '🌙';
            }
        }

        function goHome() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '/';
            }
        }

        // Enhanced mouse move effect with performance optimization
        let animationFrame;

        function handleMouseMove(e) {
            if (animationFrame) {
                cancelAnimationFrame(animationFrame);
            }

            animationFrame = requestAnimationFrame(() => {
                const spheres = document.querySelectorAll('.sphere');
                const mouseX = (e.clientX / window.innerWidth - 0.5) * 2;
                const mouseY = (e.clientY / window.innerHeight - 0.5) * 2;

                spheres.forEach((sphere, index) => {
                    const speed = (index + 1) * 2;
                    const x = mouseX * speed;
                    const y = mouseY * speed;

                    sphere.style.transform += ` translate(${x}px, ${y}px)`;
                });

                // Update glow effect
                const glowEffect = document.querySelector('.glow-effect');
                const glowX = mouseX * 20;
                const glowY = mouseY * 20;
                glowEffect.style.transform = `translateY(-50%) translateX(${glowX}px) translateY(${glowY}px)`;
            });
        }

        // Debounced resize handler
        let resizeTimeout;

        function handleResize() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                // Reset transforms on resize
                const spheres = document.querySelectorAll('.sphere');
                spheres.forEach(sphere => {
                    sphere.style.transform = sphere.style.transform.replace(/translate$$[^)]*$$/g, '');
                });
            }, 250);
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            loadTheme();
            document.addEventListener('mousemove', handleMouseMove);
            window.addEventListener('resize', handleResize);
        });

        // Handle system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                const newTheme = e.matches ? 'dark' : 'light';
                const themeToggle = document.querySelector('.theme-toggle');

                if (newTheme === 'dark') {
                    document.body.setAttribute('data-theme', 'dark');
                    themeToggle.textContent = '☀️';
                } else {
                    document.body.removeAttribute('data-theme');
                    themeToggle.textContent = '🌙';
                }
            }
        });
    </script>
</body>

</html>
