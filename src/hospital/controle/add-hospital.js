$(document).ready(function(){
    $('.btn-add').click(function(add){
    add.preventDefauly()

    var dados = $('#add-hospital').serialize()
    var url = "src/hospital/modelo/add-hospital.php"

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
                    text: "Cadastro efetuad com sucesso",
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
        $('#add-hospital input').val("")
            }
        })
    })
})