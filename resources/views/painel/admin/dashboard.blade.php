@extends('adminlte::page')

@section('title', 'Painel')


@section('content_header')
        <div class="row">
            <div class="col"><h2>Dashboard</h2></div>
        </div>
@endsection


@section('content')
    <div class="row my-4">
        <div class="col">
            <a href="#" class="btn btn-info">Usuários</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <span>05</span>
                    <h3>Obra Falta Anexo III</h3>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="assets/css/admin_custom.css">
@endsection

