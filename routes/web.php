<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AsistenciaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('empleados', EmpleadoController::class)->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('asistencias', [AsistenciaController::class, 'index'])->name('asistencias.index');
    Route::post('asistencias/entrada/{empleado_id}', [AsistenciaController::class, 'registrarEntrada'])->name('asistencias.entrada');
    Route::post('asistencias/salida/{empleado_id}', [AsistenciaController::class, 'registrarSalida'])->name('asistencias.salida');
});

// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('asistencias/registrar', [AsistenciaController::class, 'registrarFormulario'])->name('asistencias.registrar');
    Route::post('asistencias/entrada/{empleado_id}', [AsistenciaController::class, 'registrarEntrada'])->name('asistencias.entrada');
    Route::post('asistencias/salida/{empleado_id}', [AsistenciaController::class, 'registrarSalida'])->name('asistencias.salida');
});

Route::post('asistencias/registrar', [AsistenciaController::class, 'registrar'])->name('asistencias.registrar');


require __DIR__.'/auth.php';
