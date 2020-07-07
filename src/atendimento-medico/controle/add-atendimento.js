$(document).ready(function () {
    $(document).on('click', '.btn-add', function () {
        $("#modal-atendimento .modal-body").load("cadastro-atendimento.html")
        $("#modal-atendimento .modal-title h4").html("Cadastrar Horário")

        var url = "../modelo/select-atendimento.php"
        var dados = {
            "type": "search-select-atendimento",
            "table": "MEDICO"
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function (dados) {
                if (dados != "") {
                    var resUs = JSON.parse(dados)
                    for (let i = 0; i < resUs.length; i++) {
                        $(
                            `<option value="${resUs[i].CRM}">${resUs[i].nomeMedico}</option>`
                        ).appendTo('select[name="CRM"]')
                    }
                }

                var dados = {
                    "type": "search-select-atendimento",
                    "table": "UNIDADE_SAUDE"
                }

                $.ajax({
                    type: 'POST',
                    datatype: 'json',
                    url: url,
                    async: true,
                    data: dados,
                    success: function (dados) {
                        if (dados != "") {
                            var resUs = JSON.parse(dados)
                            for (let i = 0; i < resUs.length; i++) {
                                $(
                                    `<option value="${resUs[i].idUnidadeSaude}">${resUs[i].nomeUnidadeSaude}</option>`
                                ).appendTo('select[name="idUnidadeSaude"]')
                            }
                        }
                    }
                })
            }
        })

        $('#modal-atendimento').modal('show')
    })

    $(document).on('submit', '#add-atendimento', function (e) {
        e.preventDefault()

        var dados = $('#add-atendimento').serialize()
        var url = "../modelo/create-atendimento.php"

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