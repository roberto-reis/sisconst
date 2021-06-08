<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:permission-operacional');
    }

    public function index() {
        $search = request('search');
        $filtro = request('filtro');

        if($search) {
            $clientes = Cliente::where($filtro, 'like', '%'.$search.'%')->orderBy('id', 'desc')->get();
        } else {
            $clientes = Cliente::orderBy('id', 'desc')->get();
        }
        

        return view('sistema.operacional.cliente.home', [
            'clientes' => $clientes,
            'search' => $search
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

        $cliente = new Cliente();
        $cliente->contrato = $data['contrato'];
        $cliente->rasao_social = $data['rasao_social'];
        $cliente->cnpj = $data['cnpj'];
        $cliente->endereco = $data['endereco'];
        $cliente->bairro = $data['bairro'];
        $cliente->cidade = $data['cidade'];
        $cliente->uf = strtoupper($data['uf']);
        $cliente->inscricao_municipal = $data['inscricao_municipal'];
        $cliente->inscricao_estadual = $data['inscricao_estadual'];
        $cliente->classe_servico = $data['classe_servico'];
        $cliente->valor_urs = $this->format_num($data['valor_urs']);
        $cliente->save();

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

            $cliente->contrato = $data['contrato'];
            $cliente->rasao_social = $data['rasao_social'];
            $cliente->cnpj = $data['cnpj'];
            $cliente->endereco = $data['endereco'];
            $cliente->bairro = $data['bairro'];
            $cliente->cidade = $data['cidade'];
            $cliente->uf = strtoupper($data['uf']);
            $cliente->inscricao_municipal = $data['inscricao_municipal'];
            $cliente->inscricao_estadual = $data['inscricao_estadual'];
            $cliente->classe_servico = $data['classe_servico'];
            $cliente->valor_urs = $this->format_num($data['valor_urs']);
            $cliente->save();

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

    // Formata numero para guadar no BD
    public function format_num($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }


}
