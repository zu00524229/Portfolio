<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Middleware\CheckManager;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => CheckManager::class], function () {
    Route::get('home', [HomeController::class, 'home'])->name('admin.home');
    Route::post('logout', [HomeController::class, 'logout'])->name('admin.logout');
    // 其他後台功能
});
