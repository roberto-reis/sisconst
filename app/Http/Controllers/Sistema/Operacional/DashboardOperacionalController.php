<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Obra;
use App\Models\Projeto;
use App\Models\StatusObra;
use Illuminate\Http\Request;

class DashboardOperacionalController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $obras = Obra::get();
        $ObrasNaoiniciado = Obra::count();
        
        return view('sistema.operacional.dashboard', [
            'obras' => $obras,
            'ObrasNaoiniciado' => $ObrasNaoiniciado
        ]);
    }
}
