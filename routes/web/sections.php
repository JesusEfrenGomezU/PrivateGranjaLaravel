<?php

use App\Http\Controllers\SectionsController;
use App\Http\Middleware\AuthorizedMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/sections', [SectionsController::class, 'index'])
     ->name('sections.index')
     ->middleware(AuthorizedMiddleware::class . ':Secciones.showSections');;

Route::get('/sections/create', [SectionsController::class, 'create'])
    ->name('sections.create');

Route::get('/sections/edit/{id}', [SectionsController::class, 'edit'])
    ->name('sections.edit');

Route::post('/sections/store', [SectionsController::class, 'store'])
    ->name('sections.store');

Route::put('/sections/update', [SectionsController::class, 'update'])
    ->name('sections.update');

Route::delete('/sections/delete/{id}', [SectionsController::class, 'delete'])
    ->name('sections.delete');
