$(document).ready(function () {

    var url = "../modelo/select-medico.php"
    $('#table-medico').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "language": {
            "url": "../../../libs/DataTables/dataTables.brazil.json"
        },
        "columns": [
            {
                "data": 'CRM',
                "className": 'text-center'
            },
            {
                "data": 'nomeMedico',
                "className": 'text-center'
            },
            {
                "data": 'horarioMedico',
                "className": 'text-center'
            },
            {
                "data": 'tipoEspecialidade',
                "className": 'text-center'
            },
            {
                "data": 'CRM',
                "orderable": false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
                "searchable": false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
                "className": 'text-center',
                "render": function (data, type, row, meta) {
                    return `
                        <button id="${data}" class="btn btn-primary btn btn-view">Visualizar</button>
                        <button id="${data}" class="btn btn-success btn btn-edit">Editar</button>
                        <button id="${data}" class="btn btn-danger btn btn-delete">Deletar</button>
                `
                }
            }]
    })


    $(document).on('submit', '#edit-medico', function (e) {
        e.preventDefault()

        url = "../modelo/edit-medico.php"

        var dados = {
            "id": $(".modal-body").data("content"),
            "crm": $("#crm").val(),
            "nome": $("#nome").val(),
            "horario": $("#horario").val(),
            "idEspecialidade": $("#idEspecialidade").val(),
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function (dados) {
                console.log(dados)
                if (dados == "true") {
                    location.href = "list-medico.html"
                }
            }
        })
    })

    //? Função - Botão Deletar
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
            url = "../modelo/delete-medico.php"
            var dados = { "id": $(this).attr("id") }

            if (result.value) {
                $.ajax({
                    type: 'POST',
                    datatype: 'json',
                    url: url,
                    async: true,
                    data: dados,
                    success: function (dados) {
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