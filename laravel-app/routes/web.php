<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;


Route::get('/login', [PageController::class, 'login'])->name("login");
Route::post("/login",[AuthController::class,"login"])->name("auth.login");
Route::post("/register",[AuthController::class,"register"])->name("auth.register");

Route::middleware('auth')->group(function () {
    Route::post("/logout",[AuthController::class,"logout"])->name('auth.logout');
    Route::get('/', [PageController::class, 'index'])->name("home");
    Route::get('/profile', [PageController::class, 'profile'])->name("profile");
});