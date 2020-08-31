$(document).ready(function () {
  $.ajax({
    type: "POST",
    datatype: "json",
    url: "conexao/conn-session.php",
    async: true,
    success: function (response) {
      if (response != false) {
        response = JSON.parse(response);
        if (response.idTipoUsuario == 2) {
          $(".manage-hospital").addClass("d-none");
          $(".manage-paciente").addClass("d-none");
        }
      }
    },
  });

  $(".exit").click(function () {
    $.ajax({
      type: "POST",
      datatype: "json",
      url: "conexao/conn-session.php",
      async: true,
      data: { destroy: true },
      success: function (response) {
        if (response == "") {
          localStorage.setItem("login", "false");
          location.href = "index.html";
        }
      },
    });
  });
});
