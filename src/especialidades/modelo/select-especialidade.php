<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/especialidadeDAO.php");
require_once("../../../conexao/conn.php");

$especialidadeDao = new EspecialidadeDao;

if($type == "search-dados") {
    $especialidadeDao->search($id);
} else {
    $requestData = $_REQUEST;
    
    $especialidadeDao->list($requestData);
}

