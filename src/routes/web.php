<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('User/User/Index');
})->name('home');

require __DIR__.'/settings.php';

require __DIR__.'/auth.php';

require __DIR__.'/user.php';

require __DIR__.'/guest.php';

require __DIR__.'/admin.php';
