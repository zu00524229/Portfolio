<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Middleware\CheckPlayer;
use Illuminate\Support\Facades\Route;

Route::get("/front/cart/list", [CartController::class, "list"])->middleware(CheckPlayer::class);
Route::post("/front/cart/shipping", [CartController::class, "shipping"])->middleware(CheckPlayer::class);