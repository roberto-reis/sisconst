<?php

namespace App\Http\Controllers\Sistema\Operacional;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Estacao;
use App\Models\Obra;
use App\Models\Projeto;
use App\Models\Supervisor;
use App\Models\TipoServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjetoController extends Controller
{
    // Formata numero para guadar no BD
    public function format_num($valor) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }

    public function index() {
        $projetos = Projeto::paginate(10);
        

        return view('sistema.operacional.projeto.home', [
            'projetos' => $projetos
        ]);
    }

    public function create() {
        $estacoes = Estacao::get();
        $clientes = Cliente::get();
        $tipoServicos = TipoServico::get();
        $supervisores = Supervisor::get();        

        return view('sistema.operacional.projeto.create', [
            'estacoes' => $estacoes,
            'clientes' => $clientes,
            'tipoServicos' => $tipoServicos,
            'supervisores' => $supervisores
        ]);
    }

    public function store(Request $request) {

        $data = $request->only([
            'num_projeto',
            'estacao',
            'data_oe',
            'numero_oe_oc',
            'endereco',
            'bairro',
            'cidade',
            'uf',
            'contrato_cliente',
            'pc_rv',
            'tipo_servico',
            'descricao_servico',
            'inicio_previsto',
            'termino_previsto',
            'supervisor',
            'licenca',
            'inicio_licenca',
            'termino_licenca',
            'valor_projetado',
            'comprimento_galeria'
        ]);

        $validator = Validator::make($data, [
            'num_projeto' => ['required', 'string', 'max:50', 'unique:projetos'],
            'estacao' => ['required'],
            'data_oe' => ['nullable', 'date'],
            'numero_oe_oc' => ['nullable', 'string', 'max:50'],
            'endereco' => ['required', 'string', 'max:100'],
            'bairro' => ['required', 'string', 'max:50'],
            'cidade' => ['required', 'string', 'max:50'],
            'uf' => ['required', 'string', 'max:2'],
            'contrato_cliente' => ['required'],
            'pc_rv' => ['nullable', 'string', 'max:50'],
            'tipo_servico' => ['required'],
            'descricao_servico' => ['nullable', 'string', 'max:300'],
            'inicio_previsto' => ['nullable', 'date'],
            'termino_previsto' => ['nullable', 'date'],
            'licenca' => ['nullable', 'string', 'max:20'],
            'inicio_licenca' => ['nullable', 'date'],
            'termino_licenca' => ['nullable', 'date']
        ]);

        if($validator->fails()) {
            return redirect()->route('projeto.create')->withErrors($validator)->withInput();
        }

        $projeto = new Projeto();
        $projeto->num_projeto = $data['num_projeto'];
        $projeto->id_estacao = $data['estacao'];
        $projeto->data_oe = $data['data_oe'];
        $projeto->numero_oe_oc = $data['numero_oe_oc'];
        $projeto->endereco = $data['endereco'];
        $projeto->bairro = $data['bairro'];
        $projeto->cidade = $data['cidade'];
        $projeto->uf = $data['uf'];
        $projeto->pc_rv = $data['pc_rv'];
        $projeto->descricao_servico = $data['descricao_servico'];
        $projeto->inicio_previsto = $data['inicio_previsto'];
        $projeto->termino_previsto = $data['termino_previsto'];
        $projeto->id_supervisor = $data['supervisor'];
        $projeto->licenca = $data['licenca'];
        $projeto->inicio_licenca = $data['inicio_licenca'];
        $projeto->termino_licenca = $data['termino_licenca'];
        $projeto->valor_projetado = $this->format_num($data['valor_projetado']);
        $projeto->comprimento_galeria = $this->format_num($data['comprimento_galeria']);
        $projeto->id_cliente = $data['contrato_cliente'];
        $projeto->id_tipo_servico = $data['tipo_servico'];
        
        $projeto->save();

        return redirect()->route('projeto.index');
        
    }

    public function edit($id) {
        // Busca o Projeto com os relacionamentos
        $projeto = Projeto::with(['estacao', 'cliente', 'tipoServico', 'supervisor'])->find($id);

        $estacoes = Estacao::get();
        $clientes = Cliente::get();
        $tipoServicos = TipoServico::get();
        $supervisores = Supervisor::get();

        if($projeto) {

            return view('sistema.operacional.projeto.edit', [
                'projeto' => $projeto,
                'estacoes' => $estacoes,
                'clientes' => $clientes,
                'tipoServicos' => $tipoServicos,
                'supervisores' => $supervisores
            ]);
        }
        
        return redirect()->route('projeto.index');
    }

    public function update(Request $request, $id) {

        $projeto = Projeto::find($id);

        if($projeto) {
            
            $data = $request->only([
                'num_projeto',
                'estacao',
                'data_oe',
                'numero_oe_oc',
                'endereco',
                'bairro',
                'cidade',
                'uf',
                'contrato_cliente',
                'pc_rv',
                'tipo_servico',
                'descricao_servico',
                'inicio_previsto',
                'termino_previsto',
                'supervisor',
                'licenca',
                'inicio_licenca',
                'termino_licenca',
                'valor_projetado',
                'comprimento_galeria'
            ]);
    
            $validator = Validator::make($data, [
                'estacao' => ['required'],
                'data_oe' => ['nullable', 'date'],
                'numero_oe_oc' => ['nullable', 'string', 'max:50'],
                'endereco' => ['required', 'string', 'max:100'],
                'bairro' => ['required', 'string', 'max:50'],
                'cidade' => ['required', 'string', 'max:50'],
                'uf' => ['required', 'string', 'max:2'],
                'contrato_cliente' => ['required'],
                'pc_rv' => ['nullable', 'string', 'max:50'],
                'tipo_servico' => ['required'],
                'descricao_servico' => ['nullable', 'string', 'max:300'],
                'inicio_previsto' => ['nullable', 'date'],
                'termino_previsto' => ['nullable', 'date'],
                'licenca' => ['nullable', 'string', 'max:20'],
                'inicio_licenca' => ['nullable', 'date'],
                'termino_licenca' => ['nullable', 'date']
            ]);

            if($data['num_projeto'] != $projeto->num_projeto) {

                $hasProjeto = Projeto::where('num_projeto', $data['num_projeto'])->get();

                if(count($hasProjeto) === 0) {
                    $projeto->num_projeto = $data['num_projeto'];
                } else {
                    // Se o nome digitado já existe no bd add validation.unique 
                    $validator->errors()->add('num_projeto', __('validation.unique', [
                        'attribute' => 'num_projeto'
                    ]));
                }
            }
    
            if(count( $validator->errors() ) > 0) {
                return redirect()->route('projeto.edit', $id
                )->withErrors($validator);

            }else {
                // Atualiza os dados
                $projeto->id_estacao = $data['estacao'];
                $projeto->data_oe = $data['data_oe'];
                $projeto->numero_oe_oc = $data['numero_oe_oc'];
                $projeto->endereco = $data['endereco'];
                $projeto->bairro = $data['bairro'];
                $projeto->cidade = $data['cidade'];
                $projeto->uf = $data['uf'];
                $projeto->pc_rv = $data['pc_rv'];
                $projeto->descricao_servico = $data['descricao_servico'];
                $projeto->inicio_previsto = $data['inicio_previsto'];
                $projeto->termino_previsto = $data['termino_previsto'];
                $projeto->id_supervisor = $data['supervisor'];
                $projeto->licenca = $data['licenca'];
                $projeto->inicio_licenca = $data['inicio_licenca'];
                $projeto->termino_licenca = $data['termino_licenca'];
                $projeto->valor_projetado = $this->format_num($data['valor_projetado']);
                $projeto->comprimento_galeria = $this->format_num($data['comprimento_galeria']);
                $projeto->id_cliente = $data['contrato_cliente'];
                $projeto->id_tipo_servico = $data['tipo_servico'];

                $projeto->save();

            }
            return redirect()->route('projeto.index')->with('mensagem_sucesso', 'Projeto alterado com sucesso!');

        }

        return redirect()->route('projeto.index');

    }

    public function destroy($id) {
        $hasRelationship = Obra::where('id_projeto', $id)->get();
        
        if(count($hasRelationship) > 0) {
            // Verifica se não existe relacionamento o a tabela Projeto
            return redirect()->route('projeto.index')->with('mensagem_error', 'Este Projeto não pode ser deletado, existe '.count($hasRelationship).' resistro(s) usando-o. ');

        } else {

            $projeto = Projeto::findOrFail( $id );
            $projeto->delete();
            
            return redirect()->route('projeto.index');

        }       

            
    }


}
