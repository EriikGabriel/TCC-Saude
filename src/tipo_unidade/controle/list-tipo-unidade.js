$(document).ready(function(){

    var url = "../modelo/select-tipo-unidade.php"
    
    $('#table-tipo-unidade').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": url,
            "type": "POST"
        },
        "language": {
            "url": "../../../libs/DataTables/dataTables.brazil.json"
        },
        "columns": [
        {
            "data": 'idTipoUnidade',
            "className": 'text-center'
        },
        {
            "data": 'tipoUnidade',
            "className": 'text-center'
        },
        {
            // O último elemento a ser instânciado em nossa DataTable são os nossos botões de ações, ou seja, devemos criar os elementos em tela para
            // podermos executar as funções do CRUD.
            "data": 'idTipoUnidade',
            "orderable": false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
            "searchable": false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
            "className": 'text-center',
            // Nesta linha iremos chamar a função render que pega os nossos elementos HTML e renderiza juntamente com as informações carregadas do objeto
            "render": function(data, type, row, meta) {
                return `
                        <button id="${data}" class="btn btn-primary btn btn-view">Visualizar</button>
                        <button id="${data}" class="btn btn-success btn btn-edit">Editar</button>
                        <button id="${data}" class="btn btn-danger btn btn-delete">Deletar</button>
                `
            }
        }]
    })

    $(document).on('submit', '#edit-tipo-unidade', function(e) { 
        e.preventDefault()
        
        url = "../modelo/edit-tipo-unidade.php"

        var dados = {
            "id": $(".modal-body").data("content"),
            "tipo": $("#tipo").val(),
        }

        $.ajax({
            type: 'POST',
            datatype: 'json',
            url: url,
            async: true,
            data: dados,
            success: function(dados) {
                console.log(dados)
                if(dados == "true") {
                    location.href = "list-tipo-unidade.html"
                }
            }
        })
    })

    //? Função - Botão Deletar
    $(document).on('click', '.btn-delete', function(){
        Swal.fire({
            title: 'Você tem certeza?',
            text: "O registro será deletado permanentemente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, delete isso!'
        }).then((result) => {
            url = "../modelo/delete-tipo-unidade.php"
            var dados = { "id": $(this).attr("id") }

            if (result.value) {
                $.ajax({
                    type: 'POST',
                    datatype: 'json',
                    url: url,
                    async: true,
                    data: dados,
                    success: function(dados){
                        if(dados == "true") {
                            Swal.fire(
                                'Deletado!',
                                'Seu arquivo foi deletado.',
                                'success'
                            ).then((result) => {
                                if(result.value) {
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