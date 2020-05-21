$(document).ready(function(){
    $('#add-hospital').submit(function(e){
        e.preventDefault()

        var dados = $('#add-hospital').serialize()
        var url = "../modelo/create-hospital.php"

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

                $('#add-hospital input').val("")
            }
        })
    })
})