<?php

namespace conn;

require_once("../php/dashboard.php");
require_once("../php/user.php");
require_once("../conexao/conn.php");

$tabelas = filter_input(INPUT_POST, "tabelas");
$id = filter_input(INPUT_POST, "id");

if (!empty($tabelas)) {
    $tabelas = json_decode($tabelas);

    $dashboard = new Dashboard;
    $dashboard->count($tabelas);
} else {
    $user = new User;
    $user->getInfo(json_decode($id));
}
