<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/atendimentoDAO.php");
require_once("../../../conexao/conn.php");

$atendimentoDao = new AtendimentoMedicoDao;

if ($type == "search-data-atendimento") {
    $atendimentoDao->search($id);
} else if ($type == "search-select-atendimento") {
    $sql = "SELECT * FROM {$table}";
    $atendimentoDao->search($id, $sql);
} else if ($type == "count-dados") {
    $sql = "SELECT COUNT(*) as count FROM ENCAMINHAMENTO WHERE idUnidadeSaude = ?";
    $atendimentoDao->search($id, $sql);
} else {
    $requestData = $_REQUEST;

    $atendimentoDao->list($requestData);
}
