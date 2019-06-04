@extends('layout.template')

@section('titulo','Bem vindo ao alunoker - alunos')

@section('conteudo')

<div class="container">
    <div class="panel panel-primary">
        <div class="card">
            <div class="card-header">                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMaterias">
                Cadastrar
                </button>

            </div>
            <ul class="list-group list-group-flush">
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">Materias</li>
                    </div>                     
                    <div class="col-sm">
                        <li class="list-group-item"></li>
                    </div> 
                </div> 
            @foreach($materias as $materia)
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">{{$materia->nome}}</li>
                    </div>                      
                    
                    <div class="col-sm">
                        <li class="list-group-item">
                            <a class="btn  btn-light" href="{{ route('materias',$materia->id) }}">editar</a>
                            <a class="btn  btn-danger" href="{{ route('materia.deletar',$materia->id) }}">excluir</a>
                        </li>
                    </div>
                </div>
                
            @endforeach
                
            </ul>           
        </div>
    </div>
</div>




<!-- Modal CADASTRAR -->
<div class="modal fade" id="modalMaterias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar aluno</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('materia.cadastrar')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="nome">Nome da aluno</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="aluno X">
                <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do aluno.</small>
            </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            
        </form>
      </div>
    </div>      
  </div>
</div>


<!-- Modal EDITAR -->
@if(isset($materiaId))
<script type="text/javascript">
$(document).ready(function() {
    $('#modalMateriasEdit').modal('show')
});
</script>

<div class="modal fade" id="modalMateriasEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            
                <form action="{{ route('materia.editar',$materiaId->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                   
                        <div class="form-group">
                            <label for="nome">Nome da aluno</label>
                            <input type="text" class="form-control" value="{{$materiaId->nome}}" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="aluno X">
                            <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do aluno.</small>
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