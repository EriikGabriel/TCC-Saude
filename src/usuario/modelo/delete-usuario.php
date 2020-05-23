<?php

namespace conn;

require_once("../modelo/usuarioDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$usuarioDao = new UsuarioDao;

$usuarioDao->delete($id);