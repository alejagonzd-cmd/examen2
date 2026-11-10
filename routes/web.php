<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/vehiculos', [App\Http\Controllers\VehiculosController::class, 'index'])->name('vehiculos.index');

Route::get('/vehiculos/create', [App\Http\Controllers\VehiculosController::class, 'create'])->name('vehiculos.create');
Route::post('/vehiculos', [App\Http\Controllers\VehiculosController::class, 'store'])->name('vehiculos.store');
Route::get('/vehiculos/{id}/edit', [App\Http\Controllers\VehiculosController::class, 'edit'])->name('vehiculos.edit');
Route::put('/vehiculos/{id}', [App\Http\Controllers\VehiculosController::class, 'update'])->name('vehiculos.update');
Route::delete('/vehiculos/{id}', [App\Http\Controllers\VehiculosController::class, 'destroy'])->name('vehiculos.destroy');  







