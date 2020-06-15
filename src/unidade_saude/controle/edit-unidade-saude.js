$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        $("#modal-unidade-saude .modal-body").load("edit-unidade-saude.html")
        $("#modal-unidade-saude .modal-body").data("content", $(this).attr("id"));
        $("#modal-unidade-saude .modal-title h4").html("Editar Unidade de Saúde")
        $('#modal-unidade-saude').modal('show')
    })

    $('#modal-unidade-saude').on('show.bs.modal', function (e) {
        if($(".modal-body").data("content")) {
            var url = '../modelo/select-unidade-saude.php'
            console.log($(".modal-body").data("content"))
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
                    console.log(dados)
    
                    $("#nome").val(dados.nomeUnidadeSaude)
                    $("#rua").val(dados.ruaUnidadeSaude)
                    $("#bairro").val(dados.bairroUnidadeSaude)
                    $("#tel").val(dados.telefoneUnidadeSaude)
                }
            })
        }
    })
})