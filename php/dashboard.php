<?php

namespace conn;

require_once("../src/crud/crud.php");

class Dashboard
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo);
    }

    public function count($array)
    {
        try {
            $array_result = [];
            foreach ($array as $table) {
                $sql = "SELECT COUNT(*) FROM $table";
                $response = $this->crud->getSQLGeneric($sql)[0];
                array_push($array_result, $response);
            }

            echo json_encode($array_result);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
