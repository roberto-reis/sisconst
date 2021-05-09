<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    public function index() {

        $clientes = Cliente::paginate(10);

        return view('sistema.operacional.cliente.home', [
            'clientes' => $clientes
        ]);
    }

    public function create() {
        return view('sistema.operacional.cliente.create');
    }

    public function store(Request $request) {
        
        $data = $request->only([
            'contrato',
            'rasao_social',
            'cnpj',
            'endereco',
            'bairro',
            'cidade',
            'uf',
            'inscricao_municipal',
            'inscricao_estadual',
            'classe_servico',
            'valor_urs'
        ]);

        $validator = Validator::make($data, [
            'contrato' => ['required', 'string', 'max:50'],
            'rasao_social' => ['required', 'string', 'max:80'],
            'cnpj' => ['string'],
            'endereco' => ['required', 'string', 'max:60'],
            'bairro' => ['required', 'string', 'max:50'],
            'cidade' => ['required', 'string', 'max:50'],
            'uf' => ['required', 'string', 'max:2'],
            'inscricao_municipal' => ['max:50'],
            'inscricao_estadual' => ['max:50'],
            'classe_servico' => ['string', 'max:1'],
        ]);

        if($validator->fails()) {
            return redirect()->route('cliente.create')
            ->withErrors($validator)
            ->withInput();

        }

        $classe_servico = isset($data['valor_urs']) ? str_replace(',', '.', $data['valor_urs']) : $data['valor_urs'];
        Cliente::create([
            'contrato' => $data['contrato'],
            'rasao_social' => $data['rasao_social'],
            'cnpj' => $data['cnpj'],
            'endereco' => $data['endereco'],
            'bairro' => $data['endereco'],
            'cidade' => $data['cidade'],
            'uf' => strtoupper($data['uf']),
            'inscricao_municipal' => $data['inscricao_municipal'],
            'inscricao_estadual' => $data['inscricao_estadual'],
            'classe_servico' => $data['classe_servico'],
            'valor_urs' => $classe_servico
        ]);

        return redirect()->route('clientes.index')->with('mensagem_sucesso', 'Cadastrado com sucesso!');
    }

    public function edit($id) {
            
        $cliente = Cliente::find($id);
        if($cliente) {
            return view('sistema.operacional.cliente.edit', [
                'cliente' => $cliente
            ]);
        }

    }

    public function update(Request $request, $id) {
        $cliente = Cliente::find($id);

        if($cliente) {
            
            $data = $request->only([
                'contrato',
                'rasao_social',
                'cnpj',
                'endereco',
                'bairro',
                'cidade',
                'uf',
                'inscricao_municipal',
                'inscricao_estadual',
                'classe_servico',
                'valor_urs'
            ]);
    
            $validator = Validator::make($data, [
                'contrato' => ['required', 'string', 'max:50'],
                'rasao_social' => ['required', 'string', 'max:80'],
                'cnpj' => ['string'],
                'endereco' => ['required', 'string', 'max:60'],
                'bairro' => ['required', 'string', 'max:50'],
                'cidade' => ['required', 'string', 'max:50'],
                'uf' => ['required', 'string', 'max:2'],
                'inscricao_municipal' => ['max:50'],
                'inscricao_estadual' => ['max:50'],
                'classe_servico' => ['string', 'max:1']
            ]);

            if($validator->fails()) {
                return redirect()->route('cliente.edit', $id)
                ->withErrors($validator)
                ->withInput();    
            }

            $classe_servico = isset($data['valor_urs']) ? str_replace(',', '.', $data['valor_urs']) : $data['valor_urs'];
            $cliente->update([
                'contrato' => $data['contrato'],
                'rasao_social' => $data['rasao_social'],
                'cnpj' => $data['cnpj'],
                'endereco' => $data['endereco'],
                'bairro' => $data['endereco'],
                'cidade' => $data['cidade'],
                'uf' => strtoupper($data['uf']),
                'inscricao_municipal' => $data['inscricao_municipal'],
                'inscricao_estadual' => $data['inscricao_estadual'],
                'classe_servico' => $data['classe_servico'],
                'valor_urs' => $classe_servico
            ]);

            return redirect()->route('clientes.index')->with('mensagem_sucesso', 'Cliente alterado com sucesso!');

        }

        return redirect()->route('clientes.index');

    }

    public function destroy($id) {
        $hasRelationship = Projeto::where('id_cliente', $id)->get();
        
        if(count($hasRelationship) > 0) {
            // Verifica se não existe relacionamento o a tabela Projeto
            return redirect()->route('clientes.index')->with('mensagem_error', 'Este cliente não pode ser deletado, existe '.count($hasRelationship).' resistro(s) usando. ');

        } else {

            $cliente = Cliente::findOrFail( $id );
            $cliente->delete();
            
            return redirect()->route('clientes.index');

        }       

            
    }




}
