$(document).ready(function () {
  $(document).on("click", ".btn-edit", function () {
    $("#modal-usuario .modal-body").load("form-usuario.html");
    $("#modal-usuario .modal-body").data("content", $(this).attr("id"));
    $("#modal-usuario .modal-title h4").html("Editar Usuário");
    $("#modal-usuario .modal-footer #btn-alt").removeClass("d-none");
    $("#modal-usuario .modal-footer #btn-cad").addClass("d-none");
    $("#modal-usuario").modal("show");
  });

  $("#modal-usuario").on("show.bs.modal", function (e) {
    if ($(".modal-body").data("content") && $("#btn-cad").hasClass('d-none')) {
      
      var url = "../modelo/select-usuario.php";
      var dados = { type: "search-select-usuario", table: "TIPO_USUARIO" };

      $.ajax({
        type: "POST",
        datatype: "json",
        url: url,
        async: true,
        data: dados,
        success: function (dados) {
          if (dados != "") {
            var resTipo = JSON.parse(dados);
            for (let i = 0; i < resTipo.length; i++) {
              $(`<option value="${resTipo[i].idTipoUsuario}">${resTipo[i].tipoUsuario}</option>`).appendTo(
                'select[name="idTipoUsuario"]'
              );
            }
            
            $.ajax({
              type: "POST",
              datatype: "json",
              url: url,
              async: true,
              data: {
                type: "search-data-usuario",
                id: $(".modal-body").data("content"),
              },
              success: function (dados) {
                dados = JSON.parse(dados)[0];
                
                $("#nome").val(dados.nomeUsuario);
                $("#senha").val(dados.senhaUsuario);
                $("#confirmarSenha").val(dados.senhaUsuario);
                $("#idTipoUsuario").val(dados.idTipoUsuario);
              },
            });
          }
        },
      });
    }
  });

  $(document).on("click", "#change-password", function () {
    $("#senha").data("cript", $("#senha").val());
    $("#change-password").addClass("d-none");
    $(".lbl-senha").html("Senha atual");
    $(".lbl-senha").removeClass("d-none");
    $("#senha").val("");
    $("#confirmarSenha").val("");
    $("#senha").removeClass("d-none");
    $("#eye-password").removeClass("d-none");
    $(".conf-senha label").html("Senha nova");
    $(".conf-senha").removeClass("d-none");
  })

  $(document).on("click", "#eye-password", function () {
    $("input[name='senha']").attr("type") == "password"
      ? $("input[name='senha']").attr("type", "text")
      : $("input[name='senha']").attr("type", "password");
    $("#eye-password i").toggleClass("fa-eye-slash fa-eye");
  });

  $(document).on("click", "#btn-alt", function (e) {
    e.preventDefault();

    var url = "../modelo/edit-usuario.php";

    if($("#change-password").hasClass('d-none')) {
      var dados = {
        idUsuario: $(".modal-body").data("content"),
        nomeUsuario: $("#nome").val(),
        idTipoUsuario: $("#idTipoUsuario").val(),
        senhaUsuario: $("#senha").val(),
        newSenha: $("#confirmarSenha").val(),
        cript: $("#senha").data("cript")
      };
    } else { 
      var dados = {
        idUsuario: $(".modal-body").data("content"),
        nomeUsuario: $("#nome").val(),
        idTipoUsuario: $("#idTipoUsuario").val(),
      };
    }
    
    $.ajax({
      type: "POST",
      datatype: "json",
      url: url,
      async: true,
      data: dados,
      success: function (dados) {
        if($("#change-password").hasClass('d-none')) {
          if(dados != "") {
            url = "../modelo/edit-usuario.php";
            var dados = {
              idUsuario: $(".modal-body").data("content"),
              nomeUsuario: $("#nome").val(),
              senhaUsuario: $("#confirmarSenha").val(),
              idTipoUsuario: $("#idTipoUsuario").val(),
            };
            
            $.ajax({
              type: "POST",
              datatype: "json",
              url: url,
              async: true,
              data: dados,
              success: function (dados) {
                console.log(dados);
                if (dados == "true") {
                  location.href = "list-usuario.html";
                }
              },
            })
          } else {
            Swal.fire({
              title: "Erro!",
              text: "A senha atual está incorreta!",
              icon: "error",
              confirmButtonText: "Tente novamente",
            });
          }
        } else {
          console.log(dados)
          if (dados == "true") {
            location.href = "list-usuario.html";
          }
        }
      },
    });
  });
});
