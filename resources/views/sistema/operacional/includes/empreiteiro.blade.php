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
                        <input type="text" class="form-control" id="nomeEmpreiteiroAdd" name="nome" placeholder="Nome do Empreiteiro">
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
                {{-- Form cadstrar Empreiteiro --}}
                <form class="form_custom" id="form_empreiteiroUpdate">
                    <input type="hidden" name="id" id="empreiteiro_id">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="nomeEmpreiteiroUpdate" name="nome">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit">Alterar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>