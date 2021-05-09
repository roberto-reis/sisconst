@extends('adminlte::page')

@section('title', 'Clientes')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Operacional</a> > Clientes</nav>
        </div>
@stop

@section('content')

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
        <div class="col-md-8 mt-4 mb-3">
            <!-- Button trigger modal adicionar -->
            <a href="{{ route('cliente.create') }}" class="btn btn-info">Novo Cliente</a>
        </div>
        <div class="card col-md-8 col-sm-12">
            <div class="card-body">
                <div class="table-responsive-md">
                    <table class="table table-hover">
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
                        {{ $clientes->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
