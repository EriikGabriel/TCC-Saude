$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        $("#modal-tipo-usuario .modal-body").load("edit-tipo-usuario.html")
        $("#modal-tipo-usuario .modal-body").data("content", "edit");

        $('#modal-tipo-usuario').modal('show')
    })

    $('#modal-tipo-usuario').on('show.bs.modal', function(e) {
        var url = '../modelo/select_tipo_usuario.php'

        var dados = {
            "id": $(".btn-view").attr("id"),
            "type": "search-dados"
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function(dados) {
                var dados = JSON.parse(dados)[0]

                $("#tipo").val(dados.tipoUsuario)

            }
        })

    })
})