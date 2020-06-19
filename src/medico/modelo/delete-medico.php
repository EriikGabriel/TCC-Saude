<?php

namespace conn;

require_once("../modelo/medicoDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$medicoDao = new MedicoDao;

$medicoDao->delete($id);
