<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPlayer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 檢查是否有 playerId，如果沒有，則將當前的 URL 存入 session，並重定向到登入頁面
        if (empty(session()->get("playerId"))) {
            session(['intended_url' => url()->current()]); // 保存當前頁面 URL
            return redirect("/front/login");
        }

        return $next($request);
    }
}
