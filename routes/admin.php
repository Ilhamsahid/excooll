<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.custom', 'role:admin'])->group(function () {
    Route::get('/ekstrasmexa/admin/{any}', [AdminController::class, 'index'])->where('any', '.*');

    Route::get('/api', [AdminController::class, 'pengumuman']);
});