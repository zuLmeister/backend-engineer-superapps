<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Semua route API menggunakan format prefix + middleware yang konsisten.
|
*/

// Quiz routes

Route::middleware('auth.jwt.db1')->group(function () {
    require __DIR__ . '/modules/user-document.php';
    require __DIR__ . '/modules/regulasi-perusahaan.php';
    require __DIR__ . '/modules/document.php';
    require __DIR__ . '/modules/list-project.php';

});
