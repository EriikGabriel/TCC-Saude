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


$.ajax({
  type: "POST",
  datatype: "json",
  url: "php/main.php",
  async: true,
  data: { tabelas: JSON.stringify(
    ["USUARIO", "HOSPITAL", "TIPO_USUARIO", "ESPECIALIDADE", "TIPO_UNIDADE", 
    "UNIDADE_SAUDE", "PACIENTE", "MEDICO", "ENCAMINHAMENTO", "MEDICO_ATENDE_UNIDADE"]
    ) 
  },
  success: function (response) {
    response = JSON.parse(response);
    var classes = [
      "count-usuario", "count-hospital", 
      "count-tipo-usuario", "count-especialidade", 
      "count-tipo-unidade", "count-unidade-saude", 
      "count-paciente", "count-medico", 
      "count-encaminhamento", "count-atendimento"
    ];
    for (let i = 0; i < response.length; i++) {
      animateDashboardCount(response[i]["COUNT(*)"], classes[i])
    }
  },
});

function animateDashboardCount(val, classe) {
  $({ someValue: 0 }).animate({ someValue: val }, {
    duration: 1500,
    easing: 'swing',
    step: function () { 
        $(`.${classe}`).text(commaSeparateNumber(Math.round(this.someValue)));
    }
  });
}


function commaSeparateNumber(val) {
  while (/(\d+)(\d{3})/.test(val.toString())) {
      val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
  }
  return val;
}