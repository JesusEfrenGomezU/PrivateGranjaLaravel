<?php

use App\Http\Controllers\MantenimientosController;
use App\Http\Middleware\AuthorizedMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/mantenimientos', [MantenimientosController::class, 'index'])
     ->name('mantenimientos.index')
     ->middleware(AuthorizedMiddleware::class . ':Mantenimientos.showMantenimientos');

Route::get('/mantenimientos/create', [MantenimientosController::class, 'create'])
    ->name('mantenimientos.create')
    ->middleware(AuthorizedMiddleware::class . ':Mantenimientos.createMantenimientos');

Route::get('/mantenimientos/edit/{id}', [MantenimientosController::class, 'edit'])
    ->name('mantenimientos.edit')
    ->middleware(AuthorizedMiddleware::class . ':Mantenimientos.updateMantenimientos');

Route::post('/mantenimientos/store', [MantenimientosController::class, 'store'])
    ->name('mantenimientos.store')
    ->middleware(AuthorizedMiddleware::class . ':Mantenimientos.createMantenimientos');

Route::put('/mantenimientos/update', [MantenimientosController::class, 'update'])
    ->name('mantenimientos.update')
    ->middleware(AuthorizedMiddleware::class . ':Mantenimientos.updateMantenimientos');

Route::delete('/mantenimientos/delete/{id}', [MantenimientosController::class, 'delete'])
    ->name('mantenimientos.delete')
    ->middleware(AuthorizedMiddleware::class . ':Mantenimientos.deleteMantenimientos');
