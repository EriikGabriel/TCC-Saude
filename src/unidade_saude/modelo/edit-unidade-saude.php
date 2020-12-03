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
$vagas = filter_input(INPUT_POST, "vagas", FILTER_SANITIZE_SPECIAL_CHARS);

if (
    !empty($nome) && !empty($rua) && !empty($bairro)
    &&
    !empty($tel) && !empty($idTipoUnidade) && !empty($vagas)
) {
    $new_values = [$id, $nome, $rua, $bairro, $tel, $idTipoUnidade, $vagas];
} else if ($vagas != null) {
    $new_values = [$id, $vagas];
}

$unidade = new UnidadeSaude;
$unidadeDao = new UnidadeSaudeDao;

$unidadeDao->edit($new_values);
