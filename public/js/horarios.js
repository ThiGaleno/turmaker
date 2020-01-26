function atualizarHorario($id, $turma, $periodo) {}

$(document).ready(function () {
    $(".atualizaHorario").change(function () {
        let meuHorario = this.value;
        const token = $('#token').val()
        let horario = JSON.parse(meuHorario);
        console.log(token)
        console.log(horario["idMateria"]);
        console.log(horario["ordem_aula"]);
        console.log(horario["dia"]);
        console.log(horario["turma_id"]);
        console.log(horario["periodo"]);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token
            },
            type: "POST",
            url: "/horarios/editar/2",
            data: {
                "_token": token,
                id_materia: horario["idMateria"],
                ordem_aula: horario["ordem_aula"],
                dia: horario["dia"],
                turma_id: horario["turma_id"],
                periodo: horario["periodo"]
            },
            dataType: "json",
            success: function (response) {
                console.log(response + "ta rolando um ajax aqui");
            }
        });


    });
});



function captarHorarios() {
    console.log("function success");
}
