@extends('layout.template')

@section('titulo','Bem vindo ao horarioker - horarios')

@section('conteudo')

<div class="container">
    <div class="panel panel-primary">
        <div class="card">
            <div class="card-header">                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalHorarios">
                Cadastrar
                </button>

            </div>
            <ul class="list-group list-group-flush">
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">dia</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Ordem da aula</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Turma</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Professor</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Materia</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item"></li>
                    </div> 
                </div> 
            @foreach($horarios as $horario)
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">{{$horario->dia}}</li>
                    </div>   
                    <div class="col-sm">
                        <li class="list-group-item">{{$horario->ordem_aula}}</li>
                    </div>
                    <div class="col-sm">
                        <li class="list-group-item">{{$horario->turmas_id}}</li>
                    </div>
                    <div class="col-sm">
                        <li class="list-group-item">{{$horario->id}}</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">{{$horario->materia}}</li>
                    </div> 
                    
                    <div class="col-sm">
                        <li class="list-group-item">
                            <a class="btn  btn-light" href="{{ route('horarios',$horario->id) }}">editar</a>
                            <a class="btn  btn-danger" href="{{ route('horario.deletar',$horario->id) }}">excluir</a>
                        </li>
                    </div>
                </div>
                
            @endforeach
                
            </ul>           
        </div>
    </div>
</div>




<!-- Modal CADASTRAR -->
<div class="modal fade" id="modalHorarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar horario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('horario.cadastrar')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="nome">Nome da horario</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="horario X">
                <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do horario.</small>
            </div>
            <div class="form-group">
                <label for="turno">turno </label>
                <select id="turno" class="form-control" name="turno">
                <option value="matutino" >Matutino</option>
                <option value="vespertino" >Vespertino</option>                
                </select>
            </div>
            <div class="form-group">
                <label for="categoria">Ordem da aula </label>
                <select id="categoria" class="form-control" name="ordem_aula">
                    <option value="1" >1º horário</option>
                    <option value="2" >2º horário</option>                
                    <option value="3" >3º horário</option>                
                    <option value="4" >4º horário</option>    
                </select>
            </div>

            <div class="form-group">
                <label for="categoria">Dia </label>
                <select id="categoria" class="form-control" name="dia">
                    <option value="segunda" >Segunda</option>
                    <option value="terca" >Terça</option>                
                    <option value="quarta" >Quarta</option>                
                    <option value="quinta" >Quinta</option>                
                    <option value="sexta" >Sexta</option>  
                </select>
            </div>
            
            <div class="form-group">
                <label for="turma">turma </label>
                <select id="turma" class="form-control" name="turmas_id">
                <option value="" >Sem horario fixo</option>
                @foreach($turmas as $turma)
                    <option value="{{$turma->id}}" >{{$turma->nome}}</option>                
                @endforeach
                </select>
            </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
      </div>
    </div>      
  </div>
</div>


<!-- Modal EDITAR -->
@if(isset($horarioId))
<script type="text/javascript">
$(document).ready(function() {
    $('#modalHorariosEdit').modal('show')
});
</script>

<div class="modal fade" id="modalHorariosEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            
            <form action="{{ route('horario.editar',$horarioId->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                   
                    <div class="form-group">
                        <label for="nome">Nome da horario</label>
                        <input type="text" class="form-control" value="{{$horarioId->nome}}" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="horario X">
                        <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do horario.</small>
                    </div>
                    <div class="form-group">
                        <label for="turno">turno</label>
                        <input type="text" name="turno" value="{{$horarioId->turno}}" class="form-control" id="turno" placeholder="Noturno">
                    </div>
                    
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" value="{{$horarioId->data_nascimento}}" class="form-control" id="data_nascimento" placeholder="Data de nascimento">
                    </div>

                    <div class="form-group">
                        <label for="categoria">categoria </label>
                        <select id="categoria" class="form-control" name="categoria">
                        <option value="recanto" >Recanto Juvenil</option>
                        <option value="infanto" >Infanto Juvenil</option>                
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="turma">turma </label>
                        <select id="turma" class="form-control" name="turmas_id">
                        <option value="" >SELECIONAR</option>
                        @foreach($turmas as $turma)
                            <option value="{{$turma->id}}" {{ $horarioId->turmas_id == $turma->id ? 'selected="selected"' : '' }} >{{$turma->nome}}</option>                
                        @endforeach

                        </select>
                    </div>
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            
            </div>
        </div>
    </div>
</div>
@endif
@endsection