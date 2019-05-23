@extends('layout.template')

@section('titulo','Bem vindo ao Turmaker - turmas')

@section('conteudo')

<div class="container">
    <div class="panel panel-primary">
        <div class="card">
            <div class="card-header">                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalturmas">
                Cadastrar
                </button>

            </div>
            <ul class="list-group list-group-flush">
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">Turmas</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Professores</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item">Período</li>
                    </div> 
                    <div class="col-sm">
                        <li class="list-group-item"></li>
                    </div> 
                </div> 
            @foreach($turmas as $turma)
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">{{$turma->turma}}</li>
                    </div>   
                    <div class="col-sm">
                        <li class="list-group-item">{{$turma->professor}}</li>
                    </div>   
                    <div class="col-sm">
                        <li class="list-group-item">{{$turma->periodo}}</li>
                    </div>  
                    <div class="col-sm">
                        <li class="list-group-item">
                            <a class="btn  btn-light" href="{{ route('turmas',$turma->id) }}">editar</a>
                            <a class="btn  btn-danger" href="{{ route('turma.deletar',$turma->id) }}">excluir</a>
                        </li>
                    </div>
                </div>
                
            @endforeach
                
            </ul>           
        </div>
    </div>
</div>




<!-- Modal CADASTRAR -->
<div class="modal fade" id="modalturmas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar turma</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('turma.cadastrar')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="nome">Nome da turma</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="Turma X">
                <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do turma.</small>
            </div>
            <div class="form-group">
                <label for="periodo">periodo</label>
                <input type="text" name="periodo" class="form-control" id="periodo" placeholder="Noturno">
            </div>
            
            <div class="form-group">
            <label for="professor">Turma </label>
            <select id="professor" class="form-control" name="professores_id">
            <option value="" >Sem professor fixo</option>
            @foreach($professores as $professor)
                <option value="{{$professor->id}}" >{{$professor->nome}}</option>                
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
@if(isset($turmaId))
<script type="text/javascript">
$(document).ready(function() {
    $('#modalturmasEdit').modal('show')
});
</script>

<div class="modal fade" id="modalturmasEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar turma</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            
            <form action="{{ route('turma.editar',$turmaId->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                   
                    <div class="form-group">
                        <label for="nome">Nome da turma</label>
                        <input type="text" class="form-control" value="{{$turmaId->nome}}" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="Turma X">
                        <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do turma.</small>
                    </div>
                    <div class="form-group">
                        <label for="periodo">periodo</label>
                        <input type="text" name="periodo" value="{{$turmaId->periodo}}" class="form-control" id="periodo" placeholder="Noturno">
                    </div>
                    
                    <div class="form-group">
                        <label for="professor">Professor </label>
                        <select id="professor" class="form-control" name="professores_id">
                        <option value="" >Sem professor fixo</option>                
                        @foreach($professores as $professor)
                            <option value="{{ $professor->id }}" {{ $turmaId->professores_id == $professor->id ? 'selected="selected"' : '' }} >{{$professor->nome}}</option>    
                                    
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