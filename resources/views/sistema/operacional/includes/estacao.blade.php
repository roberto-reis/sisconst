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
                            <input type="text" class="form-control" name="sigla" id="siglaEstacaoAdd" placeholder="Exemp.: COP">
                        </div>
                        <div class="col-md-3 col-lg-4 mb-2">
                            <label for="descricao">Descrição*:</label>
                            <input type="text" class="form-control" name="descricao" id="descricaoEstacaoAdd" placeholder="Exemp.: Copacabana">
                        </div>
                        <div class="col-md-3 col-lg-4 mb-2">
                            <label for="municipio">Município*:</label>
                            <input type="text" class="form-control" name="municipio" id="municipioEstacaoAdd" placeholder="Qual o município?">
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
                    <input type="hidden" name="id" id="estacao_id">
                    
                    <div class="form-group">
                        <label for="sigla">Sigla*:</label>
                        <input type="text" class="form-control" name="sigla" id="siglaEstacaoUpdate">
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição*:</label>
                        <input type="text" class="form-control" name="descricao" id="descricaoEstacaoUpdate">
                    </div>
                    <div class="form-group">
                        <label for="municipio">Município*:</label>
                        <input type="text" class="form-control" name="municipio" id="municipioEstacaoUpdate">
                    </div>

                      <button class="btn btn-info" type="submit">Alterar</button>
                </form>
            </div>
        </div>
    </div>
</div>