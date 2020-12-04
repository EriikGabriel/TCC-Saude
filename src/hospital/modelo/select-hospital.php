<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/hospitalDAO.php");
require_once("../../../conexao/conn.php");

$hospitalDao = new HospitalDao;

if ($type == "search-data-hospital") {
    $hospitalDao->search($id);
} else if ($type == "search-select-hospital") {
    $sql = "SELECT * FROM USUARIO";
    $hospitalDao->search($id, $sql);
} else if ($type == "search-hospital-usuario") {
    $sql = "SELECT * FROM HOSPITAL WHERE idUsuario = ?";
    $hospitalDao->search($id, $sql);
} else {
    $requestData = $_REQUEST;
    $hospitalDao->list($requestData);
}
