<?php

namespace conn;

require_once("../modelo/encaminhamento.php");
require_once("../modelo/encaminhamentoDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$idUnidadeSaude = filter_input(INPUT_POST, "idUnidadeSaude", FILTER_SANITIZE_SPECIAL_CHARS);
$idPaciente = filter_input(INPUT_POST, "idPaciente", FILTER_SANITIZE_SPECIAL_CHARS);
$idHospital = filter_input(INPUT_POST, "idHospital", FILTER_SANITIZE_SPECIAL_CHARS);
$idUsuario = filter_input(INPUT_POST, "idUsuario", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "finish", FILTER_SANITIZE_SPECIAL_CHARS);

if (!empty($idUnidadeSaude) && !empty($idPaciente)) {
    if ($type == "true") {
        $encaminhamentoDao = new EncaminhamentoDao;
        $encaminhamentoDao->finish([$id, "Concluido"]);
    } else {
        $new_values = [$id, $idUnidadeSaude, $idPaciente, $idHospital, $idUsuario];

        $encaminhamento = new Encaminhamento;
        $encaminhamentoDao = new EncaminhamentoDao;

        $encaminhamentoDao->edit($new_values);
    }
}
