$(document).ready(function () {
  $(document).on("submit", "#login-usuario", function (e) {
    e.preventDefault();

    var url = "src/usuario/modelo/select-usuario.php";
    var dados = {
      id: $("input[name='nome']").val(),
      senha: $("input[name='senha']").val(),
      type: "search-data-usuario",
    };

    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if (dados != "") {
          dados = JSON.parse(dados)[0];
          localStorage.setItem("login", dados.idUsuario);
          location.href = "index.html";
        } else {
          Swal.fire({
            title: "Erro!",
            text: "A senha ou o nome de usuário está incorreto!",
            icon: "error",
            confirmButtonText: "Tente novamente",
          });
        }
      },
    });
  });
});
