<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\PembinaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.custom', 'role:admin'])->group(function () {
    Route::get('/ekstrasmexa/admin/{any}', [AdminController::class, 'index'])->where('any', '.*');

    Route::post('/add-pembina', [PembinaController::class, 'addPembina']);
    Route::post('/add-ekskul', [EkskulController::class, 'addEkskul']);
    Route::get('/get-pembina', [PembinaController::class, 'getPembinaJson']);
});