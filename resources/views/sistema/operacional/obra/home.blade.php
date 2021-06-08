@extends('adminlte::page')

@section('title', 'Obras')


@section('content_header')
        <div class="row align-items-center">
            <nav class="col-md-5 col-sm-5 breadcrumb_custom pb-2 p-sm-0"><div><a href="{{ route('operacional.index') }}">Operacional</a> > Obras</div></nav>
            {{-- Form de pesquisar --}}
            <form class="col-md-7 col-sm-7 p-0" action="{{ route('obras.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="O que deseja pesquisar?">
                    <div class="input-group-append">
                        <select name="filtro" class="custom-select rounded-0">
                            <option value="num_projeto" selected>Filtro...</option>
                            <option value="bairro">Bairro</option>
                            <option value="empreiteiro">Empreiteiro</option>
                            <option value="endereco">Endereço</option>
                            <option value="numero_oe_oc">OE/OC</option>
                            <option value="num_projeto">Projeto</option>
                            <option value="status">Status</option>
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
        <div class="col-xl-10 col-md-12 mt-4">
            <a href="{{ route('obra.create') }}" class="btn btn-info">Nova Obra</a>
        </div>
        <div class="title_custom col-xl-10 col-12 mt-3">
            @if ($search)
                <h3 class="mb-0">Resultado da pesquisa: {{ $search }}</h3>
            @else
                <h3 class="mb-0">Obras cadastradas</h3>
            @endif
        </div>
        <div class="col-xl-10 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table_custom">
                            <thead>
                                <tr>
                                    <th>
                                        Projeto
                                    </th>
                                    <th>
                                        O.E. / OC
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
                                        Status
                                    </th>
                                    <th>
                                        Data Anexo XIII
                                    </th>
                                    <th style="width: 78px">
                                        Ação
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
            
                                @foreach ($obras as $obra)    
                                    <tr>
                                        <td>{{ $obra->projeto->num_projeto }}</td>
                                        <td>{{ $obra->projeto->numero_oe_oc }}</td>
                                        <td>{{ $obra->projeto->endereco }}</td>
                                        <td>{{ $obra->projeto->bairro }}</td>
                                        <td>{{ $obra->projeto->licenca }}</td>
                                        <td>{{ $obra->statusObra->nome }}</td>
                                        <td>{{ !empty($obra->data_fotos_anexo_xiii) ? date("d/m/Y", strtotime($obra->data_fotos_anexo_xiii)) : "" }}</td>
                                        <td>
                                            <div class="btn_table">
                                                <a href="{{ route('obra.edit', $obra->id) }}" class="btn"><i class="fas fa-edit"></i></a>                       
                                                
                                                <form class="d-inline" action="{{ route('obra.destroy', $obra->id) }}" method="POST" onclick="return confirm('Tem certeza que deseja excluir?')">
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
                        {{ $obras->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
