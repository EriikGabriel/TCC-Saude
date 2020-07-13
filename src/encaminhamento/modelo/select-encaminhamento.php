<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/encaminhamentoDAO.php");
require_once("../../../conexao/conn.php");

$encaminhamentoDao = new EncaminhamentoDao;

if ($type == "search-data-encaminhamento") {
    $encaminhamentoDao->search($id, 'ENCAMINHAMENTO', true, 'idEncaminhamento');
} else if ($type == "search-select-encaminhamento") {
    $encaminhamentoDao->search($id, "{$table}", false);
} else {
    $requestData = $_REQUEST;

    $encaminhamentoDao->list($requestData);
}
