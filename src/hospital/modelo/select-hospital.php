<?php

namespace conn;

require_once("../modelo/hospitalDAO.php");
require_once("../../../conexao/conn.php");

$requestData = $_REQUEST;

$HospitalDao = new HospitalDao;

$HospitalDao->list($requestData);
