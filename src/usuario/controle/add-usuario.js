$(document).ready(function(){   
    $(document).on('click', '.btn-add', function() {
        $("#modal-usuario .modal-body").load("cadastro-usuario.html")
        $("#modal-usuario .modal-title h4").html("Cadastrar Usuário")

        var url = "../modelo/select-usuario.php"
        var dados = { 
            "type": "search-select-usuario",
            "table": "TIPO_USUARIO" 
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function(dados){
                var resTipo = JSON.parse(dados)
                var dados = { 
                    "type": "search-select-usuario",
                    "table": "HOSPITAL" 
                }

                $.ajax({
                    type: 'POST',
                    datatype: 'json',
                    url: url,
                    async: true,
                    data: dados,
                    success: function(dados){
                        var resHosp = JSON.parse(dados)

                        console.log(resTipo)
                        console.log(resHosp)

                        /* CONTINUAR A PARTIR DAQUI */
                    }
                })
            }
        })

        $('#modal-usuario').modal('show')
    })
    
    $(document).on('submit', '#add-usuario', function(e){
        e.preventDefault()

        var dados = $('#add-usuario').serialize()
        var url = "../modelo/create-usuario.php"
        //
        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function(dados){
                if(dados == "true"){
                    Swal.fire({
                        title: 'TCC',
                        text: "Cadastro efetuado com sucesso",
                        icon: 'success',
                        confirmButtonText: 'Feito' 
                    }).then((result) => {
                        if (result.value) {
                            location.reload()
                        }
                    })
                }else{
                    Swal.fire({
                        title: 'Erro!',
                        text: dados,
                        icon: 'error',
                        confirmButtonText: 'Tente novamente' 
                    })
                }
            }
        })
    })
})