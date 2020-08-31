<?php

namespace conn;

require_once("../../crud/crud.php");

class EncaminhamentoDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'ENCAMINHAMENTO');
    }

    //? Create
    public function create(Encaminhamento $u)
    {
        try {
            $arrayCreate = array(
                "dataEncaminhamento" => "{$u->getDataEncaminhamento()}",
                "idUnidadeSaude" => "{$u->getIdUnidadeSaude()}",
                "idPaciente" => "{$u->getIdPaciente()}",
                "idHospital" => "{$u->getIdHospital()}",
                "idUsuario" => "{$u->getIdUsuario()}",
                "situacao" => "{$u->getSituacao()}"
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
            $sql = 'SELECT `ENCAMINHAMENTO`.`idEncaminhamento`, `PACIENTE`.`nomePaciente`, `UNIDADE_SAUDE`.`nomeUnidadeSaude`, 
			`UNIDADE_SAUDE`.`ruaUnidadeSaude`, `UNIDADE_SAUDE`.`bairroUnidadeSaude`,
            `HOSPITAL`.`nomeHospital`, `USUARIO`.`nomeUsuario`, `ENCAMINHAMENTO`.`situacao`
            FROM ENCAMINHAMENTO
            INNER JOIN UNIDADE_SAUDE ON (`ENCAMINHAMENTO`.`idUnidadeSaude` = `UNIDADE_SAUDE`.`idUnidadeSaude`)
            INNER JOIN PACIENTE ON (`ENCAMINHAMENTO`.`idPaciente` = `PACIENTE`.`idPaciente`)
            INNER JOIN HOSPITAL ON (`ENCAMINHAMENTO`.`idHospital` = `HOSPITAL`.`idHospital`) 
            INNER JOIN USUARIO ON (`ENCAMINHAMENTO`.`idUsuario` = `USUARIO`.`idUsuario`)
            WHERE 1 = 1 ';

            $arrayFilterParams = array(
                "idEncaminhamento",
                "nomePaciente",
                "nomeUnidadeSaude",
                "ruaUnidadeSaude",
                "bairroUnidadeSaude",
                "nomeHospital",
                "nomeUsuario",
                "situacao"
            );
            $this->crud->getSQLDataTable($requestData, $arrayFilterParams, $sql);
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    public function search($id, $sql = null)
    {
        try {

            if (empty($sql)) $sql = "SELECT * FROM ENCAMINHAMENTO WHERE idEncaminhamento = ?";
            if ($sql == ":encaminhamento") {
                $id = json_decode(json_encode($id), true);
                $array_size = count($id);
                $where = "WHERE ";
                $cont = 1;

                foreach ($id as $key => $value) {
                    if ($array_size > 1) {
                        if ($array_size == 2) {
                            ($cont == 1) ? $where .= "$key = ? AND " : $where .= "$key = ?";
                        }
                        if ($array_size == 3) {
                            ($cont == 1 || $cont == 2) ? $where .= "$key = ? AND " : $where .= "$key = ?";
                        }
                    } else {
                        $where .= "$key = ?";
                    }
                    $cont++;
                }
                $sql = "SELECT `UNIDADE_SAUDE`.`idUnidadeSaude`, `UNIDADE_SAUDE`.`nomeUnidadeSaude`, `ESPECIALIDADE`.`tipoEspecialidade`,
                DATE_FORMAT(`MEDICO_ATENDE_UNIDADE`.`horarioMedico`, '%d/%m/%Y %H:%i') as horarioMedico
                FROM PACIENTE
                INNER JOIN UNIDADE_SAUDE ON 
                (`UNIDADE_SAUDE`.`ruaUnidadeSaude` = `PACIENTE`.`ruaPaciente` AND `UNIDADE_SAUDE`.`bairroUnidadeSaude` = `PACIENTE`.`bairroPaciente`)
                INNER JOIN MEDICO_ATENDE_UNIDADE ON 
                (`MEDICO_ATENDE_UNIDADE`.`idUnidadeSaude` = `UNIDADE_SAUDE`.`idUnidadeSaude`)
                INNER JOIN MEDICO ON 
                (`MEDICO`.`CRM` = `MEDICO_ATENDE_UNIDADE`.`CRM`)
                INNER JOIN ESPECIALIDADE ON 
                (`MEDICO`.`idEspecialidade` = `ESPECIALIDADE`.`idEspecialidade`) {$where}";
            }

            if ($sql == ":edit-encaminhamento") {
                $sql = "SELECT `PACIENTE`.`idPaciente`, `UNIDADE_SAUDE`.`idUnidadeSaude`, `PACIENTE`.`nomePaciente`, `UNIDADE_SAUDE`.`nomeUnidadeSaude`
                FROM ENCAMINHAMENTO
                INNER JOIN UNIDADE_SAUDE ON (`ENCAMINHAMENTO`.`idUnidadeSaude` = `UNIDADE_SAUDE`.`idUnidadeSaude`)
                INNER JOIN PACIENTE ON (`ENCAMINHAMENTO`.`idPaciente` = `PACIENTE`.`idPaciente`)
                WHERE idEncaminhamento = ?";
            }

            $arrayParam = (is_array($id)) ? $id : array($id);
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
                "idUnidadeSaude" => "{$array[1]}",
                "idPaciente" => "{$array[2]}",
                "idHospital" => "{$array[3]}",
                "idUsuario" => "{$array[4]}"
            );
            $arrayCond = array("id" => "idEncaminhamento=$array[0]");
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
            $arrayCond = array('idEncaminhamento=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    public function finish($array)
    {
        try {
            $arrayCond = array("id" => "idEncaminhamento=$array[0]");
            $this->crud->update(array("situacao" => "{$array[1]}"), $arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
