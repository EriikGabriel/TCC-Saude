<?php

namespace conn;

require_once("../../crud/crud.php");

class TipoUnidadeDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'TIPO_UNIDADE');
    }

    //? Create
    public function create(TipoUnidade $tun)
    {
        try {
            $arrayCreate = array("tipoUnidade" => "{$tun->getTipoUnidade()}");
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
            $arrayFilterParams = array("idTipoUnidade", "tipoUnidade");
            $this->crud->getSQLDataTable($requestData, $arrayFilterParams);
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    public function search($id)
    {
        try {
            $sql = "SELECT * FROM TIPO_UNIDADE WHERE idTipoUnidade = ?";

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
            $arrayUpdate = array("tipoUnidade" => "{$array[1]}");
            $arrayCond = array("id" => "idTipoUnidade=$array[0]");
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
            $arrayCond = array('idTipoUnidade=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
