$(document).ready(function(){   
    $(document).on('click', '.btn-add', function() {
        $("#modal-tipo-unidade .modal-body").load("cadastro-tipo-unidade.html")

        $('#modal-tipo-unidade').modal('show')
    })
    
    $(document).on('submit', '#add-tipo-unidade', function(e){
        e.preventDefault()

        var dados = $('#add-tipo-unidade').serialize()
        var url = "../modelo/create_tipo_unidade.php"

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