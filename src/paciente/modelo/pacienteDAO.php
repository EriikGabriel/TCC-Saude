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
            } else if ($sql == ":encaminhamento") {
                $id = json_decode($id, true);
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
                (`MEDICO`.`idEspecialidade` = `ESPECIALIDADE`.`idEspecialidade`) {$where} AND `UNIDADE_SAUDE`.`vagas` > 0";
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
