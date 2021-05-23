<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use App\Models\Projeto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class SupervisorController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $supervisores = Supervisor::get();

        return response()->json($supervisores);
    }

    public function store(Request $request) {
        $mensagem = [];

        $data = $request->only([
            'nome'
        ]);

        $validator = Validator::make($data, [
            'nome' => ['required', 'string', 'unique:supervisores']
        ]);

        if($validator->fails()) {
            $mensagem['error'] = $validator->errors()->get('nome');

        } else {
            // Cadastra o status
            Supervisor::create([
                'nome' => $data['nome']
            ]);   
            $mensagem['sucesso'] = "Cadastrado com Sucesso!";
        }


        return response()->json($mensagem);

    }

    public function update(Request $request) {
        $mensagem = [];
        
        //Busca o supervisor no bd
        $supervisor = Supervisor::find($request->get('id'));

        // Pega os campos do request
        $data = $request->only([
            'nome'
        ]);

        // Valida os dados
        $validator = Validator::make($data, [
            'nome' => ['required', 'string']
        ]);

        if($supervisor->nome != $data['nome']){
            //Verificar o nome digitado já existe no bd
            $hasNome = Supervisor::where('nome', $data['nome'])->get();

            if(count($hasNome) === 0) {
                // Altera o nome
                $supervisor->nome = $data['nome'];
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
            $supervisor->save();
            $mensagem['sucesso'] = "Atualizado com Sucesso!";
        }


        return response()->json($mensagem);

    }

    public function destroy($id) {
        $mensagem = [];
        $hasRelationship = Projeto::where('id_supervisor', $id)->get();
        
        if(count($hasRelationship) > 0) {

            $mensagem['error'] = "Este supervisor não pode ser deletado, está sendo usado por ".count($hasRelationship)." resistro(s)";

        } else {

            $supervisor = Supervisor::findOrFail( $id );
            $supervisor->delete();
            $mensagem['sucesso'] = "Deletado com sucesso!!!";

        }
        

        return response()->json( $mensagem );
    }
}
