$(document).ready(function () {
  $(document).on("click", ".btn-add", function () {
    $("#modal-paciente .modal-body").load("form-paciente.html");
    $("#modal-paciente .modal-title h4").html("Cadastrar Paciente");
    $("#modal-paciente .modal-footer #btn-cad").removeClass("d-none");
    $("#modal-paciente .modal-footer #btn-alt").addClass("d-none");
    $("#modal-paciente").modal("show");
  });

  $(document).on("click", "#btn-cad", function (e) {
    e.preventDefault();

    var dados = $("#form-paciente").serialize();
    var url = "../modelo/create-paciente.php";

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
