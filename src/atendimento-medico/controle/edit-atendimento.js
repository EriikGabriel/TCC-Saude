$(document).ready(function () {
    $(document).on('click', '.btn-edit', function () {
        $("#modal-atendimento .modal-body").load("edit-atendimento.html")
        $("#modal-atendimento .modal-body").data("content", $(this).attr("id"));
        $("#modal-atendimento .modal-title h4").html("Editar Hospital")
        $('#modal-atendimento').modal('show')
    })

    $('#modal-atendimento').on('show.bs.modal', function (e) {
        if ($(".modal-body").data("content")) {
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

                            var dados = {
                                "id": $(".modal-body").data("content"),
                                "type": "search-data-atendimento"
                            }

                            $.ajax({
                                type: 'POST',
                                datatype: 'json',
                                url: url,
                                async: true,
                                data: dados,
                                success: function (dados) {
                                    var dados = JSON.parse(dados)[0]

                                    $("#horario").val(dados.horarioMedico)
                                    $("#CRM").val(dados.CRM)
                                    $("#idUnidadeSaude").val(dados.idUnidadeSaude)
                                }
                            })
                        }
                    })
                }
            })
        }
    })

    $(document).on('submit', '#edit-atendimento', function (e) {
        e.preventDefault()

        url = "../modelo/edit-atendimento.php"

        var dados = {
            "id": $(".modal-body").data("content"),
            "horario": $("#horario").val(),
            "crm": $("#crm").val(),
            "idUnidadeSaude": $("#idUnidadeSaude").val()
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function (dados) {
                console.log(dados)
                if (dados == "true") {
                    location.href = "list-atendimento.html"
                }
            }
        })
    })
})