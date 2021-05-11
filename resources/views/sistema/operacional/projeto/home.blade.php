@extends('adminlte::page')

@section('title', 'Projeto')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Operacional</a> > Projeto</nav>
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
        <div class="col-md-10 mt-4 mb-3">
            <!-- Button trigger modal adicionar -->
            <a href="{{ route('projeto.create') }}" class="btn btn-info">Novo Projeto</a>
        </div>
        <div class="card col-md-10 col-sm-12">
            <div class="card-body">
                <div class="table-responsive-md">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Projeto
                                </th>
                                <th>
                                    O.E.
                                </th>
                                <th style="min-width: 180px">
                                    Endereço
                                </th>
                                <th>
                                    Bairro
                                </th>
                                <th>
                                    Licença
                                </th>
                                <th>
                                    Inicio Licença
                                </th>
                                <th>
                                    Término Licença
                                </th>
                                <th style="width: 78px">
                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody>
        
                            @foreach ($projetos as $item)

                            <tr>
                                <td>{{ $item->projeto }}</td>
                                <td>{{ $item->numero_oe_oc }}</td>
                                <td>{{ $item->endereco }}</td>
                                <td>{{ $item->bairro }}</td>
                                <td>{{ $item->licenca }}</td>
                                <td>{{ $item->inicio_licenca }}</td>
                                <td>{{ $item->termino_licenca }}</td>
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
                        {{ $projetos->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

    </div>

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
