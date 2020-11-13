$(document).ready(function () {
  $(document).on("click", ".btn-delete", function (e) {
    if(JSON.parse(localStorage.getItem("login")).id == e.target.id) {
      var text = "Você está atualmente logado na conta que será deletada, ao confirmar, você voltará para o login!"
      var loggedAcount = true;
    } else {
      var text = "O registro será deletado permanentemente!"
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
    }).then((result) => {
      url = "../modelo/delete-usuario.php";
      var dados = { id: $(this).attr("id") };

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
  });
});
