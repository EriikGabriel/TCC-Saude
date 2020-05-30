$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        $("#modal-tipo-unidade .modal-body").load("edit-tipo-unidade.html")
        $("#modal-tipo-unidade .modal-body").data("content", $(this).attr("id"));

        $('#modal-tipo-unidade').modal('show')
    })

    $('#modal-tipo-unidade').on('show.bs.modal', function (e) {
        var url = '../modelo/select_tipo_unidade.php'

        var dados = { 
            "id": $(".modal-body").data("content"),
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

                $("#tipo").val(dados.tipoUnidade)
            }
        })
        
    })
})