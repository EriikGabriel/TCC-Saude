<?php

namespace conn;

require_once("../modelo/unidade-saude.php");
require_once("../modelo/unidade-saudeDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
$tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);
$idTipoUnidade = filter_input(INPUT_POST, "idTipoUnidade", FILTER_SANITIZE_SPECIAL_CHARS);

$new_values = [$id, $nome, $rua, $bairro, $tel, $idTipoUnidade];

$unidade = new UnidadeSaude;
$unidadeDao = new UnidadeSaudeDao;

$unidadeDao->edit($new_values);
