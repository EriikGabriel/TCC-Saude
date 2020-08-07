$(document).ready(function () {
  var url = "../modelo/select-especialidade.php";
  $("#table-especialidade").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
      url: url,
      type: "POST",
    },
    language: {
      url: "../../../libs/DataTables/dataTables.brazil.json",
    },
    columns: [
      {
        data: "idEspecialidade",
        className: "text-center",
      },
      {
        data: "tipoEspecialidade",
        className: "text-center",
      },
      {
        // O último elemento a ser instânciado em nossa DataTable são os nossos botões de ações, ou seja, devemos criar os elementos em tela para
        // podermos executar as funções do CRUD.
        data: "idEspecialidade",
        orderable: false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
        searchable: false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
        className: "text-center",
        render: function (data, type, row, meta) {
          return `
            <button id="${data}" class="btn btn-primary btn btn-view">Visualizar</button>
            <button id="${data}" class="btn btn-success btn btn-edit">Editar</button>
            <button id="${data}" class="btn btn-danger btn btn-delete">Deletar</button>
            `;
        },
      },
    ],
  });
});
