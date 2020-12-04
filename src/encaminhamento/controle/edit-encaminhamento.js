$(document).ready(function () {
  $(document).on("click", ".btn-edit", function () {
    $("#modal-encaminhamento .modal-body").load("form-encaminhamento.html");
    $("#modal-encaminhamento .modal-body").data("content", $(this).attr("id"));
    $("#modal-encaminhamento .modal-title h4").html("Editar Encaminhamento");
    $("#modal-encaminhamento .modal-footer #btn-alt").removeClass("d-none");
    $("#modal-encaminhamento .modal-footer #btn-cad").addClass("d-none");
    $("#modal-encaminhamento").modal("show");
  });

  $("#modal-encaminhamento").on("show.bs.modal", function (e) {
    if ($(".modal-body").data("content") && $("#btn-cad").hasClass('d-none')) {
      var url = "../modelo/select-encaminhamento.php";

      for (let i = 1; i <= 2; i++) {
        if (i === 1) {
          var dados = {
            type: "search-select-encaminhamento",
            sql: "SELECT * FROM PACIENTE WHERE gravidade = ? OR gravidade = ?",
            id: JSON.stringify(["Pouco Urgente", "Não Urgente"]),
          };
        } else {
          var dados = {
            type: "search-select-encaminhamento",
            sql: ":edit-encaminhamento",
            id: $(".modal-body").data("content"),
          };
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
                  $(`<option value="${res[i].idPaciente}">${res[i].nomePaciente}</option>`).appendTo(
                    'select[name="idPaciente"]'
                  );
                }
              } else {
                $("#idPaciente").val(res[0].idPaciente);

                var dados = {
                  type: "search-select-encaminhamento",
                  sql: ":encaminhamento",
                  id: JSON.stringify({ idPaciente: res[0].idPaciente }),
                };

                $.ajax({
                  type: "POST",
                  datatype: "json",
                  url: url,
                  async: true,
                  data: dados,
                  success: function (dados) {
                    var dados = JSON.parse(dados);
                    for (let i = 0; i < dados.length; i++) {
                      var optUni = $("#idUnidadeSaude")[0].innerText;
                      if (optUni.includes(dados[i].idUnidadeSaude) == false) {
                        $(`<option class="response-unidade" value="${dados[i].idUnidadeSaude}">
                        ${dados[i].nomeUnidadeSaude}</option>`).appendTo('select[name="idUnidadeSaude"]');
                      }

                      var optEsp = $("#idEspecialidade")[0].innerText;
                      if (optEsp.includes(dados[i].tipoEspecialidade) == false) {
                        $(`<option class="options" value="${dados[i].tipoEspecialidade}">
                        ${dados[i].tipoEspecialidade}</option>`).appendTo('select[name="idEspecialidade"]');
                      }

                      var optHor = $("#idHorario")[0].innerText;
                      if (optHor.includes(dados[i].horarioMedico) == false) {
                        var splitDate = dados[i].horarioMedico.split(" ");
                        var convertDate = splitDate[0].split("/").reverse().join("-") + " " + splitDate[1];
                        $(`<option class="options" value="${dados[i].idAtendimento}" data-convert="${convertDate}">
                        ${dados[i].horarioMedico}</option>`).appendTo('select[name="idHorario"]');
                      }
                    }
                    $("#idUnidadeSaude").val(res[0].idUnidadeSaude);
                  },
                });
              }
            }
          },
        });
      }
    }
  });

  $(document).on("change", "#form-encaminhamento select", function (e) {
    if (e.target.name == "idPaciente") {
      $("#form-encaminhamento .form-row:not(:first-child) select").removeAttr("disabled");
      $(".options").remove();
    }

    if (e.target.name == "idPaciente" && $(this)[0].value == "")
      $("#form-encaminhamento .form-row:not(:first-child) select").attr("disabled", "disable");

    if ($("#idPaciente")[0].value != "" && e.target.name != "idUnidadeSaude") {
      $(".response-unidade").remove();

      if (e.target.name != "idUnidadeSaude") {
        var selects = $("select:not([name='idUnidadeSaude']");
        var objIds = {
          idPaciente: null,
          tipoEspecialidade: null,
          horarioMedico: null,
        };

        for (let i = 1; i <= selects.length - 1; i++) {
          switch (selects[i].name) {
            case "idPaciente":
              objIds.idPaciente = selects[i].value;
              break;
            case "idEspecialidade":
              objIds.tipoEspecialidade = selects[i].value;
              break;
            case "idHorario":
              var selectIndex = selects[i].options.selectedIndex
              objIds.horarioMedico = selects[i].options[selectIndex].dataset.convert || ""
              break;
            default:
              break;
          }
        }

        for (var column in objIds) {
          if (objIds.hasOwnProperty(column)) if (objIds[column] == "") delete objIds[column];
        }
        var url = "../modelo/select-encaminhamento.php";
        var dados = {
          type: "search-select-encaminhamento",
          sql: ":encaminhamento",
          id: JSON.stringify(objIds),
        };

        $.ajax({
          type: "POST",
          datatype: "json",
          url: url,
          async: true,
          data: dados,
          success: function (dados) {
            var res = JSON.parse(dados);

            for (let i = 0; i < res.length; i++) {
              var optUni = $("#idUnidadeSaude")[0].innerText;
              if (optUni.includes(res[i].nomeUnidadeSaude) == false) {
                $(`<option class="options response-unidade" value="${res[i].idUnidadeSaude}">
                ${res[i].nomeUnidadeSaude}</option>`).appendTo("#idUnidadeSaude");
              }

              var optEsp = $("#idEspecialidade")[0].innerText;
              if (optEsp.includes(res[i].tipoEspecialidade) == false) {
                $(`<option class="options" value="${res[i].tipoEspecialidade}">
                ${res[i].tipoEspecialidade}</option>`).appendTo("#idEspecialidade");
              }

              var optHor = $("#idHorario")[0].innerText;
              if (optHor.includes(res[i].horarioMedico) == false) {
                var splitDate = res[i].horarioMedico.split(" ");
                var convertDate = splitDate[0].split("/").reverse().join("-") + " " + splitDate[1];
                $(`<option class="options" value="${res[i].idAtendimento}" data-convert="${convertDate}">
                ${dados[i].horarioMedico}</option>`).appendTo('select[name="idHorario"]');
              }
            }
          },
        });
      }
    }
  });

  $(document).on("click", "#btn-alt", function (e) {
    e.preventDefault();

    var url = "../modelo/select-encaminhamento.php";
    var dados = {
      type: "search-select-encaminhamento",
      sql: "SELECT idHospital FROM HOSPITAL WHERE idUsuario = ?",
      id: JSON.parse(localStorage.getItem("login")).id,
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        dados = JSON.parse(dados)[0];

        var url = "../modelo/edit-encaminhamento.php";
        var dados = {
          id: $(".modal-body").data("content"),
          idUnidadeSaude: $("#idUnidadeSaude").val(),
          idPaciente: $("#idPaciente").val(),
          idHospital: dados.idHospital,
          idUsuario: JSON.parse(localStorage.getItem("login")).id,
        };

        $.ajax({
          type: "POST",
          datatype: "json",
          url: url,
          async: true,
          data: dados,
          success: function (dados) {
            if (dados == "true") location.href = "list-encaminhamento.html";
          },
        });
      },
    });
  });
});
