<?php

use Inertia\Inertia;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ArticleController::class, 'home'])->name('home');

Route::get('/about', function () {
    return Inertia::render('Guest/About');
})->name('about');

Route::get('articles/search', [ArticleController::class, 'search'])->name('articles.search');

Route::get('/genres/{genre}/articles', [ArticleController::class, 'genre'])->name('articles.genre');

Route::prefix('articles/{article}')->scopeBindings()->group(function () {
    Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
});

Route::get('users/search', [UserController::class, 'search'])->name('users.search');

Route::get('articles', [UserArticleController::class, 'index'])->name('articles.index');
Route::get('articles/{article}', [UserArticleController::class, 'show'])->name('articles.show');
