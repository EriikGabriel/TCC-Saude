<?php

namespace conn;

require_once("../modelo/tipo_usuarioDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$tipoUsuarioDao = new TipoUsuarioDao;

$tipoUsuarioDao->delete($id);