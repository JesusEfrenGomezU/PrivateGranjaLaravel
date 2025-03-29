<?php

use App\Http\Controllers\ParcelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/parcelas' , [ParcelasController::class, 'index'])->name('parcelas.index');
Route::get('/parcelas/create' , [ParcelasController::class, 'create'])->name('parcelas.create');
Route::post('/parcelas/store' , [ParcelasController::class, 'store'])->name('parcelas.store');
