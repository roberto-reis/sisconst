<?php

use App\Http\Controllers\Sistema\Admin\DashboardAdminController;
use App\Http\Controllers\Sistema\Admin\UsuariosController;
use App\Http\Controllers\Sistema\Operacional\DashboardOperacionalController;
use App\Http\Controllers\Sistema\Operacional\StatusObras;
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
    //Rotas Admin
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('usuarios', UsuariosController::class);

    // Rotas Operacional
    Route::get('/operacional', [DashboardOperacionalController::class, 'index'])->name('dashboard.index'); // Dashboard operacional
    Route::get('/operacional/status', [StatusObras::class, 'index'])->name('status.index'); //Lista os dados
    Route::post('/operacional/status', [StatusObras::class, 'store'])->name('status.store'); //Salva os status
    Route::put('/operacional/status', [StatusObras::class, 'update'])->name('status.update'); //Update status
    Route::delete('/operacional/status/{id}', [StatusObras::class, 'destroy'])->name('status.destroy'); //Deleta o status
    
    // Rotas Almoxarifado

});


require __DIR__.'/auth.php';