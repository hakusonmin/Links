<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    #記事関係ルート
    Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    //CRUD以外
    Route::put('articles/{article}/toggle-publish', [ArticleController::class, 'togglePublish'])->name('articles.togglePublish');
    Route::post('/articles/{article}/like', [ArticleController::class, 'like'])->name('articles.like');
    Route::delete('/articles/{article}/unlike', [ArticleController::class, 'unlike'])->name('articles.unlike');

    #コメント関係ルート
    Route::prefix('articles/{article}')->scopeBindings()->group(function () {
        Route::get('comments/create', [CommentController::class, 'create'])->name('comments.create');
        Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
        Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
        Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

    //フォロー関係ルート
    Route::prefix('users/{user}')->group(function () {
        Route::post('follow', [UserController::class, 'follow'])->name('follow');
        Route::delete('unfollow', [UserController::class, 'unfollow'])->name('unfollow');
    });

    //マイページ関係ルート(likesはいいねした記事一覧/followsはフォローしているユーザー一覧)
    Route::prefix('mypage')->name('mypage.')->group(function () {
        Route::get('dashboard', [MyPageController::class, 'dashboard'])->name('dashboard');
        Route::get('liked-articles', [MyPageController::class, 'likedArticle'])->name('liked-articles');
        Route::get('followed-users', [MyPageController::class, 'followedUsers'])->name('followed-users');
        // ↓->name('mypage.')あるからprofileのコンフリクト安心
        Route::get('profile/edit', [MyPageController::class, 'profileEdit'])->name('profile.edit');
        Route::put('profile', [MyPageController::class, 'profileUpdate'])->name('profile.update');
    });
});
