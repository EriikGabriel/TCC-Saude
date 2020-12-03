$(document).ready(function () {
  $(document).on("click", ".btn-delete", function (e) {
    $("#modal-usuario .modal-body").data("content", $(this).attr("id"));
    url = "../modelo/select-usuario.php";
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
          var text = "O registro que será deletado está sendo usado como referência em outras tabelas, ao confirmar, você corre o risco de perder todos os registros ligados a esse Usuário"
        } else {
          var text = "O registro será deletado permanentemente!"
        }

        Swal.fire({
          title: "Aviso!",
          text: text,
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Estou ciente!",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if(result.value) {
            if(JSON.parse(localStorage.getItem("login")).id == $(".modal-body").data("content")) {
              var text = "Você está atualmente logado na conta que será deletada, ao confirmar, você voltará para o login!"
              var loggedAcount = true;
            } else {
              var text = "Realmente deseja deletar este usuário? A ação não pode ser desfeita"
              var loggedAcount = false;
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
              url = "../modelo/delete-usuario.php";
              var dados = { id: $(".modal-body").data("content") };
        
              if (result.value) {
                $.ajax({
                  type: "POST",
                  datatype: "json",
                  url: url,
                  async: true,
                  data: dados,
                  success: function (dados) {
                    if (dados == "true") {
                      Swal.fire("Deletado!", "Seus dados foram deletados.", "success").then((result) => {
                        if (result.value) {
                          if(loggedAcount) {
                            $.ajax({
                              type: "POST",
                              datatype: "json",
                              url: "../../../conexao/conn-session.php",
                              async: true,
                              data: { destroy: true },
                              success: function (response) {
                                if (response == "") {
                                  localStorage.setItem("login", "false");
                                  location.href = "../../../index.html";
                                }
                              },
                            });
                          } else {
                            location.reload()
                          }
                        }
                      });
                    }
                  },
                });
              }
            });
          }
        })
      }
    })

    
  });
});
