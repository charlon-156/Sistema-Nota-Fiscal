<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotaFiscalController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\CupomFiscalController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::resource('notas', NotaFiscalController::class);
Route::resource('cupom', CupomFiscalController::class);
Route::resource('instituicoes', InstituicaoController::class);

Route::get('/notas/relatorios', [NotaFiscalController::class, 'relatorios'])->name('notas.relatorios');
Route::post('/notas/gerar-relatorio', [NotaFiscalController::class, 'gerarRelatorio'])->name('notas.gerar-relatorio');
