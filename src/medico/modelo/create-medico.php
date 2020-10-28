<?php

namespace conn;

require_once("../modelo/medico.php");
require_once("../modelo/medicoDAO.php");
require_once("../../../conexao/conn.php");

$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$crm = filter_input(INPUT_POST, "crm", FILTER_SANITIZE_SPECIAL_CHARS);
$idEspecialidade = filter_input(INPUT_POST, "idEspecialidade", FILTER_SANITIZE_SPECIAL_CHARS);

if (!empty($nome) && !empty($crm) && !empty($idEspecialidade)) {
    $medico = new Medico;

    $medico->setCrm($crm);
    $medico->setNomeMedico($nome);
    $medico->setIdEspecialidade($idEspecialidade);

    $medicoDao = new MedicoDao;

    $medicoDao->create($medico);
} else {
    echo "Campos não preenchidos corretamente!";
}
