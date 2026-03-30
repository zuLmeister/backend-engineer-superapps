<?php

use App\Http\Controllers\UserDocument\UserDocumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('document')->group(function () {
    // Get all
    Route::get('/', [UserDocumentController::class, 'index'])->name('userdocuments.index');

    // Store
    Route::post('/', [UserDocumentController::class, 'store'])->name('userdocuments.store');

    // Show single
    Route::get('/{userDocument}', [UserDocumentController::class, 'show'])->name(
        'userdocuments.show',
    );

    // Update
    Route::post('/{userDocument}', [UserDocumentController::class, 'update'])->name(
        'userdocuments.update',
    );

    // Delete
    Route::delete('/{userDocument}', [UserDocumentController::class, 'destroy'])->name(
        'userdocuments.destroy',
    );
});
