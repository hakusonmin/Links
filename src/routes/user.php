<?php

use App\Http\Controllers\User\ArticleController;
use App\Http\Controllers\User\ChapterController;
use App\Http\Controllers\User\NovelController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('novels', NovelController::class);

    Route::prefix('novels/{novel}')->scopeBindings()->group(function () {
        Route::resource('chapters', ChapterController::class);
    });

    Route::prefix('chapters/{chapter}')->scopeBindings()->group(function () {
        Route::resource('articles', ArticleController::class);
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
