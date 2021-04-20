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

            $status = new StatusObra();
            $status->nome = strtoupper($data['nome']);
            $status->save();

            $mensagem['sucesso'] = "Cadastrado com Sucesso!";
        }

        return response()->json($mensagem);

    }

    public function update(Request $request, $id) {
        $mensagem = [];
        
        $data = $request->only([
            'nome'
        ]);
        $validator = Validator::make($data, [
            'nome' => ['required', 'string']
        ]);

        if($validator->fails()) {
            foreach($validator->errors()->get('nome') as $error) {
                $mensagem['error'] = $error;
            }
        } else {

            $status = StatusObra::find($id)->update($request->all());
            $mensagem['sucesso'] = "Atualizado com Sucesso!" . $id;
        }

        return response()->json($mensagem);

    }

    public function destroy(Request $request) {

        $status = StatusObra::findOrFail( $request->get('id') );
        $status->delete();

        return response()->json( ["sucesso" => "Deletado com sucesso!"] );
    }
}
