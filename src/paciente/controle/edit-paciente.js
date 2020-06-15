$(document).ready(function() {
    $(document).on('click', '.btn-edit', function() {
        $("#modal-paciente .modal-body").load("edit-paciente.html")
        $("#modal-paciente .modal-body").data("content", $(this).attr("id"));
        $("#modal-paciente .modal-title h4").html("Editar Paciente")
        $('#modal-paciente').modal('show')
    })

    $('#modal-paciente').on('show.bs.modal', function (e) {
        if($(".modal-body").data("content")) {
            var url = '../modelo/select-paciente.php'
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
    
                    $("#nome").val(dados.nomePaciente)
                    $("#rua").val(dados.ruaPaciente)
                    $("#numero").val(dados.numeroPaciente)
                    $("#tel").val(dados.telefonePaciente)
                    $("#bairro").val(dados.bairroPaciente)
                }
            })
        }
    })
})