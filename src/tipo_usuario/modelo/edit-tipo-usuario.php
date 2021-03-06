<?php

namespace conn;

require_once("../modelo/tipo-usuario.php");
require_once("../modelo/tipo-usuarioDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_POST, "tipo", FILTER_SANITIZE_SPECIAL_CHARS);

if (!empty($tipo)) {
    $new_values = [$id, $tipo];

    $tipoUsuario = new TipoUsuario;
    $tipoUsuarioDao = new TipoUsuarioDao;

    $tipoUsuarioDao->edit($new_values);
}
