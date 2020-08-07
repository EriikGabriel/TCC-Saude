$(document).ready(function () {
  var url = "../modelo/select-encaminhamento.php";
  $("#table-encaminhamento").DataTable({
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
        data: "idEncaminhamento",
        className: "text-center",
      },
      {
        data: "nomePaciente",
        className: "text-center",
      },
      {
        data: "nomeUnidadeSaude",
        className: "text-center",
      },
      {
        data: "ruaUnidadeSaude",
        className: "text-center",
      },
      {
        data: "bairroUnidadeSaude",
        className: "text-center",
      },
      {
        data: "nomeHospital",
        className: "text-center",
      },
      {
        data: "nomeUsuario",
        className: "text-center",
      },
      {
        data: "idEncaminhamento",
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
