<?php

namespace conn;

require_once("../modelo/paciente.php");
require_once("../modelo/pacienteDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
$tel = filter_input(INPUT_POST, "tel", FILTER_SANITIZE_SPECIAL_CHARS);
$num = filter_input(INPUT_POST, "numeroSUS", FILTER_SANITIZE_SPECIAL_CHARS);
$gravidade = filter_input(INPUT_POST, "gravidade", FILTER_SANITIZE_SPECIAL_CHARS);

if (
    !empty($nome) && !empty($rua) && !empty($bairro)
    &&
    !empty($tel) && !empty($num) && !empty($gravidade)
) {
    $new_values = [$id, $nome, $rua, $bairro, $tel, $num, $gravidade];

    $paciente = new Paciente;
    $PacienteDao = new PacienteDao;

    $PacienteDao->edit($new_values);
}
