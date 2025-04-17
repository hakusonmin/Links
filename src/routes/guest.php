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
//個々だけuserでくくって上げる..
Route::get('/users/{user}/articles', [ArticleController::class, 'index'])->name('users.articles.index');
Route::get('articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/genres/{genre}/articles', [ArticleController::class, 'genre'])->name('articles.genre');

Route::get('users/search', [UserController::class, 'search'])->name('users.search');

