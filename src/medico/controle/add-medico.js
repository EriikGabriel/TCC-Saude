$(document).ready(function () {
    $(document).on('click', '.btn-add', function () {
        $("#modal-medico .modal-body").load("cadastro-medico.html")
        $("#modal-medico .modal-title h4").html("Cadastrar Médico")
        $('#modal-medico').modal('show')
    })

    $(document).on('submit', '#add-medico', function (e) {
        e.preventDefault()

        var dados = $('#add-medico').serialize()
        var url = "../modelo/create-medico.php"
        //
        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function (dados) {
                if (dados == "true") {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: "Cadastro efetuado com sucesso",
                        icon: 'success',
                        confirmButtonText: 'Feito'
                    }).then((result) => {
                        if (result.value) {
                            location.reload()
                        }
                    })
                } else {
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