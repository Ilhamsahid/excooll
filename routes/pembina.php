<?php

use App\Http\Controllers\PembinaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth.custom', 'role:pembina'])->group(function(){
    Route::get('ekstrasmexa/pembina/{any}', [PembinaController::class, 'index'])->where('any', '.*')->name('dashboard.pembina');
    Route::resource('pembina', PembinaController::class);
    Route::resource('jadwal', SchedulesController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('pengumuman', PengumumanController::class);

    Route::put('/pendaftaran/{status}', [PendaftaranController::class, 'handleRegistration']);
});