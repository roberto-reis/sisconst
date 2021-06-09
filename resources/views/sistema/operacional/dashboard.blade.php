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
                    <h3>Obra Falta Anexo III</h3>
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


    {{-- Modal Cadastrar Supervisor --}}
    <div class="modal fade modal_custom" id="modal_supervisorAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cadastro Supervisor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem sucesso e error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_supervisorAdd">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Supervisor">
                            <div class="input-group-append">
                            <button class="btn btn-info" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                    {{-- Table status cadastrado --}}
                    <div>
                        <table class="table table-sm table_supervisor table_custom">
                            <thead>
                                <tr>
                                    <th>Supervisor</th>
                                    <th style="width: 80px">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Lista de status aqui... --}}
                            </tbody>
                        </table>
                        {{-- Paginação --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Modal update Empreiteiro --}}
    <div class="modal fade modal_custom" id="modal_supervisorUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Supervisor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_supervisorUpdate">
                        <input type="hidden" name="id" id="input_id">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Alterar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Cadastrar Empreiteiro --}}
    <div class="modal fade modal_custom" id="modal_empreiteiroAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cadastro Empreiteiro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem sucesso e error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_empreiteiroAdd">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do Empreiteiro">
                            <div class="input-group-append">
                            <button class="btn btn-info" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                    {{-- Table status cadastrado --}}
                    <div>
                        <table class="table table-sm table_empreiterio table_custom">
                            <thead>
                                <tr>
                                    <th>Empreiteiro</th>
                                    <th style="width: 80px">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Lista de status aqui... --}}
                            </tbody>
                        </table>
                        {{-- Paginação --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Modal update Empreiteiro --}}
    <div class="modal fade modal_custom" id="modal_empreiteiroUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Empreiteiro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_empreiteiroUpdate">
                        <input type="hidden" name="id" id="input_id">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Alterar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Cadastrar Estação --}}
    <div class="modal fade modal_custom" id="modal_estacaoAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cadastro Estação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem sucesso e error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar Estação --}}
                    <form class="form_custom" id="form_estacaoAdd">
                        <div class="form-row">
                            <div class="col-md-3 col-lg-2 mb-2">
                                <label for="sigla">Sigla*:</label>
                                <input type="text" class="form-control" name="sigla" id="sigla" placeholder="Exemp.: COP">
                            </div>
                            <div class="col-md-3 col-lg-4 mb-2">
                                <label for="descricao">Descrição*:</label>
                                <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Exemp.: Copacabana">
                            </div>
                            <div class="col-md-3 col-lg-4 mb-2">
                                <label for="municipio">Município*:</label>
                                <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Qual o município?">
                            </div>
                            <div class="col-md-3 col-lg-2 mb-2 align-self-end">
                                <button type="submit" class="btn btn-info">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                    {{-- Table Estação cadastrado --}}
                    <div class="table-responsive mt-2">                        
                        <table class="table table-sm table_estacao table_custom">
                            <thead>
                                <tr>
                                    <th style="min-width: 80px">Estação</th>
                                    <th style="min-width: 150px">Descrição</th>
                                    <th style="min-width: 180px">Municipio</th>
                                    <th style="width: 78px">Ação</th>
                                </tr>
                            </thead>
                            <tbody>                                
                                {{-- Lista de Estação aqui... --}}
                            </tbody>
                        </table>
                        {{-- Paginação --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Modal update Estação --}}
    <div class="modal fade modal_custom" id="modal_estacaoUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Estação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar Estação --}}
                    <form class="form_custom" id="form_estacaoUpdate">
                        <input type="hidden" name="id" id="input_id">
                        
                        <div class="form-group">
                            <label for="sigla">Sigla*:</label>
                            <input type="text" class="form-control" name="sigla" id="sigla">
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição*:</label>
                            <input type="text" class="form-control" name="descricao" id="descricao">
                        </div>
                        <div class="form-group">
                            <label for="municipio">Município*:</label>
                            <input type="text" class="form-control" name="municipio" id="municipio">
                        </div>

                          <button class="btn btn-info" type="submit">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Cadastrar status --}}
    <div class="modal fade modal_custom" id="modal_statusObraAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cadastro Status Obra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem sucesso e error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_StatusAdd">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o status aqui...">
                            <div class="input-group-append">
                            <button class="btn btn-info" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                    {{-- Table status cadastrado --}}
                    <div>
                        <table class="table table-sm table_status table_custom">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th style="width: 80px">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Lista de status aqui... --}}
                            </tbody>
                        </table>
                        {{-- Paginação --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Modal update Status Obras --}}
    <div class="modal fade modal_custom" id="modal_statusObrasUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_statusObrasUpdate">
                        <input type="hidden" name="id" id="input_id">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Alterar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Cadastrar Tipo serviços --}}
    <div class="modal fade modal_custom" id="modal_tipoServicoAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cadastro Tipo de Serviços</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem sucesso e error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_tipoServicoAdd">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Tipo de Serviço aqui...">
                            <div class="input-group-append">
                            <button class="btn btn-info" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                    {{-- Table Tipo de Serviço cadastrado --}}
                    <div>
                        <table class="table table-sm table_tipoServico table_custom">
                            <thead>
                                <tr>
                                    <th>Tipo de Serviço</th>
                                    <th style="width: 80px">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Lista de Tipo de Serviço aqui... --}}                              
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Modal update Tipo de Serviços --}}
    <div class="modal fade modal_custom" id="modal_tipoServicoUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar Tipo de Serviços</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem error --}}
                    <div class="menssageBox">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_tipoServicoUpdate">
                        <input type="hidden" name="id" id="input_id">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">Alterar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin_custom.css') }}">
@stop

@section('js')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@stop

