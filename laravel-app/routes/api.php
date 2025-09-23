<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\APISController;

Route::post('/register', [APISController::class, 'register']);
Route::post('/login', [APISController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [APISController::class, 'logout']);
    Route::get('/news-feed', [APISController::class, 'newsFeed']);
    Route::get('/my-profile', [APISController::class, 'myProfile']);
    Route::get('/my-posts', [APISController::class, 'myPosts']);
    Route::post('/post/store', [APISController::class, 'PostStore']);
    Route::delete('/post/{id}', [APISController::class, 'deleteMyPost']);
    Route::post('/react-toggle', [APISController::class, 'reactToggle']);
    Route::post('/comment', [APISController::class, 'comment']);
    Route::delete('/comment/{id}', [APISController::class, 'deleteComment']);
});
