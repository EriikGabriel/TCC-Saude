$(document).ready(function () {
    $(document).on('click', '.btn-add', function () {
        $("#modal-usuario .modal-body").load("cadastro-usuario.html")
        $("#modal-usuario .modal-title h4").html("Cadastrar Usuário")

        var url = "../modelo/select-usuario.php"
        var dados = {
            "type": "search-select-usuario",
            "table": "TIPO_USUARIO"
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function (dados) {
                if (dados != "") {
                    var resTipo = JSON.parse(dados)
                    for (let i = 0; i < resTipo.length; i++) {
                        $(
                            `<option value="${resTipo[i].idTipoUsuario}">${resTipo[i].tipoUsuario}</option>`
                        ).appendTo('select[name="idTipoUsuario"]')
                    }
                }
            }
        })

        $('#modal-usuario').modal('show')
    })

    $(document).on('submit', '#add-usuario', function (e) {
        e.preventDefault()

        var dados = $('#add-usuario').serialize()
        var url = "../modelo/create-usuario.php"
        //
        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function (dados) {
                if (dados == "true") {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: "Cadastro efetuado com sucesso",
                        icon: 'success',
                        confirmButtonText: 'Feito'
                    }).then((result) => {
                        if (result.value) {
                            location.reload()
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Erro!',
                        text: dados,
                        icon: 'error',
                        confirmButtonText: 'Tente novamente'
                    })
                }
            }
        })
    })
})