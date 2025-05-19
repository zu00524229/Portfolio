<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return view("admin.home");              // 回傳admin.home，後台首頁
    }

    public function logout(Request $req)
    {
        Auth::logout();                         // 執行Laravel的登出方法(會清空 Auth 登入狀態)

        $req->session()->invalidate();          // 清除整個Session，確保登入狀態與資料不殘留

        // 防止登出後還殘留舊狀態
        $req->session()->regenerateToken();     // 重新產生 CSRF Token (避免 token reuse 攻擊)
        // Laravel 的 CSRF token 是存在 session 裡的
        // 如果不重新產生，舊的 token 可能會被復用（資安問題）


        return redirect('/');                   // 登出後導向前台首頁
    }
}
