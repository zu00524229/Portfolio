<?php

use App\Http\Controllers\Front\ContactController;
use Illuminate\Support\Facades\Route;

Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.store');
