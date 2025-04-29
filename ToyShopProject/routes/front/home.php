<?php

use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\RechargeController;
use App\Http\Middleware\CheckPlayer;
use Illuminate\Support\Facades\Route;

Route::get("/", [IndexController::class, "index"])->name('front.index');

Route::group(["prefix" => "front"], function () {
    Route::get("login", [IndexController::class, "login"])->name('front.login');
    Route::post("postLogin", [IndexController::class, "postLogin"]);
    Route::get("logout", [IndexController::class, "logout"]);
    Route::get("forget", [IndexController::class, "forget"]);
    Route::post("postForget", [IndexController::class, "postForget"]);
    Route::get("register", [IndexController::class, "register"]);
    Route::post('postRegister', [IndexController::class, 'postRegister']);
    Route::post('contact', [IndexController::class, 'contact']);
});
