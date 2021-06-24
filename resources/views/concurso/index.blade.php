@extends('templates.template-principal')
@section('content')
    <div class="container" style="margin-top: 5rem; margin-bottom: 8rem;">
        <div class="form-row justify-content-center">
            <div class="col-md-11">
                <div class="card shadow bg-white style_card_container">
                    <div class="card-header d-flex justify-content-between bg-white" id="style_card_container_header">
                        <h6 class="style_card_container_header_titulo">Meus concursos</h6>
                        @can('create', App\Models\Concurso::class)
                            <a href="{{route('concurso.create')}}" class="btn btn-primary" style="margin-top:10px;">Criar concurso</a>
                        @endcan
                    </div>
                    @if($concursos->count() > 0)
                        <!-- um ou mais concursos -->
                        <div class="card-body">
                            @if(session('mensage'))
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 5px;">
                                        <div class="alert alert-success" role="alert">
                                            <p>{{session('mensage')}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <table class="table table-bordered table-hover tabela_container">
                                <thead>
                                    <tr>
                                        <th scope="col" class="tabela_container_cabecalho_titulo">Id</th>
                                        <th scope="col" class="tabela_container_cabecalho_titulo" style="width: 100%;">Concurso</th>
                                        <th scope="col" class="tabela_container_cabecalho_titulo">Status</th>
                                        <th scope="col" class="tabela_container_cabecalho_titulo">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($concursos as $concurso)
                                        <tr>
                                            <th scope="row" id="tabela_container_linha"  style="text-align: center;">{{$concurso->id}}</th>
                                            <td id="tabela_container_linha">{{$concurso->titulo}}</td>
                                            <td id="tabela_container_linha" style="text-align: center;">
                                                <div class="btn-group">
                                                    <img src="img/icon_publicado.svg" alt="" width="25px" style="margin-right: 5px;">
                                                    <h6 style="margin-top: 6px; font-weight: normal; color: #2EAC1A;">Publicado</h6>
                                                </div>
                                            </td>
                                            <td id="tabela_container_linha" style="text-align: center;">
                                                <div class="btn-group">
                                                    <div style="margin-right: 15px;">
                                                        <a class="btn btn-success"><img src="{{ asset('img/icon_candidato.svg') }}" alt="Candidatos inscritos no concurso {{$concurso->titulo}}" width="23x" ></a>
                                                        <a class="btn btn-warning"><img src="{{ asset('img/icon_consultar_resultado.svg') }}" alt="Resultado do concurso {{$concurso->titulo}}" width="18px" ></a>
                                                    </div>
                                                    <div style="border-left: 1px solid #d1d1d1; margin-right: 15px;"></div>
                                                    <div >
                                                        <a class="btn btn-primary" href="{{route('concurso.show', ['concurso' => $concurso->id])}}"><img src="{{ asset('img/icon_visualizar.svg') }}" alt="Visualizar concurso" width="26px" ></a>
                                                        <a class="btn btn-info" href="{{route('concurso.edit', ['concurso' => $concurso->id])}}"><img src="{{ asset('img/icon_editar.svg') }}" alt="Editar concurso" width="22px" ></a>
                                                        <a class="btn btn-danger" data-toggle="modal" data-target="#deletar-concurso-{{$concurso->id}}"><img src="{{ asset('img/icon_lixeira.svg') }}" alt="Deletar concurso" width="22px" ></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    {{-- <tr>
                                        <th scope="row"  style="text-align: center; border-width: 0px;">2</th>
                                        <td style="border-width: 0px;">História</td>
                                        <td style="text-align: center;border-width: 0px;">
                                            <div class="btn-group">
                                                <img src="img/icon_salvo.svg" alt=" " width="25px" style="margin-right: 5px;">
                                                <h6 style="margin-top: 6px; font-weight: normal; color: #008CFF;">Salvo</h6>
                                            </div>
                                        </td>
                                        <td class="d-flex" style="border-width: 0px;">
                                            <button type="button" class="btn btn-primary" style="margin-right: 15px; width: 100%;">Abrir</button>
                                            <button type="button" class="btn btn-light" style="color: red; width: 100%;">Deletar</button>
                                        </td>
                                    </tr> --}}
                                </tbody>
                                </table>
                        </div>
                        <div class="card-footer" style="background-color: #fff; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                            <div><h6 style="font-weight: bold">Legenda:</h6></div>
                            <div class="form-row">
                                <div style="margin:5px">
                                    <button class="btn btn-success" style="margin-right: 10px" disabled>
                                        <img class="card-img-left example-card-img-responsive" src="img/icon_candidato.svg" width="20px"/>
                                    </button> Visualizar Candidatos
                                </div>
                                <div style="margin: 5px">
                                    <button class="btn btn-warning" style="margin-right: 10px" disabled>
                                    <img class="card-img-left example-card-img-responsive" src="img/icon_consultar_resultado.svg" width="15px"/>
                                    </button> Consultar o resultado final </div>
                                <div style="margin: 5px">
                                    <button class="btn btn-primary" style="margin-right: 10px" disabled>
                                    <img class="card-img-left example-card-img-responsive" src="img/icon_visualizar.svg" width="24px"/>
                                    </button> Visualizar Concurso</div>
                                <div style="margin: 5px">
                                    <button class="btn btn-info" class="btn btn-success" style="margin-right: 10px" disabled>
                                    <img class="card-img-left example-card-img-responsive" src="img/icon_editar.svg" width="16px"/>
                                    </button> Editar Concurso</div>
                                <div style="margin: 5px">
                                    <button class="btn btn-danger" class="btn btn-success" style="margin-right: 10px" disabled>
                                    <img class="card-img-left example-card-img-responsive" src="img/icon_lixeira.svg" width="16px"/>
                                    </button> Deletar Concurso</div>
                            </div>
                        </div>
                    @else
                    <!-- Nenhum concurso criado -->
                        <div class="card-body">
                            <div class="form-row" style="text-align: center;">
                                <div class="col-md-12" style="margin-top: 5rem; margin-bottom: 10rem;">
                                    <img src="img/img_default_meus_concursos.svg" alt="Imagem default" width="190px">
                                    <h6 class="style_campo_titulo" style="margin-top: 20px;">Nenhum concurso criado.</h6>
                                    <h6 class="style_campo_titulo" style="font-weight: normal;"><a href="{{route('concurso.create')}}">Clique aqui</a> para criar um concurso</h6>
                                </div>
                                
                            </div>
                        </div>
                    @endif    
                </div>
            </div>
        </div>
    </div>

    @foreach ($concursos as $concurso)
        <!-- Modal deletar concurso -->
        <div class="modal fade" id="deletar-concurso-{{$concurso->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deletar {{$concurso->titulo}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="form-delete-concurso-{{$concurso->id}}" method="POST" action="{{route('concurso.destroy', ['concurso' => $concurso->id])}}">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        Tem certeza que deseja deletar o concurso {{$concurso->titulo}}?
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger" form="form-delete-concurso-{{$concurso->id}}">Deletar</button>
                </div>
            </div>
            </div>
        </div>
    @endforeach
@endsection