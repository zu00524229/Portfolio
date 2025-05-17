<?php

use App\Http\Controllers\Front\PlayerController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "front"], function () {
    Route::get('dashboard', [PlayerController::class, 'dashboard'])->name('front.player.dashboard');
    Route::get('edit', [PlayerController::class, 'edit'])->name('front.player.edit');
    Route::post('update', [PlayerController::class, 'update'])->name('front.player.update');
});
