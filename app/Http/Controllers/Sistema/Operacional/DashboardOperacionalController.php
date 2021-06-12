<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Obra;
use Illuminate\Http\Request;

class DashboardOperacionalController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:permission-operacional');
    }

    public function index() {
        $obras = Obra::get();

        //Contar obras com determinado status
        $obrasEmAndamentoCount = Obra::whereHas('statusObra', function($query) {                    
            $query->where('nome', 'Em andamento');
        })->count();   
        $obrasFinalizadaCount = Obra::whereHas('statusObra', function($query) {                    
            $query->where('nome', 'finalizada');
        })->count();       
        $obrasFaturadaCount = Obra::whereHas('statusObra', function($query) {                    
            $query->where('nome', 'faturada');
        })->count();

        // Contar as obras que não tem anexo XIII
        $obraFaltaAnexoIII = Obra::where('fotos_anexo_xiii', 'N')->count();

        return view('sistema.operacional.dashboard', [
            'obras' => $obras,
            'obrasEmAndamentoCount' => $obrasEmAndamentoCount,
            'obrasFinalizadaCount' => $obrasFinalizadaCount,
            'obrasFaturadaCount' => $obrasFaturadaCount,
            'obraFaltaAnexoIII' => $obraFaltaAnexoIII
        ]);
    }
}
