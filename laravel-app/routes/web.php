<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactController;


Route::get('/login', [PageController::class, 'login'])->name("login");
Route::post("/login",[AuthController::class,"login"])->name("auth.login");
Route::post("/register",[AuthController::class,"register"])->name("auth.register");

Route::middleware('auth')->group(function () {
    Route::post("/logout",[AuthController::class,"logout"])->name('auth.logout');
    Route::get('/', [PageController::class, 'index'])->name("home");
    /* Profile */
    Route::get('/profile', [PageController::class, 'profile'])->name("profile");
    Route::get("/profile/{user_url}",[PageController::class,"other_profile"])->name("other_profile");
    /* Post  */
    Route::post("/post/store",[PostController::class,"store"])->name("post.store");
    Route::delete("/post/{id}/delete",[PostController::class,"delete"])->name("post.delete");
    /* React */
    Route::post("/react/toggle",[ReactController::class,"react_toggle"])->name("react.toggle");
});