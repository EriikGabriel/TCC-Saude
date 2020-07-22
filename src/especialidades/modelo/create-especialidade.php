<?php

namespace conn;

require_once("../modelo/especialidade.php");
require_once("../modelo/especialidadeDAO.php");
require_once("../../../conexao/conn.php");

$tipoEspecialidade = filter_input(INPUT_POST, "tipoEspecialidade", FILTER_SANITIZE_SPECIAL_CHARS);

$especialidade = new Especialidade;

$especialidade->setTipoEspecialidade($tipoEspecialidade);

$especialidadeDao = new EspecialidadeDao;

$especialidadeDao->create($especialidade);
