@extends('adminlte::page')

@section('title', 'Operacional')


@section('content_header')
        <div class="row">
            <div class="col"><h2>Dashboard</h2></div>
        </div>
@stop


@section('content')

    {{-- Mensagem Error --}}
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
        {{-- mensagem_sucesso --}}
        @if (session('mensagem_sucesso'))
        <div class="alert alert-success alert-dismissible alerta_custom">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            
                {{ session('mensagem_sucesso') }}
            
        </div>
    @endif

    <!-- Seção nav btn's -->
    <div class="row my-4">
        <nav class="col-12 nav_btns">
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Projetos</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Obras</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Empreiteiros</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Estação</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Clientes</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info" data-toggle="modal" data-target="#statusObra">Status</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Tipo Serviços</a>
        </nav>
    </div>

    <!-- Seção Operacional -->
    <div class="row mb-4">

        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>05</span>
                    <h3>Obra Falta Anexo III</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>10</span>
                    <h3>Obras Não iniciado</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>08</span>
                    <h3>Obras em andamento</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>03</span>
                    <h3>Obras Encerrado</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>50</span>
                    <h3>Obras Faturada</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Seção Ultímas Obras --}}
    <div class="row">
        <div class="title_custom col-12">
            <h3>últimas Obras</h3>
        </div>
        <div class="table-responsive-md col-md-12">
            <table class="table table-bordered table_custom">
                <thead>
                    <tr>
                        <th>Projeto</th>
                        <th>O.E</th>
                        <th>Endereço</th>
                        <th>Bairro</th>
                        <th>Licença</th>
                        <th>Status</th>
                        <th>Foto Anexo XII</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A2-10002-2017-DE-BPAC-RJ</td>
                        <td>2017-031981</td>
                        <td>Estrada Adhemar Bebiano, 3610</td>
                        <td>Inhaúma</td>
                        <td>01837-2021</td>
                        <td>Em andamento</td>
                        <td>03/07/2021</td>
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
                    <tr>
                        <td>A2-10002-2017-DE-BPAC-RJ</td>
                        <td>2017-031981</td>
                        <td>Estrada Adhemar Bebiano, 3610</td>
                        <td>Inhaúma</td>
                        <td>01837-2021</td>
                        <td>Em andamento</td>
                        <td>03/07/2021</td>
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
                </tbody>
            </table>
            {{-- Paginação --}}
        </div>
    </div>

    {{-- Modal Statu de Obras --}}
    <div class="modal fade modal_custom" id="statusObra" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Status Obra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Form cadstrar status --}}
                <form class="form_custom" action="{{ route('status.store') }}" method="post">
                    @csrf 
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('statusObra') is-invalid @enderror" id="nome" value="{{ old('nome') }}" name="nome" placeholder="Digite o status aqui..." aria-label="Status" aria-describedby="button-cadastrar">

                        <div class="input-group-append">
                          <button class="btn btn-info" type="submit" id="button-cadastrar">Cadastrar</button>
                        </div>
                      </div>
                </form>

                {{-- Table status cadastrado --}}
                <div>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th style="width: 80px">Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($statusObras as $item)                                
                            
                                <tr>
                                    <td>{{ $item->nome }}</td>
                                    <td>
                                        <div class="btn_table">
                                            <a href="" class="btn"><i class="fas fa-edit"></i></a>                       
                                            
                                            <form class="d-inline" action="{{ route('status.destroy', $item->id) }}" method="POST" onclick="return confirm('Tem certeza que deseja excluir?')">
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
                    {{-- Paginação --}}
                </div>

            </div>
        </div>
        </div>
  </div>

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop

