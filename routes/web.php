<?php

use App\Http\Controllers\Sistema\Operacional\ClientesController;
use App\Http\Controllers\Sistema\Admin\DashboardAdminController;
use App\Http\Controllers\Sistema\Admin\UsuariosController;
use App\Http\Controllers\Sistema\Operacional\DashboardOperacionalController;
use App\Http\Controllers\Sistema\Operacional\EmpreiteirosController;
use App\Http\Controllers\Sistema\Operacional\StatusObrasController;
use App\Http\Controllers\Sistema\Operacional\EstacoesController;
use App\Http\Controllers\Sistema\Operacional\ObraController;
use App\Http\Controllers\Sistema\Operacional\ProjetoController;
use App\Http\Controllers\Sistema\Operacional\SupervisorController;
use App\Http\Controllers\Sistema\Operacional\TipoServicosController;
use App\Http\Controllers\Site\HomeSiteController;
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

Route::get('/', [HomeSiteController::class, 'index']);

Route::prefix('/sistema')->group(function(){
    // Rotas Admin
    Route::resource('usuarios', UsuariosController::class);

    // Rotas Operacional
    Route::get('/operacional', [DashboardOperacionalController::class, 'index'])->name('operacional.index'); // Dashboard operacional

    // Rotas Operacional status
    Route::get('/operacional/status', [StatusObrasController::class, 'index'])->name('status.index'); //Lista os dados
    Route::post('/operacional/status', [StatusObrasController::class, 'store'])->name('status.store'); //Salva os status
    Route::put('/operacional/status', [StatusObrasController::class, 'update'])->name('status.update'); //Update status
    Route::delete('/operacional/status/{id}', [StatusObrasController::class, 'destroy'])->name('status.destroy'); //Deleta o status

    // Rotas Operacional Tipo de Serviços
    Route::get('/operacional/tipoServico', [TipoServicosController::class, 'index'])->name('tipoServico.index'); //Lista os dados
    Route::post('/operacional/tipoServico', [TipoServicosController::class, 'store'])->name('tipoServico.store'); //Salva os Tipo de Serviços
    Route::put('/operacional/tipoServico', [TipoServicosController::class, 'update'])->name('tipoServico.update'); //Update Tipo de Serviços
    Route::delete('/operacional/tipoServico/{id}', [TipoServicosController::class, 'destroy'])->name('tipoServico.destroy'); //Deleta Tipo de Serviços

    // Rotas Operacional Estações
    Route::get('/operacional/estacoes', [EstacoesController::class, 'index'])->name('estacoes.index'); //Lista os dados
    Route::post('/operacional/estacoes', [EstacoesController::class, 'store'])->name('estacoes.store'); //Salva as estações
    Route::put('/operacional/estacoes', [EstacoesController::class, 'update'])->name('estacoes.update'); //Update estação
    Route::delete('/operacional/estacoes/{id}', [EstacoesController::class, 'destroy'])->name('estacoes.destroy'); //Deleta estação

    // Rotas Operacional Empreiteiros
    Route::get('/operacional/empreiteiros', [EmpreiteirosController::class, 'index'])->name('empreiteiros.index'); //Lista os dados
    Route::post('/operacional/empreiteiros', [EmpreiteirosController ::class, 'store'])->name('empreiteiros.store'); //Salva as Empreiteiro
    Route::put('/operacional/empreiteiros', [EmpreiteirosController::class, 'update'])->name('empreiteiros.update'); //Update Empreiteiro
    Route::delete('/operacional/empreiteiros/{id}', [EmpreiteirosController::class, 'destroy'])->name('empreiteiros.destroy'); //Deleta Empreiteiro
    // Rotas Operacional Empreiteiros
    Route::get('/operacional/supervisores', [SupervisorController::class, 'index'])->name('supervisores.index'); //Lista os Supervisores
    Route::post('/operacional/supervisor', [SupervisorController ::class, 'store'])->name('supervisor.store'); //Salva as supervisor
    Route::put('/operacional/supervisor', [SupervisorController::class, 'update'])->name('supervisor.update'); //Update supervisor
    Route::delete('/operacional/supervisor/{id}', [SupervisorController::class, 'destroy'])->name('supervisor.destroy'); //Deleta supervisor

    // Rotas Operacional Cliente
    Route::get('/operacional/clientes', [ClientesController::class, 'index'])->name('clientes.index'); //Lista os dados
    Route::get('/operacional/clientes/create', [ClientesController ::class, 'create'])->name('cliente.create'); // View Cadatrar cliente
    Route::post('/operacional/clientes', [ClientesController ::class, 'store'])->name('cliente.store'); //Salva as clientes
    Route::get('/operacional/clientes/{id}/edit', [ClientesController::class, 'edit'])->name('cliente.edit'); //Editar cliente
    Route::put('/operacional/clientes/{id}', [ClientesController::class, 'update'])->name('cliente.update'); //Update cliente
    Route::delete('/operacional/clientes/{id}/delete', [ClientesController::class, 'destroy'])->name('cliente.destroy'); //Update cliente

    // Rotas Operacional Projeto
    Route::get('/operacional/projetos', [ProjetoController::class, 'index'])->name('projetos.index'); //Lista os dados
    Route::get('/operacional/projeto/create', [ProjetoController ::class, 'create'])->name('projeto.create'); // View Cadatrar projeto
    Route::post('/operacional/projeto', [ProjetoController ::class, 'store'])->name('projeto.store'); //Salva as projeto
    Route::get('/operacional/projeto/{id}/edit', [ProjetoController::class, 'edit'])->name('projeto.edit'); //Editar projeto
    Route::put('/operacional/projeto/{id}', [ProjetoController::class, 'update'])->name('projeto.update'); //Update projeto
    Route::delete('/operacional/projeto/{id}/delete', [ProjetoController::class, 'destroy'])->name('projeto.destroy'); //Update projeto

    // Rotas Operacional Obras
    Route::get('/operacional/obras', [ObraController::class, 'index'])->name('obras.index'); //Lista os dados
    Route::get('/operacional/obra/create', [ObraController ::class, 'create'])->name('obra.create'); // View Cadatrar obra
    Route::post('/operacional/obra', [ObraController ::class, 'store'])->name('obra.store'); //Salva as obra
    Route::get('/operacional/obra/{id}/edit', [ObraController::class, 'edit'])->name('obra.edit'); //Editar obra
    Route::put('/operacional/obra/{id}', [ObraController::class, 'update'])->name('obra.update'); //Update obra
    Route::delete('/operacional/obra/{id}/delete', [ObraController::class, 'destroy'])->name('obra.destroy'); //Update obra

    // Rotas Almoxarifado

});


require __DIR__.'/auth.php';