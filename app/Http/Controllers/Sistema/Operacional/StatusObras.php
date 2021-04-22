<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\StatusObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusObras extends Controller
{
    
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
            foreach($validator->errors()->get('nome') as $error) {
                $mensagem['error'] = $error;
            }
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

        // Pega os campos do request
        $data = $request->only([
            'nome'
        ]);
        // Valida os dados
        $validator = Validator::make($data, [
            'nome' => ['required', 'string']
        ]);

        $status = StatusObra::find($request->get('status_id'));

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
            foreach($validator->errors()->get('nome') as $error) {
                $mensagem['error'] = $error;
            }

        } else {
            // Atualiza os dados
            $status->save();
            $mensagem['sucesso'] = "Atualizado com Sucesso!";
        }


        return response()->json($mensagem);

    }

    public function destroy($id) {

        $status = StatusObra::findOrFail( $id );
        $status->delete();

        return response()->json( ["sucesso" => "Deletado com sucesso!"] );
    }
}
