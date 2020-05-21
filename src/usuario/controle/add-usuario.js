$(document).ready(function(){
    $('.btn-add').click(function(add){
        add.preventDefauly()
    
        var dados = $('#add-usuario').serialize()
        var url = "src/usuario/modelo/add-usuario.php"
    
        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function(dados){
                if(dados.return == true){
                    Swal.fire({
                        title: 'TCC',
                        text: "Cadastro efetuado com sucesso",
                        type: 'success',
                        confirmButtonText: 'Feito' 
                    })
                }else{
                    Swal.fire({
                        title: 'TCC',
                        text: dados.return,
                        type: 'error',
                        confirmButtonText: 'Tente novamente' 
                })
            }
            $('#add-usuario input').val("")
                }
        })
    })
})