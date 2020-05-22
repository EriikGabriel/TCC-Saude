$(document).ready(function(){   
    $(document).on('click', '.btn-add', function() {
        $("#modal-hospital .modal-body").load("cadastro-hospital.html")

        $('#modal-hospital').modal('show')
    })
    
    $(document).on('submit', '#add-hospital', function(e){
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