$(document).ready(function () {
    $(document).on('click', '.btn-forward', function () {
        $("#modal-paciente .modal-body").load("forward-paciente.html")
        $("#modal-paciente .modal-body").data("content", $(this).attr("id"))
        $("#modal-paciente .modal-title h4").html("Encaminhar Paciente")

        var url = "../modelo/select-paciente.php"
        var dados = {
            "id": $(".modal-body").data("content"),
            "type": "search-data-paciente",
            "table": "PACIENTE",
            "where": "idPaciente"
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
                        var ruaPaciente = resPac[i].ruaPaciente
                        var bairroPaciente = resPac[i].bairroPaciente

                        $(
                            `<option value="${resPac[i].idPaciente}">${ruaPaciente}</option>`
                        ).appendTo('select[name="ruaPaciente"]')

                        $(
                            `<option value="${resPac[i].idPaciente}">${bairroPaciente}</option>`
                        ).appendTo('select[name="bairroPaciente"]')
                    }
                }

                var dados = {
                    "id": `'${ruaPaciente}' AND bairroUnidadeSaude = '${bairroPaciente}'`,
                    "type": "search-data-paciente",
                    "table": "UNIDADE_SAUDE",
                    "where": "ruaUnidadeSaude"
                }

                $.ajax({
                    type: 'POST',
                    datatype: 'json',
                    url: url,
                    async: true,
                    data: dados,
                    success: function (res) {
                        console.log(res)

                    }
                })
            }
        })

        $('#modal-paciente').modal('show')
    })

    $('#modal-paciente').on('show.bs.modal', function (e) {

    })

    $(document).on('submit', '#edit-paciente', function (e) {
        e.preventDefault()

        url = "../modelo/edit-paciente.php"

        var dados = {
            "id": $(".modal-body").data("content"),
            "nome": $("#nome").val(),
            "rua": $("#rua").val(),
            "numeroSUS": $("#numeroSUS").val(),
            "tel": $("#tel").val(),
            "bairro": $("#bairro").val(),
            "gravidade": $("input[name='gravidade']:checked").val(),
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
                    location.href = "list-paciente.html"
                }
            }
        })
    })
})