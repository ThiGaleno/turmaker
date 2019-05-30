@extends('layout.template')
@section('titulo','Bem vindo ao horarioker - horarios')
@section('conteudo')


@foreach($turmas as $turma)
<div class="container">
    <div class="panel panel-primary">
        <div class="card">
            <div class="card-header"> 
                <div class="row">
                    <div class="col-sm-10">{{$turma->nome}}</div>                       
                    <div class="col-sm-2">
                        <a class="btn  btn-primary" href="{{ route('horarios',$turma->id) }}">editar</a>
                        <a class="btn  btn-danger" href="{{ route('horario.deletar',$turma->id) }}">excluir</a>
                    </div> 
                </div>
            </div>


            <div class="row">
                <div class="col">
                    {{$turma->nome}}<br>
                    1ºHorário<br>        
                    2ºHorário<br>        
                    3ºHorário<br>        
                    4ºHorário<br>
                </div>

                <div class="col">segunda<br>        
                    @foreach($horarios as $horario)             
                        @if($horario->dia == 'segunda' && $horario->nome == $turma->nome)
                            @if($horario->materia == "") 
                            {{$horario->materia = "<vazio>"}}<br>
                            @else
                                {{$horario->materia}}<br> 
                            @endif
                        @endif                  
                    @endforeach        
                </div>

                <div class="col">terça<br>        
                    @foreach($horarios as $horario)  
                        @if($horario->dia == 'terça' && $horario->nome == $turma->nome)                          
                            @if($horario->materia == "") 
                            {{$horario->materia = "<vazio>"}}<br>
                            @else
                                {{$horario->materia}}<br> 
                            @endif 
                        @endif                  
                    @endforeach        
                </div>

                <div class="col">quarta<br>        
                    @foreach($horarios as $horario)  
                        @if($horario->dia == 'quarta'  && $horario->nome == $turma->nome)                 
                            @if($horario->materia == "") 
                            {{$horario->materia = "<vazio>"}}<br>
                            @else
                                {{$horario->materia}}<br>
                            @endif

                        @endif                  
                    @endforeach        
                </div>

                <div class="col">quinta<br>        
                    @foreach($horarios as $horario)  
                        @if($horario->dia == 'quinta'  && $horario->nome == $turma->nome)                          
                            {{$horario->materia}}<br> 
                        @endif                  
                    @endforeach        
                </div>

                <div class="col">sexta<br>        
                    @foreach($horarios as $horario)  
                        @if($horario->dia == 'sexta'  && $horario->nome == $turma->nome)                          
                            {{$horario->materia}}<br> 
                        @endif                  
                    @endforeach        
                </div>

            </div>
        </div>    
    </div>    
    <hr>
</div>
@endforeach





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
        <!--
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
        -->


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
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">infanto 4 <br>vespertino</th>
                        <th scope="col">Segunda</th>
                        <th scope="col">Terça</th>
                        <th scope="col">Quarta</th>
                        <th scope="col">Quinta</th>
                        <th scope="col">Sexta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{route('horario.cadastrar')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <tr>
                            <th scope="row">1º horário</th>
                            <td>
                                <div class="form-group">                
                                    <input type="text" class="form-control" value="{{$horario->materia}}" 
                                    name="materia" id="materia" placeholder="Matéria">
                                </div>
                            </td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2º horário</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>@fat</td>
                            <td>@fat</td>
                            </tr>

                            <th scope="row">lanche</th>
                            <td>lanche</td>
                            <td>lanche</td>
                            <td>lanche</td>
                            <td>lanche</td>
                            <td>lanche</td>
                            </tr> 

                            <tr>
                            <th scope="row">3º horário</th>
                            <td>Larry the</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                            </tr>
                            <tr>
                            <th scope="row">4º horário</th>
                            <td>Larry the</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                            <td>@twitter</td>
                            </tr>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>    
                    </tbody>
                </table>            
            </div>
        </div>
    </div>
</div>
@endif
@endsection