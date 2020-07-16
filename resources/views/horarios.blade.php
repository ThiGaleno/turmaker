@extends('layout.template')
@section('titulo','Bem vindo ao horarioker - horarios')
@section('conteudo')

<script type="text/javascript" src='/js/horarios.js'></script>


@foreach($turmas as $turma)
<div class="container">
    <div class="panel panel-primary">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-10 text-danger font-weight-bold">
                        <h4>{{$turma->nome}} - {{$turma->periodo}}</h4>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn  btn-primary" href="{{ route('horarios',$turma->id) }}">editar</a>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="font-weight-bold">Horários</div>
                        <div class="font-weight-bold">1º </div>
                        <div class="font-weight-bold">2º </div>
                        <div class="font-weight-bold">3º </div>
                        <div class="font-weight-bold">4º </div>
                    </div>

                    <div class="col">
                        <div class="font-weight-bold">Segunda</div>
                        @foreach($horarios as $horario)
                        @if($horario->dia == 'segunda' && $horario->nome == $turma->nome && $horario->periodo == $turma->periodo)
                        <div>{{$horario->materia}}</div>
                        @endif
                        @endforeach
                    </div>

                    <div class="col">
                        <div class="font-weight-bold">Terça</div>
                        @foreach($horarios as $horario)
                        @if($horario->dia == 'terça' && $horario->nome == $turma->nome && $horario->periodo == $turma->periodo)
                        <div>{{$horario->materia}}</div>
                        @endif
                        @endforeach
                    </div>

                    <div class="col">
                        <div class="font-weight-bold">Quarta</div>
                        @foreach($horarios as $horario)
                        @if($horario->dia == 'quarta' && $horario->nome == $turma->nome && $horario->periodo == $turma->periodo)
                        <div>{{$horario->materia}}</div>
                        @endif
                        @endforeach
                    </div>

                    <div class="col">
                        <div class="font-weight-bold">Quinta</div>
                        @foreach($horarios as $horario)
                        @if($horario->dia == 'quinta' && $horario->nome == $turma->nome && $horario->periodo == $turma->periodo)
                        <div>{{$horario->materia}}</div>
                        @endif
                        @endforeach
                    </div>

                    <div class="col">
                        <div class="font-weight-bold">Sexta</div>
                        @foreach($horarios as $horario)
                        @if($horario->dia == 'sexta' && $horario->nome == $turma->nome && $horario->periodo == $turma->periodo)
                        <div>{{$horario->materia}}</div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
@endforeach


<!-- Modal EDITAR -->

@if(isset($horarioId))
<!-- Abre modal editar, $horarioId == id da turma -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#modalHorariosEdit').modal('show')
    });
</script>


