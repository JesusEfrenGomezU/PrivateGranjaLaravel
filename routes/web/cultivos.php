<?php

use App\Http\Controllers\CultivosController;
use Illuminate\Support\Facades\Route;

Route::get('/cultivos', [CultivosController::class, 'index'])
     ->name('cultivos.index');

Route::get('/cultivos/create', [CultivosController::class, 'create'])
    ->name('cultivos.create');

Route::get('/cultivos/edit/{id}', [CultivosController::class, 'edit'])
    ->name('cultivos.edit');

Route::post('/cultivos/store', [CultivosController::class, 'store'])
    ->name('cultivos.store');

Route::put('/cultivos/update', [CultivosController::class, 'update'])
    ->name('cultivos.update');

Route::delete('/cultivos/delete/{id}', [CultivosController::class, 'delete'])
    ->name('cultivos.delete');
