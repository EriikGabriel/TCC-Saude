<?php

namespace conn;

require_once("../modelo/medico.php");
require_once("../modelo/medicoDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$crm = filter_input(INPUT_POST, "crm", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$idEspecialidade = filter_input(INPUT_POST, "idEspecialidade", FILTER_SANITIZE_SPECIAL_CHARS);

if (!empty($nome) && !empty($crm) && !empty($idEspecialidade)) {
    $new_values = [$id, $crm, $nome, $idEspecialidade];

    $medico = new Medico;
    $medicoDao = new MedicoDao;

    $medicoDao->edit($new_values);
}
