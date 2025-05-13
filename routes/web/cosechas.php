<?php

use App\Http\Controllers\CosechasController;
use App\Http\Middleware\AuthorizedMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/cosechas', [CosechasController::class, 'index'])
     ->name('cosechas.index')
     ->middleware(AuthorizedMiddleware::class . ':Cosechas.showCosechas');

Route::get('/cosechas/create', [CosechasController::class, 'create'])
    ->name('cosechas.create')
    ->middleware(AuthorizedMiddleware::class . ':Cosechas.createCosechas');

Route::get('/cosechas/edit/{id}', [CosechasController::class, 'edit'])
    ->name('cosechas.edit')
    ->middleware(AuthorizedMiddleware::class . ':Cosechas.updateCosechas');

Route::post('/cosechas/store', [CosechasController::class, 'store'])
    ->name('cosechas.store')
    ->middleware(AuthorizedMiddleware::class . ':Cosechas.createCosechas');

Route::put('/cosechas/update', [CosechasController::class, 'update'])
    ->name('cosechas.update')
    ->middleware(AuthorizedMiddleware::class . ':Cosechas.updateCosechas');

Route::delete('/cosechas/delete/{id}', [CosechasController::class, 'delete'])
    ->name('cosechas.delete')
    ->middleware(AuthorizedMiddleware::class . ':Cosechas.deleteCosechas');
