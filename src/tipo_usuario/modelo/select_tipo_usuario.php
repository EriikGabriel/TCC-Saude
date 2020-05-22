<?php

namespace conn;

require_once("../modelo/tipo_usuarioDAO.php");
require_once("../../../conexao/conn.php");

$requestData = $_REQUEST;

$tipoUsuarioDao = new TipoUsuarioDao;

$tipoUsuarioDao->list($requestData);
