@extends('adminlte::page')



@section('content')

    {{-- Conteudo Principal --}}
    @yield('content_main')


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
    @yield('css_custom')
    
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop



@section('js')
    @yield('js_custom')

    <script>
        $(document).ready(function() {
            // CSRF-TOKEN
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            getStatus(); // Listar Status
            getTipoServicos(); // Listar Tipos de Serviços
            getEstacoes(); // Listar Estações
            getEmpreiteiros(); // Listar Empreiteiro
            getSupervisor(); // Listar os supervisores

            // Focar no input quando o modal abrir
            $('#modal_statusObraAdd').on('shown.bs.modal', function () {
                $('#nomeStatusAdd').trigger('focus');
            });
            $('#modal_tipoServicoAdd').on('shown.bs.modal', function () {
                $('#nomeTipoServicoAdd').trigger('focus');
            });
            $('#modal_estacaoAdd').on('shown.bs.modal', function () {
                $('#siglaEstacaoAdd').trigger('focus');
            });
            $('#modal_empreiteiroAdd').on('shown.bs.modal', function () {
                $('#nomeEmpreiteiroAdd').trigger('focus');
            });
            $('#modal_supervisorAdd').on('shown.bs.modal', function () {
                $('#nomeSupervisorAdd').trigger('focus');
            });

            // Lista as Supervisor
            function getSupervisor() {
                $.ajax({
                    url: "{{ route('supervisores.index') }}",
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
                                            <a href="#" class="btn btn_edit_supervisor" data-id="${response[i].id}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn_delete_supervisor" data-id="${response[i].id}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }
                        $('.table_supervisor tbody').html(rowTable);
                    }
                });
            }

            // Lista as Empreiteiro
            function getEmpreiteiros() {
                $.ajax({
                    url:"{{ route('empreiteiros.index') }}",
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
                                            <a href="#" class="btn btn_edit_empreiteiro" data-id="${response[i].id}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn_delete_empreiteiro" data-id="${response[i].id}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }
                        $('.table_empreiterio tbody').html(rowTable);
                    }
                });
            }

            // Lista as Estações
            function getEstacoes() {
                $.ajax({
                    url:"{{ route('estacoes.index') }}",
                    type:"GET",
                    dataType: 'json',
                    success: function(response) {
                        let rowTable;
                        for(var i=0; i < response.length; i++) {
                            rowTable += `
                                <tr>
                                    <td>${response[i].sigla}</td>
                                    <td>${response[i].descricao}</td>
                                    <td>${response[i].municipio}</td>
                                    <td>
                                        <div class="btn_table">
                                            <a href="#" class="btn btn_edit_estacao" data-id="${response[i].id}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn_delete_estacao" data-id="${response[i].id}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }
                        $('.table_estacao tbody').html(rowTable);
                    }
                });
            }

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

            // Lista os Tipo de Serviços
            function getTipoServicos() {
                $.ajax({
                    url:"{{ route('tipoServico.index') }}",
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
                                            <a href="#" class="btn btn_edit_tipoServico" data-id="${response[i].id}"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btn_delete_tipoServico" data-id="${response[i].id}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }
                        $('.table_tipoServico tbody').html(rowTable);
                    }
                });
            }

            // Cadastrar Supervisor
            $('#form_supervisorAdd').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url:"{{ route('supervisor.store') }}",
                    type:"POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_supervisorAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            getSupervisor();
                            $('#form_supervisorAdd').trigger("reset");//Reset form
                            $('#nome').focus();
                        }
                        if(response.error) {
                            $('#modal_supervisorAdd .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }
                    }
                })
            });

            // Editar Supervisor
            $('body').on('click', '.btn_edit_supervisor', function() {
                // Carrega os dados para o form update       
                let tr = $(this).closest('tr');
                let data = tr.children('td').map(function(){
                    return $(this).text();
                }).get();
                $('#nomeSupervisorUpdate').val(data[0]);
                $('#supervisor_id').val($(this).attr("data-id"));
                $('#modal_supervisorUpdate').modal('toggle');
                $('#modal_supervisorUpdate').on('shown.bs.modal', function () {
                    $('#nomeSupervisorUpdate').trigger('focus');
                });
            });
            // Update Supervisor
            $('#form_supervisorUpdate').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('supervisor.update') }}",
                    type:"PUT",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_supervisorAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            $('#modal_supervisorUpdate').modal('hide');
                            getSupervisor();
                        }
                        if(response.error) {
                            $('#modal_supervisorUpdate .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }            
                    }
                });
            });

            // Deletar Supervisor
            $('body').on('click', '.btn_delete_supervisor', function() { 
                let id = $(this).attr("data-id");   
                if(confirm("Tem certeza que deseja excluir?")) {
                    $.ajax({
                        url:"{{ route('supervisor.store') }}/" + id,
                        type:"DELETE",
                        dataType: 'json',
                        success: function(response) {
                            if(response.error) {
                                $('#modal_supervisorAdd .menssageBox').html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                        ${response.error}
                                    </div>
                                `);
                            }
                            getSupervisor();
                        },
                        error: function (response) {
                            console.log('Error:', response.responseJSON);
                        }                   
                    });
                } else {
                    return false;
                }
            });

            // Cadastrar Empreiteiro
            $('#form_empreiteiroAdd').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url:"{{ route('empreiteiros.store') }}",
                    type:"POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_empreiteiroAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            getEmpreiteiros();
                            $('#form_empreiteiroAdd').trigger("reset");//Reset form
                            $('#nome').focus();
                        }
                        if(response.error) {
                            $('#modal_empreiteiroAdd .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }
                    }
                })
            });

            // Editar Empreiteiro
            $('body').on('click', '.btn_edit_empreiteiro', function() {
                // Carrega os dados para o form update       
                let tr = $(this).closest('tr');
                let data = tr.children('td').map(function(){
                    return $(this).text();
                }).get();
                $('#nomeEmpreiteiroUpdate').val(data[0]);
                $('#empreiteiro_id').val($(this).attr("data-id"));
                $('#modal_empreiteiroUpdate').modal('toggle');
                $('#modal_empreiteiroUpdate').on('shown.bs.modal', function () {
                    $('#nomeEmpreiteiroUpdate').trigger('focus');
                });
            });
            // Update Empreiteiro
            $('#form_empreiteiroUpdate').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('empreiteiros.update') }}",
                    type:"PUT",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_empreiteiroAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            $('#modal_empreiteiroUpdate').modal('hide');
                            getEmpreiteiros();
                        }
                        if(response.error) {
                            $('#modal_empreiteiroUpdate .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }            
                    }
                });
            });

            // Deletar Empreiteiro
            $('body').on('click', '.btn_delete_empreiteiro', function() { 
                let id = $(this).attr("data-id");   
                if(confirm("Tem certeza que deseja excluir?")) {
                    $.ajax({
                        url:"{{ route('empreiteiros.store') }}/" + id,
                        type:"DELETE",
                        dataType: 'json',
                        success: function(response) {
                            //console.log(response);
                            if(response.error) {
                                $('#modal_empreiteiroAdd .menssageBox').html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                        ${response.error}
                                    </div>
                                `);
                            }
                            getEmpreiteiros();
                        },
                        error: function (response) {
                            console.log('Error:', response.responseJSON);
                        }                   
                    });
                } else {
                    return false;
                }
            });

            // Cadastrar Estação
            $('#form_estacaoAdd').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url:"{{ route('estacoes.store') }}",
                    type:"POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_estacaoAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            getEstacoes();
                            $('#form_estacaoAdd').trigger("reset");//Reset form
                            $('#sigla').focus();
                        }
                        if(response.error) {
                            $('#modal_estacaoAdd .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }
                    }
                })
            });

            // Editar Estação
            $('body').on('click', '.btn_edit_estacao', function() {
                // Carrega os dados para o form update       
                let tr = $(this).closest('tr');
                let data = tr.children('td').map(function(){
                    return $(this).text();
                }).get();
                $('#estacao_id').val($(this).attr("data-id"));
                $('#siglaEstacaoUpdate').val(data[0]);
                $('#descricaoEstacaoUpdate').val(data[1]);
                $('#municipioEstacaoUpdate').val(data[2]);
                $('#modal_estacaoUpdate').modal('toggle');
                $('#modal_estacaoUpdate').on('shown.bs.modal', function () {
                    $('#siglaEstacaoUpdate').trigger('focus');
                });
            });
            // Update Estação
            $('#form_estacaoUpdate').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('estacoes.update') }}",
                    type:"PUT",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_estacaoAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            $('#modal_estacaoUpdate').modal('hide');
                            getEstacoes();
                        }
                        if(response.error) {
                            $('#modal_estacaoUpdate .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }            
                    }
                });
            });

            // Deletar Estação
            $('body').on('click', '.btn_delete_estacao', function() { 
                let id = $(this).attr("data-id");   
                if(confirm("Tem certeza que deseja excluir?")) {
                    $.ajax({
                        url:"{{ route('estacoes.store') }}/" + id,
                        type:"DELETE",
                        dataType: 'json',
                        success: function(response) {
                            if(response.error) {
                                $('#modal_estacaoAdd .menssageBox').html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                        ${response.error}
                                    </div>
                                `);
                            }
                            getEstacoes();
                        },
                        error: function (response) {
                            console.log('Error:', response.responseJSON);
                        }                   
                    });
                } else {
                    return false;
                }
            });

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
                            $('#modal_statusObraAdd .menssageBox').html(`
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
                            $('#modal_statusObraAdd .menssageBox').html(`
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
                $('#nomeStatusUpdate').val(data[0]);
                $('#status_id').val($(this).attr("data-id"));
                $('#modal_statusObrasUpdate').modal('toggle');
                $('#modal_statusObrasUpdate').on('shown.bs.modal', function () {
                    $('#nomeStatusUpdate').trigger('focus');
                });
            });
            // Update Status
            $('#form_statusObrasUpdate').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('status.update') }}",
                    type:"PUT",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_statusObraAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            $('#modal_statusObrasUpdate').modal('hide');
                            getStatus();
                        }
                        if(response.error) {
                            $('#modal_statusObrasUpdate .menssageBox').html(`
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
                        url:"{{ route('status.store') }}/" + id,
                        type:"DELETE",
                        dataType: 'json',
                        success: function(response) {
                            //console.log(response);
                            if(response.error){
                                $('#modal_statusObraAdd .menssageBox').html(`
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                        ${response.error}
                                    </div>
                                `);
                            }
                            getStatus();
                        },
                        error: function (response) {
                            console.log('Error:', response.responseJSON);
                        }                   
                    });
                } else {
                    return false;
                }
            });

            // Cadastrar Tipo de Serviço
            $('#form_tipoServicoAdd').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url:"{{ route('tipoServico.store') }}",
                    type:"POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_tipoServicoAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            getTipoServicos();
                            $('#form_tipoServicoAdd').trigger("reset");//Reset form
                            $('#form_tipoServicoAdd #nome').focus();
                        }
                        if(response.error) {
                            $('#modal_tipoServicoAdd .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }
                    }
                })
            });

            // Editar Tipo de Serviço
            $('body').on('click', '.btn_edit_tipoServico', function() {
                // Carrega os dados para o form update       
                let tr = $(this).closest('tr');
                let data = tr.children('td').map(function(){
                    return $(this).text();
                }).get();
                $('#nomeTipoServicoUpdate').val(data[0]);
                $('#tipoServico_id').val($(this).attr("data-id"));
                $('#modal_tipoServicoUpdate').modal('toggle');
                $('#modal_tipoServicoUpdate').on('shown.bs.modal', function () {
                    $('#nomeTipoServicoUpdate').trigger('focus');
                });
            });
            // Update Tipo de Serviço
            $('#form_tipoServicoUpdate').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "{{ route('tipoServico.update') }}",
                    type:"PUT",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if(response.sucesso) {
                            $('#modal_tipoServicoUpdate').modal('hide');
                            $('#modal_tipoServicoAdd .menssageBox').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.sucesso}
                                </div>
                            `);
                            getTipoServicos();
                        }
                        if(response.error) {
                            $('#modal_tipoServicoUpdate .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                        }            
                    }
                });
            });

            // Deletar Tipo de Serviço
            $('body').on('click', '.btn_delete_tipoServico', function() { 
                let id = $(this).attr("data-id");   
                if(confirm("Tem certeza que deseja excluir?")) {
                    $.ajax({
                        url:"{{ route('tipoServico.store') }}/" + id,
                        type:"DELETE",
                        dataType: 'json',
                        success: function(response) {
                            //console.log(response);
                            if(response.error) {
                                $('#modal_tipoServicoAdd .menssageBox').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                    ${response.error}
                                </div>
                            `);
                            }
                            getTipoServicos();
                        },
                        error: function (response) {
                            console.log('Error:', response.responseJSON);
                        }                   
                    });
                } else {
                    return false;
                }
            });

        });
    </script>
@stop