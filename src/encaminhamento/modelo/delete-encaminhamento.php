<?php

namespace conn;

require_once("../modelo/encaminhamentoDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$encaminhamentoDAO = new EncaminhamentoDao;

$encaminhamentoDAO->delete($id);
