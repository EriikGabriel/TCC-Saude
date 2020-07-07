<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);
$table = filter_input(INPUT_POST, "table", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/atendimentoDAO.php");
require_once("../../../conexao/conn.php");

$atendimentoDao = new AtendimentoMedicoDao;

if ($type == "search-data-atendimento") {
    $atendimentoDao->search($id, 'MEDICO_ATENDE_UNIDADE', true, 'CRM');
} else if ($type == "search-select-atendimento") {
    $atendimentoDao->search($id, "{$table}", false);
} else {
    $requestData = $_REQUEST;

    $atendimentoDao->list($requestData);
}
