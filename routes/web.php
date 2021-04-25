<?php

use App\Http\Controllers\Sistema\Admin\DashboardAdminController;
use App\Http\Controllers\Sistema\Admin\UsuariosController;
use App\Http\Controllers\Sistema\Operacional\DashboardOperacionalController;
use App\Http\Controllers\Sistema\Operacional\StatusObrasController;
use App\Http\Controllers\Sistema\Operacional\EstacoesController;
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
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('usuarios', UsuariosController::class);

    // Rotas Operacional
    Route::get('/operacional', [DashboardOperacionalController::class, 'index'])->name('dashboard.index'); // Dashboard operacional

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



    // Rotas Almoxarifado

});


require __DIR__.'/auth.php';