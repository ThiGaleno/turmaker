@extends('layout.template')

@section('titulo','Bem vindo ao alunoker - alunos')

@section('conteudo')

<div class="container">
    <div class="panel panel-primary">
        <div class="card">
            <div class="card-header">                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlunos">
                Cadastrar
                </button>

            </div>
            <ul class="list-group list-group-flush">
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">alunos</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Turno</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Nascimento</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Categorias</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Turmas</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item"></li>
                    </div> 
                </div> 
            @foreach($alunos as $aluno)
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">{{$aluno->nome}}</li>
                    </div>   
                    <div class="col-sm">
                        <li class="list-group-item">{{$aluno->turno}}</li>
                    </div>
                    <div class="col-sm">
                        <li class="list-group-item">{{$aluno->data_nascimento}}</li>
                    </div>
                    <div class="col-sm">
                        <li class="list-group-item">{{$aluno->categoria}}</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">{{$aluno->turmas}}</li>
                    </div> 
                    
                    <div class="col-sm">
                        <li class="list-group-item">
                            <a class="btn  btn-light" href="{{ route('alunos',$aluno->id) }}">editar</a>
                            <a class="btn  btn-danger" href="{{ route('aluno.deletar',$aluno->id) }}">excluir</a>
                        </li>
                    </div>
                </div>
                
            @endforeach
                
            </ul>           
        </div>
    </div>
</div>




<!-- Modal CADASTRAR -->
<div class="modal fade" id="modalAlunos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar aluno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('aluno.cadastrar')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="nome">Nome da aluno</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="aluno X">
                <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do aluno.</small>
            </div>
            <div class="form-group">
                <label for="turno">turno </label>
                <select id="turno" class="form-control" name="turno">
                <option value="matutino" >Matutino</option>
                <option value="vespertino" >Vespertino</option>                
                </select>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="form-control" id="data_nascimento" placeholder="Data de nascimento">
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
                <option value="" >Sem aluno fixo</option>
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
@if(isset($alunoId))
<script type="text/javascript">
$(document).ready(function() {
    $('#modalAlunosEdit').modal('show')
});
</script>

<div class="modal fade" id="modalAlunosEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar aluno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            
            <form action="{{ route('aluno.editar',$alunoId->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                   
                    <div class="form-group">
                        <label for="nome">Nome da aluno</label>
                        <input type="text" class="form-control" value="{{$alunoId->nome}}" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="aluno X">
                        <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do aluno.</small>
                    </div>
                    <div class="form-group">
                        <label for="turno">turno</label>
                        <input type="text" name="turno" value="{{$alunoId->turno}}" class="form-control" id="turno" placeholder="Noturno">
                    </div>
                    
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" value="{{$alunoId->data_nascimento}}" class="form-control" id="data_nascimento" placeholder="Data de nascimento">
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
                            <option value="{{$turma->id}}" {{ $alunoId->turmas_id == $turma->id ? 'selected="selected"' : '' }} >{{$turma->nome}}</option>                
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