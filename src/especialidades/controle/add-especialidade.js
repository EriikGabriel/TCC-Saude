$(document).ready(function () {
  $(document).on("click", ".btn-add", function () {
    $("#modal-especialidade .modal-body").load("form-especialidade.html");
    $("#modal-especialidade .modal-title h4").html("Cadastrar Especialidade");
    $("#modal-especialidade .modal-footer #btn-cad").removeClass("d-none");
    $("#modal-especialidade .modal-footer #btn-alt").addClass("d-none");
    $("#modal-especialidade").modal("show");
  });

  $(document).on("click", "#btn-cad", function (e) {
    e.preventDefault();

    var dados = $("#form-especialidade").serialize();
    var url = "../modelo/create-especialidade.php";

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
            text: "Essa especialidade já foi cadastrada",
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
  });
});
