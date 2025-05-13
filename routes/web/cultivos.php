<?php

use App\Http\Controllers\CultivosController;
use App\Http\Middleware\AuthorizedMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/cultivos', [CultivosController::class, 'index'])
     ->name('cultivos.index')
     ->middleware(AuthorizedMiddleware::class . ':Cultivos.showCultivos');

Route::get('/cultivos/create', [CultivosController::class, 'create'])
    ->name('cultivos.create')
    ->middleware(AuthorizedMiddleware::class . ':Cultivos.createCultivos');

Route::get('/cultivos/edit/{id}', [CultivosController::class, 'edit'])
    ->name('cultivos.edit')
    ->middleware(AuthorizedMiddleware::class . ':Cultivos.updateCultivos');

Route::post('/cultivos/store', [CultivosController::class, 'store'])
    ->name('cultivos.store')
    ->middleware(AuthorizedMiddleware::class . ':Cultivos.createCultivos');

Route::put('/cultivos/update', [CultivosController::class, 'update'])
    ->name('cultivos.update')
    ->middleware(AuthorizedMiddleware::class . ':Cultivos.updateCultivos');

Route::delete('/cultivos/delete/{id}', [CultivosController::class, 'delete'])
    ->name('cultivos.delete')
    ->middleware(AuthorizedMiddleware::class . ':Cultivos.deleteCultivos');
