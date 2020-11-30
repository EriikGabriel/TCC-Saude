$(document).ready(function () {
  $(document).on("click", ".btn-delete", function (e) {
    url = "../modelo/select-medico.php";
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
          var text = "O registro que será deletado está sendo usado como referência em outras tabelas, ao confirmar, você corre o risco de perder todos os registros ligados a esse Médico"
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
            url = "../modelo/delete-medico.php";
            var dados = { id: e.target.id };

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
