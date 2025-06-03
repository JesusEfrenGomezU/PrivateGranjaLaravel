<?php

use App\Http\Controllers\RolsController;
use App\Http\Middleware\AuthorizedMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/rols', [RolsController::class, 'index'])
     ->name('rols.index')
     ->middleware(AuthorizedMiddleware::class . ':Rols.showRols');

Route::get('/rols/create', [RolsController::class, 'create'])
    ->name('rols.create')
    ->middleware(AuthorizedMiddleware::class . ':Rols.createRols');

Route::get('/rols/edit/{id}', [RolsController::class, 'edit'])
     ->name('rols.edit')
     ->middleware(AuthorizedMiddleware::class . ':Rols.updateRols');

Route::post('/rols/store', [RolsController::class, 'store'])
     ->name('rols.store')
     ->middleware(AuthorizedMiddleware::class . ':Rols.createRols');

Route::put('/rols/update/{id}', [RolsController::class, 'update'])
     ->name('rols.update')
     ->middleware(AuthorizedMiddleware::class . ':Rols.updateRols');

Route::delete('/rols/delete/{id}', [RolsController::class, 'delete'])
     ->name('rols.delete')
     ->middleware(AuthorizedMiddleware::class . ':Rols.deleteRols');
