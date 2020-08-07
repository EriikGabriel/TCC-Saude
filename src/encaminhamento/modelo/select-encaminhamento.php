<?php

namespace conn;

$id = filter_input(INPUT_POST, "id");
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);
$sql = filter_input(INPUT_POST, "sql", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/encaminhamentoDAO.php");
require_once("../../../conexao/conn.php");

$encaminhamentoDao = new EncaminhamentoDao;

if ($type == "search-data-encaminhamento") {
    $encaminhamentoDao->search($id);
} else if ($type == "search-select-encaminhamento") {
    if (!empty($sql)) $id = json_decode($id);
    $encaminhamentoDao->search($id, $sql);
} else {
    $requestData = $_REQUEST;
    $encaminhamentoDao->list($requestData);
}
