<?php

namespace conn;

require_once("../modelo/tipo-unidade.php");
require_once("../modelo/tipo-unidadeDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_POST, "tipo", FILTER_SANITIZE_SPECIAL_CHARS);

if (!empty($tipo)) {
    $new_values = [$id, $tipo];

    $tipoUnidade = new TipoUnidade;
    $tipoUnidadeDao = new TipoUnidadeDao;

    $tipoUnidadeDao->edit($new_values);
}
