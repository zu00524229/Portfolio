<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Middleware\CheckManager;
use Illuminate\Support\Facades\Route;

Route::get('/admin/contact/contactList', [ContactController::class, 'contactList'])->middleware(CheckManager::class);