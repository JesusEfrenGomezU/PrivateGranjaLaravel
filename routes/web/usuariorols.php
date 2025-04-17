<?php

use App\Http\Controllers\usuariorolsController;
use Illuminate\Support\Facades\Route;

Route::get('/usuario_rols', [UsuarioRolsController::class, 'index'])
     ->name('usuariorols.index');