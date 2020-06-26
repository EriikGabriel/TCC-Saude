$(document).ready(function () {

    var url = "../modelo/select-unidade-saude.php"
    $('#table-unidade-saude').DataTable({
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
                "data": 'idUnidadeSaude',
                "className": 'text-center'
            },
            {
                "data": 'nomeUnidadeSaude',
                "className": 'text-center'
            },
            {
                "data": 'ruaUnidadeSaude',
                "className": 'text-center'
            },
            {
                "data": 'bairroUnidadeSaude',
                "className": 'text-center'
            },
            {
                "data": 'telefoneUnidadeSaude',
                "className": 'text-center'
            },
            {
                "data": 'tipoUnidade',
                "className": 'text-center'
            },
            {
                // O último elemento a ser instânciado em nossa DataTable são os nossos botões de ações, ou seja, devemos criar os elementos em tela para
                // podermos executar as funções do CRUD.
                "data": 'idUnidadeSaude',
                "orderable": false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
                "searchable": false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
                "className": 'text-center',
                // Nesta linha iremos chamar a função render que pega os nossos elementos HTML e renderiza juntamente com as informações carregadas do objeto
                "render": function (data, type, row, meta) {
                    return `
                        <button id="${data}" class="btn btn-primary btn btn-view">Visualizar</button>
                        <button id="${data}" class="btn btn-success btn btn-edit">Editar</button>
                        <button id="${data}" class="btn btn-danger btn btn-delete">Deletar</button>
                `
                }
            }]
    })
})