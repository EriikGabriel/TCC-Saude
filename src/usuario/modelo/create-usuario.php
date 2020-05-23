<?php

namespace conn;

require_once("../modelo/usuario.php");
require_once("../modelo/usuarioDAO.php");
require_once("../../../conexao/conn.php");

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_SPECIAL_CHARS);
$idTipoUsuario = filter_input(INPUT_POST, "idTipoUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$idHospital = filter_input(INPUT_POST, "idHospital", FILTER_SANITIZE_SPECIAL_CHARS);

$usuario = new Usuario;

$usuario->setNomeUsuario($nome);
$usuario->setSenhaUsuario($senha);
$usuario->setIdTipoUsuario($idTipoUsuario);
$usuario->setIdHospital($idHospital);

$usuarioDao = new UsuarioDao;

$usuarioDao->create($usuario);

