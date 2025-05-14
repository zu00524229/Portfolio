<?php

use App\Http\Controllers\Admin\AdminPlayerController;
use Illuminate\Support\Facades\Route;

// 後台管理系統-商品管理 AdminProductController
Route::group(["middleware::class", "prefix" => "admin/player"], function () {
    Route::get("playerList", [AdminPlayerController::class, "playerList"]);
    Route::get("rechargeList/{Id}", [AdminPlayerController::class, "rechargeList"]);
    Route::get("lotteryList/{Id}", [AdminPlayerController::class, "lotteryList"]);
    Route::get("shippingList/{Id}", [AdminPlayerController::class, "shippingList"]);
    Route::get("rechargeAllList", [AdminPlayerController::class, "rechargeAllList"]);
    Route::get("lotteryAllList", [AdminPlayerController::class, "lotteryAllList"]);
    Route::get("shippingAllList", [AdminPlayerController::class, "shippingAllList"]);
});
