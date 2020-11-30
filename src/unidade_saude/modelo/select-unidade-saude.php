<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/unidade-saudeDAO.php");
require_once("../../../conexao/conn.php");

$unidadeDao = new UnidadeSaudeDao;

if ($type == "search-data-unidade") {
    $unidadeDao->search($id);
} else if ($type == "search-select-unidade") {
    $sql = "SELECT * FROM TIPO_UNIDADE";
    $unidadeDao->search($id, $sql);
} else if ($type == "count-dados") {
    $sql = "SELECT COUNT(*) as count FROM ENCAMINHAMENTO WHERE idUnidadeSaude = ?";
    $unidadeDao->search($id, $sql);
} else {
    $requestData = $_REQUEST;
    $unidadeDao->list($requestData);
}
