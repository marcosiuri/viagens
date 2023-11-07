<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\MinhaController;
use App\Http\Controllers\PromocaoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CadastroController;

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

Route::get('/', [MainController::class, 'main'])->name('main');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginpost'])->name('loginpost');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/cadastro', [CadastroController::class, 'showRegistrationForm'])->name('cadastro');
Route::post('/cadastro', [CadastroController::class, 'cadastro']);

Route::prefix('/destinos')->group(function () {
    Route::get('/', [DestinoController::class, 'destino'])->name('destino');
    Route::get('/novo', [DestinoController::class, 'create'])->name('destino.create');
    Route::post('/novo', [DestinoController::class, 'store'])->name('destino.store');
    Route::get('/{id}', [DestinoController::class, 'show'])->name('destino.show');
    Route::post('/salvar-contador/{id}', [DestinoController::class, 'salvarContador'])->name('destino.salvarContador');
});

Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');

Route::get('/promocao', [PromocaoController::class, 'promocao'])->name('promocao');

Route::middleware(['auth'])->group(function () {
    Route::post('/salvarContador/{id}', [DestinoController::class, 'salvarContador']);
    Route::get('/minha-conta/destinos-comprados', [MinhaController::class, 'destinosComprados'])->name('minha.destinos-comprados');
    Route::get('/minha', [MinhaController::class, 'minha'])->name('minha');
    Route::post('/minha/cancelar-passagem/{passagemId}/{destinoId}', [MinhaController::class, 'cancelarPassagem']);
    Route::post('/minha/diminuir-passagem/{passagemId}/{destinoId}', [MinhaController::class, 'diminuirPassagem']);
});





