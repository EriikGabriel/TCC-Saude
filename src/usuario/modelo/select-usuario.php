<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/usuarioDAO.php");
require_once("../../../conexao/conn.php");

$usuarioDao = new UsuarioDao;

if($type == "search-dados") {
    $usuarioDao->search($id);
} else {
    $requestData = $_REQUEST;
    
    $usuarioDao->list($requestData);
}

