<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/usuarios', [UsuariosController::class, 'index'])
     ->name('usuarios.index');

Route::get('/usuarios/create', [UsuariosController::class, 'create'])
    ->name('usuarios.create');

Route::get('/usuarios/edit/{id}', [UsuariosController::class, 'edit'])
    ->name('usuarios.edit');

Route::post('/usuarios/store', [UsuariosController::class, 'store'])
    ->name('usuarios.store');

Route::put('/usuarios/update', [UsuariosController::class, 'update'])
    ->name('usuarios.update');

Route::delete('/usuarios/delete/{id}', [UsuariosController::class, 'delete'])
    ->name('usuarios.delete');
