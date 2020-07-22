<?php

namespace conn;

require_once("../../crud/crud.php");

class PacienteDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'PACIENTE');
    }

    //? Create
    public function create(Paciente $u)
    {
        try {
            $arrayCreate = array(
                "nomePaciente" => "{$u->getNomePaciente()}",
                "ruaPaciente" => "{$u->getRuaPaciente()}",
                "bairroPaciente" => "{$u->getBairroPaciente()}",
                "telefonePaciente" => "{$u->getTelefonePaciente()}",
                "numeroSUS" => "{$u->getNumeroSUS()}",  
                "gravidade" => "{$u->getGravidade()}"
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
            $sql = 'SELECT * FROM PACIENTE';

            $arrayFilterParams = array(
                "idPaciente",
                "nomePaciente",
                "ruaPaciente",
                "bairroPaciente",
                "telefonePaciente",
                "numeroSUS",              
                "gravidade"
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
                $sql = "SELECT * FROM PACIENTE WHERE idPaciente = ?";
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
                "nomePaciente" => "{$array[1]}",
                "ruaPaciente" => "{$array[2]}",
                "bairroPaciente" => "{$array[3]}",
                "telefonePaciente" => "{$array[4]}",
                "numeroSUS" => "{$array[5]}",           
                "gravidade" => "{$array[6]}",
            );
            $arrayCond = array("id" => "idPaciente=$array[0]");
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
            $arrayCond = array('idPaciente=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
