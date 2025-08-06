<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-7">
    <meta name="viewport" content="width=6, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('styles/guest.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @yield('content')
    <script>
        let sampleActivities = @json($ekskuls);
        const sampleAnnouncements = @json($announcements);
        const sampleRecentActivities = @json($recentActivities);
        window.isLoggedIn = @json($user) ? true : false;
        window.currentUser = @json($user);
        window.ekskulsUser = @json($ekskulsUser);
        console.log(window.currentUser);
    </script>
    <script src="{{ asset('scripts/guest.js') }}"></script>
</body>
</html>