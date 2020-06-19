<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/pacienteDAO.php");
require_once("../../../conexao/conn.php");

$PacienteDao = new PacienteDao;

if($type == "search-dados") {
    $PacienteDao->search($id);
} else {
    $requestData = $_REQUEST;
    
    $PacienteDao->list($requestData);
}