<?php

namespace conn;

require_once("../modelo/tipo-unidadeDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$tipoUnidadeDao = new TipoUnidadeDao;
$tipoUnidadeDao->delete($id);
