@extends('layouts.pembina')
@section('content')
    <!-- Dashboard Section -->
    @include('pembina.dashboard.overview')

    <!-- Profile Section -->
    @include('pembina.data.profile')

    <!-- Calendar Section -->
    @include('pembina.data.calendar')

    <!-- Attendance Section -->
    @include('pembina.data.attendance')

    <!-- Announcements Section -->
    @include('pembina.data.announcements')

    <!-- Students Section -->
    @include('pembina.data.students')

    {{-- Pendaftaran/application Section --}}
    @include('pembina.data.application')
@endsection

@section('outContent')
    @include('pembina.layouts.bottom-nav')

    <!-- Enhanced Modals -->
    @include('pembina.forms.schedule')

    @include('pembina.forms.announcements')

    @include('pembina.forms.activity')

    @include('pembina.forms.attendance')

    @include('pembina.forms.profile')

    @include('pembina.forms.students')

    @include('pembina.data.modal.attendance-profile')

    @include('pembina.forms.edit-attendance')

    @include('pembina.data.modal.delete')
@endsection