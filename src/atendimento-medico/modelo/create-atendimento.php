<?php

namespace conn;

require_once("../modelo/atendimento-medico.php");
require_once("../modelo/atendimentoDAO.php");
require_once("../../../conexao/conn.php");

$data = filter_input(INPUT_POST, "data", FILTER_SANITIZE_SPECIAL_CHARS);
$horario = filter_input(INPUT_POST, "horario", FILTER_SANITIZE_SPECIAL_CHARS);
$crm = filter_input(INPUT_POST, "CRM", FILTER_SANITIZE_SPECIAL_CHARS);
$unidadeSaude = filter_input(INPUT_POST, "idUnidadeSaude", FILTER_SANITIZE_SPECIAL_CHARS);

$atendimento = new AtendimentoMedico;

$atendimento->setHorarioMedico($data . " " . $horario);
$atendimento->setIdUnidadeSaude($unidadeSaude);
$atendimento->setCrm($crm);

$atendimentoDao = new AtendimentoMedicoDao;

$atendimentoDao->create($atendimento);
