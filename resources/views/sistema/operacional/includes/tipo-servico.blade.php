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