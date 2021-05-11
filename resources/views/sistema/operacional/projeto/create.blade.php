@extends('adminlte::page')

@section('title', 'Novo Projeto')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Operacional</a> > <a href="{{ route('projeto.index') }}">Projeto</a> > Novo Projeto</nav>
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
                <form class=" form_custom" action="{{ route('projeto.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="contrato">Projeto*:</label>
                            <input type="text" name="projeto" class="form-control @error('projeto') is-invalid @enderror" id="projeto" value="{{ old('projeto') }}" placeholder="Digite o numero do projeto">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="estacao">Estação*:</label>
                            <select name="estacao" id="estacao" class="form-control">
                                <option></option>
                                <option value="COP">COP</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="data_oe">Data O.E. / OC:</label>
                            <input type="date" name="data_oe" class="form-control @error('data_oe') is-invalid @enderror" id="data_oe" value="{{ old('data_oe') }}">
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="numero_oe_oc">O.E. / OC:</label>
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
                            <input type="text" name="uf" class="form-control @error('numero_oe_oc') is-invalid @enderror" id="uf" value="{{ old('uf') }}" placeholder="Qual o Estado?">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="contrato">Contrato*:</label>
                            <select name="contrato" id="contrato" class="form-control">
                                <option></option>
                                <option value="id_contrato">45632589-5 - Vogel</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="pc_rv">PC / RV:</label>
                            <input type="text" name="pc_rv" class="form-control @error('pc_rv') is-invalid @enderror" id="bairro" value="{{ old('pc_rv') }}" placeholder="Digite o PC ou SC">
                        </div>
                        <div class="form-group col-md-4 col-sm-12">
                            <label for="tipo_servico">Tipo de Serviço:*</label>
                            <select name="tipo_servico" id="tipo_servico" class="form-control">
                                <option></option>
                                <option value="id_tipo_servico">Desobstrução de Galeria</option>
                            </select>                            
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8 col-sm-12">
                            <label for="descricao_servico">Descrição Serviço:</label>
                            <textarea name="descricao_servico" class="form-control @error('descricao_servico') is-invalid @enderror" value="{{ old('descricao_servico') }}" rows="1" placeholder="Digite a descrição do serviço"></textarea>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="inicio_previsto">Inicio Previsto:</label>
                            <input type="date" name="inicio_previsto" class="form-control @error('bairro') is-invalid @enderror" value="{{ old('inicio_previsto') }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="cidade">Término Previsto:</label>
                            <input type="date" name="cidade" class="form-control @error('cidade') is-invalid @enderror" id="cidade" value="{{ old('cidade') }}" placeholder="Digite o cidade">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-5 col-sm-6">
                            <label for="supervisor">Supervisor:</label>
                            <select name="contrato" id="supervisor" class="form-control">
                                <option></option>
                                <option value="id_supervisor">José Roberto</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="licenca">Licença:</label>
                            <input type="text" name="licenca" class="form-control @error('licenca') is-invalid @enderror" value="{{ old('licenca') }}" placeholder="Digite licença">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="inicio_licenca">Inicio Licença:</label>
                            <input type="date" name="inicio_licenca" class="form-control @error('inicio_licenca') is-invalid @enderror" value="{{ old('inicio_licenca') }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="termino_licenca">Término Licença:</label>
                            <input type="date" name="termino_licenca" class="form-control @error('termino_licenca') is-invalid @enderror" value="{{ old('termino_licenca') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="classe_servico">Classe Serviço:</label>
                            <input type="text" disabled name="classe_servico" class="form-control @error('classe_servico') is-invalid @enderror" value="{{ old('classe_servico') }}">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="valor_urs">Valor UR’s::</label>
                            <input type="text" disabled name="valor_urs" class="form-control @error('valor_urs') is-invalid @enderror" value="{{ old('valor_urs') }}">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="valor_projetado">Valor Previsto:</label>
                            <input type="text" name="valor_projetado" class="form-control @error('valor_projetado') is-invalid @enderror" value="{{ old('valor_projetado') }}" placeholder="Qual o valor previsto">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="comprimento_galeria">Comprimento Galeria:</label>
                            <input type="text" name="comprimento_galeria" class="form-control @error('comprimento_galeria') is-invalid @enderror" value="{{ old('comprimento_galeria') }}" placeholder="Qual o Comprimento Galeria">
                        </div>
                    </div>
        
                    <button type="submit" class="btn btn-info btn-lg">Cadastrar</button>
                </form>
            </div>
        </div>

    </div>

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
