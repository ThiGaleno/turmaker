function atualizarHorario($id, $turma, $periodo) {}

$(document).ready(function () {
    $(".atualizaHorario").change(function () {
        let meuHorario = this.value;
        let atualizaHorario = JSON.parse(meuHorario);
        console.log(atualizaHorario["idMateria"]);
        console.log(atualizaHorario["ordem_aula"]);
        console.log(atualizaHorario["dia"]);
        const id_turma = atualizaHorario["turma_id"];
        console.log(atualizaHorario["periodo"]);
    });
});

$.ajax({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    type: "POST",
    url: "/horarios/editar/2",
    data: {
        "_token": "{{ csrf_token() }}",
        nome: "thiagoCG",
    },
    dataType: "json",
    success: function (response) {
        console.log(response + "ta rolando um ajax aqui");
    }
});

function captarHorarios() {
    console.log("function success");
}
