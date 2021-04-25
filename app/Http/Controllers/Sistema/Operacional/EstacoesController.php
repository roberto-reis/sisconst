<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Estacao;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstacoesController extends Controller
{
    public function index() {
        $estacoes = Estacao::get();

        return response()->json($estacoes);
    }

    public function store(Request $request) {
        $mensagem = [];
        $data = $request->only([
            'sigla',
            'descricao',
            'municipio'

        ]);

        $validator = Validator::make($data, [
            'sigla' => ['required', 'string', 'unique:estacoes'],
            'descricao' => ['required', 'string'],
            'municipio' => ['required', 'string'],
        ]);

        if($validator->fails()) {
            $mensagem['error'] = null;
            foreach($validator->errors()->all() as $error) {
                $mensagem['error'] .= "<li>".$error."</li>";
            }

        } else {
            Estacao::create([
                'sigla' => strtoupper($data['sigla']),
                'descricao' => ucwords($data['descricao']),
                'municipio' => ucwords($data['municipio'])
            ]);
            
            $mensagem['sucesso'] = "Cadastrado com sucesso!";
        }

        return response()->json($mensagem);
    }

    public function update(Request $request) {
        $mensagem = [];

        //Busca a sigla digitado no bd
        $estacao = Estacao::find($request->get('id'));

        // Pega os campos do request
        $data = $request->only([
            'sigla',
            'descricao',
            'municipio'
        ]);
        // Valida os dados
        $validator = Validator::make($data, [
            'sigla' => ['required', 'string'],
            'descricao' => ['required', 'string'],
            'municipio' => ['required', 'string']
        ]);

        // Altera descrição
        $estacao->descricao = ucwords($data['descricao']);
        // Altera municipio
        $estacao->municipio = ucwords($data['municipio']);

        if($data['sigla'] != $estacao->sigla) {

            $hasSigla = Estacao::where('sigla', $data['sigla'])->get();
            if(count($hasSigla) === 0) {
                $estacao->sigla = strtoupper($data['sigla']);
            } else {
                // Se o nome digitado já existe no bd add validation.unique 
                $validator->errors()->add('sigla', __('validation.unique', [
                    'attribute' => 'sigla'
                ]));
            }
        }

        if(count($validator->errors()) > 0) {
            $mensagem['error'] = null;
            
            foreach($validator->errors()->all() as $error) {
                $mensagem['error'] .= "<li>".$error."</li>";
            }            

        } else {
            // Atualiza os dados
            $estacao->save();
            $mensagem['sucesso'] = "Atualizado com Sucesso!";
        }

        return response()->json($mensagem);
    }

    public function destroy($id) {
        $mensagem = [];
        $hasRelationship = Projeto::where('id_estacao', $id)->get();
        
        if(count($hasRelationship) > 0) {

            $mensagem['error'] = "Esta estação não pode ser deletado, existe ".count($hasRelationship)." resistro(s) usando. ";

        } else {

            $tipoServico = Estacao::findOrFail( $id );
            $tipoServico->delete();
            $mensagem['sucesso'] = "Deletado com sucesso!!!";

        }

        return response()->json( $mensagem );
    }
}
