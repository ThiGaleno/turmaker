window.onload = function(){
    console.log('teste');
}

function my() {
    document.getElementById("demo").innerHTML = "Hello World";
    
}

function atualizarHorario($id , $turma, $periodo){

}

$(document).ready(function(){
    $('.atualizaHorario').change(function() {        
        let meuHorario = this.value;        
        console.log(meuHorario)
        
        /*$.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/horarios' ,
            data: {
                "_token": "{{ csrf_token() }}",
                nome: 'thiago galã',
                gata: 'amorzoca'        
            }            
        }); 
        */       
    });
});




function captarHorarios(){
    console.log('function success');
}