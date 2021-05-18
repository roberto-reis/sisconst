@extends('adminlte::page')

@section('title', 'Editar Projeto')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Operacional</a> > <a href="{{ route('projeto.index') }}">Projeto</a> > Editar Projeto</nav>
        </div>
@stop

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show alerta_custom" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5>
                <i class="icon fas fa-ban"></i>
                Ocorreu um erro!
            </h5>     
            <ul>                    
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center mt-4">
        
        <div class="card col-xl-10 col-md-12">
            <div class="card-bady p-2">
                <form class=" form_custom" action="{{ route('projeto.update', $projeto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="num_projeto">Projeto*:</label>
                            <input type="text" name="num_projeto" class="form-control @error('num_projeto') is-invalid @enderror" id="projeto" value="{{ $projeto->num_projeto }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="estacao">Estação*:</label>
                            <select name="estacao" id="estacao" class="form-control @error('estacao') is-invalid @enderror" id="estacao">
                                @foreach ($estacoes as $estacao)
                                    <option value="{{ $estacao->id }}" {{ $estacao->id === $projeto->estacao->id ? "selected" : null }} >{{ $estacao->sigla }}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="data_oe">Data O.E. / OC:</label>
                            <input type="date" name="data_oe" class="form-control @error('data_oe') is-invalid @enderror" id="data_oe" value="{{ $projeto->data_oe }}">
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="numero_oe_oc">O.E. / OC:</label>
                            <input type="text" name="numero_oe_oc" class="form-control @error('numero_oe_oc') is-invalid @enderror" id="numero_oe_oc" value="{{ $projeto->numero_oe_oc }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="endereco">Endereço*:</label>
                            <input type="text" name="endereco" class="form-control @error('endereco') is-invalid @enderror" id="endereco" value="{{ $projeto->endereco }}">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="bairro">Bairro*:</label>
                            <input type="text" name="bairro" class="form-control @error('bairro') is-invalid @enderror" id="bairro" value="{{ $projeto->bairro }}">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="cidade">Cidade*:</label>
                            <input type="text" name="cidade" class="form-control @error('cidade') is-invalid @enderror" id="cidade" value="{{ $projeto->cidade }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="uf">UF*:</label>
                            <input type="text" name="uf" class="form-control @error('uf') is-invalid @enderror" id="uf" value="{{ $projeto->uf }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="contrato_cliente">Contrato - Cliente*:</label>
                            <select name="contrato_cliente" id="contrato_cliente" class="form-control @error('contrato_cliente') is-invalid @enderror" id="contrato_cliente">
                                @foreach ($clientes as $cliente)
                                    <option {{ $cliente->id === $projeto->cliente->id ? "selected" : null }} data-valor_urs="{{ $cliente->valor_urs }}" data-classe_servico="{{ $cliente->classe_servico }}" value="{{ $cliente->id }}">{{ $cliente->contrato }} - {{ $cliente->rasao_social }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="pc_rv">PC / RV:</label>
                            <input type="text" name="pc_rv" class="form-control @error('pc_rv') is-invalid @enderror" id="bairro" value="{{ $projeto->pc_rv }}">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="tipo_servico">Tipo de Serviço:*</label>
                            <select name="tipo_servico" id="tipo_servico" class="form-control @error('tipo_servico') is-invalid @enderror" id="tipo_servico">
                                @foreach ($tipoServicos as $tipoServico)
                                    <option value="{{ $tipoServico->id }}" {{ $tipoServico->id === $projeto->tipoServico->id ? "selected" : null }}>{{ $tipoServico->nome }}</option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8 col-sm-12">
                            <label for="descricao_servico">Descrição Serviço:</label>
                            <textarea name="descricao_servico" class="form-control @error('descricao_servico') is-invalid @enderror" rows="1">{{ $projeto->descricao_servico }}</textarea>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="inicio_previsto">Inicio Previsto:</label>
                            <input type="date" name="inicio_previsto" class="form-control @error('inicio_previsto') is-invalid @enderror" value="{{ $projeto->inicio_previsto }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="termino_previsto">Término Previsto:</label>
                            <input type="date" name="termino_previsto" class="form-control @error('termino_previsto') is-invalid @enderror" id="termino_previsto" value="{{ $projeto->termino_previsto }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-5 col-sm-6">
                            <label for="supervisor">Supervisor:</label>
                            <select name="supervisor" id="supervisor" class="form-control">
                                @foreach ($supervisores as $supervisor)
                                    <option value="{{ $supervisor->id }}" {{ $projeto->supervisor->id === $supervisor->id ? "selected" : null }}>{{ $supervisor->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="licenca">Licença:</label>
                            <input type="text" name="licenca" class="form-control @error('licenca') is-invalid @enderror" value="{{ $projeto->licenca }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="inicio_licenca">Inicio Licença:</label>
                            <input type="date" name="inicio_licenca" class="form-control @error('inicio_licenca') is-invalid @enderror" value="{{ $projeto->inicio_licenca }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="termino_licenca">Término Licença:</label>
                            <input type="date" name="termino_licenca" class="form-control @error('termino_licenca') is-invalid @enderror" value="{{ $projeto->termino_licenca }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="classe_servico">Classe Serviço:</label>
                            <input type="text" id="classe_servico" disabled name="classe_servico" class="form-control">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="valor_urs">Valor UR’s:</label>
                            <input type="text" id="valor_urs" disabled name="valor_urs" class="form-control">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="valor_projetado">Valor Previsto:</label>
                            <input type="text" name="valor_projetado" id="valor_projetado" class="form-control @error('valor_projetado') is-invalid @enderror" value="{{ number_format($projeto->valor_projetado, 2, ",", ".") }}">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="comprimento_galeria">Comprimento Galeria:</label>
                            <input type="text" name="comprimento_galeria" class="form-control @error('comprimento_galeria') is-invalid @enderror" value="{{ number_format($projeto->comprimento_galeria, 2, ",", ".") }}">
                        </div>
                    </div>
        
                    <button type="submit" class="btn btn-info btn-lg">Alualizar</button>
                </form>
            </div>
        </div>

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Carrega os dados
            $('#classe_servico').val($('#contrato_cliente option:selected').attr("data-classe_servico"));
            $('#valor_urs').val($('#contrato_cliente option:selected').attr("data-valor_urs"));

            // carrega os dados quando o click
            $('#contrato_cliente').on('click', function() {
                $('#classe_servico').val($('#contrato_cliente option:selected').attr("data-classe_servico"));
                $('#valor_urs').val($('#contrato_cliente option:selected').attr("data-valor_urs"));
            })


        });
    </script>
@stop
