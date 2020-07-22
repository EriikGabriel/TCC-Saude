<?php

namespace conn;

require_once("../../crud/crud.php");

class HospitalDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'HOSPITAL');
    }

    //? Create
    public function create(Hospital $u)
    {
        try {
            $arrayCreate = array(
                "nomeHospital" => "{$u->getNomeHospital()}",
                "ruaHospital" => "{$u->getRuaHospital()}",
                "bairroHospital" => "{$u->getBairroHospital()}",
                "cepHospital" => "{$u->getCepHospital()}",
                "telefoneHospital" => "{$u->getTelefoneHospital()}",
                "idUsuario" => "{$u->getIdUsuario()}"
            );
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
            $sql = 'SELECT `HOSPITAL`.`idHospital`, `HOSPITAL`.`nomeHospital`, `HOSPITAL`.`ruaHospital`, `HOSPITAL`.`bairroHospital`, 
            `HOSPITAL`.`cepHospital`, `HOSPITAL`.`telefoneHospital`, `USUARIO`.`nomeUsuario`
            FROM HOSPITAL 
            INNER JOIN USUARIO ON (`HOSPITAL`.`idUsuario` = `USUARIO`.`idUsuario`) WHERE 1 = 1 ';

            $arrayFilterParams = array(
                "idHospital",
                "nomeHospital",
                "ruaHospital",
                "bairroHospital",
                "cepHospital",
                "telefoneHospital",
                "nomeUsuario"
            );
            $this->crud->getSQLDataTable($requestData, $arrayFilterParams, $sql);
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    public function search($id, $sql = null)
    {
        try {
            if (empty($sql)) {
                $sql = "SELECT * FROM HOSPITAL WHERE idHospital = ?";
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
            $arrayUpdate = array(
                "nomeHospital" => "{$array[1]}",
                "ruaHospital" => "{$array[2]}",
                "bairroHospital" => "{$array[3]}",
                "cepHospital" => "{$array[4]}",
                "telefoneHospital" => "{$array[5]}",
                "idUsuario" => "{$array[6]}",
            );
            $arrayCond = array("id" => "idHospital=$array[0]");
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
            $arrayCond = array('idHospital=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
