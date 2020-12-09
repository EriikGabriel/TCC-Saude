$(document).on("click", ".btn-cancel", function(e) {
    $("#modal-encaminhamento .modal-body").data("content", $(this).attr("id"));
    Swal.fire({
        title: "Você tem certeza?",
        text: "O status do encaminhamento será alterado e não poderá ser desfeito!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, cancelar encaminhamento!",
    }).then((result) => {
        if (result.value) {
            var url = "../modelo/edit-encaminhamento.php";
            var dados = {
                id: $(".modal-body").data("content"),
                type: "cancel",
            };

            $.ajax({
                type: "POST",
                datatype: "json",
                url: url,
                async: true,
                data: dados,
                success: function(dados) {
                    if (dados == "true") {
                        var url = "../modelo/select-encaminhamento.php";
                        var dados = {
                            type: "search-select-encaminhamento",
                            sql: ":edit-vagas",
                            id: $(".modal-body").data("content"),
                        };

                        $.ajax({
                            type: "POST",
                            datatype: "json",
                            url: url,
                            async: true,
                            data: dados,
                            success: function(dadoUni) {
                                dadoUni = JSON.parse(dadoUni)[0];
                                var url = "../../unidade_saude/modelo/edit-unidade-saude.php";
                                var dados = {
                                    id: dadoUni.idUnidadeSaude,
                                    vagas: dadoUni.vagas + 1
                                }

                                $.ajax({
                                    type: "POST",
                                    datatype: "json",
                                    url: url,
                                    async: true,
                                    data: dados,
                                    success: function(res) {
                                        url = "../modelo/delete-encaminhamento.php";
                                        var dados = { id: $(".modal-body").data("content") };

                                        $.ajax({
                                            type: "POST",
                                            datatype: "json",
                                            url: url,
                                            async: true,
                                            data: dados,
                                            success: function(dados) {
                                                if (dados == "true") {
                                                    Swal.fire("Sucesso!", "Encaminhamento cancelado!", "success").then((result) => {
                                                        if (result.value) location.reload()
                                                    });
                                                }
                                            },
                                        });
                                    }
                                })
                            }
                        })
                    }
                },
            });
        }
    });
});