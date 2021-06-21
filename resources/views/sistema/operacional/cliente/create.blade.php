@extends('layouts.main')

@section('title', 'Novo Cliente')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Dashboard</a> > <a href="{{ route('clientes.index') }}">Clientes</a> > Novo Cliente</nav>
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
            <form class=" form_custom" action="{{ route('cliente.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="contrato">Nº Contrato*:</label>
                            <input type="text" name="contrato" class="form-control @error('contrato') is-invalid @enderror" id="contrato" value="{{ old('contrato') }}" placeholder="Digite o numero do contrato">
                        </div>
                        <div class="form-group col-md-5 ">
                            <label for="rasao_social">Rasão Social*:</label>
                            <input type="text" name="rasao_social" class="form-control @error('rasao_social') is-invalid @enderror" id="rasao_social" value="{{ old('rasao_social') }}" placeholder="Digite a Rasão Social">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cnpj">CNPJ*:</label>
                            <input type="text" name="cnpj" class="form-control @error('cnpj') is-invalid @enderror" id="cnpj" value="{{ old('cnpj') }}" placeholder="Qual o CNPJ?">
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="endereco">Endereço*:</label>
                            <input type="text" name="endereco" class="form-control @error('endereco') is-invalid @enderror" id="endereco" value="{{ old('endereco') }}" placeholder="Qual o endereço?">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="bairro">Bairro*:</label>
                            <input type="text" name="bairro" class="form-control @error('bairro') is-invalid @enderror" id="bairro" value="{{ old('bairro') }}" placeholder="Qual o bairro?">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cidade">Cidade*:</label>
                            <input type="text" name="cidade" class="form-control @error('cidade') is-invalid @enderror" id="cidade" value="{{ old('cidade') }}" placeholder="Qual a cidade?">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="uf">UF*:</label>
                            <input type="text" name="uf" class="form-control @error('uf') is-invalid @enderror" id="uf" value="{{ old('uf') }}" placeholder="Estado">
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inscricao_municipal">Inscrição Munícipal:</label>
                            <input type="text" name="inscricao_municipal" class="form-control @error('inscricao_municipal') is-invalid @enderror" id="inscricao_municipal" value="{{ old('inscricao_municipal') }}" placeholder="Digite a Inscrição Munícipal">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inscricao_estadual">Inscrição Estadual:</label>
                            <input type="text" name="inscricao_estadual" class="form-control @error('inscricao_estadual') is-invalid @enderror" id="inscricao_estadual" value="{{ old('inscricao_estadual') }}" placeholder="Digite a Inscrição Estadual">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="classe_servico">Classe Serviço:</label>
                            <select name="classe_servico" id="classe_servico" class="form-control">
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="F">F</option>
                                <option value="G" selected>G</option>
                                <option value="L">L</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="valor_urs">Valor UR’s:</label>
                            <input type="text" name="valor_urs" class="form-control @error('valor_urs') is-invalid @enderror" id="valor_urs" value="{{ old('valor_urs') }}" placeholder="Exemplo: 29,90">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-info">Cadastrar</button>
                </div>
            </form>
        </div>

    </div>

@stop