<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotalFiscalController;

Route::get('/', function(){return view('index');});

Route::resource('/nota-fiscal', NotalFiscalController::class);
Route::resource('/empresa', EmpresaController::class);
