<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/usuarioDAO.php");
require_once("../../../conexao/conn.php");

$usuarioDao = new UsuarioDao;

if ($type == "search-data-usuario") {
    $usuarioDao->search($id, $senha, 'USUARIO', true, 'nomeUsuario');
} else if ($type == "search-select-usuario") {
    $usuarioDao->search($id, $senha, "{$table}", false);
} else {
    $requestData = $_REQUEST;

    $usuarioDao->list($requestData);
}
