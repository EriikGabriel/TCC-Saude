<?php

namespace conn;

require_once("../modelo/usuario.php");
require_once("../modelo/usuarioDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "idUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, "nomeUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, "senhaUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$newSenha = filter_input(INPUT_POST, "newSenha", FILTER_SANITIZE_SPECIAL_CHARS);
$idTipoUsuario = filter_input(INPUT_POST, "idTipoUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$hash = filter_input(INPUT_POST, "cript");

if ($hash == null) {
    $new_values = [$id, $nome, null, $idTipoUsuario];
} else if (password_verify($senha, $hash)) {
    $new_values = [$id, $nome, password_hash($newSenha, PASSWORD_DEFAULT), $idTipoUsuario];
} else {
    die("");
}

$usuario = new Usuario;
$usuarioDao = new UsuarioDao;

$usuarioDao->edit($new_values);
