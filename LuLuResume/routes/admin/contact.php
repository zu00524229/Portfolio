<?php

use App\Http\Controllers\Admin\AdminContactController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('list', [AdminContactController::class, 'index'])->name('admin.contact.list');
    Route::get('edit/{id}', [AdminContactController::class, 'edit'])->name("admin.contact.edit");
    Route::post('update/{id}', [AdminContactController::class, 'update'])->name("admin.contact.update");
    Route::post('delete', [AdminContactController::class, 'destroy'])->name("admin.contact.delete");
});
