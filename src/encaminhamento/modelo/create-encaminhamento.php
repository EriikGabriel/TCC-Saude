<?php

namespace conn;

require_once("../modelo/encaminhamento.php");
require_once("../modelo/encaminhamentoDAO.php");
require_once("../../../conexao/conn.php");

$data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_SPECIAL_CHARS);
$idUnidadeSaude = filter_input(INPUT_POST, "idUnidadeSaude", FILTER_SANITIZE_SPECIAL_CHARS);
$idPaciente = filter_input(INPUT_POST, "idPaciente", FILTER_SANITIZE_SPECIAL_CHARS);
$idHospital = filter_input(INPUT_POST, "idHospital", FILTER_SANITIZE_SPECIAL_CHARS);
$idUsuario = filter_input(INPUT_POST, "idUsuario", FILTER_SANITIZE_SPECIAL_CHARS);

$encaminhamento = new Encaminhamento;

$encaminhamento->setDataEncaminhamento($data);
$encaminhamento->setIdUnidadeSaude($idUnidadeSaude);
$encaminhamento->setIdPaciente($idPaciente);
$encaminhamento->setIdHospital($idHospital);
$encaminhamento->setIdUsuario($idUsuario);

$encaminhamentoDao = new EncaminhamentoDao;

$encaminhamentoDao->create($encaminhamento);
