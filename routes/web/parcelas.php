<?php

use App\Http\Controllers\ParcelasController;
use Illuminate\Support\Facades\Route;

Route::get('/parcelas', [ParcelasController::class, 'index'])
     ->name('parcelas.index');

Route::get('/parcelas/create', [ParcelasController::class, 'create'])
    ->name('parcelas.create');

Route::get('/parcelas/edit/{id}', [ParcelasController::class, 'edit'])
    ->name('parcelas.edit');

Route::post('/parcelas/store', [ParcelasController::class, 'store'])
    ->name('parcelas.store');

Route::put('/parcelas/update', [ParcelasController::class, 'update'])
    ->name('parcelas.update');

Route::delete('/parcelas/delete/{id}', [ParcelasController::class, 'delete'])
    ->name('parcelas.delete');
