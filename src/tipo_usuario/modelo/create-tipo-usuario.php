<?php

namespace conn;

require_once("../modelo/tipo-usuario.php");
require_once("../modelo/tipo-usuarioDAO.php");
require_once("../../../conexao/conn.php");

$tipo = filter_input(INPUT_POST, "tipo", FILTER_SANITIZE_SPECIAL_CHARS);

$tipoUsuario = new TipoUsuario;

$tipoUsuario->setTipoUsuario($tipo);

$tipoUsuarioDao = new TipoUsuarioDao;

$tipoUsuarioDao->create($tipoUsuario);
