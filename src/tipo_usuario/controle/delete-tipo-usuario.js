$(document).ready(function () {
  $(document).on("click", ".btn-delete", function (e) {
    $("#modal-tipo-usuario .modal-body").data("content", $(this).attr("id"));
    url = "../modelo/select-tipo-usuario.php";
    var dados = { 
      id: $(this).attr("id"),
      type: "count-dados"
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        dados = JSON.parse(dados)[0]
        if (dados.count > 0) {       
          var text = "O registro que será deletado está sendo usado como referência em outras tabelas, ao confirmar, você corre o risco de perder todos os registros ligados a esse Tipo de Usuário"
        } else {
          var text = "O registro será deletado permanentemente!"
        }
        
        Swal.fire({
          title: "Você tem certeza?",
          text: text,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sim, delete isso!",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.value) {
            url = "../modelo/delete-tipo-usuario.php";
            var dados = { id: $(".modal-body").data("content") };

            $.ajax({
              type: "POST",
              datatype: "json",
              url: url,
              async: true,
              data: dados,
              success: function (dados) {
                console.log(dados)
                if (dados == "true") {
                  Swal.fire("Deletado!", "Seus dados foram deletados.", "success").then((result) => {
                    if (result.value) location.reload();
                  });
                }
              },
            });
          }
        });
      },
    });
  });
});
