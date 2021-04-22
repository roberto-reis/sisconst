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
            <a href="#" class="btn btn-info">Projetos</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Obras</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Empreiteiros</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Estação</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-info">Clientes</a>
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal_StatusObraAdd" id="btn_status">Status</a>
            <a href="#" data-toggle="modal" data-target="#modal_TipoServicoAdd" id="btn_TipoServico" class="btn btn-info">Tipo Serviços</a>
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

    {{-- Modal Cadastrar status --}}
    <div class="modal fade modal_custom" id="modal_StatusObraAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Status Obra</h5>
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
                        @csrf 
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o status aqui..." aria-label="Status" aria-describedby="btn_add_update">
                            <div class="input-group-append">
                            <button class="btn btn-info" type="submit" id="btn_add">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                    {{-- Table status cadastrado --}}
                    <div>
                        <table class="table table-sm table_status">
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

    {{-- Modal update status --}}
    <div class="modal fade modal_custom" id="modal_StatusObraUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Altualizar Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Mensagem error --}}
                    <div class="menssageBox_update">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="formStatusUpdate">
                        @csrf
                        <input type="hidden" name="status_id" id="status_id">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome_update" name="nome" aria-label="Status" aria-describedby="btn_add_update">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit" id="btn_update">Alterar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Cadastrar Tipo serviços --}}
    <div class="modal fade modal_custom" id="modal_TipoServicoAdd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tipo de Serviços</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    {{-- Mensagem sucesso e error --}}
                    <div class="menssageBox_TipoServico">
                    </div>
                    {{-- Form cadstrar status --}}
                    <form class="form_custom" id="form_TipoServicoAdd">
                        @csrf 
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Tipo de Serviço aqui..." aria-label="Status" aria-describedby="btn_add">
                            <div class="input-group-append">
                            <button class="btn btn-info" type="submit" id="btn_add">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                    {{-- Table status cadastrado --}}
                    <div>
                        <table class="table table-sm table_TipoServico">
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

@section('js')
    <script>
        $(document).ready(function() {
            // CSRF-TOKEN
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            
            $('#btn_status').on('click', function() {
                getStatus(); // Listar Status
                $('#modal_StatusObraAdd').on('shown.bs.modal', function () {
                    $('#nome').trigger('focus');
                });
            });
            // Lista os status
            function getStatus() {
                $.ajax({
                    url:"{{ route('status.index') }}",
                    type:"GET",
                    dataType: 'json',
                    success: function(response) {
                        let rowTable;
                        for(var i=0; i < response.length; i++) {
                            rowTable += `
                                <tr>
                                    <td>${response[i].nome}</td>
                                    <td>
                                        <div class="btn_table">
                                            <a href="#" class="btn btn_edit_status" data-id="${response[i].id}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn_delete_status" data-id="${response[i].id}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }
                        $('.table_status tbody').html(rowTable);
                    }
                });
            }

            // Cadastrar Status
            $('#form_StatusAdd').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url:"{{ route('status.store') }}",
                    type:"POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('.menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            getStatus();
                            $('#form_StatusAdd').trigger("reset");//Reset form
                            $('#nome').focus();
                        }
                        if(response.error) {
                            $('.menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }
                    }
                })
            });

            // Editar status
            $('body').on('click', '.btn_edit_status', function() {
                // Carrega os dados para o form update       
                let tr = $(this).closest('tr');
                let data = tr.children('td').map(function(){
                    return $(this).text();
                }).get();
                $('#nome_update').val(data[0]);
                $('#status_id').val($(this).attr("data-id"));
                $('#modalStatusObraUpdate').modal('show');
                $('#modalStatusObraUpdate').on('shown.bs.modal', function () {
                    $('#nome_update').trigger('focus');
                });

            });
            // Update Status
            $('#formStatusUpdate').submit(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url:"{{ route('status.update') }}",
                        type:"PUT",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response) {
                            if(response.sucesso) {
                                $('.menssageBox').html(`
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                        ${response.sucesso}
                                    </div>
                                `);
                                $('#modalStatusObraUpdate').modal('hide');
                                getStatus();
                            }
                            if(response.error) {
                                $('.menssageBox_update').html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                        ${response.error}
                                    </div>
                                `);
                            }            
                        }
                    });
                });

            // Deletar status
            $('body').on('click', '.btn_delete_status', function() { 
                let id = $(this).attr("data-id");   
                if(confirm("Tem certeza que deseja excluir?")) {
                    $.ajax({
                        url:"operacional/status/" + id,
                        type:"DELETE",
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response);
                            getStatus();
                        }                      
                    });
                } else {
                    return false;
                }
            });
       });
    </script>
@stop

