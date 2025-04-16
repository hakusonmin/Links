<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MyPageUserController extends Controller
{
    public function dashboard()  {
        return Inertia::render('User/MyPage/Dashboard', [
            'user' => Auth::user(),
        ]);
    }
}

