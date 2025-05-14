<?php

use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('front.home');
Route::get('/index', [IndexController::class, 'index'])->name('front.index');

Route::group(["prefix" => "front"], function () {
    Route::get("login", [IndexController::class, "login"])->name('front.login');
    Route::post("postLogin", [IndexController::class, "postLogin"])->name('front.postLogin');
    Route::post("logout", [IndexController::class, "logout"])->name('front.logout');
    Route::get('register', [IndexController::class, 'register'])->name('front.register');
    Route::get("forget", [IndexController::class, "forget"]);
    Route::post("postForget", [IndexController::class, "postForget"]);
});

Route::get('/admin', [HomeController::class, 'home'])->name('admin.home');
