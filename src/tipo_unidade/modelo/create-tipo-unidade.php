<?php

namespace conn;

require_once("../modelo/tipo-unidade.php");
require_once("../modelo/tipo-unidadeDAO.php");
require_once("../../../conexao/conn.php");

$tipo = filter_input(INPUT_POST, "tipo", FILTER_SANITIZE_SPECIAL_CHARS);

$tipoUnidade = new TipoUnidade;

$tipoUnidade->setTipoUnidade($tipo);

$tipoUnidadeDao = new TipoUnidadeDao;

$tipoUnidadeDao->create($tipoUnidade);

