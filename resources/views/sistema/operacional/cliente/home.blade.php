@extends('adminlte::page')

@section('title', 'Clientes')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Operacional</a> > Clientes</nav>
        </div>
@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 mt-4 mb-3">
            <!-- Button trigger modal adicionar -->
            <a href="{{ route('cliente.create') }}" class="btn btn-info">Novo Cliente</a>
        </div>
        <div class="table-responsive-md col-md-8 col-sm-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            Nº Contrato
                        </th>
                        <th>
                            Rasão Social
                        </th>
                        <th>
                            CNPJ
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
                        <td>
                            <div class="btn_table">
                                <a href="" class="btn"><i class="fas fa-edit"></i></a>                       
                                
                                <form class="d-inline" action="" method="POST" onclick="return confirm('Tem certeza que deseja excluir?')">
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

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
