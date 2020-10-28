$(document).ready(function () {
  $(document).on("click", ".btn-add", function () {
    $("#modal-tipo-unidade .modal-body").load("form-tipo-unidade.html");
    $("#modal-tipo-unidade .modal-title h4").html("Cadastrar Tipo de Unidade");
    $("#modal-tipo-unidade .modal-footer #btn-cad").removeClass("d-none");
    $("#modal-tipo-unidade .modal-footer #btn-alt").addClass("d-none");
    $("#modal-tipo-unidade").modal("show");
  });

  $(document).on("click", "#btn-cad", function (e) {
    e.preventDefault();

    var dados = $("#form-tipo-unidade").serialize();
    var url = "../modelo/create-tipo-unidade.php";

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
