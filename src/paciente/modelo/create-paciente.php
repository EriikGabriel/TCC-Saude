<?php

namespace conn;

require_once("../modelo/paciente.php");
require_once("../modelo/pacienteDAO.php");
require_once("../../../conexao/conn.php");

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
$tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);
$num = filter_input(INPUT_POST, "numeroSUS", FILTER_SANITIZE_SPECIAL_CHARS);
$gravidade = filter_input(INPUT_POST, "gravidade", FILTER_SANITIZE_SPECIAL_CHARS);

$paciente = new Paciente;

$paciente->setNomePaciente($nome);
$paciente->setRuaPaciente($rua);
$paciente->setBairroPaciente($bairro);
$paciente->setTelefonePaciente($tel);
$paciente->setNumeroSUS($num);
$paciente->setGravidade($gravidade);

$PacienteDao = new PacienteDao;

$PacienteDao->create($paciente);