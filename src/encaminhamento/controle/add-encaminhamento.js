$(document).ready(function () {
  $(document).on("click", ".btn-add", function () {
    $("#modal-encaminhamento .modal-body").load("form-encaminhamento.html");
    $("#modal-encaminhamento .modal-title h4").html("Fazer Encaminhamento");
    $("#modal-encaminhamento .modal-footer #btn-cad").removeClass("d-none");
    $("#modal-encaminhamento .modal-footer #btn-alt").addClass("d-none");

    var url = "../../hospital/modelo/select-hospital.php";
    var dados = {
      type: "search-hospital-usuario",
      id: JSON.parse(localStorage.getItem("login")).id,
    };
    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if (JSON.parse(dados) != "") {  
          var url = "../modelo/select-encaminhamento.php";
          var dados = {
            type: "search-select-encaminhamento",
            sql: "SELECT * FROM PACIENTE WHERE gravidade = ? OR gravidade = ?",
            id: JSON.stringify(["Pouco Urgente", "Não Urgente"]),
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
              }
            },
          });
          $("#modal-encaminhamento").modal("show");
        } else {
          Swal.fire({
            title: "Erro!",
            text: "Não é possível realizar um encaminhamento, o usuário não está relacionado a nenhum hospital!",
            icon: "error",
            confirmButtonText: "Entendi",
          });
        }
      }
    })
    
  });

  $(document).on("change", "#form-encaminhamento select", function (e) {
    if (e.target.name == "idPaciente") {
      $("#form-encaminhamento .form-row:not(:first-child) select").removeAttr("disabled");
      $(".options").remove();
    }

    if (e.target.name == "idPaciente" && $(this)[0].value == "")
      $("#form-encaminhamento .form-row:not(:first-child) select").attr("disabled", "disable");

    if ($("select[name='idPaciente']")[0].value != "" && e.target.name != "idUnidadeSaude") {
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

  $(document).on("click", "#btn-cad", function (e) {
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
      success: function (dadoHosp) {
        dadoHosp = JSON.parse(dadoHosp)[0];

        var url = "../modelo/select-encaminhamento.php";
        var dados = {
          type: "search-select-encaminhamento",
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

            var url = "../modelo/create-encaminhamento.php";
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
                        if (dados == "true") location.reload()
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
