$(document).ready(function () {
  var url = location.href;
  var path_absoluto = url.split("/")[url.split("/").length - 1];
  var error;

  if (path_absoluto.includes("home.html") || path_absoluto == "") {
    url = "conexao/conn-session.php";
    error = "error-page.html";
  } else {
    url = "../../../conexao/conn-session.php";
    error = "../../../error-page.html";
  }

  $.ajax({
    type: "POST",
    datatype: "json",
    url: url,
    async: true,
    success: function (response) {
      if (response == false) location.href = error;
    },
  });
});
