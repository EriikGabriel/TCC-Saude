$(document).ready(function(){   
    $(document).on('click', '.btn-add', function() {
        $("#modal-unidade-saude .modal-body").load("cadastro-unidade-saude.html")
        $("#modal-unidade-saude .modal-title h4").html("Cadastrar Unidade de Saúde")
        $('#modal-unidade-saude').modal('show')
    })
    
    $(document).on('submit', '#add-unidade-saude', function(e){
        e.preventDefault()

        var dados = $('#add-unidade-saude').serialize()
        var url = "../modelo/create-unidade-saude.php"
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