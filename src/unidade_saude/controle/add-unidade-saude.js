$(document).ready(function () {
  $(document).on("click", ".btn-add", function () {
    $("#modal-unidade-saude .modal-body").load("form-unidade-saude.html");
    $("#modal-unidade-saude .modal-title h4").html("Cadastrar Unidade de Saúde");
    $("#modal-unidade-saude .modal-footer #btn-cad").removeClass("d-none");
    $("#modal-unidade-saude .modal-footer #btn-alt").addClass("d-none");

    var url = "../modelo/select-unidade-saude.php";
    var dados = {
      type: "search-select-unidade",
      table: "TIPO_UNIDADE",
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if (dados != "") {
          var resTipo = JSON.parse(dados);

          for (let i = 0; i < resTipo.length; i++) {
            $(`<option value="${resTipo[i].idTipoUnidade}">${resTipo[i].tipoUnidade}</option>`).appendTo(
              'select[name="idTipoUnidade"]'
            );
          }
        }
      },
    });

    $("#modal-unidade-saude").modal("show");
  });

  $(document).on("click", "#btn-cad", function (e) {
    e.preventDefault();

    var dados = $("#form-unidade-saude").serialize();
    var url = "../modelo/create-unidade-saude.php";

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
