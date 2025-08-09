<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EkskulController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/ekstrasmexa', [GuestController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/join-ekskul', [EkskulController::class,'joinEkskul']);

Route::get('/json/{true}', [GuestController::class, 'getUserEkskul']);
Route::get('/csrf-token', function () {
    return ['csrf_token' => csrf_token()];
});