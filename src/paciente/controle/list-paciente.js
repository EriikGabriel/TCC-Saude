$(document).ready(function () {
  var url = "../modelo/select-paciente.php";
  $("#table-paciente")
    .DataTable({
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
          data: "idPaciente",
          className: "text-center",
        },
        {
          data: "nomePaciente",
          className: "text-center",
        },
        {
          data: "ruaPaciente",
          className: "text-center",
        },
        {
          data: "bairroPaciente",
          className: "text-center",
        },

        {
          data: "telefonePaciente",
          className: "text-center",
        },
        {
          data: "numeroSUS",
          className: "text-center",
        },
        {
          data: "gravidade",
          className: "text-center",
        },
        {
          // O último elemento a ser instânciado em nossa DataTable são os nossos botões de ações, ou seja, devemos criar os elementos em tela para
          // podermos executar as funções do CRUD.
          data: "idPaciente",
          orderable: false, // Aqui iremos desabilitar a opção de ordenamento por essa coluna
          searchable: false, // Aqui também iremos desabilitar a possibilidade de busca por essa coluna
          className: "text-center",
          // Nesta linha iremos chamar a função render que pega os nossos elementos HTML e renderiza juntamente com as informações carregadas do objeto
          render: function (data, type, row, meta) {
            if (row.gravidade == "Não Urgente" || row.gravidade == "Pouco Urgente") {
              return ` 
                <button id="${data}" class="btn btn-warning btn btn-forward text-white"><i class="fas fa-reply"></i></button>
                <button id="${data}" class="btn btn-primary btn btn-edit text-white"><i class="fas fa-pencil-alt"></i></button>
                <button id="${data}" class="btn btn-danger btn btn-delete"><i class="fas fa-trash"></i></button>
                `;
            } else {
              return ` 
                <button id="${data}" class="btn btn-warning btn btn-forward text-white" disabled><i class="fas fa-reply"></i></button>
                <button id="${data}" class="btn btn-primary btn btn-edit text-white"><i class="fas fa-pencil-alt"></i></button>
                <button id="${data}" class="btn btn-danger btn btn-delete"><i class="fas fa-trash"></i></button>
                `;
            }
          },
        },
      ],
    })
    .responsive.recalc();
});
