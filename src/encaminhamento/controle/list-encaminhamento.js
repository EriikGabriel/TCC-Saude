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
        data: "horarioMedico",
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
        data: "situacao",
        className: "text-center",
      },
      {
        data: "idEncaminhamento",
        orderable: false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
        searchable: false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
        className: "text-center",
        render: function (data, type, row, meta) {
          if (JSON.parse(localStorage.getItem("login")).tipo == 1) {
            return `
              <button id="${data}" class="btn btn-primary btn btn-edit"><i class="fas fa-pencil-alt"></i></button>
              <button id="${data}" class="btn btn-danger btn btn-delete"><i class="fas fa-trash"></i></button>
            `;
          } else if (row.situacao == "Concluido") {
            return `
              <button id="${data}" class="btn btn-primary btn btn-view"><i class="fa fa-eye" aria-hidden="true"></i></button>
            `;
          } else {
            return `
              <button id="${data}" class="btn btn-success btn btn-finish"><i class="fa fa-check" aria-hidden="true"></i></button>
            `;
          }
        },
      },
    ],
  });
});
