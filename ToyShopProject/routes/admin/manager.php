<?php

use App\Http\Controllers\Admin\ManagerController;
use Illuminate\Support\Facades\Route;

// 後台管理系統-管理者 ManagerController
Route::group(["middleware::class", "prefix" => "admin/manager"], function(){
    Route::get("list", [ManagerController::class,"list"]);
    Route::get("add", [ManagerController::class,"add"]);
    Route::post("insert", [ManagerController::class,"insert"]);
    Route::get("edit/{Id}", [ManagerController::class,"edit"]);
    Route::post("update", [ManagerController::class,"update"]);
    Route::post("delete", [ManagerController::class,"delete"]);
});