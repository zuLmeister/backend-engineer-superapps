<?php

use App\Http\Controllers\Document\DocumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('internal/document')->group(function () {
    // Get all
    Route::get('/', [DocumentController::class, 'index'])->name('document.index');

    // Store
    Route::post('/', [DocumentController::class, 'store'])->name('document.store');

    // Show single
    Route::get('/{userDocument}', [DocumentController::class, 'show'])->name(
        'document.show',
    );

    // Update
    Route::post('/{userDocument}', [DocumentController::class, 'update'])->name(
        'document.update',
    );

    // Delete
    Route::delete('/{userDocument}', [DocumentController::class, 'destroy'])->name(
        'document.destroy',
    );
});
