@extends('layout.template')

@section('titulo','Bem vindo ao Turmaker - Professores')

@section('conteudo')

<div class="container">
    <div class="panel panel-primary">
        <div class="card">
            <div class="card-header">                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalProfessores">
                Cadastrar
                </button>

            </div>
            <ul class="list-group list-group-flush">
            @foreach($professors as $professor)
                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">{{$professor['materia']}}</li>
                    </div>   
                    <div class="col-sm">
                        <li class="list-group-item">{{$professor['nome']}}</li>
                    </div>  
                    <div class="col-sm">
                        <li class="list-group-item">
                            <button class="btn  btn-light">editar</button>
                            <button class="btn  btn-danger">excluir</button>
                        </li>
                    </div>
                </div>
            @endforeach
                
            </ul>           
        </div>
    </div>
</div>


@endsection


<!-- Modal -->
<div class="modal fade" id="modalProfessores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Professor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('professor.cadastrar')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nomeObrigatorio" placeholder="João da Silva">
                <small id="nomeObrigatorio" class="form-text text-muted">Digite o nome do professor.</small>
            </div>
            <div class="form-group">
                <label for="materia">Matéria</label>
                <input type="text" name="materia" class="form-control" id="materia" placeholder="Capoeira">
            </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>

      </div>      
  </div>
</div>