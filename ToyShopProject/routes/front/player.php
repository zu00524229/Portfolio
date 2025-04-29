<?php

use App\Http\Controllers\Front\PlayerController;
use App\Http\Middleware\CheckPlayer;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "front/player"], function () {
    Route::get("playerInfo", [PlayerController::class, "playerInfo"])->middleware(CheckPlayer::class);
    Route::get("recharge", [PlayerController::class, "recharge"])->middleware(CheckPlayer::class);
    Route::post("postrecharge", [PlayerController::class, "postrecharge"])->middleware(CheckPlayer::class);
    Route::get("edit", [PlayerController::class,"edit"]);
    Route::post("update", [PlayerController::class,"update"]);
    Route::get("shippingList", [PlayerController::class,"shippingList"]);
});