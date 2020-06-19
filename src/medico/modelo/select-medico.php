<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/medicoDAO.php");
require_once("../../../conexao/conn.php");

$medicoDao = new MedicoDao;

if ($type == "search-data-medico") {
    $medicoDao->search($id, 'MEDICO', true, 'CRM');
} else if ($type == "search-select-medico") {
    $medicoDao->search($id, "{$table}", false);
} else {
    $requestData = $_REQUEST;

    $medicoDao->list($requestData);
}
