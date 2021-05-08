<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index() {

        $clientes = Cliente::paginate(12);

        return view('sistema.operacional.cliente.home', [
            'clientes' => $clientes
        ]);
    }

    public function create() {
        return view('sistema.operacional.cliente.create');
    }
}
