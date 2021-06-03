<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Empreiteiro;
use App\Models\Obra;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmpreiteiroController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $empreiteiro = Empreiteiro::get();

        return response()->json($empreiteiro);
    }

    public function store(Request $request) {
        $mensagem = [];

        $data = $request->only([
            'nome'
        ]);

        $validator = Validator::make($data, [
            'nome' => ['required', 'string', 'unique:empreiteiros']
        ]);

        if($validator->fails()) {
            $mensagem['error'] = $validator->errors()->get('nome');

        } else {
            // Cadastra o status
            Empreiteiro::create([
                'nome' => $data['nome']
            ]);   
            $mensagem['sucesso'] = "Cadastrado com Sucesso!";
        }


        return response()->json($mensagem);

    }

    public function update(Request $request) {
        $mensagem = [];
        
        //Busca o status no bd
        $empreiteiro = Empreiteiro::find($request->get('id'));

        // Pega os campos do request
        $data = $request->only([
            'nome'
        ]);

        // Valida os dados
        $validator = Validator::make($data, [
            'nome' => ['required', 'string']
        ]);

        if($empreiteiro->nome != $data['nome']){
            //Verificar o nome digitado já existe no bd
            $hasNome = Empreiteiro::where('nome', $data['nome'])->get();

            if(count($hasNome) === 0) {
                // Altera o nome
                $empreiteiro->nome = $data['nome'];
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
            $empreiteiro->save();
            $mensagem['sucesso'] = "Atualizado com Sucesso!";
        }


        return response()->json($mensagem);

    }

    public function destroy($id) {
        $mensagem = [];
        $hasRelationship = Obra::where('id_empreiteiro', $id)->get();
        
        if(count($hasRelationship) > 0) {

            $mensagem['error'] = "Este Tipo de Serviço não pode ser deletado, existe ".count($hasRelationship)." resistro(s) usando. ";

        } else {

            $status = Empreiteiro::findOrFail( $id );
            $status->delete();
            $mensagem['sucesso'] = "Deletado com sucesso!!!";

        }        

        return response()->json( $mensagem );
    }

}
