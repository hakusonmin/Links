<?php

use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MyPageUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    #記事関係ルート
    Route::prefix('users/{user}')->scopeBindings()->group(function () {
        Route::get('articles/create', [UserArticleController::class, 'create'])->name('articles.create');
        Route::post('articles', [UserArticleController::class, 'store'])->name('articles.store');
        Route::get('articles/{articles}/edit', [UserArticleController::class, 'edit'])->name('articles.edit');
        Route::put('articles/{articles}', [UserArticleController::class, 'update'])->name('articles.update');
        Route::delete('articles/{articles}', [UserArticleController::class, 'destroy'])->name('articles.destroy');
    });

    #コメント関係ルート
    Route::prefix('articles/{article}')->scopeBindings()->group(function () {
        Route::get('comments/create', [CommentController::class, 'create'])->name('comments.create');
        Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
        Route::get('comments/{comments}/edit', [CommentController::class, 'edit'])->name('comments.edit');
        Route::put('comments/{comments}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('comments/{comments}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

    //アカウント関係ルート
    Route::prefix('users/{user}')->group(function () {
        Route::post('like', [UserController::class, 'like'])->name('like');
        Route::delete('unlike', [UserController::class, 'unlike'])->name('unlike');
        Route::post('follow', [UserController::class, 'follow'])->name('follow');
        Route::delete('unfollow', [UserController::class, 'unfollow'])->name('unfollow');
    });

    //マイページ関係ルート(likesはいいねした記事一覧/followsはフォローしているユーザー一覧)
    Route::prefix('mypage')->name('mypage.')->group(function () {
        Route::get('dashboard', [MyPageUserController::class, 'dashboard'])->name('dashboard');
        Route::get('liked-articles', [MyPageUserController::class, 'likedArticle'])->name('liked-articles');
        Route::get('followed-users', [MyPageUserController::class, 'followedUsers'])->name('followed-users');
        // ↓->name('mypage.')あるからprofileのコンフリクト安心
        Route::get('profile/edit', [MyPageUserController::class, 'profileEdit'])->name('profile.edit');
        Route::put('profile', [MyPageUserController::class, 'profileUpdate'])->name('profile.update');
    });
});
