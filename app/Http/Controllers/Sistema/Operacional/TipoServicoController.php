<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Projeto;
use Illuminate\Http\Request;
use App\Models\TipoServico;
use Illuminate\Support\Facades\Validator;

class TipoServicoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:permission-operacional');
    }

    public function index() {

        $tipoServico = TipoServico::get();

        return response()->json($tipoServico);
    }

    public function store(Request $request) {
        $mensagem = [];
        $data = $request->only([
            'nome'
        ]);

        $validator = Validator::make($data, [
            'nome' => ['required', 'string', 'unique:tipo_servicos']
        ]);

        if($validator->fails()) {
            $mensagem['error'] = $validator->errors()->get('nome');

        } else {
            TipoServico::create([
                'nome' => $data['nome']
            ]);
            $mensagem['sucesso'] = "Cadastrado com sucesso!";
        }

        return response()->json($mensagem);
    }

    public function update(Request $request) {
        $mensagem = [];
        
        //Busca o TipoServico no bd
        $tipoServico = TipoServico::find($request->get('id'));

        // Pega os campos do request
        $data = $request->only([
            'nome'
        ]);
        // Valida os dados
        $validator = Validator::make($data, [
            'nome' => ['required', 'string']
        ]);

        if($data['nome'] != $tipoServico->nome) {

            $hasName = TipoServico::where('nome', $data['nome'])->get();
            if(count($hasName) === 0) {
                $tipoServico->nome = $data['nome'];
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
            $tipoServico->save();
            $mensagem['sucesso'] = "Atualizado com Sucesso!";
        }

        return response()->json($mensagem);
    }

    public function destroy($id) {
        $mensagem = [];
        $hasRelationship = Projeto::where('id_tipo_servico', $id)->get();
        
        if(count($hasRelationship) > 0) {

            $mensagem['error'] = "Este Tipo de Serviço não pode ser deletado, existe ".count($hasRelationship)." resistro(s) usando. ";

        } else {

            $tipoServico = TipoServico::findOrFail( $id );
            $tipoServico->delete();
            $mensagem['sucesso'] = "Deletado com sucesso!!!";

        }

        return response()->json( $mensagem );
    }
}
