<?php

namespace conn;

require_once("../php/dashboard.php");
require_once("../conexao/conn.php");

$tabelas = filter_input(INPUT_POST, "tabelas");

$tabelas = json_decode($tabelas);

$dashboard = new Dashboard;
$dashboard->count($tabelas);
