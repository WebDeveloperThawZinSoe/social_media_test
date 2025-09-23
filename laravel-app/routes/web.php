<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get("/",[PageController::class,"index"]);
Route::get("/login",[PageController::class,"login"]);
Route::get("/profile",[PageController::class,"profile"]);