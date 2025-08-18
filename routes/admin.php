<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.custom', 'role:admin'])->group(function () {
    Route::get('/ekstrasmexa/admin/{any}', [AdminController::class, 'index'])->where('any', '.*');

    Route::post('/add-pembina', [PembinaController::class, 'addPembina']);
    Route::post('/add-student', [SiswaController::class, 'addSiswa']);
    Route::post('/add-ekskul', [EkskulController::class, 'addEkskul']);
    Route::post('/add-pengumuman', [PengumumanController::class, 'addPengumuman']);
    Route::put('/registration-approve', [PendaftaranController::class, 'approveRegistration']);
    Route::put('/approve-all', [PendaftaranController::class, 'approveAll']);

    Route::get('/get-mentors', [PembinaController::class, 'getPembinaJson']);
    Route::get('/get-ekskul', [EkskulController::class, 'getEkskulJson']);
    Route::get('/get-students', [SiswaController::class, 'getSiswaJson']);
    Route::get('/get-pengumuman', [PengumumanController::class, 'getPengumumanJson']);
});