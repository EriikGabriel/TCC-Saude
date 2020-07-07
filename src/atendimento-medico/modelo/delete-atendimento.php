<?php

namespace conn;

require_once("../modelo/hospitalDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$HospitalDao = new HospitalDao;

$HospitalDao->delete($id);