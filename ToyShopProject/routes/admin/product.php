<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\ProductAwardsController;
use App\Http\Controllers\Admin\ProductCategoryController;
use Illuminate\Support\Facades\Route;

// 後台管理系統-商品管理 AdminProductController
Route::group(["middleware::class", "prefix" => "admin/product"], function(){
    Route::get("list", [AdminProductController::class,"list"]);
    Route::get("add", [AdminProductController::class,"add"]);
    Route::post("insert", [AdminProductController::class,"insert"]);
    Route::get("edit/{Id}", [AdminProductController::class,"edit"]);
    Route::post("update", [AdminProductController::class,"update"]);
    Route::post("delete", [AdminProductController::class,"delete"]);
});

// 後台管理系統-商品標籤 ProductCategoryController
Route::group(["middleware::class", "prefix" => "admin/productCategory"], function(){
    Route::get("list", [ProductCategoryController::class,"list"]);
    Route::get("add", [ProductCategoryController::class,"add"]);
    Route::post("insert", [ProductCategoryController::class,"insert"]);
    Route::get("edit/{Id}", [ProductCategoryController::class,"edit"]);
    Route::post("update", [ProductCategoryController::class,"update"]);
    Route::post("delete", [ProductCategoryController::class,"delete"]);
});

// 後台管理系統-商品獎項 ProductAwardsController
Route::group(["middleware::class", "prefix" => "admin/productAwards"], function(){
    Route::get("list/{Id}", [ProductAwardsController::class,"list"]);
    Route::get("add/{Id}", [ProductAwardsController::class,"add"]);
    Route::post("insert", [ProductAwardsController::class,"insert"]);
    Route::get("edit/{Id}", [ProductAwardsController::class,"edit"]);
    Route::post("update", [ProductAwardsController::class,"update"]);
    Route::post("delete", [ProductAwardsController::class,"delete"]);
});