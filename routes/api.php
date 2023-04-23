<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(['auth:api']);
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'me']);
});

Route::apiResource('/posts', PostController::class)->only([
    'index', 'store', 'destroy'
]);

Route::apiResource('/comments/posts', CommentController::class)->only([
    'store'
]);

Route::apiResource('/posts/likes', LikeController::class)->only([
    'store'
]);

Route::apiResource('/likes/users/{user}/posts', LikeController::class)->only([
    'destroy'
]);

Route::get('/likes', [LikeController::class, 'countLikes']);
