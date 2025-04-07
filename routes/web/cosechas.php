<?php

use App\Http\Controllers\CosechasController;
use Illuminate\Support\Facades\Route;

Route::get('/cosechas', [CosechasController::class, 'index'])
     ->name('cosechas.index');

Route::get('/cosechas/create', [CosechasController::class, 'create'])
    ->name('cosechas.create');

Route::get('/cosechas/edit/{id}', [CosechasController::class, 'edit'])
    ->name('cosechas.edit');

Route::post('/cosechas/store', [CosechasController::class, 'store'])
    ->name('cosechas.store');

Route::put('/cosechas/update', [CosechasController::class, 'update'])
    ->name('cosechas.update');

Route::delete('/cosechas/delete/{id}', [CosechasController::class, 'delete'])
    ->name('cosechas.delete');