<div class="modal fade" id="modalHorariosEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Turma: <span class="text-primary font-weight-bold"> {{$horarioId->nome}}</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <form action="{{ route('aluno.editar',$horarioId->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="csrf-token" id="token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_method" value="put">
                    <!-- codigo importante-->
                    @foreach($turmaSelects as $keyPeriodo => $dia)
                    <!-- $key = periodos matutino\vespertino!-->

                    @if ($keyPeriodo == $horarioId->periodo)
                    <!-- Filtra o período matutino e vespertino !-->
                    <div class="row">
                        <div class="col-auto mr-2">
                            <div class="row">
                                <div class="font-weight-bold font-italic text-primary">{{$keyPeriodo}}</div>
                            </div>
                            <div class="row">
                                <div class="form-control-plaintext font-weight-bold">1º horario </div>
                            </div>
                            <div class="row">
                                <div class="form-control-plaintext font-weight-bold">2º horario</div>
                            </div>
                            <div class="row">
                                <div class="form-control-plaintext font-weight-bold">3º horario</div>
                            </div>
                            <div class="row">
                                <div class="form-control-plaintext font-weight-bold">4º horario</div>
                            </div>
                        </div>
                        @foreach($dia as $keySemana => $order)
                        <!-- $key = dias da semana !-->

                        <div class="col">
                            <div class="d-flex justify-content-center font-weight-bold">{{$keySemana}}</div>
                            @foreach($order as $keyOrder => $selects)
                            <!-- $key = 1, 2, 3, 4 horário de cada dia da semana!-->
                            <div class="row">
                                @if ($keyOrder == '1')
                                <!-- preenche a linha dos primeiros horário de segunda a sexta !-->
                                <select class="form-control atualizaHorario">
                                    @foreach ($horarios as $horario)
                                    <!--preenche <option> do horário SELECTED !-->
                                    @if ($horario->turmas_id == $horarioId->id && $horario->dia == $keySemana && $horario->ordem_aula == $keyOrder)
                                    <option value="{{json_encode($horario)}}" selected>{{$horario->materia}}</option>
                                    @endif
                                    @endforeach

                                    @foreach ($selects as $select )
                                    <!-- preenche os <option> das materias livres para cadastrar !-->
                                    <option value="{{json_encode(['idMateria' => $select->idMateria, 'ordem_aula' => $keyOrder, 'dia' => $keySemana, 'turma_id' => $horarioId->id, 'periodo' => $keyPeriodo])}}">{{$select->materia}}</option>
                                    @endforeach
                                </select>
                                @endif

                                @if ($keyOrder == '2')
                                <!-- preenche a linha dos segundos horários de segunda a sexta !-->
                                <select class="form-control atualizaHorario">
                                    @foreach ($horarios as $horario)
                                    <!--preenche <option> do horário SELECTED !-->
                                    @if ($horario->turmas_id == $horarioId->id && $horario->dia == $keySemana && $horario->ordem_aula == $keyOrder)
                                    <option value="{{json_encode($horario)}}" selected>{{$horario->materia}}</option>
                                    @endif
                                    @endforeach

                                    @foreach ($selects as $select )
                                    <!-- preenche os <option> das materias livres para cadastrar !-->
                                    <option value="{{json_encode(['idMateria' => $select->idMateria, 'ordem_aula' => $keyOrder, 'dia' => $keySemana, 'turma_id' => $horarioId->id, 'periodo' => $keyPeriodo])}}">{{$select->materia}}</option>
                                    @endforeach
                                </select>
                                @endif
                                @if ($keyOrder == '3')
                                <!-- preenche a linha dos terceiros horários de segunda a sexta !-->
                                <select class="form-control atualizaHorario">
                                    @foreach ($horarios as $horario)
                                    <!--preenche <option> do horário SELECTED !-->
                                    @if ($horario->turmas_id == $horarioId->id && $horario->dia == $keySemana && $horario->ordem_aula == $keyOrder)
                                    <option value="{{json_encode($horario)}}" selected>{{$horario->materia}}</option>
                                    @endif
                                    @endforeach

                                    @foreach ($selects as $select )
                                    <!-- preenche os <option> das materias livres para cadastrar !-->
                                    <option value="{{json_encode(['idMateria' => $select->idMateria, 'ordem_aula' => $keyOrder, 'dia' => $keySemana, 'turma_id' => $horarioId->id, 'periodo' => $keyPeriodo])}}">{{$select->materia}}</option>
                                    @endforeach
                                </select>
                                @endif
                                @if ($keyOrder == '4')
                                <!-- preenche a linha dos quartos horário de segunda a sexta !-->
                                <select class="form-control atualizaHorario">
                                    @foreach ($horarios as $horario)
                                    <!--preenche <option> do horário SELECTED !-->
                                    @if ($horario->turmas_id == $horarioId->id && $horario->dia == $keySemana && $horario->ordem_aula == $keyOrder)
                                    <option value="{{json_encode($horario)}}" selected>{{$horario->materia}}</option>
                                    @endif
                                    @endforeach

                                    @foreach ($selects as $select )
                                    <!-- preenche os <option> das materias livres para cadastrar !-->
                                    <option value="{{json_encode(['idMateria' => $select->idMateria, 'ordem_aula' => $keyOrder, 'dia' => $keySemana, 'turma_id' => $horarioId->id, 'periodo' => $keyPeriodo])}}">{{$select->materia}}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            @endforeach
                            <br>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @endforeach
                </form>
            </div>
            <div id="status"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection