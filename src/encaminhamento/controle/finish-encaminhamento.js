$(document).on("click", ".btn-finish", function (e) {
  Swal.fire({
    title: "Você tem certeza?",
    text: "O status do encaminhamento será alterado e não poderá ser desfeito!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sim, concluír encaminhamento!",
  }).then((result) => {
    if (result.value) {
      var url = "../modelo/edit-encaminhamento.php";
      var dados = {
        id: $(this).attr("id"),
        finish: "true",
      };

      $.ajax({
        type: "POST",
        datatype: "json",
        url: url,
        async: true,
        data: dados,
        success: function (dados) {
          if (dados == "true") {
            Swal.fire("Sucesso!", "Encaminhamento concluido!", "success").then((result) => {
              if (result.value) location.reload();
            });
          }
        },
      });
    }
  });
});
