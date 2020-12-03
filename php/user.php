<?php

namespace conn;

require_once("../src/crud/crud.php");

class User
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo);
    }

    public function getInfo($id)
    {
        try {
            $sql = "SELECT `USUARIO`.`nomeUsuario`, `TIPO_USUARIO`.`tipoUsuario` FROM USUARIO
            INNER JOIN TIPO_USUARIO ON (`TIPO_USUARIO`.`idTipoUsuario` = `USUARIO`.`idTipoUsuario`)
            WHERE idUsuario = ?";

            $arrayParam = (is_array($id)) ? $id : array($id);
            $retorno = $this->crud->getSQLGeneric($sql, $arrayParam, TRUE);


            if ($retorno > 0) echo json_encode($retorno);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
