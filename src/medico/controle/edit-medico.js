$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        $("#modal-medico .modal-body").load("edit-medico.html")
        $("#modal-medico .modal-body").data("content", $(this).attr("id"));
        $("#modal-medico .modal-title h4").html("Editar Médico")
        $('#modal-medico').modal('show')
    })

    $('#modal-medico').on('show.bs.modal', function (e) {
        if($(".modal-body").data("content")) {
            var url = '../modelo/select-medico.php'
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
    
                    $("#nome").val(dados.nomeMedico)
                    $("#horario").val(dados.horarioMedico)
                    $("#idEspecialidade").val(dados.idEspecialidade)
                }
            })
        }
    })
})