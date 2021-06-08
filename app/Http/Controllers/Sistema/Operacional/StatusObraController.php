<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Obra;
use App\Models\StatusObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusObraController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:permission-operacional');
    }
    
    public function index() {
        $statusObras = StatusObra::get();
        return response()->json($statusObras);
    }

    public function store(Request $request) {
        $mensagem = [];

        $data = $request->only([
            'nome'
        ]);

        $validator = Validator::make($data, [
            'nome' => ['required', 'string', 'unique:status_obras']
        ]);

        if($validator->fails()) {
            $mensagem['error'] = $validator->errors()->get('nome');

        } else {
            // Cadastra o status
            StatusObra::create([
                'nome' => strtoupper($data['nome'])
            ]);   
            $mensagem['sucesso'] = "Cadastrado com Sucesso!";
        }


        return response()->json($mensagem);

    }

    public function update(Request $request) {
        $mensagem = [];
        
        //Busca o status no bd
        $status = StatusObra::find($request->get('id'));

        // Pega os campos do request
        $data = $request->only([
            'nome'
        ]);
        // Valida os dados
        $validator = Validator::make($data, [
            'nome' => ['required', 'string']
        ]);

        if($status->nome != $data['nome']){

            //Verificar o nome digitado já existe no bd
            $hasNome = StatusObra::where('nome', $data['nome'])->get();

            if(count($hasNome) === 0) {
                $status->nome = strtoupper($data['nome']);
            } else {
                // Se o nome digitado já existe no bd add validation.unique 
                $validator->errors()->add('nome', __('validation.unique', [
                    'attribute' => 'nome'
                ]));
            }
        }
    
        if(count($validator->errors()) > 0) {
            $mensagem['error'] = $validator->errors()->get('nome');

        } else {
            // Atualiza os dados
            $status->save();
            $mensagem['sucesso'] = "Atualizado com Sucesso!";
        }


        return response()->json($mensagem);

    }

    public function destroy($id) {
        $mensagem = [];
        $hasRelationship = Obra::where('id_status_obra', $id)->get();
        
        if(count($hasRelationship) > 0) {
            $mensagem['error'] = "Este Tipo de Serviço não pode ser deletado, existe ".count($hasRelationship)." resistro(s) usando. ";
        } else {
            $status = StatusObra::findOrFail( $id );
            $status->delete();
            $mensagem['sucesso'] = "Deletado com sucesso!!!";

        }
        

        return response()->json( $mensagem );
    }
}
