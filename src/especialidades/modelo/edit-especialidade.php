<?php

namespace conn;

require_once("../modelo/especialidade.php");
require_once("../modelo/especialidadeDAO.php");
require_once("../../../conexao/conn.php");

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
$tipo = filter_input(INPUT_POST, "tipoEspecialidade", FILTER_SANITIZE_SPECIAL_CHARS);

$new_values = [$id, $tipo];

$especialidade = new Especialidade;
$especialidadeDao = new EspecialidadeDao;

$especialidadeDao->edit($new_values);