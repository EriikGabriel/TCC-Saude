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
              if (result.value) {
                var url = "../modelo/select-encaminhamento.php";
                var dados = {
                  type: "search-select-encaminhamento",
                  sql: ":edit-vagas",
                  id: e.target.id,
                };
          
                $.ajax({
                  type: "POST",
                  datatype: "json",
                  url: url,
                  async: true,
                  data: dados,
                  success: function (dadoUni) {
                    console.log(dadoUni)
                    dadoUni = JSON.parse(dadoUni)[0];
                    var url = "../../unidade_saude/modelo/edit-unidade-saude.php";
                    var dados = {
                      id: dadoUni.idUnidadeSaude,
                      vagas: dadoUni.vagas + 1
                    }

                    $.ajax({
                      type: "POST",
                      datatype: "json",
                      url: url,
                      async: true,
                      data: dados,
                      success: function (dados) {
                        url = "../modelo/delete-encaminhamento.php";
                        var dados = { id: e.target.id };

                        $.ajax({
                          type: "POST",
                          datatype: "json",
                          url: url,
                          async: true,
                          data: dados,
                          success: function (dados) {
                            if (dados == "true") location.reload()
                          },
                        });
                      }
                    })
                  }
                })
              }
            });
          }
        },
      });
    }
  });
});
