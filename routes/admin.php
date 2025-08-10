<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EkskulController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.custom', 'role:admin'])->group(function () {
    Route::get('/ekstrasmexa/admin/{any}', [AdminController::class, 'index'])->where('any', '.*');

    Route::get('ekskul/api', [EkskulController::class, 'getAllEkskulWithRelation']);
});