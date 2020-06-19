<?php

namespace conn;

require_once("../modelo/pacienteDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$PacienteDao = new PacienteDao;

$PacienteDao->delete($id);