@extends('layout.template')

@section('titulo','Bem vindo ao Turmaker - Professores')

@section('conteudo')

<div class="container">
    <div class="panel panel-primary">
        <div class="card">
            <div class="card-header">                
                <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
                        Cadastrar
                </button>
            </div>
            <ul class="list-group list-group-flush">

                <div class="row">
                    <div class="col-sm">
                        <li class="list-group-item">Informática</li>
                    </div>   
                    <div class="col-sm">
                        <li class="list-group-item">Thiago</li>
                    </div>  
                    <div class="col-sm">
                        <li class="list-group-item">X</li>
                    </div>
                </div>

             
                <div class="row">
                        <div class="col">
                            <li class="list-group-item">Dança</li>
                        </div>   
                        <div class="col">
                            <li class="list-group-item">Sabrina Sato</li>
                        </div>  
                        <div class="col">
                            <li class="list-group-item">X</li>
                        </div>
            </div>


            </ul>
           
        </div>


    </div>

</div>

@endsection
