<?php

use App\Http\Controllers\Front\PlayerController;
use Illuminate\Support\Facades\Route;

// 會員專區、會員修改
Route::group(["prefix" => "front"], function () {
    Route::get('dashboard', [PlayerController::class, 'dashboard'])->name('front.player.dashboard');
    Route::get('edit', [PlayerController::class, 'edit'])->name('front.player.edit');
    Route::post('update', [PlayerController::class, 'update'])->name('front.player.update');


    Route::get('register', [PlayerController::class, 'register'])->name('front.register'); // 顯示註冊頁面
    Route::post('postRegister', [PlayerController::class, 'postRegister'])->name('front.postRegister');
});
