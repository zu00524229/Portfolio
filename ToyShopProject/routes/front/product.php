<?php

use App\Http\Controllers\Front\ProductController;
use App\Http\Middleware\CheckPlayer;
use Illuminate\Support\Facades\Route;

// 商品管理
Route::group(['prefix' => 'front/product'], function () {
    Route::get('productAllList', [ProductController::class, 'productAllList']);
    Route::get('productCategoryList/{Id}', [ProductController::class, 'productCategoryList']);
    Route::get('productList/{Id}', [ProductController::class, 'productList']);
    Route::any('lottery', [ProductController::class, 'lottery'])->middleware(CheckPlayer::class);
});
