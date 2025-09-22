<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EkstraKu Pembina - Dashboard Supervisor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3"></script>
    <link rel="stylesheet" href="{{ asset('styles/pembina.css') }}">
</head>

<body>
    <div class="pembina-layouts">
        @include('pembina.layouts.sidebar')
        <main class="main-content">
            @include('pembina.layouts.header')

            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('outContent')

    <div id="notificationContainer" class="notification-container"></div>

    <script>
        let pembina = @json($pembina);
        // Sample schedule data for Klub Basket only
        const ekskulSchTemp = @json($ekskulSchedules);

        let ekskulSchedules = ekskulSchTemp.reduce((acc, item) => {
            if(!acc[item.tanggal]){
                acc[item.tanggal] = [];
            }

            acc[item.tanggal].push(item);
            return acc;
        }, {});

        let latestId = Object.values(ekskulSchedules)
        .flat()
        .reduce((max, item) => {
            if(item.id > max) {
                max = item.id
            }
            return max;
        }, 0);

        const siswa = @json($siswa);
        console.log(siswa);
    </script>
    <script src="{{ asset('scripts/pembina.js') }}"></script>
</body>

</html>
