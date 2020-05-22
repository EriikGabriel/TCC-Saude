$(document).ready(function(){
    $('#add-tipo-usuario').submit(function(e){
        e.preventDefault()

        var dados = $('#add-tipo-usuario').serialize()
        var url = "../modelo/create_tipo_usuario.php"

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
                    })
                }else{
                    Swal.fire({
                        title: 'TCC',
                        text: dados.return,
                        icon: 'error',
                        confirmButtonText: 'Tente novamente' 
                    })
                }

                $('#add-tipo-usuario input').val("")
            }
        })
    })
})