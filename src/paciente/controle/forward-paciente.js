$(document).ready(function () {
    $(document).on('click', '.btn-forward', function () {
        $("#modal-paciente .modal-body").load("forward-paciente.html")
        $("#modal-paciente .modal-body").data("content", $(this).attr("id"));
        $("#modal-paciente .modal-title h4").html("Encaminhar Paciente")
        $('#modal-paciente').modal('show')
    })

    $('#modal-paciente').on('show.bs.modal', function (e) {
        var url = "../modelo/select-paciente.php"
        $('#table-paciente').DataTable({
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
            "columns": [{
                "data": 'idPaciente',
                "className": 'text-center'
            },
            {
                "data": 'nomePaciente',
                "className": 'text-center'
            },
            {
                "data": 'ruaPaciente',
                "className": 'text-center'
            },
            {
                "data": 'bairroPaciente',
                "className": 'text-center'
            },

            {
                "data": 'telefonePaciente',
                "className": 'text-center'
            },
            {
                "data": 'numeroSUS',
                "className": 'text-center'
            },
            {
                "data": 'gravidade',
                "className": 'text-center'
            },
            {
                // O último elemento a ser instânciado em nossa DataTable são os nossos botões de ações, ou seja, devemos criar os elementos em tela para
                // podermos executar as funções do CRUD.
                "data": 'idPaciente',
                "orderable": false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
                "searchable": false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
                "className": 'text-center',
                // Nesta linha iremos chamar a função render que pega os nossos elementos HTML e renderiza juntamente com as informações carregadas do objeto
                "render": function (data, type, row, meta) {
                    return `
                        <button id="${data}" class="btn btn-primary btn btn-forward">Encaminhar</button>
                        <button id="${data}" class="btn btn-success btn btn-edit">Editar</button>
                        <button id="${data}" class="btn btn-danger btn btn-delete">Deletar</button>
                `
                }
            }
            ]
        }).responsive.recalc();
    })

    $(document).on('submit', '#edit-paciente', function (e) {
        e.preventDefault()

        url = "../modelo/edit-paciente.php"

        var dados = {
            "id": $(".modal-body").data("content"),
            "nome": $("#nome").val(),
            "rua": $("#rua").val(),
            "numeroSUS": $("#numeroSUS").val(),
            "tel": $("#tel").val(),
            "bairro": $("#bairro").val(),
            "gravidade": $("input[name='gravidade']:checked").val(),
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
                    location.href = "list-paciente.html"
                }
            }
        })
    })
})