<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\StatusObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusObras extends Controller
{
    

    public function store(Request $request) {

        $data = $request->only([
            'nome'
        ]);

        $validator = Validator::make($data, [
            'nome' => ['required', 'string', 'unique:status_obras']
        ]);

        if($validator->fails()) {
            return redirect()->route('dashboard.index')
            ->withErrors($validator)
            ->withInput();
        }

        $status = new StatusObra();
        $status->nome = $data['nome'];
        $status->save();


        return redirect()->route('dashboard.index')->with('mensagem_sucesso', 'Cadastrado com Sucesso!');

    }

    public function destroy($id) {

        $status = StatusObra::find($id);

        $status->delete();

        return redirect()->route('dashboard.index');
    }
}
