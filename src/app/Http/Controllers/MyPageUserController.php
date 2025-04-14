<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\FnStream;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MyPageUserController extends Controller
{
    public function dashboard()  {
        return Inertia::render('User/MyPage/Dashboard');
    }
}
