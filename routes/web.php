<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParcelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
-> name('home.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





include('web/sections.php');
include('web/parcelas.php');
include('web/mantenimientos.php');
include('web/cultivos.php');
include('web/cosechas.php');
include('web/cultivoparcelas.php');
include('web/usuarios.php');
include('web/rols.php');

Route::get('/parcelas' , [ParcelasController::class, 'index'])->name('parcelas.index');
Route::get('/parcelas/create' , [ParcelasController::class, 'create'])->name('parcelas.create');
Route::post('/parcelas/store' , [ParcelasController::class, 'store'])->name('parcelas.store');
