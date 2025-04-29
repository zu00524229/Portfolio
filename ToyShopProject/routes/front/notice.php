<?php

use App\Http\Controllers\Front\NoticeController;
use Illuminate\Support\Facades\Route;

Route::get("/front/notice/list", [NoticeController::class, "list"]);