<?php

use App\Http\Controllers\CorredorController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\ProvaController;
use App\Http\Controllers\ResultadoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'Deliver IT API: Online';
});

Route::post('/corredor', [CorredorController::class, 'store'])->name('corredor.store');
Route::post('/prova', [ProvaController::class, 'store'])->name('prova.store');
Route::post('/inscricao', [InscricaoController::class, 'store'])->name('inscricao.store');
Route::post('/resultado', [ResultadoController::class, 'store'])->name('resultado.store');

Route::post('/resultado/{prova}/por-idade', [ResultadoController::class, 'porIdade'])->name('resultado.por-idade');
Route::post('/resultado/{prova}/por-distancia', [ResultadoController::class, 'porDistancia'])->name('resultado.por-distancia');
