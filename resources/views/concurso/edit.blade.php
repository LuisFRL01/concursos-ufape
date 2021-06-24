@extends('templates.template-principal')
@section('content')
    <div class="container" style="margin-top: 5rem; margin-bottom: 8rem;">
        <div class="form-row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow bg-white style_card_container">
                    <div class="card-header d-flex justify-content-between bg-white" id="style_card_container_header">
                        <div class="form-group">
                            <h6 class="style_card_container_header_titulo">Editar concurso</h6>
                            <h6 class="" style="font-weight: normal; color: #909090; margin-top: -10px; margin-bottom: -15px;">Meus concursos > Editar concurso</h6>
                        </div>
                        <h6 class="style_card_container_header_campo_obrigatorio"><span style="color: red; font-weight: bold;">*</span> Campo obrigatório</h6>                            </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                                <h6 style="color: #707070; font-weight: normal; font-size: 22px;">Informações</h6>
                            </div>
                            <form method="POST" action="{{route('concurso.update', ['concurso' => $concurso->id])}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-row">
                                    <div class="col-sm-8 form-group">
                                        <label for="titulo" class="style_campo_titulo">Título</label>
                                        <input type="text" class="form-control style_campo @error('titulo') is-invalid @enderror" id="titulo" name="titulo" placeholder="Concurso professores substitutos 2021" value="{{old('titulo') != null ? old('titulo') : $concurso->titulo}}">

                                        @error('titulo')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="quantidade_vagas" class="style_campo_titulo">Quantidade vagas</label>
                                        <input type="number" class="form-control style_campo @error('quantidade_vagas') is-invalid @enderror" id="quantidade_vagas" name="quantidade_vagas" placeholder="5" value="{{old('quantidade_vagas') != null ? old('quantidade_vagas') : $concurso->qtd_vagas}}">

                                        @error('quantidade_vagas')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <div class="card shadow bg-white style_card_container">
                                            <div class="card-header d-flex justify-content-between bg-white" id="style_card_container_header">
                                                <h6 class="style_card_container_header_titulo">Vagas do concurso</h6>
                                                <button type="button" id="btn-adicionar-escolhar" onclick="adicionarEscolha()" class="btn btn-primary" style="margin-top:10px;">Adicionar vaga</button>
                                            </div>
                                            <div class="card-body">
                                                <div id="opcoes" class="row">
                                                    @if(old('opcoes_vaga') != null)
                                                        @foreach (old('opcoes_vaga') as $i => $opcao)
                                                            <div class="col-sm-5 form-group" style="border: 1px solid #ced4da; border-radius: 10px; padding: 20px; margin-left: 35px; margin-right: 25px;">
                                                                <label class="style_campo_titulo">Nome da opção</label>
                                                                <input type="hidden" name="opcoes_id[]" value="{{old('opcoes_id.'.$i)}}">
                                                                <input class="form-control style_campo @error('opcoes_vaga.'.$i) is-invalid @enderror" type="text" placeholder="Professor de geografia" name="opcoes_vaga[]" value="{{$opcao}}">               
                                                                
                                                                @error('opcoes_vaga.'.$i)
                                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                                
                                                                <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger" style="margin-top: 10px;">Excluir</button>
                                                            </div>    
                                                        @endforeach
                                                    @else
                                                        @foreach ($concurso->vagas as $i => $opcao)
                                                            <div class="col-sm-5 form-group" style="border: 1px solid #ced4da; border-radius: 10px; padding: 20px; margin-left: 35px; margin-right: 25px;">
                                                                <label class="style_campo_titulo">Nome da opção</label>
                                                                <input type="hidden" name="opcoes_id[]" value="{{$opcao->id}}">
                                                                <input class="form-control style_campo @error('opcoes_vaga.'.$i) is-invalid @enderror" type="text" placeholder="Professor de geografia" name="opcoes_vaga[]" value="{{$opcao->nome}}">               
                                                                
                                                                @error('opcoes_vaga.'.$i)
                                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                                
                                                                <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger" style="margin-top: 10px;">Excluir</button>
                                                            </div>    
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label for="descricao" class="style_campo_titulo">Descrição</label>
                                        <textarea type="text" class="form-control style_campo @error('descricao') is-invalid @enderror" id="descricao" name="descricao" placeholder="Esse concurso se refere há..." rows="5" cols="30">{{old('descricao') != null ? old('descricao') : $concurso->descricao}}</textarea>   
                                    
                                        @error('descricao')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="data_inicio_inscricao" class="style_campo_titulo">Data de inicio das inscrições</label>
                                        <input type="date" class="form-control style_campo @error('data_inicio_inscricao') is-invalid @enderror" id="data_inicio_inscricao" name="data_inicio_inscricao" value="{{old('data_inicio_inscricao') != null ? old('data_inicio_inscricao') : $concurso->data_inicio_inscricao}}">
                                    
                                        @error('data_inicio_inscricao')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="data_fim_inscricao" class="style_campo_titulo">Data de termino das inscrições</label>
                                        <input type="date" class="form-control style_campo @error('data_fim_inscricao') is-invalid @enderror" id="data_fim_inscricao" name="data_fim_inscricao" value="{{old('data_fim_inscricao') != null ? old('data_fim_inscricao') : $concurso->data_fim_inscricao}}">

                                        @error('data_fim_inscricao')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="data_fim_isencao_inscricao" class="style_campo_titulo">Data limite para isenção</label>
                                        <input type="date" class="form-control style_campo @error('data_fim_isencao_inscricao') is-invalid @enderror" id="data_fim_isencao_inscricao" name="data_fim_isencao_inscricao" value="{{old('data_fim_isencao_inscricao') != null ? old('data_fim_isencao_inscricao') : $concurso->data_fim_isencao_inscricao}}">
                                    
                                        @error('data_fim_isencao_inscricao')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="data_fim_pagamento_inscricao" class="style_campo_titulo">Data limite para pagamento</label>
                                        <input type="date" class="form-control style_campo @error('data_fim_pagamento_inscricao') is-invalid @enderror" id="data_fim_pagamento_inscricao" name="data_fim_pagamento_inscricao" value="{{old('data_fim_pagamento_inscricao') != null ? old('data_fim_pagamento_inscricao') : $concurso->data_fim_pagamento_inscricao}}">
                                    
                                        @error('data_fim_pagamento_inscricao')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="data_inicio_envio_doc" class="style_campo_titulo">Data inicio para envio dos documentos</label>
                                        <input type="date" class="form-control style_campo @error('data_inicio_envio_doc') is-invalid @enderror" id="data_inicio_envio_doc" name="data_inicio_envio_doc" value="{{old('data_inicio_envio_doc') != null ? old('data_inicio_envio_doc') : $concurso->data_inicio_envio_doc}}">
                                    
                                        @error('data_inicio_envio_doc')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="data_fim_envio_doc" class="style_campo_titulo">Data fim para envio dos documentos</label>
                                        <input type="date" class="form-control style_campo @error('data_fim_envio_doc') is-invalid @enderror" id="data_fim_envio_doc" name="data_fim_envio_doc" value="{{old('data_fim_envio_doc') != null ? old('data_fim_envio_doc') : $concurso->data_fim_envio_doc}}">

                                        @error('data_fim_envio_doc')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="data_resultado_selecao" class="style_campo_titulo">Data do resultado do concurso</label>
                                        <input type="date" class="form-control style_campo @error('data_resultado_selecao') is-invalid @enderror" id="data_resultado_selecao" name="data_resultado_selecao" value="{{old('data_resultado_selecao') != null ? old('data_resultado_selecao') : $concurso->data_resultado_selecao}}">

                                        @error('data_resultado_selecao')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="edital_geral" class="style_campo_titulo">Edital geral &nbsp;</label><a href="{{asset('storage/' . $concurso->edital_geral)}}" target="_black">Arquivo atual</a>
                                        <input type="file" class="form-control style_campo @error('edital_geral') is-invalid @enderror" name="edital_geral" id="edital_geral" value="{{old('edital_geral')}}">
                                        <small>Para editar o arquivo envie um novo</small>
                                        @error('edital_geral')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="edital_especifico" class="style_campo_titulo">Edital especifico &nbsp;</label><a href="{{asset('storage/' . $concurso->edital_especifico)}}" target="_black">Arquivo atual</a>
                                        <input type="file" class="form-control style_campo @error('edital_especifico') is-invalid @enderror" name="edital_especifico" id="edital_especifico" value="{{old('edital_especifico')}}">
                                        <small>Para editar o arquivo envie um novo</small>
                                        @error('edital_especifico')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label for="declaracao_de_veracidade" class="style_campo_titulo">Declaração de veracidade &nbsp;</label><a href="{{asset('storage/' . $concurso->declaracao_veracidade)}}" target="_black">Arquivo atual</a>
                                        <input type="file" class="form-control style_campo @error('declaracao_de_veracidade') is-invalid @enderror" name="declaracao_de_veracidade" id="declaracao_de_veracidade" value="{{old('declaracao_de_veracidade')}}">
                                        <small>Para editar o arquivo envie um novo</small>
                                        @error('declaracao_de_veracidade')
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-bottom: 5px;">
                                    <hr>
                                </div>
                                <div class="col-md-12" style="margin-bottom: 5px; text-align: right;">
                                    <button type="submit" class="btn btn-success shadow-sm" style="width: 240px; ">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function adicionarEscolha() {
            var escolha = `<div class="col-sm-3" style="border: solid 1px black; border-radius: 5px; padding: 5px; margin: 5px;">
                            <label>Nome da opção</label>
                            <input type="hidden" name="opcoes_id[]" value="0">
                            <input class="form-control" type="text" placeholder="Professor de geografia" name="opcoes_vaga[]">               
                            <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger">Excluir</button>
                           </div>`;
            $('#opcoes').append(escolha);
        }
    </script>
@endsection