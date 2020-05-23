$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        $("#modal-usuario .modal-body").load("edit-usuario.html")

        $('#modal-usuario').modal('show')
    })

    $('#modal-usuario').on('show.bs.modal', function (e) {
        var url = '../modelo/select-usuario.php'

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
            success: function(dados){
                var dados = JSON.parse(dados)[0]

                $("#nome").val(dados.nomeUsuario)
                $("#senha").val(dados.senhaUsuario)
                $("#idTipoUsuario").val(dados.idTipoUsuario)
                $("#idHospital").val(dados.idHospital)
            }
        })
    
    })
})