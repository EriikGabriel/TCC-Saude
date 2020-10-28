$(document).ready(function () {
  $(document).on("click", ".btn-edit", function () {
    $("#modal-hospital .modal-body").load("form-hospital.html");
    $("#modal-hospital .modal-body").data("content", $(this).attr("id"));
    $("#modal-hospital .modal-title h4").html("Editar Hospital");
    $("#modal-hospital .modal-footer #btn-alt").removeClass("d-none");
    $("#modal-hospital .modal-footer #btn-cad").addClass("d-none");
    $("#modal-hospital").modal("show");
  });

  $("#modal-hospital").on("show.bs.modal", function (e) {
    if ($(".modal-body").data("content") && $("#btn-cad").hasClass('d-none')) {
      var url = "../modelo/select-hospital.php";
      var dados = {
        type: "search-select-hospital",
        table: "USUARIO",
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
              $(`<option value="${resTipo[i].idUsuario}">${resTipo[i].nomeUsuario}</option>`).appendTo(
                'select[name="idUsuario"]'
              );
            }
          }

          var dados = {
            id: $(".modal-body").data("content"),
            type: "search-data-hospital",
          };

          $.ajax({
            type: "POST",
            datatype: "json",
            url: url,
            async: true,
            data: dados,
            success: function (dados) {
              var dados = JSON.parse(dados)[0];

              $("#nome").val(dados.nomeHospital);
              $("#rua").val(dados.ruaHospital);
              $("#bairro").val(dados.bairroHospital);
              $("#cep").val(dados.cepHospital);
              $("#tel").val(dados.telefoneHospital);
              $("#idUsuario").val(dados.idUsuario);
            },
          });
        },
      });
    }
  });

  $(document).on("click", "#btn-alt", function (e) {
    e.preventDefault();

    url = "../modelo/edit-hospital.php";

    var dados = {
      id: $(".modal-body").data("content"),
      nome: $("#nome").val(),
      rua: $("#rua").val(),
      bairro: $("#bairro").val(),
      cep: $("#cep").val(),
      tel: $("#tel").val(),
      idUsuario: $("#idUsuario").val(),
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if (dados == "true") {
          location.href = "list-hospital.html";
        }
      },
    });
  });
});
