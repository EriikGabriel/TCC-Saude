<?php

namespace conn;

require_once("../modelo/atendimentoDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$atendimentoDao = new AtendimentoMedicoDao;

$atendimentoDao->delete($id);
