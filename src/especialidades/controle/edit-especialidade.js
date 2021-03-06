$(document).ready(function () {
  $(document).on("click", ".btn-edit", function () {
    $("#modal-especialidade .modal-body").load("form-especialidade.html");
    $("#modal-especialidade .modal-body").data("content", $(this).attr("id"));
    $("#modal-especialidade .modal-title h4").html("Editar Especialidade");
    $("#modal-especialidade .modal-footer #btn-alt").removeClass("d-none");
    $("#modal-especialidade .modal-footer #btn-cad").addClass("d-none");
    $("#modal-especialidade").modal("show");
  });

  $("#modal-especialidade").on("show.bs.modal", function (e) {
    if ($(".modal-body").data("content") && $("#btn-cad").hasClass('d-none')) {
      var url = "../modelo/select-especialidade.php";
      var dados = {
        id: $(".modal-body").data("content"),
        type: "search-dados",
      };

      $.ajax({
        type: "POST",
        datatype: "json",
        url: url,
        async: true,
        data: dados,
        success: function (dados) {
          var dados = JSON.parse(dados)[0];

          $("#tipo").val(dados.tipoEspecialidade);
        },
      });
    }
  });

  $(document).on("click", "#btn-alt", function (e) {
    e.preventDefault();

    url = "../modelo/edit-especialidade.php";

    var dados = {
      id: $(".modal-body").data("content"),
      tipoEspecialidade: $("#tipo").val(),
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        console.log(dados);
        if (dados == "true") {
          location.href = "list-especialidade.html";
        }
      },
    });
  });
});
