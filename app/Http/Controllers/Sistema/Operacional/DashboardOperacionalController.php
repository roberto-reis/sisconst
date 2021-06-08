<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Obra;
use App\Models\StatusObra;
use Illuminate\Http\Request;

class DashboardOperacionalController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:permission-operacional');
    }

    public function index() {
        $obras = Obra::get();

        // Pega os id referente aos status
        $emAndamento = StatusObra::where('nome', 'Em andamento')->first();
        $emAndamentoId = $emAndamento != null ? $emAndamento->id : 0;
        $finalizada = StatusObra::where('nome', 'finalizada')->first();
        $finalizadaId = $finalizada != null ? $finalizada->id : 0;
        $faturada = StatusObra::where('nome', 'faturada')->first();
        $faturadaId = $faturada != null ? $faturada->id : 0;

        //Contar obras com determinado status
        $obrasEmAndamentoCount = Obra::where('id_status_obra', $emAndamentoId)->count();        
        $obrasFinalizadaCount = Obra::where('id_status_obra', $finalizadaId)->count();        
        $obrasFaturadaCount = Obra::where('id_status_obra', $faturadaId)->count();

        // 
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
