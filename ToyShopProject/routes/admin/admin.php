<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Middleware\CheckManager;
use Illuminate\Support\Facades\Route;

// 後台管理系統- 登入 HomeController
Route::group(["prefix" => "admin"], function(){
    Route::get('home', [HomeController::class, 'home'])->name('admin.home')->middleware(CheckManager::class); // 後台首頁
    Route::get('login', [HomeController::class, 'login'])->name('admin.login'); // 登入頁
    Route::post('postLogin', [HomeController::class, 'postLogin'])->name('admin.postLogin'); // 處理登入
    Route::get('forget', [HomeController::class, 'forget'])->name('admin.forget'); // 忘記密碼頁
    Route::post('postForget', [HomeController::class, 'postForget'])->name('admin.postForget'); // 處理忘記密碼
    Route::post('logout', [HomeController::class, 'logout'])->name('admin.logout'); // 登出
});