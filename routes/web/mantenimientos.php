<?php

use App\Http\Controllers\MantenimientosController;
use Illuminate\Support\Facades\Route;

Route::get('/mantenimientos', [MantenimientosController::class, 'index'])
     ->name('mantenimientos.index');

Route::get('/mantenimientos/create', [MantenimientosController::class, 'create'])
    ->name('mantenimientos.create');

Route::get('/mantenimientos/edit/{id}', [MantenimientosController::class, 'edit'])
    ->name('mantenimientos.edit');

Route::post('/mantenimientos/store', [MantenimientosController::class, 'store'])
    ->name('mantenimientos.store');

Route::put('/mantenimientos/update', [MantenimientosController::class, 'update'])
    ->name('mantenimientos.update');

Route::delete('/mantenimientos/delete/{id}', [MantenimientosController::class, 'delete'])
    ->name('mantenimientos.delete');
