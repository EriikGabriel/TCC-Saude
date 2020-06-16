<?php

namespace conn;

require_once("../modelo/unidade-saudeDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$unidadeDao = new UnidadeSaudeDao;

$unidadeDao->delete($id);
