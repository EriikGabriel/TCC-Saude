<?php

namespace conn;

require_once("../modelo/usuario.php");
require_once("../modelo/usuarioDAO.php");
require_once("../../../conexao/conn.php");

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);
$idTipoUsuario = filter_input(INPUT_POST, "idTipoUsuario", FILTER_SANITIZE_SPECIAL_CHARS);

$usuario = new Usuario;

$usuario->setNomeUsuario($nome);
$usuario->setSenhaUsuario(password_hash($senha, PASSWORD_DEFAULT));
$usuario->setIdTipoUsuario($idTipoUsuario);

$usuarioDao = new UsuarioDao;

$usuarioDao->create($usuario);
