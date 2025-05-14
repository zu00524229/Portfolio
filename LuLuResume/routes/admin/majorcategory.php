<?php

use App\Http\Controllers\Admin\MajorCategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin/major-category')->group(function () {
    Route::get('list', [MajorCategoryController::class, 'list'])->name('admin.major_category.list');
    Route::get('add', [MajorCategoryController::class, 'add'])->name('admin.major_category.add');
    Route::post('insert', [MajorCategoryController::class, 'insert'])->name('admin.major_category.insert');
    Route::get('edit/{id}', [MajorCategoryController::class, 'edit'])->name('admin.major_category.edit');
    Route::post('update', [MajorCategoryController::class, 'update'])->name('admin.major_category.update');
    Route::post('delete', [MajorCategoryController::class, 'delete'])->name('admin.major_category.delete');
});
