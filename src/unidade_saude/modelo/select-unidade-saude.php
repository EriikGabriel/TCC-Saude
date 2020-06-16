<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/unidade-saudeDAO.php");
require_once("../../../conexao/conn.php");

$unidadeDao = new UnidadeSaudeDao;

if ($type == "search-data-unidade") {
    $unidadeDao->search($id, 'UNIDADE_SAUDE', true, 'idUnidadeSaude');
} else if ($type == "search-select-unidade") {
    $unidadeDao->search($id, "{$table}", false);
} else {
    $requestData = $_REQUEST;

    $unidadeDao->list($requestData);
}
