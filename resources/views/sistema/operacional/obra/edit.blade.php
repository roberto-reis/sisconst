@extends('adminlte::page')

@section('title', 'Editar Obra')


@section('content_header')
        <div class="row">
            <nav class="col breadcrumb_custom"><a href="{{ route('operacional.index') }}">Operacional</a> > <a href="{{ route('obras.index') }}">Obras</a> > Editar Obra</nav>
        </div>
@stop

@section('content')

    <div class="row justify-content-center mt-4">
        
        <div class="card col-xl-10 col-md-12 p-0">
            <form class=" form_custom" action="{{ route('obra.update', $obra->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-bady px-3 pt-2">
                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="num_projeto">Projeto*:</label>
                            <select name="projeto" id="projeto" class="form-control @error('projeto') is-invalid @enderror">
                                @foreach ($projetos as $projeto)
                                    <option data-estacao="{{$projeto->estacao->sigla}}" data-numerooe="{{$projeto->numero_oe_oc}}" data-endereco="{{$projeto->endereco}}"
                                        data-bairro="{{$projeto->bairro}}" data-contrato="{{$projeto->cliente->contrato ." - ". $projeto->cliente->rasao_social}}"
                                        data-pcrv="{{$projeto->pc_rv}}" data-tiposervico="{{$projeto->tipoServico->nome}}" data-descricaoservico="{{$projeto->descricao_servico}}"
                                        data-valorprojetado="{{$projeto->valor_projetado}}" data-comprimentogaleria="{{$projeto->comprimento_galeria}}"
                                        data-licenca="{{$projeto->licenca}}" data-iniciolicenca="{{$projeto->inicio_licenca}}"
                                        data-terminolicenca="{{$projeto->termino_licenca}}"data-supervisor="{{$projeto->supervisor->nome}}"
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
                            <label for="estacao">Estação:</label>
                            <input type="text" name="estacao" class="form-control" id="estacao" disabled>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="numero_oe_oc">O.E. / OC:</label>
                            <input type="text" name="numero_oe_oc" class="form-control" id="numero_oe_oc" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="endereco">Endereço:</label>
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
                            <label for="tipo_servico">Tipo de Serviço:</label>
                            <input type="text" name="tipo_servico" id="tipo_servico" class="form-control" id="tipo_servico" disabled>                           
                        </div>
                        <div class="form-group col-md-7 col-sm-12">
                            <label for="descricao_servico">Descrição Serviço:</label>
                            <input type="text" name="descricao_servico" class="form-control" id="descricao_servico" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-xl-2 col-md-4 col-sm-6">
                            <label for="valor_projetado">Valor Previsto:</label>
                            <input type="text" name="valor_projetado" class="form-control" id="valor_projetado" disabled>
                        </div>
                        <div class="form-group col-xl-2 col-md-4 col-sm-6">
                            <label for="comprimento_galeria">Comprimento Galeria:</label>
                            <input type="text" name="comprimento_galeria" class="form-control" id="comprimento_galeria" disabled>
                        </div>
                        <div class="form-group col-xl-2 col-md-4 col-sm-6">
                            <label for="licenca">Licença:</label>
                            <input type="text" name="licenca" class="form-control" id="licenca" disabled>
                        </div>
                        <div class="form-group col-xl-2 col-md-4 col-sm-6">
                            <label for="inicio_licenca">Inicio Licença:</label>
                            <input type="date" name="inicio_licenca" class="form-control" id="inicio_licenca" disabled>
                        </div>
                        <div class="form-group col-xl-2 col-md-4 col-sm-6">
                            <label for="termino_licenca">Término Licença:</label>
                            <input type="date" name="termino_licenca" class="form-control" id="termino_licenca" disabled>
                        </div>
                        <div class="form-group col-xl-2 col-md-4 col-sm-6">
                            <label for="data_fotos_emergencia">Dt. Fotos Emergência:</label>
                            <input type="date" name="data_fotos_emergencia" class="form-control" id="data_fotos_emergencia" value="{{ $obra->data_fotos_emergencia }}">
                        </div>                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="data_fotos_anexo_xiii">Dt. Fotos Anexo XIII:</label>
                            <input type="date" name="data_fotos_anexo_xiii" class="form-control" id="data_fotos_anexo_xiii" value="{{ $obra->data_fotos_anexo_xiii }}">
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="empreiteiro">Empreiteiro:</label>
                            <select name="empreiteiro" id="empreiteiro" class="form-control">
                                @foreach ($empreiteiros as $empreiteiro)
                                    <option value="{{ $empreiteiro->id }}" {{ $empreiteiro->id === $obra->empreiteiro->id ? "selected" : null }} >{{ $empreiteiro->nome }}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="fiscal_cliente">Fiscal (Cliente):</label>
                            <input type="text" name="fiscal_cliente" class="form-control" value="{{ $obra->fiscal_cliente }}">
                        </div>
                        <div class="form-group col-md-3 col-sm-6">
                            <label for="supervisor">Supervisor:</label>
                            <input type="text" name="supervisor" id="supervisor" class="form-control" disabled>
                        </div>                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="inicio_real">Inicio Real:</label>
                            <input type="date" name="inicio_real" class="form-control" id="inicio_real" value="{{ $obra->inicio_real }}">
                        </div>
                        <div class="form-group col-md-2 col-sm-6">
                            <label for="termino_real">Término Real:</label>
                            <input type="date" name="termino_real" class="form-control" id="termino_real" value="{{ $obra->termino_real }}">
                        </div>
                        <div class="form-group col-md-8 col-sm-12">
                            <label for="observacao">Observações:</label>
                            <textarea name="observacao" class="form-control" rows="1" placeholder="Digite a descrição do serviço">{{ $obra->observacao }}</textarea>
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

@section('css')
    <link rel="stylesheet" href="/assets/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {

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
            $('#supervisor').val($('#projeto option:selected').attr("data-supervisor"));

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
                $('#supervisor').val($('#projeto option:selected').attr("data-supervisor"));
            });


        });
    </script>
@stop
