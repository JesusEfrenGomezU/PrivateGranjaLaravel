<?php

use App\Http\Controllers\CultivoparcelasController;
use Illuminate\Support\Facades\Route;




Route::get('/cultivoparcelas', [CultivoparcelasController::class, 'index'])
     ->name('cultivoparcelas.index');

Route::get('/cultivoparcelas/create', [CultivoparcelasController::class, 'create'])
    ->name('cultivoparcelas.create');

Route::get('/cultivoparcelas/edit/{id}', [CultivoparcelasController::class, 'edit'])
    ->name('cultivoparcelas.edit');

Route::post('/cultivoparcelas/store', [CultivoparcelasController::class, 'store'])
    ->name('cultivoparcelas.store');

Route::put('/cultivoparcelas/update', [CultivoparcelasController::class, 'update'])
    ->name('cultivoparcelas.update');

Route::delete('/cultivoparcelas/delete/{id}', [CultivoparcelasController::class, 'delete'])
    ->name('cultivoparcelas.delete');
