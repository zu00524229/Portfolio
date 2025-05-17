<?php

use App\Http\Controllers\Front\PlayerController;
use Illuminate\Support\Facades\Route;

Route::post('/front/postRegister', [PlayerController::class, 'postRegister'])->name('front.postRegister');
