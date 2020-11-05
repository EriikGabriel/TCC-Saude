<?php

namespace conn;

require_once("../../crud/crud.php");

class UsuarioDao
{
    private $crud = null;

    public function __construct()
    {
        $pdo = Conexao::getConn();
        $this->crud = Crud::getInstance($pdo, 'USUARIO');
    }

    //? Create
    public function create(Usuario $u)
    {
        try {
            $arrayCreate = array(
                "nomeUsuario" => "{$u->getNomeUsuario()}",
                "senhaUsuario" => "{$u->getSenhaUsuario()}",
                "idTipoUsuario" => "{$u->getIdTipoUsuario()}"
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
            $sql = 'SELECT `USUARIO`.`idUsuario`, `USUARIO`.`nomeUsuario`, `USUARIO`.`senhaUsuario`, `TIPO_USUARIO`.`tipoUsuario`
            FROM USUARIO 
            INNER JOIN TIPO_USUARIO ON (`USUARIO`.`idTipoUsuario` = `TIPO_USUARIO`.`idTipoUsuario`) 
            WHERE 1 = 1 ';

            $arrayFilterParams = array("idUsuario", "nomeUsuario", "senhaUsuario", "tipoUsuario");
            $this->crud->getSQLDataTable($requestData, $arrayFilterParams, $sql);
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    public function search($id, $sql = null, $senha = null)
    {
        try {
            $check_password = false;

            if (empty($sql) && $senha == null) {
                $sql = "SELECT * FROM USUARIO WHERE idUsuario = ?";
            } else if ($senha != null) {
                $sql = "SELECT * FROM USUARIO WHERE nomeUsuario = ?";
                $check_password = true;
            }

            $arrayParam = array($id);
            $retorno = $this->crud->getSQLGeneric($sql, $arrayParam, TRUE);

            if (isset($retorno[0]->nomeUsuario) && $retorno[0]->nomeUsuario == "Administrador") {
                if ($senha == $retorno[0]->senhaUsuario) return json_encode($retorno);
            } else if ($retorno > 0 && $check_password && $retorno != null) {
                if (password_verify($senha, $retorno[0]->senhaUsuario)) return json_encode($retorno);
            } else {
                if ($retorno > 0) echo json_encode($retorno);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    //? Update
    public function edit($array)
    {
        try {

            if ($array[2] == null) {
                $arrayUpdate = array(
                    "nomeUsuario" => "{$array[1]}",
                    "idTipoUsuario" => "{$array[3]}"
                );
            } else {
                $arrayUpdate = array(
                    "nomeUsuario" => "{$array[1]}",
                    "senhaUsuario" => "{$array[2]}",
                    "idTipoUsuario" => "{$array[3]}"
                );
            }
            $arrayCond = array("id" => "idUsuario=$array[0]");
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
            $arrayCond = array('idUsuario=' => "$id");
            $this->crud->delete($arrayCond);

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
