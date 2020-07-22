<?php

namespace conn;

require_once("../../crud/crud.php");

class EspecialidadeDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'ESPECIALIDADE');
    }

    //? Create
    public function create(Especialidade $es)
    {
        try {
            $arrayCreate = array("tipoEspecialidade" => "{$es->getTipoEspecialidade()}");
            $this->crud->insert($arrayCreate);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function list($requestData)
    {
        try {
            $arrayFilterParams = array("idEspecialidade", "tipoEspecialidade");
            $this->crud->getSQLDataTable($requestData, $arrayFilterParams);
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    //? Search
    public function search($id)
    {
        try {
            $sql = "SELECT * FROM ESPECIALIDADE WHERE idEspecialidade = ?";

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
            $arrayUpdate = array("tipoEspecialidade" => "{$array[1]}");
            $arrayCond = array("id" => "idEspecialidade=$array[0]");
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
            $arrayCond = array('idEspecialidade=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
