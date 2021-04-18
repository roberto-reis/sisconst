<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use App\Models\StatusObra;
use Illuminate\Http\Request;

class DashboardOperacionalController extends Controller
{
    public function index() {
        $projetos = Projeto::paginate(12);

        $statusObras = StatusObra::get();
        
        return view('sistema.operacional.dashboard', [
            'projetos' => $projetos,
            'statusObras' => $statusObras
        ]);
    }
}
