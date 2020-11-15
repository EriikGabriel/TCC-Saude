<?php

namespace conn;

require_once("../modelo/unidade-saude.php");
require_once("../modelo/unidade-saudeDAO.php");
require_once("../../../conexao/conn.php");

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
$tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);
$id = filter_input(INPUT_POST, "idTipoUnidade", FILTER_SANITIZE_SPECIAL_CHARS);

if (
    !empty($nome) && !empty($rua) && !empty($bairro)
    &&
    !empty($tel) && !empty($id)
) {
    $unidade = new UnidadeSaude;

    $unidade->setNomeUnidadeSaude($nome);
    $unidade->setRuaUnidadeSaude($rua);
    $unidade->setBairroUnidadeSaude($bairro);
    $unidade->setTelefoneUnidadeSaude($tel);
    $unidade->setVagas(3);
    $unidade->setIdTipoUnidade($id);

    $unidadeDao = new UnidadeSaudeDao;

    $unidadeDao->create($unidade);
} else {
    echo "Campos não preenchidos corretamente!";
}
