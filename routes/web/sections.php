<?php

use App\Http\Controllers\SectionsController;
use Illuminate\Support\Facades\Route;

Route::get('/sections', [SectionsController::class, 'index'])
     ->name('sections.index');

Route::get('/sections/create', [SectionsController::class, 'create'])
    ->name('sections.create');

Route::post('/sections/store', [SectionsController::class, 'store'])
    ->name('sections.store');
