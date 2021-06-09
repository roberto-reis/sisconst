@extends('adminlte::page')

@section('title', 'Projeto')


@section('content_header')
    <div class="row align-items-center">
        <nav class="col-md-5 col-sm-5 breadcrumb_custom pb-2 p-sm-0"><a href="{{ route('operacional.index') }}">Operacional</a> > Projetos</nav>
        {{-- Form de pesquisar --}}
        <form class="col-md-7 col-sm-7 p-0" action="{{ route('projetos.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" value="{{ $search }}" placeholder="O que deseja pesquisar?">
                <div class="input-group-append">
                    <select name="filtro" class="custom-select rounded-0">
                        <option value="num_projeto" selected>Filtro...</option>
                        <option value="bairro">Bairro</option>
                        <option value="endereco">Endereço</option>
                        <option value="licenca">licença</option>
                        <option value="numero_oe_oc">OE/OC</option>
                        <option value="num_projeto">Projeto</option>
                    </select>
                  <button type="submit" class="btn btn-outline-info"><i class="fas fa-search"></i></button>
                </div>
              </div>
        </form>
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
        <div class="col-xl-10 col-12 mt-4">
            <a href="{{ route('projeto.create') }}" class="btn btn-info">Novo Projeto</a>
        </div>
    </div>

    <div class="row justify-content-center"> 
        <div class="title_custom col-xl-10 col-12 mt-3">
            @if ($search)
                <h3 class="mb-0">Resultado da pesquisa: {{ $search }}</h3>
            @else
                <h3 class="mb-0">Projetos cadastrados</h3>
            @endif
        </div>
        <div class="col-xl-10 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table_custom table-projetos">
                            <thead>
                                <tr>
                                    <th style="min-width: 150px">
                                        Projeto
                                    </th>
                                    <th>
                                        O.E.
                                    </th>
                                    <th style="min-width: 250px">
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
            
                                @foreach ($projetos as $projeto)
    
                                <tr>
                                    <td>{{ $projeto->num_projeto }}</td>
                                    <td>{{ $projeto->numero_oe_oc }}</td>
                                    <td>{{ $projeto->endereco }}</td>
                                    <td>{{ $projeto->bairro }}</td>
                                    <td>{{ $projeto->licenca }}</td>
                                    <td>{{ !empty($projeto->inicio_licenca) ? date("d/m/Y", strtotime($projeto->inicio_licenca)) : "" }}</td>
                                    <td>{{ !empty($projeto->termino_licenca) ? date("d/m/Y", strtotime($projeto->termino_licenca)) : "" }}</td>
                                    <td>
                                        <div class="btn_table">
                                            <a href="{{ route('projeto.edit', $projeto->id) }}" class="btn"><i class="fas fa-edit"></i></a>                       
                                            
                                            <form class="d-inline" action="{{ route('projeto.destroy', $projeto->id) }}" method="POST" onclick="return confirm('Tem certeza que deseja excluir?')">
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
@section('js')
    <script>
        $(document).ready(function () {
            $('.table-projetos').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
