<?php

namespace conn;

require_once("../../crud/crud.php");

class AtendimentoMedicoDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'MEDICO_ATENDE_UNIDADE');
    }

    //? Create
    public function create(AtendimentoMedico $u)
    {
        try {
            $arrayCreate = array(
                "horarioMedico" => "{$u->getHorarioMedico()}",
                "idUnidadeSaude" => "{$u->getIdUnidadeSaude()}",
                "CRM" => "{$u->getCrm()}"
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
            $sql = 'SELECT `MEDICO`.`CRM`, `MEDICO`.`nomeMedico`, `ESPECIALIDADE`.`tipoEspecialidade`, 
			DATE_FORMAT(`MEDICO_ATENDE_UNIDADE`.`horarioMedico`, "%d/%m/%Y %H:%i") as horarioMedico, `UNIDADE_SAUDE`.`nomeUnidadeSaude`
            FROM MEDICO 
            INNER JOIN ESPECIALIDADE ON (`MEDICO`.`idEspecialidade` = `ESPECIALIDADE`.`idEspecialidade`)
            INNER JOIN MEDICO_ATENDE_UNIDADE ON (`MEDICO`.`CRM` = `MEDICO_ATENDE_UNIDADE`.`CRM`)
            INNER JOIN UNIDADE_SAUDE ON (`MEDICO_ATENDE_UNIDADE`.`idUnidadeSaude` = `UNIDADE_SAUDE`.`idUnidadeSaude`)
            WHERE 1 = 1 ';

            $arrayFilterParams = array(
                "CRM",
                "nomeMedico",
                "tipoEspecialidade",
                "horarioMedico",
                "nomeUnidadeSaude"
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
                $sql = "SELECT * FROM MEDICO_ATENDE_UNIDADE WHERE CRM = ?";
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
                "horarioMedico" => "{$array[1]}",
                "idUnidadeSaude" => "{$array[2]}",
                "CRM" => "{$array[3]}"
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
