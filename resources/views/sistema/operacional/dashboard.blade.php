@extends('layouts.main')

@section('title', 'Operacional')


@section('content_header')
    <div class="row">
        <nav class="col breadcrumb_custom">Dashboard</nav>
    </div>
@stop


@section('content_main')

    <!-- Seção Operacional -->
    <div class="row my-4">

        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <a href="{{ url('/sistema/operacional/obras?search=n&filtro=fotos_anexo_xiii') }}">{{ $obraFaltaAnexoIII }}</a>
                    <h3>Obras Falta Anexo III</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <a href="{{ url('/sistema/operacional/obras?search=em+andamento&filtro=status') }}">{{ $obrasEmAndamentoCount }}</a>
                    <h3>Obras em andamento</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <a href="{{ url('/sistema/operacional/obras?search=finalizada&filtro=status') }}">{{ $obrasFinalizadaCount }}</a>
                    <h3>Obras Finalizadas</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card card_custom">
                <div class="card-body text-center">
                    <a href="{{ url('/sistema/operacional/obras?search=faturada&filtro=status') }}">{{ $obrasFaturadaCount }}</a>
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

@stop
