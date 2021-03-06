$(document).ready(function () {
  $(document).on("click", ".btn-edit", function () {
    $("#modal-medico .modal-body").load("form-medico.html");
    $("#modal-medico .modal-body").data("content", $(this).attr("id"));
    $("#modal-medico .modal-title h4").html("Editar Médico");
    $("#modal-medico .modal-footer #btn-alt").removeClass("d-none");
    $("#modal-medico .modal-footer #btn-cad").addClass("d-none");
    $("#modal-medico").modal("show");
  });

  $("#modal-medico").on("show.bs.modal", function (e) {
    if ($(".modal-body").data("content") && $("#btn-cad").hasClass('d-none')) {
      var url = "../modelo/select-medico.php";
      var dados = {
        type: "search-select-medico",
        table: "ESPECIALIDADE",
      };

      $.ajax({
        type: "POST",
        datatype: "json",
        url: url,
        async: true,
        data: dados,
        success: function (dados) {
          if (dados != "") {
            var resEsp = JSON.parse(dados);

            for (let i = 0; i < resEsp.length; i++) {
              $(`<option value="${resEsp[i].idEspecialidade}">${resEsp[i].tipoEspecialidade}</option>`).appendTo(
                'select[name="idEspecialidade"]'
              );
            }

            var dados = {
              id: $(".modal-body").data("content"),
              type: "search-data-medico",
            };

            $.ajax({
              type: "POST",
              datatype: "json",
              url: url,
              async: true,
              data: dados,
              success: function (dados) {
                var dados = JSON.parse(dados)[0];

                $("#crm").val(dados.CRM);
                $("#nome").val(dados.nomeMedico);
                $("#idEspecialidade").val(dados.idEspecialidade);
              },
            });
          }
        },
      });
    }
  });

  $(document).on("click", "#btn-alt", function (e) {
    e.preventDefault();

    url = "../modelo/edit-medico.php";

    var dados = {
      id: $(".modal-body").data("content"),
      crm: $("#crm").val(),
      nome: $("#nome").val(),
      idEspecialidade: $("#idEspecialidade").val(),
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if (dados == "true") {
          location.href = "list-medico.html";
        }
      },
    });
  });
});
