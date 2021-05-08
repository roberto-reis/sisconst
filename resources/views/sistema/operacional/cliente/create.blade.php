@extends('adminlte::page')

@section('title', 'Novo Cliente')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Operacional</a> > <a href="{{ route('clientes.index') }}">Clientes</a> > Novo Cliente</nav>
        </div>
@stop

@section('content')

    <div class="row justify-content-center mt-4">
        <div class="col-xl-10 col-md-12">
            <form class="form_custom">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="contrato">Nº Contrato*:</label>
                        <input type="text" name="contrato" class="form-control" id="contrato">
                    </div>
                    <div class="form-group col-md-5 ">
                        <label for="contrato">Rasão Social*:</label>
                        <input type="text" name="rasao_social" class="form-control" id="contrato">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="contrato">CNPJ:</label>
                        <input type="text" name="cnpj" class="form-control" id="contrato">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="endereco">Endereço*:</label>
                        <input type="text" name="endereco" class="form-control" id="endereco">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="bairro">Bairro*:</label>
                        <input type="text" name="bairro" class="form-control" id="bairro">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cidade">Cidade*:</label>
                        <input type="text" name="cidade" class="form-control" id="cidade">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="uf">UF*:</label>
                        <input type="text" name="uf" class="form-control" id="uf">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inscricao_municipal">Inscrição Munícipal:</label>
                        <input type="text" name="inscricao_municipal" class="form-control" id="inscricao_municipal">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inscricao_estadual">Inscrição Estadual:</label>
                        <input type="text" name="inscricao_estadual" class="form-control" id="inscricao_estadual">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="classe_servico">Classe Serviço:</label>
                        <select name="classe_servico" id="classe_servico" class="form-control">
                          <option></option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="F">F</option>
                          <option value="G">G</option>
                          <option value="L">L</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="valor_urs">Valor UR’s:</label>
                        <input type="text" name="valor_urs" class="form-control" id="valor_urs">
                    </div>
                </div>

                <button type="submit" class="btn btn-info">Cadastrar</button>
            </form>
        </div>
    </div>

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
