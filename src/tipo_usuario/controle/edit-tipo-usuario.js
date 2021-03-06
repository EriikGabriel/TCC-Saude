$(document).ready(function () {
  $(document).on("click", ".btn-edit", function () {
    $("#modal-tipo-usuario .modal-body").load("form-tipo-usuario.html");
    $("#modal-tipo-usuario .modal-body").data("content", $(this).attr("id"));
    $("#modal-tipo-usuario .modal-title h4").html("Editar Tipo de Usuário");
    $("#modal-tipo-usuario .modal-footer #btn-alt").removeClass("d-none");
    $("#modal-tipo-usuario .modal-footer #btn-cad").addClass("d-none");
    $("#modal-tipo-usuario").modal("show");
  });

  $("#modal-tipo-usuario").on("show.bs.modal", function (e) {
    if ($(".modal-body").data("content") && $("#btn-cad").hasClass('d-none')) {
      var url = "../modelo/select-tipo-usuario.php";

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

          $("#tipo").val(dados.tipoUsuario);
        },
      });
    }
  });

  $(document).on("click", "#btn-alt", function (e) {
    e.preventDefault();

    url = "../modelo/edit-tipo-usuario.php";
    var dados = {
      id: $(".modal-body").data("content"),
      tipo: $("#tipo").val(),
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if (dados == "true") {
          location.href = "list-tipo-usuario.html";
        }
      },
    });
  });
});
