$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        $("#modal-paciente .modal-body").load("edit-paciente.html")
        $("#modal-paciente .modal-body").data("content", $(this).attr("id"));
        $("#modal-paciente .modal-title h4").html("Editar Paciente")
        $('#modal-paciente').modal('show')
    })

    $('#modal-paciente').on('show.bs.modal', function(e) {
        alert("aaaaaaaaaaaaa")
        if ($(".modal-body").data("content")) {
            console.log($(".modal-body").data("content"))
            var url = '../modelo/select-paciente.php'
            var dados = {
                "type": "search-select-paciente",
                "table": "PACIENTE"
            }

            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: url,
                async: true,
                data: dados,
                success: function(dados) {
                    console.log(dados)
                    var dados = JSON.parse(dados)[0]

                    $("#nome").val(dados.nomePaciente)
                    $("#rua").val(dados.ruaPaciente)
                    $("#bairro").val(dados.bairroPaciente)
                    $("#tel").val(dados.telefonePaciente)
                    $("#numeroSUS").val(dados.numeroSUS)

                    const options = $("input[name='gravidade']")
                    for (const option of options) {
                        if (option.value === dados.gravidade) option.checked = true
                    }
                }
            })
        }
    })

    $(document).on('submit', '#edit-paciente', function(e) {
        e.preventDefault()

        url = "../modelo/edit-paciente.php"

        var dados = {
            "id": $(".modal-body").data("content"),
            "nome": $("#nome").val(),
            "rua": $("#rua").val(),
            "bairro": $("#bairro").val(),
            "tel": $("#tel").val(),
            "numeroSUS": $("#numeroSUS").val(),
            "gravidade": $("input[name='gravidade']:checked").val(),
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function(dados) {
                console.log(dados)
                if (dados == "true") {
                    location.href = "list-paciente.html"
                }
            }
        })
    })
})