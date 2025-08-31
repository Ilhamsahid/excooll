<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['auth.custom', 'role:pembina'])->group(function(){
    Route::get('ekstrasmexa/pembina/{any}', fn() => 'test')->where('any', '.*');
});