<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.custom', 'role:admin'])->group(function () {
    Route::get('/ekstrasmexa/admin/{any}', [AdminController::class, 'index'])->where('any', '.*');

    Route::resource('pembina', PembinaController::class);
    Route::resource('student', SiswaController::class);
    Route::resource('ekskul', EkskulController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('users', UserController::class);

    Route::put('/registration-approve', [PendaftaranController::class, 'approveRegistration']);
    Route::put('/registration-reject', [PendaftaranController::class, 'rejectRegistration']);
    Route::put('/approve-all', [PendaftaranController::class, 'approveAll']);

    Route::get('/get-mentors', [PembinaController::class, 'getPembinaJson']);
    Route::get('/get-activities', [EkskulController::class, 'getEkskulJson']);
    Route::get('/get-students', [SiswaController::class, 'getSiswaJson']);
    Route::get('/get-announcements', [PengumumanController::class, 'getPengumumanJson']);
    Route::get('/get-users', [UserController::class, 'getUserJson']);
});