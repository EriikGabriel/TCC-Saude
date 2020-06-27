<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/tipo-usuarioDAO.php");
require_once("../../../conexao/conn.php");

$tipoUsuarioDao = new TipoUsuarioDao;

if ($type == "search-dados") {
    $tipoUsuarioDao->search($id);
} else {
    $requestData = $_REQUEST;

    $tipoUsuarioDao->list($requestData);
}
