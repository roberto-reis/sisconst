<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Empreiteiro;
use App\Models\Obra;
use App\Models\Projeto;
use App\Models\StatusObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ObraController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $obras = Obra::paginate(10);

        return view('sistema.operacional.obra.home', [
            'obras' => $obras
        ]);
    }

    public function create() {
        $projetos = Projeto::get();
        $statusObras = StatusObra::get();
        $empreiteiros = Empreiteiro::get();

        return view('sistema.operacional.obra.create', [
            'projetos' => $projetos,
            'statusObras' => $statusObras,
            'empreiteiros' => $empreiteiros
        ]);
    }

    public function store(Request $request) {
        $loggedUser = intval( Auth::id() );

        $data = $request->only([
            'projeto',
            'statusObra',
            'data_fotos_emergencia',
            'data_fotos_anexo_xiii',
            'empreiteiro',
            'fiscal_cliente',
            'inicio_real',
            'termino_real',
            'observacao'
        ]);

        $validator = Validator::make($data, [
            'projeto' => ['required', 'integer'],
            'statusObra' => ['required', 'integer'],
            'data_fotos_emergencia' => ['nullable', 'date'],
            'data_fotos_anexo_xiii' => ['nullable', 'date'],
            'empreiteiro' => ['nullable', 'integer'],
            'fiscal_cliente' => ['nullable', 'string', 'max:50'],
            'inicio_real' => ['nullable', 'date'],
            'termino_real' => ['nullable', 'date'],
            'observacao' => ['nullable', 'string', 'max:300']
        ]);

        if($validator->fails()) {
            return redirect()->route('obra.create')->withErrors($validator)->withInput();
        }

        $obra = new Obra();
        $obra->inicio_real = $data['inicio_real'];
        $obra->termino_real = $data['termino_real'];
        $obra->data_fotos_emergencia = $data['data_fotos_emergencia'];
        $obra->data_fotos_anexo_xiii = $data['data_fotos_anexo_xiii'];
        $obra->fiscal_cliente = $data['fiscal_cliente'];
        $obra->observacao = $data['observacao'];
        $obra->id_projeto = $data['projeto'];
        $obra->id_empreiteiro = $data['empreiteiro'];
        $obra->id_status_obra = $data['statusObra'];
        $obra->id_usuario = $loggedUser;
        $obra->save();

        return redirect()->route('obras.index');

    }

    public function edit($id) {
        $obra = Obra::find($id);
        $projetos = Projeto::get();
        $statusObras = StatusObra::get();
        $empreiteiros = Empreiteiro::get();

        if($obra) {
            return view('sistema.operacional.obra.edit', [
                'obra' => $obra,
                'projetos' => $projetos,
                'statusObras' => $statusObras,
                'empreiteiros' => $empreiteiros
            ]);
        }        

        return redirect()->route('obras.index');
    }

    public function update(Request $request, $id) {
        // Busca o Projeto no BD
        $obra = Obra::find($id);

        // Verificar se existe
        if($obra) {
            $data = $request->only([
                'projeto',
                'statusObra',
                'data_fotos_emergencia',
                'data_fotos_anexo_xiii',
                'empreiteiro',
                'fiscal_cliente',
                'inicio_real',
                'termino_real',
                'observacao'
            ]);
    
            $validator = Validator::make($data, [
                'projeto' => ['required', 'integer'],
                'statusObra' => ['required', 'integer'],
                'data_fotos_emergencia' => ['nullable', 'date'],
                'data_fotos_anexo_xiii' => ['nullable', 'date'],
                'empreiteiro' => ['nullable', 'integer'],
                'fiscal_cliente' => ['nullable', 'string', 'max:50'],
                'inicio_real' => ['nullable', 'date'],
                'termino_real' => ['nullable', 'date'],
                'observacao' => ['nullable', 'string', 'max:300']
            ]);

            if($validator->fails()) {
                return redirect()->route('obra.edit', $id)->withErrors($validator)->withInput();
            } else {

                $obra->inicio_real = $data['inicio_real'];
                $obra->termino_real = $data['termino_real'];
                $obra->data_fotos_emergencia = $data['data_fotos_emergencia'];
                $obra->data_fotos_anexo_xiii = $data['data_fotos_anexo_xiii'];
                $obra->fiscal_cliente = $data['fiscal_cliente'];
                $obra->observacao = $data['observacao'];
                $obra->id_projeto = $data['projeto'];
                $obra->id_empreiteiro = $data['empreiteiro'];
                $obra->id_status_obra = $data['statusObra'];
                $obra->save();

                return redirect()->route('obras.index')->with('mensagem_sucesso', 'Obra alterada com sucesso!');
            }

        }

        return redirect()->route('obras.index');
    }

    public function destroy($id) {
        

        $obra = Obra::findOrFail( $id );
        $obra->delete();
        
        return redirect()->route('obras.index');   

            
    }



}
