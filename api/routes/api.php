<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserBlogController;
use Illuminate\Support\Facades\Route;
use Tighten\Ziggy\Ziggy;

Route::get('ziggy', fn() => response()->json(new Ziggy));

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('send-otp', OtpController::class)->name('send-otp');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me'])->name('me');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('manage')->name('user.')->group(function () {
        Route::apiResource('blogs', UserBlogController::class);
    });
    Route::apiResource('blogs.comments', CommentController::class);
});


Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('search', SearchController::class)->name('blogs.search');
