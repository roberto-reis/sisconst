@extends('adminlte::page')

@section('title', 'Operacional')


@section('content_header')
        <div class="row">
            <div class="col"><h2>Dashboard</h2></div>
        </div>
@stop


@section('content')
    <!-- Seção nav btn's -->
    <div class="row my-4">
        <nav class="col-12 nav_btns">
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Projetos</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Obras</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Empreiteiros</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Estação</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Clientes</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Status</a>
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

<div class="row">
    <div class="title_custom col-12">
        <h3>últimas Obras</h3>
    </div>
    <div class="table-responsive-md col-md-12">
        <table class="table table-sm table-bordered table_custom">
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
                    <td style="word-break:break-all;">A2-10002-2017-DE-BPAC-RJ</td>
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

@stop


@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop

