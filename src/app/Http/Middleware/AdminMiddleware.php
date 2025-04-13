<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインが必要です');
        }
        
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            return redirect('/')->with('error', '管理者専用ページです');
        }

        return $next($request);
    }
}