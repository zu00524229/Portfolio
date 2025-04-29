<?php

use App\Http\Controllers\Admin\AdminNoticeController;
use Illuminate\Support\Facades\Route;

// 後台管理系統-公告管理 AdminNoticeController
Route::group(["middleware::class", "prefix" => "admin/notice"], function(){
    Route::get("list", [AdminNoticeController::class,"list"]);
    Route::get("add", [AdminNoticeController::class,"add"]);
    Route::post("insert", [AdminNoticeController::class,"insert"]);
    Route::get("edit/{Id}", [AdminNoticeController::class,"edit"]);
    Route::post("update", [AdminNoticeController::class,"update"]);
    Route::post("delete", [AdminNoticeController::class,"delete"]);
});