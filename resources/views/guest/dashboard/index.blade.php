@extends('layouts.guest')

@section('content')
    <header class="header">
        <div class="container">
            @include('guest.dashboard.partials.layouts.navbar')
        </div>
    </header>

    @include('guest.dashboard.partials.layouts.bottom-nav')

    @include('guest.dashboard.partials.hero')

    <main class="main">
        <div class="container">
            @include('guest.dashboard.partials.stats')
            @include('guest.dashboard.partials.data.activities')
            @include('guest.dashboard.partials.data.announcements')
            @include('guest.dashboard.partials.about')
            @include('guest.dashboard.partials.how-to-work')
            @include('guest.dashboard.partials.questions')
            @include('guest.dashboard.partials.data.recent-activities')
        </div>
    </main>

    @include('guest.dashboard.partials.modal.login')
    @include('guest.dashboard.partials.modal.register')
    @include('guest.dashboard.partials.modal.join-activity')
    @include('guest.dashboard.partials.modal.login-required')
    @include('guest.dashboard.partials.data.modal.profile-modal')
    @include('guest.dashboard.partials.modal.logout')

    <!-- Enhanced Notification Container -->
    <div id="notificationContainer" class="notification-container">
        <!-- Notifications will be dynamically added here -->
    </div>
@endsection