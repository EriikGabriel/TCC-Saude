<?php

namespace conn;

require_once("../../crud/crud.php");

class UnidadeSaudeDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'UNIDADE_SAUDE');
    }

    //? Create
    public function create(UnidadeSaude $u)
    {
        try {
            $arrayCreate = array(
                "nomeUnidadeSaude" => "{$u->getNomeUnidadeSaude()}",
                "ruaUnidadeSaude" => "{$u->getRuaUnidadeSaude()}",
                "bairroUnidadeSaude" => "{$u->getBairroUnidadeSaude()}",
                "telefoneUnidadeSaude" => "{$u->getTelefoneUnidadeSaude()}",
                "vagas" => "{$u->getVagas()}",
                "idTipoUnidade" => "{$u->getIdTipoUnidade()}"
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
            $sql = 'SELECT `UNIDADE_SAUDE`.`idUnidadeSaude`, `UNIDADE_SAUDE`.`nomeUnidadeSaude`, `UNIDADE_SAUDE`.`ruaUnidadeSaude`,
            `UNIDADE_SAUDE`.`bairroUnidadeSaude`, `UNIDADE_SAUDE`.`telefoneUnidadeSaude`, `UNIDADE_SAUDE`.`vagas`, `TIPO_UNIDADE`.`tipoUnidade`
            FROM UNIDADE_SAUDE
            INNER JOIN TIPO_UNIDADE ON (`UNIDADE_SAUDE`.`idTipoUnidade` = `TIPO_UNIDADE`.`idTipoUnidade`) 
            WHERE 1 = 1 ';

            $arrayFilterParams = array(
                "idUnidadeSaude",
                "nomeUnidadeSaude",
                "ruaUnidadeSaude",
                "bairroUnidadeSaude",
                "telefoneUnidadeSaude",
                "vagas",
                "tipoUnidade",
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
                $sql = "SELECT * FROM UNIDADE_SAUDE WHERE idUnidadeSaude = ?";
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
            if (count($array) == 2) {
                $arrayUpdate = array("vagas" => "{$array[1]}");
            } else {
                $arrayUpdate = array(
                    "nomeUnidadeSaude" => "{$array[1]}",
                    "ruaUnidadeSaude" => "{$array[2]}",
                    "bairroUnidadeSaude" => "{$array[3]}",
                    "telefoneUnidadeSaude" => "{$array[4]}",
                    "idTipoUnidade" => "{$array[5]}",
                );
            }
            $arrayCond = array("id" => "idUnidadeSaude=$array[0]");
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
            $arrayCond = array('idUnidadeSaude=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
