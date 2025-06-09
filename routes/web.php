<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CommitmentController;
use App\Http\Controllers\CoacheeController;
use App\Http\Controllers\CoachController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para sesiones
    Route::resource('sessions', SessionController::class);
    
    // Rutas para compromisos
    Route::resource('commitments', CommitmentController::class);
    
    // Rutas para coachees
    Route::resource('coachees', CoacheeController::class);
    
    // Rutas para coaches (solo para administradores)
    Route::resource('coaches', CoachController::class);
});

require __DIR__.'/auth.php';
