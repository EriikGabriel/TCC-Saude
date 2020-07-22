<?php

namespace conn;

require_once("../../crud/crud.php");

class MedicoDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'MEDICO');
    }

    //? Create
    public function create(Medico $u)
    {
        try {
            $arrayCreate = array(
                "CRM" => "{$u->getCrm()}",
                "nomeMedico" => "{$u->getNomeMedico()}",
                "idEspecialidade" => "{$u->getIdEspecialidade()}"
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
            $sql = 'SELECT `MEDICO`.`CRM`, `MEDICO`.`nomeMedico`, `ESPECIALIDADE`.`tipoEspecialidade`
            FROM MEDICO
            INNER JOIN ESPECIALIDADE ON (`MEDICO`.`idEspecialidade` = `ESPECIALIDADE`.`idEspecialidade`)
            WHERE 1 = 1 ';

            $arrayFilterParams = array("idTipoUnidade", "tipoUnidade");
            $this->crud->getSQLDataTable($requestData, $arrayFilterParams, $sql);
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    public function search($id, $sql = null)
    {
        try {
            if (empty($sql)) {
                $sql = "SELECT * FROM MEDICO WHERE CRM = ?";
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
                "CRM" => "{$array[1]}",
                "nomeMedico" => "{$array[2]}",
                "idEspecialidade" => "{$array[3]}"
            );
            $arrayCond = array("id" => "CRM=$array[0]");
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
            $arrayCond = array('CRM=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
