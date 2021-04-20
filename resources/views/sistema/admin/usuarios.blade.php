@extends('adminlte::page')

@section('title', 'Usuários')


@section('content_header')
        <div class="row">
            <div class="col"><h2><a href="{{ route('admin.dashboard') }}">Dashboard</a> > Usuarios</h2></div>
        </div>
@stop

@section('content')
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

    <div class="row justify-content-center">
        <div class="col-md-10 mt-4 mb-3">
            <!-- Button trigger modal adicionar -->
            <button type="button" data-toggle="modal" data-target="#modalAdicionar" class="btn btn-info">Novo Usuário</button>
        </div>
        <div class="table-responsive-md col-md-10 col-sm-12">
            <table class="table table-hover table_custom">
                <thead>
                    <tr>
                        <th>
                            Nome
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Nivel
                        </th>
                        <th>
                            Ação
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nivel }}</td>
                        <td>
                            <div class="btn_table">
                                <a href="{{ route('usuarios.edit', $user->id) }}" class="btn"><i class="fas fa-edit"></i></a>                        
                                @if ($user->id !== $loggedId)
                                    <form class="d-inline" action="{{ route('usuarios.destroy', $user->id) }}" method="POST" onclick="return confirm('Tem certeza que deseja excluir?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="subimit" class="btn"><i class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                            </div>                        
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
                {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- Modal Cadastrar usuários-->
    <div class="modal fade modal_custom" id="modalAdicionar" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuários</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="form_custom" action="{{ route('usuarios.store') }}" method="post">
                    @csrf
                    <div class="modal-body">                    
                        <div class="form-group">
                            <label for="name">Nome:*</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" aria-describedby="name" placeholder="Nome Completo">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:*</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" aria-describedby="email" placeholder="exemplo@exemplo.com.br">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:*</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Minímo 8 caractere...">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar senha:*</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="Comfirme a senha">
                        </div>
                        <div class="form-group">
                            <label for="nivel">Nivel:*</label>
                            <select name="nivel" class="form-control" id="nivel">
                                <option value="convidado">convidado</option>
                                <option value="adm">adm</option>
                                <option value="rh">rh</option>
                                <option value="almoxarife">almoxarife</option>
                                <option value="operacional">operacional</option>
                                <option value="admin">admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="subimit" class="btn btn-info">Cadastrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
