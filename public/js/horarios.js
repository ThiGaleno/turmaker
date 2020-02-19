function setOffMessage() {
    document.getElementById("status").style.transition = "opacity 2s";
    document.getElementById("status").style.opacity = "0%";

}

function setOnMessage() {
    document.getElementById("status").style.transition = "opacity 0s";
    document.getElementById("status").style.opacity = "100%";

}

function successMsg() {
    setOnMessage()
    document.getElementById("status").style.backgroundColor =
        "mediumseagreen";
    document.getElementById("status").textContent =
        "Atualizado com Sucesso!";
    setTimeout(setOffMessage, 2000); //função localizada na linha 1
}

function errorMsg() {
    setOnMessage()
    document.getElementById("status").style.backgroundColor = "tomato";
    document.getElementById("status").textContent =
        "Não foi possível atualizar, tente novamente";
    setTimeout(setOffMessage, 2000);
}

function loadingMsg() {
    setOnMessage()
    document.getElementById("status").style.backgroundColor =
        "grey";
    document.getElementById("status").style.opacity = "100%";
    document.getElementById("status").textContent = "Carregando...";
}



$(document).ready(function () {
    $(".atualizaHorario").change(function () {
        let meuHorario = this.value;
        const token = $("#token").val();
        let horario = JSON.parse(meuHorario);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": token
            },
            type: "POST",
            url: "/horarios/editar/2",
            data: {
                _token: token,
                id_materia: horario["idMateria"],
                ordem_aula: horario["ordem_aula"],
                dia: horario["dia"],
                turma_id: horario["turma_id"],
                periodo: horario["periodo"]
            },
            //dataType: "json", //tipo de dado que deve retornar para que success seja true
            beforeSend: function () {
                loadingMsg()
            },

            success: function (data) {
                successMsg()
            },

            error: function (data) {
                errorMsg()
            }
        });
    });
});

function captarHorarios() {
    console.log("function success");
}
