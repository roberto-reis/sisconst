@extends('layouts.main')

@section('title', 'Editar Projeto')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Dashboard</a> > <a href="{{ route('projetos.index') }}">Projetos</a> > Editar Projeto</nav>
        </div>
@stop

@section('content_main')

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
        
        <div class="card col-xl-10 col-md-12 p-0">
            <form class=" form_custom" action="{{ route('projeto.update', $projeto->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="num_projeto">Projeto*:</label>
                            <input type="text" name="num_projeto" id="num_projeto" class="form-control @error('num_projeto') is-invalid @enderror" id="projeto" value="{{ $projeto->num_projeto }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="estacao">Estação*:</label>
                            <select name="estacao" id="estacao" class="form-control @error('estacao') is-invalid @enderror" id="estacao">
                                @foreach ($estacoes as $estacao)
                                    <option value="{{ $estacao->id }}" {{ $estacao->id === $projeto->estacao->id ? "selected" : null }} >{{ $estacao->sigla }} - {{ $estacao->descricao }}</option>
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
                            <select name="contrato_cliente" id="contrato_cliente" class="form-control @error('contrato_cliente') is-invalid @enderror">
                                @foreach ($clientes as $cliente)
                                    <option {{ $cliente->id === $projeto->cliente->id ? "selected" : null }} data-valor_urs="{{ $cliente->valor_urs }}" data-classe_servico="{{ $cliente->classe_servico }}" value="{{ $cliente->id }}">{{ $cliente->contrato }} - {{ $cliente->rasao_social }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="pc_rv">PC / RV:</label>
                            <input type="text" name="pc_rv" class="form-control @error('pc_rv') is-invalid @enderror" id="pc_rv" value="{{ $projeto->pc_rv }}">
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
                        <div class="form-group col-lg-8 col-md-5 col-sm-12">
                            <label for="descricao_servico">Descrição Serviço:</label>
                            <textarea name="descricao_servico" id="descricao_servico" class="form-control @error('descricao_servico') is-invalid @enderror" rows="1">{{ $projeto->descricao_servico }}</textarea>
                        </div>
                        <div class="form-group col-lg-2 col-md-3 col-sm-6">
                            <label for="inicio_previsto">Inicio Previsto:</label>
                            <input type="date" name="inicio_previsto" id="inicio_previsto" class="form-control @error('inicio_previsto') is-invalid @enderror" value="{{ $projeto->inicio_previsto }}">
                        </div>
                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                            <label for="termino_previsto">Término Previsto:</label>
                            <input type="date" name="termino_previsto" id="termino_previsto" class="form-control @error('termino_previsto') is-invalid @enderror" value="{{ $projeto->termino_previsto }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="licenca">Licença:</label>
                            <input type="text" name="licenca" id="licenca" class="form-control @error('licenca') is-invalid @enderror" value="{{ $projeto->licenca }}">
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="inicio_licenca">Inicio Licença:</label>
                            <input type="date" name="inicio_licenca" id="inicio_licenca" class="form-control @error('inicio_licenca') is-invalid @enderror" value="{{ $projeto->inicio_licenca }}">
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="termino_licenca">Término Licença:</label>
                            <input type="date" name="termino_licenca" id="termino_licenca" class="form-control @error('termino_licenca') is-invalid @enderror" value="{{ $projeto->termino_licenca }}">
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
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text form-control">R$</span>
                                </div>
                                <input type="text" name="valor_projetado" id="valor_projetado" class="form-control @error('valor_projetado') is-invalid @enderror" value="{{ number_format($projeto->valor_projetado, 2, ",", ".") }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="comprimento_galeria">Comprimento Galeria:</label>
                            <input type="text" name="comprimento_galeria" id="comprimento_galeria" class="form-control @error('comprimento_galeria') is-invalid @enderror" value="{{ number_format($projeto->comprimento_galeria, 2, ",", ".") }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('projetos.index') }}" class="btn btn-danger btn-lg">Cancelar</a>
                    <button type="submit" class="btn btn-info btn-lg">Alualizar</button>
                </div>                    
            </form>
        </div>

    </div>
@stop

@section('css_custom')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css"> <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css"> <!-- Select2 -->
@stop

@section('js_custom')
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            // Function buncar no select
            $('select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            });

            // Carrega os dados ao iniciar
            $('#classe_servico').val($('#contrato_cliente option:selected').attr("data-classe_servico"));
            $('#valor_urs').val($('#contrato_cliente option:selected').attr("data-valor_urs"));

            // Carrega do dados quando selecionar o option do select
            $('#contrato_cliente').on('change', function() {
                $('#classe_servico').val($('#contrato_cliente option:selected').attr("data-classe_servico"));
                $('#valor_urs').val($('#contrato_cliente option:selected').attr("data-valor_urs"));
            })


        });
    </script>
@stop
