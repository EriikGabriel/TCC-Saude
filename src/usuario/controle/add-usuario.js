$(document).ready(function () {
  $(document).on("click", ".btn-add", function () {
    $("#modal-usuario .modal-body").load("cadastro-usuario.html");
    $("#modal-usuario .modal-title h4").html("Cadastrar Usuário");

    var url = "../modelo/select-usuario.php";
    var dados = { type: "search-select-usuario", table: "TIPO_USUARIO" };

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
            $(`<option value="${resTipo[i].idTipoUsuario}">${resTipo[i].tipoUsuario}</option>`).appendTo(
              'select[name="idTipoUsuario"]'
            );
          }
        }
      },
    });

    $("#modal-usuario").modal("show");
  });

  $("#eye-password").click(function () {
    $("input[name='senha']").attr("type") == "password"
      ? $("input[name='senha']").attr("type", "text")
      : $("input[name='senha']").attr("type", "password");
    $("#eye-password i").toggleClass("fa-eye-slash fa-eye");
  });

  $(document).on("submit", "#add-usuario", function (e) {
    e.preventDefault();

    if ($('input[name = "senha"]').val() === $('input[name = "confirmarSenha"]').val()) {
      var dados = $("#add-usuario").serialize();
      var url = "../modelo/create-usuario.php";

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
          } else if (dados.includes("23000")) {
            Swal.fire({
              title: "Erro!",
              text: "Esse usuário já foi cadastrado",
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
    } else {
      Swal.fire({
        title: "Erro!",
        text: "As senhas não coincidem!",
        icon: "error",
        confirmButtonText: "Tente novamente",
      });
    }
  });
});
