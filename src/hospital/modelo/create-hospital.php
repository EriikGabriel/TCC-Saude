<?php

namespace conn;

require_once("../modelo/hospital.php");
require_once("../modelo/hospitalDAO.php");
require_once("../../../conexao/conn.php");

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
$cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_SPECIAL_CHARS);
$tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);
$idUsuario = filter_input(INPUT_POST, "idUsuario", FILTER_SANITIZE_SPECIAL_CHARS);

if (
    !empty($nome) && !empty($rua) && !empty($bairro)
    &&
    !empty($cep) && !empty($tel) && !empty($idUsuario)
) {
    $hospital = new Hospital;

    $hospital->setNomeHospital($nome);
    $hospital->setRuaHospital($rua);
    $hospital->setBairroHospital($bairro);
    $hospital->setCepHospital($cep);
    $hospital->setTelefoneHospital($tel);
    $hospital->setIdUsuario($idUsuario);

    $hospitalDao = new HospitalDao;

    $hospitalDao->create($hospital);
} else {
    echo "Campos não preenchidos corretamente!";
}
