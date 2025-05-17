<?php

use App\Http\Controllers\Admin\AdminPlayerController;
use Illuminate\Support\Facades\Route;

// 後台管理系統-會員管理 AdminProductController
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/player/list', [AdminPlayerController::class, 'list'])->name('admin.player.list');
    Route::get('/player/edit/{id}', [AdminPlayerController::class, 'edit'])->name('admin.player.edit');
    Route::post('/player/update', [AdminPlayerController::class, 'update'])->name('admin.player.update');
    Route::post('/player/delete', [AdminPlayerController::class, 'delete'])->name('admin.player.delete');
});
