$(document).ready(function () {
    $(document).on('click', '.btn-cadastrar', function () {
        $("#login-container").load("src/usuario/visao/cadastro-usuario.html")

        $(document).on('submit', "#add-usuario", function (e) {
            e.preventDefault()

            if ($('input[name = "senha"]').val() === $('input[name = "confirmarSenha"]').val()) {
                var dados = $('#add-usuario').serialize()
                var url = "src/usuario/modelo/create-usuario.php"

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
                        } else if (dados.includes("23000")) {
                            Swal.fire({
                                title: 'Erro!',
                                text: 'Esse usuário já foi cadastrado',
                                icon: 'error',
                                confirmButtonText: 'Tente novamente'
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
            } else {
                Swal.fire({
                    title: 'Erro!',
                    text: 'As senhas não coincidem!',
                    icon: 'error',
                    confirmButtonText: 'Tente novamente'
                })
            }

        })
    })
})