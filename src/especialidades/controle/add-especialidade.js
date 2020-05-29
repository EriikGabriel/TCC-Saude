$(document).ready(function(){   
    $(document).on('click', '.btn-add', function() {
        $("#modal-especialidade .modal-body").load("cadastro-especialidade.html")

        $('#modal-especialidade').modal('show')
    })
    
    $(document).on('submit', '#add-especialidade', function(e){
        e.preventDefault()

        var dados = $('#add-especialidade').serialize()
        var url = "../modelo/create-especialidade.php"
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
                        title: 'TCC',
                        text: dados.return,
                        icon: 'error',
                        confirmButtonText: 'Tente novamente' 
                    })
                }

                
            }
        })
    })
})