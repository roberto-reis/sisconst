<?php

use App\Http\Controllers\Painel\Admin\DashboardAdminController;
use App\Http\Controllers\Painel\Admin\UsuariosController;
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

Route::prefix('/painel')->group(function(){
    //Rotas Admin
    Route::get('/', [DashboardAdminController::class, 'index']);
    Route::get('/usuarios', [UsuariosController::class, 'index']);

    // Rotas Operacional

    // Rotas Almoxarifado

});


require __DIR__.'/auth.php';
