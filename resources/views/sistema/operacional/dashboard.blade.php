@extends('adminlte::page')

@section('title', 'Operacional')


@section('content_header')
    <div class="row">
        <nav class="col breadcrumb_custom">Dashboard</nav>
    </div>
@stop


@section('content')

    <!-- Seção Operacional -->
    <div class="row my-4">

        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>{{ $obraFaltaAnexoIII }}</span>
                    <h3>Obras Falta Anexo III</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>{{ $obrasEmAndamentoCount }}</span>
                    <h3>Obras em andamento</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>{{ $obrasFinalizadaCount }}</span>
                    <h3>Obras Finalizadas</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <span>{{ $obrasFaturadaCount }}</span>
                    <h3>Obras Faturadas</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- Seção Ultímas Obras --}}
    <div class="row">
        <div class="title_custom col-12">
            <h3>últimas Obras</h3>
        </div>
        <div class="table-responsive col-md-12">
            <table class="table table-bordered table_custom">
                <thead>
                    <tr>
                        <th style="min-width: 220px">Projeto</th>
                        <th>O.E</th>
                        <th style="min-width: 250px">Endereço</th>
                        <th>Bairro</th>
                        <th>Licença</th>
                        <th>Status</th>
                        <th>Foto Anexo XII</th>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Include modal supervisor --}}
    @include('sistema.operacional.includes.supervisor')

    {{-- Modal Cadastrar Empreiteiro --}}
    @include('sistema.operacional.includes.empreiteiro')

    {{-- Modal Cadastrar Estação --}}
    @include('sistema.operacional.includes.estacao')    

    {{-- Modal Cadastrar status --}}
    @include('sistema.operacional.includes.status')

    {{-- Modal Cadastrar Tipo serviços --}}
    @include('sistema.operacional.includes.tipo-servico')

@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin_custom.css') }}">
@stop

@section('js')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@stop

