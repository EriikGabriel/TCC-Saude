$(document).ready(function () {
  $(document).on("click", ".btn-edit", function () {
    $("#modal-atendimento .modal-body").load("form-atendimento.html");
    $("#modal-atendimento .modal-body").data("content", $(this).attr("id"));
    $("#modal-atendimento .modal-title h4").html("Editar Atendimento");
    $("#modal-atendimento .modal-footer #btn-alt").removeClass("d-none");
    $("#modal-atendimento .modal-footer #btn-cad").addClass("d-none");
    $("#modal-atendimento").modal("show");
  });

  $("#modal-atendimento").on("show.bs.modal", function (e) {
    if ($(".modal-body").data("content") && $("#btn-cad").hasClass('d-none')) {
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

              var dados = { id: $(".modal-body").data("content"), type: "search-data-atendimento" };

              $.ajax({
                type: "POST",
                datatype: "json",
                url: url,
                async: true,
                data: dados,
                success: function (dados) {
                  var dados = JSON.parse(dados)[0];
                  var dataHora = dados.horarioMedico.split(" ");

                  $("#data").val(dataHora[0]);
                  $("#horario").val(dataHora[1]);
                  $("#CRM").val(dados.CRM);
                  $("#idUnidadeSaude").val(dados.idUnidadeSaude);
                },
              });
            }
          },
        });
      }
    }
  });

  $(document).on("click", "#btn-alt", function (e) {
    e.preventDefault();

    url = "../modelo/edit-atendimento.php";

    var dados = {
      id: $(".modal-body").data("content"),
      horario: $("#data").val() + " " + $("#horario").val(),
      crm: $("#CRM").val(),
      idUnidadeSaude: $("#idUnidadeSaude").val(),
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if (dados == "true") {
          location.href = "list-atendimento.html";
        }
      },
    });
  });
});
