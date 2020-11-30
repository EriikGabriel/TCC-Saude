<?php

namespace conn;

require_once("../../crud/crud.php");

class TipoUsuarioDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'TIPO_USUARIO');
    }

    //? Create
    public function create(TipoUsuario $tus)
    {
        try {
            $arrayCreate = array("tipoUsuario" => "{$tus->getTipoUsuario()}");
            $this->crud->insert($arrayCreate);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    //? Select
    public function list($requestData)
    {
        try {
            $arrayFilterParams = array("idTipoUsuario", "tipoUsuario");
            $this->crud->getSQLDataTable($requestData, $arrayFilterParams);
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    public function search($id, $type)
    {
        try {
            if ($type == "search-dados") {
                $sql = "SELECT * FROM TIPO_USUARIO WHERE idTipoUsuario = ?";
            } else {
                $sql = "SELECT COUNT(*) as count FROM USUARIO WHERE idTipoUsuario = ?";
            }

            $arrayParam = array($id);
            $retorno = $this->crud->getSQLGeneric($sql, $arrayParam, TRUE);

            if ($retorno > 0) echo json_encode($retorno);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    //? Update
    public function edit($array)
    {
        try {
            $arrayUpdate = array("tipoUsuario" => "{$array[1]}");
            $arrayCond = array("id" => "idTipoUsuario=$array[0]");
            $this->crud->update($arrayUpdate, $arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    //? Delete
    public function delete($id)
    {
        try {
            $arrayCond = array('idTipoUsuario=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
