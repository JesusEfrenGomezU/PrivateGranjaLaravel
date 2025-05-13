<?php

use App\Http\Controllers\ParcelasController;
use App\Http\Middleware\AuthorizedMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/parcelas', [ParcelasController::class, 'index'])
     ->name('parcelas.index')
     ->middleware(AuthorizedMiddleware::class . ':Parcelas.showParcelas');

Route::get('/parcelas/create', [ParcelasController::class, 'create'])
    ->name('parcelas.create')
    ->middleware(AuthorizedMiddleware::class . ':Parcelas.createParcelas');

Route::get('/parcelas/edit/{id}', [ParcelasController::class, 'edit'])
    ->name('parcelas.edit')
    ->middleware(AuthorizedMiddleware::class . ':Parcelas.updateParcelas');

Route::post('/parcelas/store', [ParcelasController::class, 'store'])
    ->name('parcelas.store')
    ->middleware(AuthorizedMiddleware::class . ':Parcelas.createParcelas');

Route::put('/parcelas/update', [ParcelasController::class, 'update'])
    ->name('parcelas.update')
    ->middleware(AuthorizedMiddleware::class . ':Parcelas.updateParcelas');

Route::delete('/parcelas/delete/{id}', [ParcelasController::class, 'delete'])
    ->name('parcelas.delete')
    ->middleware(AuthorizedMiddleware::class . ':Parcelas.deleteParcelas');
