<?php

use App\Http\Controllers\Front\IndexController;
use Illuminate\Support\Facades\Route;

// 首頁(前台)
Route::get('/', [IndexController::class, 'index'])->name('front.home');
Route::get('/index', [IndexController::class, 'index'])->name('front.index');

// 前台會員功能
Route::group(["prefix" => "front"], function () {
    Route::get("login", [IndexController::class, "login"])->name('front.login');                // 登入
    Route::post("postLogin", [IndexController::class, "postLogin"])->name('front.postLogin');   // 處理登入資料提交與驗證邏輯（帳號、密碼比對
    Route::post("logout", [IndexController::class, "logout"])->name('front.logout');            // 登出
    Route::get('register', [IndexController::class, 'register'])->name('front.register');       // 會員註冊
    Route::get("forget", [IndexController::class, "forget"]);                                   // 會員忘記密碼
    Route::post("postForget", [IndexController::class, "postForget"]);                          // 處理忘記密碼資料送出，驗證帳號與新密碼一致性，並更新資料庫
});
