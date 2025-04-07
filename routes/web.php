<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParcelasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);


include('web/sections.php');
include('web/parcelas.php');
include('web/mantenimientos.php');

Route::get('/parcelas' , [ParcelasController::class, 'index'])->name('parcelas.index');
Route::get('/parcelas/create' , [ParcelasController::class, 'create'])->name('parcelas.create');
Route::post('/parcelas/store' , [ParcelasController::class, 'store'])->name('parcelas.store');
