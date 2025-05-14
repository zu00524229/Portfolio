<?php

use App\Http\Controllers\Admin\MajorController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin/major')->group(function () {
    Route::get('list', [MajorController::class, 'list'])->name('admin.major.list');
    Route::get('add', [MajorController::class, 'add'])->name('admin.major.add');
    Route::post('insert', [MajorController::class, 'insert'])->name('admin.major.insert');
    Route::get('edit/{id}', [MajorController::class, 'edit'])->name('admin.major.edit');
    Route::post('update', [MajorController::class, 'update'])->name('admin.major.update');
    Route::post('delete', [MajorController::class, 'delete'])->name('admin.major.delete');
});
