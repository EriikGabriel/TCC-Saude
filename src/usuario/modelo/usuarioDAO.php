<?php

namespace conn;

class UsuarioDao
{

    //? Create
    public function create(Usuario $u)
    {
        try {
            $sql = 'INSERT INTO USUARIO (nomeUsuario, senhaUsuario, idTipoUsuario) 
                    VALUES (?, ?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $u->getNomeUsuario());
            $stmt->bindValue(2, $u->getSenhaUsuario());
            $stmt->bindValue(3, $u->getIdTipoUsuario());

            $stmt->execute();

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    //? Select
    public function list($requestData)
    {
        try {
            $columnData = $requestData['columns'];

            $sql = 'SELECT `USUARIO`.`idUsuario`, `USUARIO`.`nomeUsuario`, `USUARIO`.`senhaUsuario`, `TIPO_USUARIO`.`tipoUsuario`
            FROM USUARIO 
            INNER JOIN TIPO_USUARIO ON (`USUARIO`.`idTipoUsuario` = `TIPO_USUARIO`.`idTipoUsuario`) 
            WHERE 1 = 1 ';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->execute();

            $registerCount = $stmt->rowCount();

            $filter = $requestData['search']['value'];

            if (!empty($filter)) {
                $sql .= " AND (idUsuario LIKE '$filter%' 
                          OR nomeUsuario LIKE '$filter%' 
                          OR senhaUsuario LIKE '$filter%' 
                          OR tipoUsuario LIKE '$filter%') ";
            }

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->execute();

            $totalFiltred = $stmt->rowCount();

            $columnOrder = $requestData['order'][0]['column'];
            $order = $columnData[$columnOrder]['data'];
            $direction = $requestData['order'][0]['dir'];

            $limitStart = $requestData['start'];
            $limitLenght = $requestData['length'];

            $sql .= " ORDER BY $order $direction LIMIT $limitStart, $limitLenght ";

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($registerCount),
                "recordsFiltered" => intval($totalFiltred),
                "data" => $result
            );

            echo json_encode($json_data);
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    public function search($id, $table, $isWhere, $where = null)
    {
        try {
            if ($isWhere == true) {
                $sql = "SELECT * FROM {$table} WHERE {$where} = ?";

                $stmt = Conexao::getConn()->prepare($sql);
                $stmt->bindValue(1, $id);
                $stmt->execute();
            } else {
                $sql = "SELECT * FROM {$table}";

                $stmt = Conexao::getConn()->prepare($sql);
                $stmt->execute();
            }

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                echo json_encode($result);
            }
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    //? Update
    public function edit($array)
    {
        try {
            $sql = "UPDATE USUARIO SET nomeUsuario = ?, senhaUsuario = ?, idTipoUsuario = ? WHERE idUsuario = ?";

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $array[1]);
            $stmt->bindValue(2, $array[2]);
            $stmt->bindValue(3, $array[3]);
            $stmt->bindValue(4, $array[0]);

            $stmt->execute();

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }

    //? Delete
    public function delete($id)
    {
        try {
            $sql = 'DELETE FROM USUARIO WHERE idUsuario = ?';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);

            $stmt->execute();

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
