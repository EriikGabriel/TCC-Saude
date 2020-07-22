<?php

namespace conn;

require_once("../modelo/especialidadeDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$especialidadeDao = new EspecialidadeDao;

$especialidadeDao->delete($id);
