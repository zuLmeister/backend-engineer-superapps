<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListProject\ListProjectController;

Route::prefix('projects')->group(function () {
    // Get all
    Route::get('/', [ListProjectController::class, 'index'])->name('projects.index');

    // Store
    Route::post('/', [ListProjectController::class, 'store'])->name('projects.store');

    // Show single
    Route::get('/{listProject}', [ListProjectController::class, 'show'])->name('projects.show');

    // Update
    Route::match(['put', 'patch'], '/{listProject}', [ListProjectController::class, 'update'])->name('projects.update');

    // Delete
    Route::delete('/{listProject}', [ListProjectController::class, 'destroy'])->name('projects.destroy');
});
