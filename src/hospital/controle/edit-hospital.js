$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        $("#modal-hospital .modal-body").load("edit-hospital.html")
        $("#modal-hospital .modal-body").data("content", "edit");

        $('#modal-hospital').modal('show')
    })

    $('#modal-hospital').on('show.bs.modal', function (e) {
        var url = '../modelo/select-hospital.php'

        if($("#modal-hospital .modal-body").data("content") == "edit") {
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
    
                    $("#nome").val(dados.nomeHospital)
                    $("#rua").val(dados.ruaHospital)
                    $("#bairro").val(dados.bairroHospital)
                    $("#cep").val(dados.cepHospital)
                    $("#tel").val(dados.telefoneHospital)
                }
            })
        } 
    })
})