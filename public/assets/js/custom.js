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
        $('#form_StatusAdd #nome').trigger('focus');
    });
    $('#modal_tipoServicoAdd').on('shown.bs.modal', function () {
        $('#form_tipoServicoAdd #nome').trigger('focus');
    });
    $('#modal_estacaoAdd').on('shown.bs.modal', function () {
        $('#form_estacaoAdd #sigla').trigger('focus');
    });
    $('#modal_empreiteiroAdd').on('shown.bs.modal', function () {
        $('#form_empreiteiroAdd #nome').trigger('focus');
    });
    $('#modal_supervisorAdd').on('shown.bs.modal', function () {
        $('#form_supervisorAdd #nome').trigger('focus');
    });

    // Lista as Supervisor
    function getSupervisor() {
        $.ajax({
            url: "operacional/supervisores",
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
            url:"operacional/empreiteiros",
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
            url:"operacional/estacoes",
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
            url:"operacional/status",
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
            url:"operacional/tipoServicos",
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
            url:"operacional/supervisor",
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
        $('#form_supervisorUpdate #nome').val(data[0]);
        $('#form_supervisorUpdate #input_id').val($(this).attr("data-id"));
        $('#modal_supervisorUpdate').modal('toggle');
        $('#modal_supervisorUpdate').on('shown.bs.modal', function () {
            $('#form_supervisorUpdate #nome').trigger('focus');
        });
    });
    // Update Supervisor
    $('#form_supervisorUpdate').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "operacional/supervisor",
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
                url:"operacional/supervisor/" + id,
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
            url:"operacional/empreiteiro",
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
        $('#form_empreiteiroUpdate #nome').val(data[0]);
        $('#form_empreiteiroUpdate #input_id').val($(this).attr("data-id"));
        $('#modal_empreiteiroUpdate').modal('toggle');
        $('#modal_empreiteiroUpdate').on('shown.bs.modal', function () {
            $('#form_empreiteiroUpdate #nome').trigger('focus');
        });
    });
    // Update Empreiteiro
    $('#form_empreiteiroUpdate').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "operacional/empreiteiro",
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
                url:"operacional/empreiteiro/" + id,
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
            url:"operacional/estacao",
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
        $('#form_estacaoUpdate #input_id').val($(this).attr("data-id"));
        $('#form_estacaoUpdate #sigla').val(data[0]);
        $('#form_estacaoUpdate #descricao').val(data[1]);
        $('#form_estacaoUpdate #municipio').val(data[2]);
        $('#modal_estacaoUpdate').modal('toggle');
        $('#modal_estacaoUpdate').on('shown.bs.modal', function () {
            $('#modal_estacaoUpdate #sigla').trigger('focus');
        });
    });
    // Update Estação
    $('#form_estacaoUpdate').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "operacional/estacao",
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
                url:"operacional/estacao/" + id,
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
            url:"operacional/status",
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
        $('#form_statusObrasUpdate #nome').val(data[0]);
        $('#form_statusObrasUpdate #input_id').val($(this).attr("data-id"));
        $('#modal_statusObrasUpdate').modal('toggle');
        $('#modal_statusObrasUpdate').on('shown.bs.modal', function () {
            $('#form_statusObrasUpdate #nome').trigger('focus');
        });
    });
    // Update Status
    $('#form_statusObrasUpdate').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "operacional/status",
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
                url:"operacional/status/" + id,
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
            url:"operacional/tipoServico",
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
        $('#form_tipoServicoUpdate #nome').val(data[0]);
        $('#form_tipoServicoUpdate #input_id').val($(this).attr("data-id"));
        $('#modal_tipoServicoUpdate').modal('toggle');
        $('#modal_tipoServicoUpdate').on('shown.bs.modal', function () {
            $('#form_tipoServicoUpdate #nome').trigger('focus');
        });
    });
    // Update Tipo de Serviço
    $('#form_tipoServicoUpdate').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "operacional/tipoServico",
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
                url:"operacional/tipoServico/" + id,
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