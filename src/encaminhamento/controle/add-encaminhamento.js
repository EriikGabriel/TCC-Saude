$(document).ready(function () {
    $(document).on('click', '.btn-add', function () {
        $("#modal-encaminhamento .modal-body").load("cadastro-encaminhamento.html")
        $("#modal-encaminhamento .modal-title h4").html("Fazer Encaminhamento")

        var url = "../modelo/select-encaminhamento.php"
        var dados = {
            "type": "search-data-encaminhamento",
            "table": "PACIENTE",
            "where": JSON.stringify(["gravidade", "gravidade"]),
            "id": JSON.stringify(["Pouco Urgente", "Não Urgente"]),
            "operator": "OR"
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function (dados) {
                if (dados != "") {
                    var resPac = JSON.parse(dados)

                    for (let i = 0; i < resPac.length; i++) {
                        $(
                            `<option value="${resPac[i].idPaciente}" 
                                     data-rua="${resPac[i].ruaPaciente}" 
                                     data-bairro="${resPac[i].bairroPaciente}">
                            ${resPac[i].nomePaciente}
                            </option>`
                        ).appendTo('select[name="idPaciente"]')
                    }

                    $("#add-encaminhamento select").removeAttr('disabled')
                }
            }
        })

        $('#modal-encaminhamento').modal('show')
    })

    $(document).on('change', 'select', function (e) {
        if (e.target.name == "idPaciente") {
            $("select:not([name='idPaciente']) option:not(:first-child)").remove()
            if ($(this)[0].value != "") {
                var ruaPaciente = $(this)[0].selectedOptions[0].dataset.rua
                var bairroPaciente = $(this)[0].selectedOptions[0].dataset.bairro

                var url = "../modelo/select-encaminhamento.php"
                var dados = {
                    "type": "search-data-encaminhamento",
                    "table": "UNIDADE_SAUDE",
                    "where": JSON.stringify(["ruaUnidadeSaude", "bairroUnidadeSaude"]),
                    "id": JSON.stringify([ruaPaciente, bairroPaciente]),
                    "operator": "OR"
                }

                $.ajax({
                    type: 'POST',
                    datatype: 'json',
                    url: url,
                    async: true,
                    data: dados,
                    success: function (dados) {
                        var resUn = JSON.parse(dados)

                        for (let i = 0; i < resUn.length; i++) {
                            $(
                                `<option value="${resUn[i].idUnidadeSaude}">
                                ${resUn[i].nomeUnidadeSaude}
                                </option>`
                            ).appendTo('select[name="idUnidadeSaude"]')

                            var dados = {
                                "type": "search-data-encaminhamento",
                                "table": "MEDICO_ATENDE_UNIDADE",
                                "where": "idUnidadeSaude",
                                "id": resUn[i].idUnidadeSaude
                            }

                            $.ajax({
                                type: 'POST',
                                datatype: 'json',
                                url: url,
                                async: true,
                                data: dados,
                                success: function (dados) {
                                    var resMedicoAt = JSON.parse(dados)

                                    for (let i = 0; i < resMedicoAt.length; i++) {
                                        $(
                                            `<option value="${resMedicoAt[i].CRM}">
                                            ${resMedicoAt[i].horarioMedico}
                                            </option>`
                                        ).appendTo('select[name="idHorario"]')

                                        var dados = {
                                            "type": "search-data-encaminhamento",
                                            "table": "MEDICO",
                                            "where": "CRM",
                                            "id": resMedicoAt[i].CRM
                                        }

                                        $.ajax({
                                            type: 'POST',
                                            datatype: 'json',
                                            url: url,
                                            async: true,
                                            data: dados,
                                            success: function (dados) {
                                                var resMedico = JSON.parse(dados)

                                                var dados = {
                                                    "type": "search-data-encaminhamento",
                                                    "table": "ESPECIALIDADE",
                                                    "where": "idEspecialidade",
                                                    "id": resMedico[0].idEspecialidade
                                                }

                                                $.ajax({
                                                    type: 'POST',
                                                    datatype: 'json',
                                                    url: url,
                                                    async: true,
                                                    data: dados,
                                                    success: function (dados) {
                                                        var resEsp = JSON.parse(dados)
                                                        for (let i = 0; i < resEsp.length; i++) {
                                                            $(
                                                                `<option value="${resEsp[i].idEspecialidade}">
                                                                ${resEsp[i].tipoEspecialidade}
                                                                </option>`
                                                            ).appendTo('select[name="idEspecialidade"]')
                                                        }
                                                    }
                                                })
                                            }
                                        })
                                    }
                                }
                            })
                        }
                    }
                })
            }
        }
    })

    $(document).on('submit', '#add-medico', function (e) {
        e.preventDefault()

        var dados = $('#add-medico').serialize()
        var url = "../modelo/create-medico.php"

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
                } else if (dados.includes("23000")) {
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Esse CRM já foi cadastrado',
                        icon: 'error',
                        confirmButtonText: 'Tente novamente'
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