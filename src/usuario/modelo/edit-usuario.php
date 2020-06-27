<?php

namespace conn;

require_once("../modelo/usuario.php");
require_once("../modelo/usuarioDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "idUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, "nomeUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, "senhaUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$idTipoUsuario = filter_input(INPUT_POST, "idTipoUsuario", FILTER_SANITIZE_SPECIAL_CHARS);

$new_values = [$id, $nome, $senha, $idTipoUsuario];

$usuario = new Usuario;
$usuarioDao = new UsuarioDao;

$usuarioDao->edit($new_values);
