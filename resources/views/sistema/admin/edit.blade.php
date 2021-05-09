@extends('adminlte::page')

@section('title', 'Editar Usuário')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('admin.dashboard') }}">Dashboard</a> > <a href="{{ route('usuarios.index') }}">Usuarios</a> > Editar Usuario</nav>
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

    <div class="row my-4 justify-content-center">
        <div class="col-md-6">
            <form class="form_custom" action="{{ route('usuarios.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')                
                <div class="form-group">
                    <label for="name">Nome:*</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $user->name }}" aria-describedby="name" placeholder="Nome Completo">
                </div>
                <div class="form-group">
                    <label for="email">Email:*</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $user->email }}" aria-describedby="email" placeholder="exemplo@exemplo.com.br">
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
                        <option value="convidado" {{ $user->nivel === "convidado" ? "selected" : null }} >convidado</option>
                        <option value="adm" {{ $user->nivel === "adm" ? "selected" : null }}>adm</option>
                        <option value="rh" {{ $user->nivel === "rh" ? "selected" : null }}>rh</option>
                        <option value="almoxarife" {{ $user->nivel === "almoxarife" ? "selected" : null }}>almoxarife</option>
                        <option value="operacional" {{ $user->nivel === "operacional" ? "selected" : null }}>operacional</option>
                        <option value="admin" {{ $user->nivel === "admin" ? "selected" : null }}>admin</option>
                    </select>
                </div>
        
                <button type="subimit" class="btn btn-info">Atualizar</button>
            </form>
        </div>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop
