<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.custom', 'role:admin'])->group(function () {
    Route::get('/ekstrasmexa/admin/{any}', function () {
        return view('admin.main'); // return blade utama yang isinya JS SPA kamu
    })->where('any', '.*');
});