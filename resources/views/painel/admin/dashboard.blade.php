@extends('adminlte::page')

@section('title', 'Painel')


@section('content_header')
        <div class="row">
            <div class="col"><h2>Dashboard</h2></div>
        </div>
@stop


@section('content')
    <!-- Seção nav btn's -->
    <div class="row my-4">
        <div class="col">
            <a href="#" class="btn btn-info">Usuários</a>
        </div>
    </div>
    
    <!-- Seção Operacional -->
    <div class="row my-4">
        <div class="title_custom col-12">
            <h2>Operacional</h2>
        </div>

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

    <!-- Seção Almoxarifado -->
    <div class="row">
        <div class="title_custom col-12">
            <h2>Almoxarifado</h2>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>05</span>
                    <h3>Fornecedores Cadastrados</h3>
                </div>
            </div>
        </div>

    </div>
@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop

