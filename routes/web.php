<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepuestoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('clientes', ClienteController::class);
    Route::resource('vehiculos', VehiculoController::class);
    Route::resource('ordenes', OrdenController::class)
        ->parameters(['ordenes' => 'orden']);
    Route::resource('repuestos', RepuestoController::class);
    Route::resource('facturas', FacturaController::class)
        ->except(['edit', 'update']);
});



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
