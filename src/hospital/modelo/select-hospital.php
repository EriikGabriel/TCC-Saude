<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_SPECIAL_CHARS);

require_once("../modelo/hospitalDAO.php");
require_once("../../../conexao/conn.php");

$HospitalDao = new HospitalDao;

if($type == "search-dados") {
    $HospitalDao->search($id);
} else {
    $requestData = $_REQUEST;
    
    $HospitalDao->list($requestData);
}

