$(document).ready(function () {
  $.ajax({
    type: "POST",
    datatype: "json",
    url: "conexao/conn-session.php",
    async: true,
    success: function (response) {
      if (response != false) {
        response = JSON.parse(response);

        switch(response.idTipoUsuario) {
          case 2:
            $(".manage-tipo-usuario").addClass("d-none");
            $(".manage-especialidade").addClass("d-none");
            $(".manage-tipo-unidade").addClass("d-none");
            $(".manage-unidade").addClass("d-none");
            $(".manage-medico").addClass("d-none");
            $(".manage-atendimento").addClass("d-none");
            $(".dropdown-divider").removeClass("dropdown-divider")

            $("div.manage-usuario").toggleClass("col-md-3 col-md-6");
            $("div.manage-hospital").toggleClass("col-md-3 col-md-6");
            $("div.manage-paciente").toggleClass("col-md-3 col-md-6");
            $("div.manage-encaminhamento").toggleClass("col-md-3 col-md-6");
            break;
          case 3:
            $(".manage-tipo-usuario").addClass("d-none");
            $(".manage-tipo-unidade").addClass("d-none");
            $(".manage-hospital").addClass("d-none");
            $(".manage-paciente").addClass("d-none");
            $(".dropdown-divider").removeClass("dropdown-divider")

            $("div.manage-usuario").toggleClass("col-md-3 col-md-4");
            $("div.manage-especialidade").toggleClass("col-md-3 col-md-4");
            $("div.manage-unidade").toggleClass("col-md-3 col-md-4");
            $("div.manage-medico").toggleClass("col-md-3 col-md-4");
            $("div.manage-encaminhamento").toggleClass("col-md-3 col-md-4");
            $("div.manage-atendimento").toggleClass("col-md-3 col-md-4");
            break;
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

  $.ajax({
    type: "POST",
    datatype: "json",
    url: "php/main.php",
    async: true,
    data: {  
      id: JSON.stringify([
        JSON.parse(localStorage.getItem("login")).id, 
        JSON.parse(localStorage.getItem("login")).tipo
      ])
    },
    success: function (res) {
      if (res != "") {
        res = JSON.parse(res)[0]
        $(".username").html(res.nomeUsuario)
        $(".type-user").html(res.tipoUsuario)
      }
    },
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