<?php

namespace conn;

require_once("../modelo/atendimento-medico.php");
require_once("../modelo/atendimentoDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$horario = filter_input(INPUT_POST, "horario", FILTER_SANITIZE_SPECIAL_CHARS);
$crm = filter_input(INPUT_POST, "crm", FILTER_SANITIZE_SPECIAL_CHARS);
$idUnidadeSaude = filter_input(INPUT_POST, "idUnidadeSaude", FILTER_SANITIZE_SPECIAL_CHARS);

$new_values = [$id, $horario, $idUnidadeSaude, $crm];

$atendimento = new AtendimentoMedico;
$atendimentoDao = new AtendimentoMedicoDao;

$atendimentoDao->edit($new_values);
