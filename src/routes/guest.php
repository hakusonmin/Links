<?php

use App\Http\Controllers\Guest\ArticleController;
use App\Http\Controllers\Guest\ChapterController;
use App\Http\Controllers\Guest\NovelController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::prefix('guest')->name('guest.')->group(function () {
    Route::resource('novels', NovelController::class);

    Route::prefix('novels/{novel}')->scopeBindings()->group(function () {
        Route::resource('chapters', ChapterController::class);
    });

    Route::prefix('chapters/{chapter}')->scopeBindings()->group(function () {
        Route::resource('articles', ArticleController::class);
    });
});
