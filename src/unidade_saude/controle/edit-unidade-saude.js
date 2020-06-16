$(document).ready(function () {
    $(document).on('click', '.btn-edit', function () {
        $("#modal-unidade-saude .modal-body").load("edit-unidade-saude.html")
        $("#modal-unidade-saude .modal-body").data("content", $(this).attr("id"));
        $("#modal-unidade-saude .modal-title h4").html("Editar Unidade de Saúde")
        $('#modal-unidade-saude').modal('show')
    })

    $('#modal-unidade-saude').on('show.bs.modal', function (e) {
        if ($(".modal-body").data("content")) {
            var url = '../modelo/select-unidade-saude.php'
            var dados = {
                "type": "search-select-unidade",
                "table": "TIPO_UNIDADE"
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
                                `<option value="${resTipo[i].idTipoUnidade}">${resTipo[i].tipoUnidade}</option>`
                            ).appendTo('select[name="idTipoUnidade"]')
                        }

                        var dados = {
                            "id": $(".modal-body").data("content"),
                            "type": "search-data-unidade"
                        }

                        $.ajax({
                            type: 'POST',
                            datatype: 'json',
                            url: url,
                            async: true,
                            data: dados,
                            success: function (dados) {
                                var dados = JSON.parse(dados)[0]

                                $("#nome").val(dados.nomeUnidadeSaude)
                                $("#rua").val(dados.ruaUnidadeSaude)
                                $("#bairro").val(dados.bairroUnidadeSaude)
                                $("#tel").val(dados.telefoneUnidadeSaude)
                                $("#idTipoUnidade").val(dados.idTipoUnidade)
                            }
                        })
                    }
                }
            })
        }
    })
})