<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/tipo-unidadeDAO.php");
require_once("../../../conexao/conn.php");

$tipoUnidadeDao = new TipoUnidadeDao;

if ($type == "search-dados") {
    $tipoUnidadeDao->search($id);
} else {
    $requestData = $_REQUEST;
    $tipoUnidadeDao->list($requestData);
}
