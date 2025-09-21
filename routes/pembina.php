<?php

use App\Http\Controllers\PembinaController;
use App\Http\Controllers\SchedulesController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth.custom', 'role:pembina'])->group(function(){
    Route::get('ekstrasmexa/pembina/{any}', [PembinaController::class, 'index'])->where('any', '.*')->name('dashboard.pembina');
    Route::resource('pembina', PembinaController::class);
    Route::resource('jadwal', SchedulesController::class);
});