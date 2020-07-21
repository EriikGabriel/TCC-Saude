<?php

namespace conn;

$id = filter_input(INPUT_POST, "id");
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);
$where = filter_input(INPUT_POST, "where");
$operator = filter_input(INPUT_POST, "operator", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/encaminhamentoDAO.php");
require_once("../../../conexao/conn.php");

$encaminhamentoDao = new EncaminhamentoDao;

if ($type == "search-data-encaminhamento") {
    if ($operator != "") {
        $id = json_decode($id);
        $where = json_decode($where);
    }
    $encaminhamentoDao->search($id, "{$table}", true, $where, "{$operator}");
} else if ($type == "search-select-encaminhamento") {
    $encaminhamentoDao->search($id, "{$table}", false);
} else {
    $requestData = $_REQUEST;

    $encaminhamentoDao->list($requestData);
}
