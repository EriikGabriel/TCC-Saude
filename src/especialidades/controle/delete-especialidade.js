$(document).ready(function () {
    $(document).on('click', '.btn-delete', function () {
        Swal.fire({
            title: 'Você tem certeza?',
            text: "O registro será deletado permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, delete isso!'
        }).then((result) => {
            url = "../modelo/delete-especialidade.php"
            var dados = { "id": $(this).attr("id") }

            if (result.value) {
                $.ajax({
                    type: 'POST',
                    datatype: 'json',
                    url: url,
                    async: true,
                    data: dados,
                    success: function (dados) {
                        console.log(dados)
                        if (dados == "true") {
                            Swal.fire(
                                'Deletado!',
                                'Seus dados foram deletados.',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    location.reload()
                                }
                            })
                        }
                    }
                })
            }
        })
    })
})