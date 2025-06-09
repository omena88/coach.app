<?php

use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas del Instalador
|--------------------------------------------------------------------------
*/

Route::middleware(['install'])->prefix('install')->name('install.')->group(function () {
    Route::get('/', [InstallController::class, 'index'])->name('index');
    Route::get('/requirements', [InstallController::class, 'requirements'])->name('requirements');
    Route::get('/database', [InstallController::class, 'database'])->name('database');
    Route::post('/test-database', [InstallController::class, 'testDatabase'])->name('test-database');
    Route::get('/application', [InstallController::class, 'application'])->name('application');
    Route::get('/email', [InstallController::class, 'email'])->name('email');
    Route::get('/admin', [InstallController::class, 'admin'])->name('admin');
    Route::post('/process', [InstallController::class, 'install'])->name('process');
}); 