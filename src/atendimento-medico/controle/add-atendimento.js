$(document).ready(function () {
  $(document).on("click", ".btn-add", function () {
    $("#modal-atendimento .modal-body").load("cadastro-atendimento.html");
    $("#modal-atendimento .modal-title h4").html("Cadastrar Horário");

    var url = "../modelo/select-atendimento.php";

    for (let i = 1; i <= 2; i++) {
      if (i === 1) {
        var dados = { type: "search-select-atendimento", table: "MEDICO" };
      } else {
        var dados = { type: "search-select-atendimento", table: "UNIDADE_SAUDE" };
      }

      $.ajax({
        type: "POST",
        datatype: "json",
        url: url,
        async: true,
        data: dados,
        success: function (dados) {
          if (dados != "") {
            var res = JSON.parse(dados);
            if (i == 1) {
              for (let i = 0; i < res.length; i++) {
                $(`<option value="${res[i].CRM}">${res[i].nomeMedico}</option>`).appendTo('select[name="CRM"]');
              }
            } else {
              for (let i = 0; i < res.length; i++) {
                $(`<option value="${res[i].idUnidadeSaude}">${res[i].nomeUnidadeSaude}</option>`).appendTo(
                  'select[name="idUnidadeSaude"]'
                );
              }
            }
          }
        },
      });
    }

    $("#modal-atendimento").modal("show");
  });

  $(document).on("submit", "#add-atendimento", function (e) {
    e.preventDefault();

    var dados = $("#add-atendimento").serialize();
    var url = "../modelo/create-atendimento.php";

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if (dados == "true") {
          Swal.fire({
            title: "Sucesso!",
            text: "Cadastro efetuado com sucesso",
            icon: "success",
            confirmButtonText: "Feito",
          }).then((result) => {
            if (result.value) {
              location.reload();
            }
          });
        } else {
          Swal.fire({
            title: "Erro!",
            text: dados,
            icon: "error",
            confirmButtonText: "Tente novamente",
          });
        }
      },
    });
  });
});
