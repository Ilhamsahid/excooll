<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.custom', 'role:admin'])->group(function () {
    Route::view('ekstrasmexa/admin/dashboard', 'admin.dashboard');
});