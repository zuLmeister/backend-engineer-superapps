<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegulasiPerusahaan\RegulasiPerusahaanController;

Route::prefix('regulasi')->group(function () {
    // Get all
    Route::get('/', [RegulasiPerusahaanController::class, 'index'])->name('regulasi.index');

    // Store
    Route::post('/', [RegulasiPerusahaanController::class, 'store'])->name('regulasi.store');

    // Show single
    Route::get('/{regulasiPerusahaan}', [RegulasiPerusahaanController::class, 'show'])->name(
        'regulasi.show',
    );

    // Update
    Route::match(['put', 'patch'], '/{regulasiPerusahaan}', [
        RegulasiPerusahaanController::class,
        'update',
    ])->name('regulasi.update');

    // Delete
    Route::delete('/{regulasiPerusahaan}', [RegulasiPerusahaanController::class, 'destroy'])->name(
        'regulasi.destroy',
    );
});
