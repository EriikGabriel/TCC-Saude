$(document).ready(function () {
  $(document).on("click", ".btn-forward", function () {
    if (JSON.parse(localStorage.getItem("login")).id != "false") {
      $("#modal-paciente .modal-body").load("forward-paciente.html");
      $("#modal-paciente .modal-body").data("content", $(this).attr("id"));
      $("#modal-paciente .modal-title h4").html("Encaminhar Paciente");
      $("#modal-paciente .modal-footer #btn-cad").addClass("d-none");
      $("#modal-paciente .modal-footer #btn-alt").addClass("d-none");
      $("#modal-paciente .modal-footer #btn-fwd").removeClass("d-none");

      var url = "../modelo/select-paciente.php";
      var dados = {
        type: "search-select-paciente",
        sql: "SELECT * FROM PACIENTE WHERE idPaciente = ?",
        id: $(this).attr("id"),
      };

      $.ajax({
        type: "POST",
        datatype: "json",
        url: url,
        async: true,
        data: dados,
        success: function (dados) {
          if (dados != "") {
            var resPac = JSON.parse(dados);
            for (let i = 0; i < resPac.length; i++) {
              $(`<option value="${resPac[i].idPaciente}">${resPac[i].nomePaciente}</option>`).appendTo(
                'select[name="idPaciente"]'
              );
            }
            $("#idPaciente").val(resPac[0].idPaciente);

            var url = "../modelo/select-paciente.php";
            var dados = {
              type: "search-select-paciente",
              sql: ":encaminhamento",
              id: JSON.stringify({idPaciente: resPac[0].idPaciente}),
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
                  var optUni = $('select[name="idUnidadeSaude"]')[0].innerText;
                  if (optUni.includes(res[i].nomeUnidadeSaude) == false) {
                    $(`<option class="options response-unidade" value="${res[i].idUnidadeSaude}">
                    ${res[i].nomeUnidadeSaude}</option>`).appendTo('select[name="idUnidadeSaude"]');
                  }
    
                  var optEsp = $('select[name="idEspecialidade"]')[0].innerText;
                  if (optEsp.includes(res[i].tipoEspecialidade) == false) {
                    $(`<option class="options" value="${res[i].tipoEspecialidade}">
                    ${res[i].tipoEspecialidade}</option>`).appendTo('select[name="idEspecialidade"]');
                  }
    
                  var optHor = $('select[name="idHorario"]')[0].innerText;
                  if (optHor.includes(res[i].horarioMedico) == false) {
                    var splitDate = res[i].horarioMedico.split(" ");
                    var convertDate = splitDate[0].split("/").reverse().join("-") + " " + splitDate[1];
                    $(`<option class="options" value="${res[i].idAtendimento}" data-convert="${convertDate}">
                    ${res[i].horarioMedico}</option>`).appendTo('select[name="idHorario"]');
                  }
                }
              },
            });
          }
        },
      });
      $("#modal-paciente").modal("show");
    } else {
      Swal.fire({
        title: "Erro!",
        text: "Não é possível realizar um encaminhamento, o usuário não está logado!",
        icon: "error",
        confirmButtonText: "Entendi",
      });
    }
  });

  $(document).on("change", "#form-forward select", function (e) {
    if (e.target.name == "idPaciente") {
      $("#form-paciente .form-row:not(:first-child) select").removeAttr("disabled");
      $(".options").remove();
    }

    if (e.target.name != "idUnidadeSaude") {
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
        var url = "../modelo/select-paciente.php";
        var dados = {
          type: "search-select-paciente",
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
              var optUni = $('select[name="idUnidadeSaude"]')[0].innerText;
              if (optUni.includes(res[i].nomeUnidadeSaude) == false) {
                $(`<option class="options response-unidade" value="${res[i].idUnidadeSaude}">
                ${res[i].nomeUnidadeSaude}</option>`).appendTo('select[name="idUnidadeSaude"]');
              }

              var optEsp = $('select[name="idEspecialidade"]')[0].innerText;
              if (optEsp.includes(res[i].tipoEspecialidade) == false) {
                $(`<option class="options" value="${res[i].tipoEspecialidade}">
                ${res[i].tipoEspecialidade}</option>`).appendTo('select[name="idEspecialidade"]');
              }

              var optHor = $('select[name="idHorario"]')[0].innerText;
              if (optHor.includes(res[i].horarioMedico) == false) {
                var splitDate = res[i].horarioMedico.split(" ");
                var convertDate = splitDate[0].split("/").reverse().join("-") + " " + splitDate[1];
                $(`<option class="options" value="${res[i].idAtendimento}" data-convert="${convertDate}">
                ${res[i].horarioMedico}</option>`).appendTo('select[name="idHorario"]');
              }
            }
          },
        });
      }
    }
  });

  $(document).on("click", "#btn-fwd", function (e) {
    e.preventDefault();

    var url = "../modelo/select-paciente.php";
    var dados = {
      type: "search-select-paciente",
      sql: "SELECT idHospital FROM HOSPITAL WHERE idUsuario = ?",
      id: JSON.parse(localStorage.getItem("login")).id,
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dadoHosp) {
        dadoHosp = JSON.parse(dadoHosp)[0];

        var url = "../modelo/select-paciente.php";
        var dados = {
          type: "search-select-paciente",
          sql: "SELECT vagas FROM UNIDADE_SAUDE WHERE idUnidadeSaude = ?",
          id: $('select[name="idUnidadeSaude"]').val(),
        };

        $.ajax({
          type: "POST",
          datatype: "json",
          url: url,
          async: true,
          data: dados,
          success: function (dadoUni) {
            dadoUni = JSON.parse(dadoUni)[0];

            var url = "../../encaminhamento/modelo/create-encaminhamento.php";
            var dados = {
              idUnidadeSaude: $('select[name="idUnidadeSaude"]').val(),
              idPaciente: $('select[name="idPaciente"]').val(),
              idAtendimento: $('select[name="idHorario"]').val(),
              idHospital: dadoHosp.idHospital,
              idUsuario: JSON.parse(localStorage.getItem("login")).id
            };

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
                    var url = "../../unidade_saude/modelo/edit-unidade-saude.php";
                    var dados = {
                      id: $('select[name="idUnidadeSaude"]').val(),
                      vagas: dadoUni.vagas - 1
                    };

                    $.ajax({
                      type: "POST",
                      datatype: "json",
                      url: url,
                      async: true,
                      data: dados,
                      success: function (dados) {
                        if (dados == "true") location.href = "../../encaminhamento/visao/list-encaminhamento.html"
                      }
                    })
                  });
                } else if (dados.includes("23000")) {
                  Swal.fire({
                    title: "Erro!",
                    text: "Esse CRM já foi cadastrado",
                    icon: "error",
                    confirmButtonText: "Tente novamente",
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
          }
        })
      },
    });
  });
});
