@extends('layouts.main')

@section('title', 'Clientes')


@section('content_header')
        <div class="row align-items-center">
            <nav class="col-md-5 col-sm-5 breadcrumb_custom pb-2 p-sm-0"><div><a href="{{ route('operacional.index') }}">Dashboard</a> > Clientes</div></nav>
            {{-- Form de pesquisar --}}
            <form class="col-md-7 col-sm-7 p-0" action="{{ route('clientes.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="O que deseja pesquisar?">
                    <div class="input-group-append">
                        <select name="filtro" class="custom-select rounded-0">
                            <option value="contrato" selected>Filtro...</option>
                            <option value="cnpj">CNPJ</option>
                            <option value="contrato">Contrato</option>
                            <option value="rasao_social">Rasão Social</option>
                        </select>
                    <button type="submit" class="btn btn-outline-info"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
@stop

@section('content_main')

    @if (session('mensagem_sucesso'))
        <div class="alert alert-success alert-dismissible alerta_custom">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>            
            {{ session('mensagem_sucesso') }}            
        </div>
    @elseif (session('mensagem_error'))
        <div class="alert alert-danger alert-dismissible alerta_custom">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>            
            {{ session('mensagem_error') }}
            
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-xl-10 col-md-12 mt-4">
            <a href="{{ route('cliente.create') }}" class="btn btn-info">Novo Cliente</a>
        </div>
        <div class="title_custom col-xl-10 col-12 mt-3">
            @if ($search)
                <h3 class="mb-0">Resultado da pesquisa: {{ $search }}</h3>
            @else
                <h3 class="mb-0">Clientes cadastrados</h3>
            @endif
        </div>
        <div class="col-xl-10 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-clientes">
                            <thead>
                                <tr>
                                    <th>
                                        Nº Contrato
                                    </th>
                                    <th style="min-width: 180px">
                                        Rasão Social
                                    </th>
                                    <th style="min-width: 136px">
                                        CNPJ
                                    </th>
                                    <th>
                                        Classe Serviço
                                    </th>
                                    <th>
                                        VALOR UR's
                                    </th>
                                    <th style="width: 78px">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
            
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->contrato }}</td>
                                    <td>{{ $cliente->rasao_social }}</td>
                                    <td>{{ $cliente->cnpj }}</td>
                                    <td>{{ $cliente->classe_servico }}</td>
                                    <td>{{ str_replace('.', ',', $cliente->valor_urs) }}</td>
                                    <td>
                                        <div class="btn_table">
                                            <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn"><i class="fas fa-edit"></i></a>                       
                                            
                                            <form class="d-inline" action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" onclick="return confirm('Tem certeza que deseja excluir?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div> 
                                    </td>
                                </tr>
                                @endforeach        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@section('plugins.Datatables', true)
@section('js_custom')
    <script>
        $(document).ready(function () {
            $('.table-clientes').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@stop
