<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotalFiscalController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('notas', NotaFiscalController::class);
Route::resource('cupom', CupomFiscalController::class);
Route::resource('instituicoes', InstituicaoController::class);
