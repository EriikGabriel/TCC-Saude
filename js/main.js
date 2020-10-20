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
// Dashboard
// Animate the element's value from x to y:
$({ someValue: 0 }).animate({ someValue: Math.floor(Math.random() * 3000) }, {
  duration: 3000,
  easing: 'swing', // can be anything
  step: function () { // called on every step
      // Update the element's text with rounded-up value:
      $('.count').text(commaSeparateNumber(Math.round(this.someValue)));
  }
});

function commaSeparateNumber(val) {
  while (/(\d+)(\d{3})/.test(val.toString())) {
      val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
  }
  return val;
}