<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use Illuminate\Http\Request;

class ProjetoController extends Controller
{
    public function index() {
        $projetos = Projeto::paginate(10);

        return view('sistema.operacional.projeto.home', [
            'projetos' => $projetos
        ]);
    }

    public function create() {
        return view('sistema.operacional.projeto.create');
    }


}
