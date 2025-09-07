<?php

use App\Http\Controllers\PembinaController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth.custom', 'role:pembina'])->group(function(){
    Route::get('ekstrasmexa/pembina/{any}', [PembinaController::class, 'index'])->where('any', '.*');
});