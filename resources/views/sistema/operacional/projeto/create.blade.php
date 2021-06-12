@extends('adminlte::page')

@section('title', 'Novo Projeto')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Operacional</a> > <a href="{{ route('projetos.index') }}">Projetos</a> > Novo Projeto</nav>
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
        
        <div class="card col-xl-10 col-md-12 p-0">
            <form class="form_custom" action="{{ route('projeto.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="num_projeto">Projeto*:</label>
                            <input type="text" name="num_projeto" class="form-control @error('num_projeto') is-invalid @enderror" id="num_projeto" value="{{ old('num_projeto') }}" placeholder="Digite o numero do projeto">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="estacao">Estação*:</label>
                            <select name="estacao" id="estacao" class="form-control @error('estacao') is-invalid @enderror" id="estacao" value="{{ old('estacao') }}">
                                <option value="">Selecione a estação</option>
                                @foreach ($estacoes as $estacao)
                                    <option value="{{ $estacao->id }}">{{ $estacao->sigla }}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="data_oe">Data OE / OC:</label>
                            <input type="date" name="data_oe" class="form-control @error('data_oe') is-invalid @enderror" id="data_oe" value="{{ old('data_oe') }}">
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="numero_oe_oc">OE / OC:</label>
                            <input type="text" name="numero_oe_oc" class="form-control @error('numero_oe_oc') is-invalid @enderror" id="numero_oe_oc" value="{{ old('numero_oe_oc') }}" placeholder="Digite o nº O.E. ou OC">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="endereco">Endereço*:</label>
                            <input type="text" name="endereco" class="form-control @error('endereco') is-invalid @enderror" id="endereco" value="{{ old('endereco') }}" placeholder="Digite o endereço">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="bairro">Bairro*:</label>
                            <input type="text" name="bairro" class="form-control @error('bairro') is-invalid @enderror" id="bairro" value="{{ old('bairro') }}" placeholder="Digite o bairro">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="cidade">Cidade*:</label>
                            <input type="text" name="cidade" class="form-control @error('cidade') is-invalid @enderror" id="cidade" value="{{ old('cidade') }}" placeholder="Digite o cidade">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="uf">UF*:</label>
                            <input type="text" name="uf" class="form-control @error('uf') is-invalid @enderror" id="uf" value="{{ old('uf') }}" placeholder="Qual o Estado?">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="contrato_cliente">Contrato - Cliente*:</label>
                            <select name="contrato_cliente" id="contrato_cliente" class="form-control @error('contrato_cliente') is-invalid @enderror" id="contrato_cliente" value="{{ old('contrato_cliente') }}">
                                <option value="">Selecione um contrato</option>
                                @foreach ($clientes as $cliente)
                                    <option data-valor_urs="{{ $cliente->valor_urs }}" data-classe_servico="{{ $cliente->classe_servico }}" value="{{ $cliente->id }}">{{ $cliente->contrato }} - {{ $cliente->rasao_social }}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="pc_rv">PC / RV:</label>
                            <input type="text" name="pc_rv" class="form-control @error('pc_rv') is-invalid @enderror" id="pc_rv" value="{{ old('pc_rv') }}" placeholder="Digite o PC ou SC">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="tipo_servico">Tipo de Serviço*:</label>
                            <select name="tipo_servico" id="tipo_servico" class="form-control @error('tipo_servico') is-invalid @enderror" id="tipo_servico" value="{{ old('tipo_servico') }}">
                                <option value="">Selecione o tipo de serviço</option>
                                @foreach ($tipoServicos as $tipoServico)
                                    <option value="{{ $tipoServico->id }}">{{ $tipoServico->nome }}</option>
                                @endforeach                                
                            </select>                            
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-8 col-md-5 col-sm-12">
                            <label for="descricao_servico">Descrição Serviço:</label>
                            <textarea name="descricao_servico" id="descricao_servico" class="form-control @error('descricao_servico') is-invalid @enderror" rows="1" placeholder="Digite a descrição do serviço">{{ old('descricao_servico') }}</textarea>
                        </div>
                        <div class="form-group col-lg-2 col-md-3 col-sm-6">
                            <label for="inicio_previsto">Inicio Previsto:</label>
                            <input type="date" name="inicio_previsto" id="inicio_previsto" class="form-control @error('inicio_previsto') is-invalid @enderror" value="{{ old('inicio_previsto') }}">
                        </div>
                        <div class="form-group col-lg-2 col-md-4 col-sm-6">
                            <label for="termino_previsto">Término Previsto:</label>
                            <input type="date" name="termino_previsto" id="termino_previsto" class="form-control @error('termino_previsto') is-invalid @enderror" id="termino_previsto" value="{{ old('termino_previsto') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-lg-5 col-md-4 col-sm-6">
                            <label for="supervisor">Supervisor:</label>
                            <select name="supervisor" id="supervisor" class="form-control">
                                <option value="">Selecione um supervisor</option>
                                @foreach ($supervisores as $supervisor)
                                    <option value="{{ $supervisor->id }}">{{ $supervisor->nome }}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group col-lg-3 col-md-2 col-sm-6">
                            <label for="licenca">Licença:</label>
                            <input type="text" name="licenca" id="licenca" class="form-control @error('licenca') is-invalid @enderror" value="{{ old('licenca') }}" placeholder="Digite licença">
                        </div>
                        <div class="form-group col-lg-2 col-md-3 col-sm-6">
                            <label for="inicio_licenca">Inicio Licença:</label>
                            <input type="date" name="inicio_licenca" id="inicio_licenca" class="form-control @error('inicio_licenca') is-invalid @enderror" value="{{ old('inicio_licenca') }}">
                        </div>
                        <div class="form-group col-lg-2 col-md-3 col-sm-6">
                            <label for="termino_licenca">Término Licença:</label>
                            <input type="date" name="termino_licenca" id="termino_licenca" class="form-control @error('termino_licenca') is-invalid @enderror" value="{{ old('termino_licenca') }}">
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
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text form-control">R$</span>
                                </div>
                                <input type="text" name="valor_projetado" id="valor_projetado" class="form-control @error('valor_projetado') is-invalid @enderror" value="{{ old('valor_projetado') }}" placeholder="Qual o valor previsto?">
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="comprimento_galeria">Comprimento Galeria:</label>
                            <input type="text" name="comprimento_galeria" id="comprimento_galeria" class="form-control @error('comprimento_galeria') is-invalid @enderror" value="{{ old('comprimento_galeria') }}" placeholder="Qual o Comprimento Galeria?">
                        </div>
                    </div>
                </div>    
                <div class="card-footer">
                    <a href="{{ route('projetos.index') }}" class="btn btn-danger btn-lg">Cancelar</a>
                    <button type="submit" class="btn btn-info btn-lg">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css"> <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css"> <!-- Select2 -->
@stop

@section('js')
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

            // Carrega do dados quando selecionar o option do select
            $('#contrato_cliente').on('change', function() {
                $('#classe_servico').val($('#contrato_cliente option:selected').attr("data-classe_servico"));
                $('#valor_urs').val($('#contrato_cliente option:selected').attr("data-valor_urs"));
            })


        });
    </script>
@stop
