<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);
$where = filter_input(INPUT_POST, "where", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/pacienteDAO.php");
require_once("../../../conexao/conn.php");

$PacienteDao = new PacienteDao;

if ($type == "search-data-paciente") {
    $PacienteDao->search($id, 'PACIENTE', true, 'idPaciente');
} else if ($type == "search-select-paciente") {
    $PacienteDao->search($id, "{$table}", false);
} else if ($type == "search-forward-paciente") {
    $PacienteDao->search($id, "{$table}", true, "{$where}");
} else {
    $requestData = $_REQUEST;

    $PacienteDao->list($requestData);
}
