<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/pacienteDAO.php");
require_once("../../../conexao/conn.php");

$pacienteDao = new PacienteDao;

if ($type == "search-data-paciente") {
    $pacienteDao->search($id);
} else if ($type == "search-select-paciente") {
    $sql = "SELECT * FROM PACIENTE";
    $pacienteDao->search($id, $sql);
} else {
    $requestData = $_REQUEST;
    $pacienteDao->list($requestData);
}
