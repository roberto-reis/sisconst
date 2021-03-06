@extends('layouts.main')

@section('title', 'Editar Obra')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Dashboard</a> > <a href="{{ route('obras.index') }}">Obras</a> > Editar Obra</nav>
        </div>
@stop

@section('content_main')

    <div class="row justify-content-center mt-4">
        
        <div class="card col-xl-10 col-md-12 p-0">
            <form class="form_custom" action="{{ route('obra.update', $obra->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="projeto">Projeto*:</label>
                            <select name="projeto" id="projeto" class="form-control @error('projeto') is-invalid @enderror">
                                @foreach ($projetos as $projeto)
                                    <option data-estacao="{{$projeto->estacao->sigla}}" data-numerooe="{{$projeto->numero_oe_oc}}" data-endereco="{{$projeto->endereco}}"
                                        data-bairro="{{$projeto->bairro}}" data-contrato="{{$projeto->cliente->contrato ." - ". $projeto->cliente->rasao_social}}"
                                        data-pcrv="{{$projeto->pc_rv}}" data-tiposervico="{{$projeto->tipoServico->nome}}" data-descricaoservico="{{$projeto->descricao_servico}}"
                                        data-valorprojetado="{{$projeto->valor_projetado}}" data-comprimentogaleria="{{$projeto->comprimento_galeria}}"
                                        data-licenca="{{$projeto->licenca}}" data-iniciolicenca="{{$projeto->inicio_licenca}}"
                                        data-terminolicenca="{{$projeto->termino_licenca}}"
                                        value="{{ $projeto->id }}" {{ $projeto->id === $obra->projeto->id ? "selected" : null }} >{{ $projeto->num_projeto }}</option>
                                @endforeach                                
                            </select>
                            @error('projeto') <small class="invalid-feedback">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="statusObra">Status da Obra*:</label>
                            <select name="statusObra" id="statusObra" class="form-control @error('statusObra') is-invalid @enderror">
                                @foreach ($statusObras as $statusObra)
                                    <option value="{{ $statusObra->id }}" {{ $statusObra->id === $obra->statusObra->id ? "selected" : null }} >{{ $statusObra->nome }}</option>
                                @endforeach                                
                            </select>
                            @error('statusObra') <small class="invalid-feedback">{{ $message }}</small> @enderror
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="estacao">Esta????o:</label>
                            <input type="text" name="estacao" class="form-control" id="estacao" disabled>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="numero_oe_oc">O.E. / OC:</label>
                            <input type="text" name="numero_oe_oc" class="form-control" id="numero_oe_oc" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="endereco">Endere??o:</label>
                            <input type="text" name="endereco" class="form-control" id="endereco" disabled>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="bairro">Bairro:</label>
                            <input type="text" name="bairro" class="form-control" id="bairro" disabled>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="contrato_cliente">Contrato - Cliente:</label>
                            <input type="text" name="contrato_cliente" id="contrato_cliente" class="form-control" id="contrato_cliente" disabled>                            
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="pc_rv">PC / RV:</label>
                            <input type="text" name="pc_rv" class="form-control" id="pc_rv" disabled>
                        </div>
                    </div>

                    <div class="form-row">                        
                        <div class="form-group col-md-5 col-sm-12">
                            <label for="tipo_servico">Tipo de Servi??o:</label>
                            <input type="text" name="tipo_servico" id="tipo_servico" class="form-control" id="tipo_servico" disabled>                           
                        </div>
                        <div class="form-group col-md-7 col-sm-12">
                            <label for="descricao_servico">Descri????o Servi??o:</label>
                            <input type="text" name="descricao_servico" class="form-control" id="descricao_servico" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="valor_projetado">Valor Previsto:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text form-control">R$</span>
                                </div>
                                <input type="text" name="valor_projetado" class="form-control" id="valor_projetado" disabled>
                            </div>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="comprimento_galeria">Comprimento Galeria:</label>
                            <input type="text" name="comprimento_galeria" class="form-control" id="comprimento_galeria" disabled>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="licenca">Licen??a:</label>
                            <input type="text" name="licenca" class="form-control" id="licenca" disabled>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="inicio_licenca">Inicio Licen??a:</label>
                            <input type="date" name="inicio_licenca" class="form-control" id="inicio_licenca" disabled>
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="termino_licenca">T??rmino Licen??a:</label>
                            <input type="date" name="termino_licenca" class="form-control" id="termino_licenca" disabled>
                        </div>                     
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="data_fotos_emergencia">Dt. Fotos Emerg??ncia:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                        <input type="checkbox"  name="fotos_emergencia" id="fotos_emergencia" value="S" {{ $obra->fotos_emergencia == 'S' ? 'checked' : '' }}>
                                  </div>
                                </div>
                                <input type="date" name="data_fotos_emergencia" class="form-control" id="data_fotos_emergencia" value="{{ $obra->data_fotos_emergencia }}">
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="data_fotos_anexo_xiii">Dt. Fotos Anexo XIII:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <input type="checkbox" name="fotos_anexo_xiii" id="fotos_anexo_xiii" value="S" {{ $obra->fotos_anexo_xiii == 'S' ? 'checked' : '' }}>
                                  </div>
                                </div>
                                <input type="date" name="data_fotos_anexo_xiii" class="form-control" id="data_fotos_anexo_xiii" value="{{ $obra->data_fotos_anexo_xiii }}">
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label for="empreiteiro">Empreiteiro:</label>
                            <select name="empreiteiro" id="empreiteiro" class="form-control">
                                <option value="">Selecione a empreiteiro</option>
                                    @foreach ($empreiteiros as $empreiteiro)
                                        @if($obra->id_empreiteiro)
                                            <option value="{{ $empreiteiro->id }}" {{ $empreiteiro->id === $obra->empreiteiro->id ? "selected" : '' }} >{{ $empreiteiro->nome }}</option>
                                        @else
                                            <option value="{{ $empreiteiro->id }}">{{ $empreiteiro->nome }}</option>
                                        @endif
                                    @endforeach                             
                            </select>
                        </div>                      
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="supervisor">Supervisor:</label>
                            <select name="supervisor" id="supervisor" class="form-control">
                                @foreach ($supervisores as $supervisor)
                                    <option value="{{ $supervisor->id }}" {{ $obra->supervisor->id === $supervisor->id ? "selected" : null }}>{{ $supervisor->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="fiscal_cliente">Fiscal (Cliente):</label>
                            <input type="text" name="fiscal_cliente" class="form-control" value="{{ $obra->fiscal_cliente }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="inicio_real">Inicio Real:</label>
                            <input type="date" name="inicio_real" class="form-control" id="inicio_real" value="{{ $obra->inicio_real }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="termino_real">T??rmino Real:</label>
                            <input type="date" name="termino_real" class="form-control" id="termino_real" value="{{ $obra->termino_real }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="observacao">Observa????es:</label>
                            <textarea name="observacao" class="form-control" rows="1" placeholder="Digite a descri????o do servi??o">{{ $obra->observacao }}</textarea>
                        </div>
                    </div>
                </div>                    
                <div class="card-footer">
                    <a href="{{ route('obras.index') }}" class="btn btn-danger btn-lg">Cancelar</a>
                    <button type="submit" class="btn btn-info btn-lg">Atualizar</button>
                </div>
            </form>
        </div>

    </div>

@stop

@section('css_custom')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css"> <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css"> <!-- Select2 -->
@stop

@section('js_custom')
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            // Function buncar no select
            $('select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            });
            
            // Quando o checkbox estiver checked libera o campo data
            if($('#fotos_emergencia').is(":checked")) {
                $('#data_fotos_emergencia').prop('disabled', false);
            } else {
                $('#data_fotos_emergencia').prop('disabled', true);
            }
            $('#fotos_emergencia').on('click', function() {
                if($('#fotos_emergencia').is(":checked")) {
                    $('#data_fotos_emergencia').prop('disabled', false);
                } else {
                    $('#data_fotos_emergencia').prop('disabled', true);
                }
            });

            // Quando o checkbox estiver checked libera o campo data
            if($('#fotos_anexo_xiii').is(":checked")) {
                $('#data_fotos_anexo_xiii').prop('disabled', false);
            } else {
                $('#data_fotos_anexo_xiii').prop('disabled', true);
            }
            $('#fotos_anexo_xiii').on('click', function() {
                if($('#fotos_anexo_xiii').is(":checked")) {
                    $('#data_fotos_anexo_xiii').prop('disabled', false);
                } else {
                    $('#data_fotos_anexo_xiii').prop('disabled', true);
                }
            });

            // Carrega os dados ao iniciar
            $('#estacao').val($('#projeto option:selected').attr("data-estacao"));
            $('#data_oe').val($('#projeto option:selected').attr("data-dataoe"));
            $('#numero_oe_oc').val($('#projeto option:selected').attr("data-numerooe"));
            $('#endereco').val($('#projeto option:selected').attr("data-endereco"));
            $('#bairro').val($('#projeto option:selected').attr("data-bairro"));
            $('#contrato_cliente').val($('#projeto option:selected').attr("data-contrato"));
            $('#tipo_servico').val($('#projeto option:selected').attr("data-tiposervico"));
            $('#pc_rv').val($('#projeto option:selected').attr("data-pcrv"));
            $('#descricao_servico').val($('#projeto option:selected').attr("data-descricaoservico"));
            $('#valor_projetado').val($('#projeto option:selected').attr("data-valorprojetado"));
            $('#comprimento_galeria').val($('#projeto option:selected').attr("data-comprimentogaleria"));
            $('#licenca').val($('#projeto option:selected').attr("data-licenca"));
            $('#inicio_licenca').val($('#projeto option:selected').attr("data-iniciolicenca"));
            $('#termino_licenca').val($('#projeto option:selected').attr("data-terminolicenca"));

            // Carrega do dados quando selecionar o option do select
            $('#projeto').on('change', function() {
                $('#estacao').val($('#projeto option:selected').attr("data-estacao"));
                $('#data_oe').val($('#projeto option:selected').attr("data-dataoe"));
                $('#numero_oe_oc').val($('#projeto option:selected').attr("data-numerooe"));
                $('#endereco').val($('#projeto option:selected').attr("data-endereco"));
                $('#bairro').val($('#projeto option:selected').attr("data-bairro"));
                $('#contrato_cliente').val($('#projeto option:selected').attr("data-contrato"));
                $('#tipo_servico').val($('#projeto option:selected').attr("data-tiposervico"));
                $('#pc_rv').val($('#projeto option:selected').attr("data-pcrv"));
                $('#descricao_servico').val($('#projeto option:selected').attr("data-descricaoservico"));
                $('#valor_projetado').val($('#projeto option:selected').attr("data-valorprojetado"));
                $('#comprimento_galeria').val($('#projeto option:selected').attr("data-comprimentogaleria"));
                $('#licenca').val($('#projeto option:selected').attr("data-licenca"));
                $('#inicio_licenca').val($('#projeto option:selected').attr("data-iniciolicenca"));
                $('#termino_licenca').val($('#projeto option:selected').attr("data-terminolicenca"));
            });


        });
    </script>
@stop
