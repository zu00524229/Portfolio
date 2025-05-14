<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckManager
{
    public function handle(Request $request, Closure $next): Response
    {

        logger('CheckManager Middleware Debug', [
            'auth_check' => Auth::check(),
            'user' => Auth::user(),
            'session_managerId' => session('managerId'),
            'session_playerId' => session('playerId'),
            'session_role' => session('role'),
            'path' => $request->path(),
        ]);
        if (!session()->has('managerId') || session('role') !== 'admin') {
            return redirect('/')->with('error', '您沒有權限進入後台');
        }

        return $next($request);
    }
}
