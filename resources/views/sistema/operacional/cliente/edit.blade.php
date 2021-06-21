@extends('layouts.main')

@section('title', 'Editar Cliente')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Dashboard</a> > <a href="{{ route('clientes.index') }}">Clientes</a> > Editar Cliente</nav>
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

    @if (session('mensagem_sucesso'))
        <div class="alert alert-success alert-dismissible alerta_custom">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            
                {{ session('mensagem_sucesso') }}
            
        </div>
    @endif

    <div class="row justify-content-center mt-4">
        <div class="card col-xl-10 col-md-12 p-0">
            <form class="form_custom" action="{{ route('cliente.update', $cliente->id) }}" method="POST">
                @csrf
                @method('PUT')                
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="contrato">Nº Contrato*:</label>
                            <input type="text" name="contrato" class="form-control @error('contrato') is-invalid @enderror" id="contrato" value="{{ $cliente->contrato }}" id="contrato">
                        </div>
                        <div class="form-group col-md-5 ">
                            <label for="rasao_social">Rasão Social*:</label>
                            <input type="text" name="rasao_social" class="form-control @error('rasao_social') is-invalid @enderror" id="contrato" value="{{ $cliente->rasao_social }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cnpj">CNPJ*:</label>
                            <input type="text" name="cnpj" class="form-control @error('cnpj') is-invalid @enderror" id="contrato" value="{{ $cliente->cnpj }}">
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="endereco">Endereço*:</label>
                            <input type="text" name="endereco" class="form-control @error('endereco') is-invalid @enderror" id="contrato" value="{{ $cliente->endereco }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="bairro">Bairro*:</label>
                            <input type="text" name="bairro" class="form-control @error('bairro') is-invalid @enderror" id="contrato" value="{{ $cliente->bairro }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cidade">Cidade*:</label>
                            <input type="text" name="cidade" class="form-control @error('cidade') is-invalid @enderror" id="contrato" value="{{ $cliente->cidade }}">
                        </div>
                        <div class="form-group col-md-1">
                            <label for="uf">UF*:</label>
                            <input type="text" name="uf" class="form-control @error('uf') is-invalid @enderror" id="contrato" value="{{ $cliente->uf }}">
                        </div>
                    </div>
        
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inscricao_municipal">Inscrição Munícipal:</label>
                            <input type="text" name="inscricao_municipal" class="form-control @error('inscricao_municipal') is-invalid @enderror" id="contrato" value="{{ $cliente->inscricao_municipal }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inscricao_estadual">Inscrição Estadual:</label>
                            <input type="text" name="inscricao_estadual" class="form-control @error('inscricao_estadual') is-invalid @enderror" id="contrato" value="{{ $cliente->inscricao_estadual }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="classe_servico">Classe Serviço:</label>
                            <select name="classe_servico" id="classe_servico" class="form-control">
                                <option value="B" {{ $cliente->classe_servico === "B" ? "selected" : null }} >B</option>
                                <option value="C" {{ $cliente->classe_servico === "C" ? "selected" : null }}>C</option>
                                <option value="F" {{ $cliente->classe_servico === "F" ? "selected" : null }}>F</option>
                                <option value="G" {{ $cliente->classe_servico === "G" ? "selected" : null }}>G</option>
                                <option value="L" {{ $cliente->classe_servico === "L" ? "selected" : null }}>L</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="valor_urs">Valor UR’s:</label>
                            <input type="text" name="valor_urs" class="form-control @error('valor_urs') is-invalid @enderror" id="contrato" value="{{ str_replace('.', ',', $cliente->valor_urs) }}">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-info">Atualizar</button>
                </div>
            </form>
        </div>
        
    </div>

@stop
