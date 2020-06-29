<?php

namespace conn;

class UnidadeSaudeDao
{

    //? Create
    public function create(UnidadeSaude $un)
    {
        try {
            $sql = 'INSERT INTO UNIDADE_SAUDE (nomeUnidadeSaude, ruaUnidadeSaude, bairroUnidadeSaude, telefoneUnidadeSaude, idTipoUnidade) 
                    VALUES (?, ?, ?, ?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $un->getNomeUnidadeSaude());
            $stmt->bindValue(2, $un->getRuaUnidadeSaude());
            $stmt->bindValue(3, $un->getBairroUnidadeSaude());
            $stmt->bindValue(4, $un->getTelefoneUnidadeSaude());
            $stmt->bindValue(5, $un->getIdTipoUnidade());

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

            $sql = 'SELECT `UNIDADE_SAUDE`.`idUnidadeSaude`, `UNIDADE_SAUDE`.`nomeUnidadeSaude`, 
            `UNIDADE_SAUDE`.`ruaUnidadeSaude`, `UNIDADE_SAUDE`.`bairroUnidadeSaude`, `UNIDADE_SAUDE`.`telefoneUnidadeSaude`, `TIPO_UNIDADE`.`tipoUnidade`
            FROM UNIDADE_SAUDE
            INNER JOIN TIPO_UNIDADE ON (`UNIDADE_SAUDE`.`idTipoUnidade` = `TIPO_UNIDADE`.`idTipoUnidade`) 
            WHERE 1 = 1 ';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->execute();

            $registerCount = $stmt->rowCount();

            $filter = $requestData['search']['value'];

            if (!empty($filter)) {
                $sql .= " AND (idUnidadeSaude LIKE '$filter%' 
                          OR nomeUnidadeSaude LIKE '$filter%' 
                          OR ruaUnidadeSaude LIKE '$filter%' 
                          OR bairroUnidadeSaude LIKE '$filter%' 
                          OR telefoneUnidadeSaude LIKE '$filter%' 
                          OR tipoUnidade LIKE '$filter%') ";
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
            $sql = "UPDATE UNIDADE_SAUDE SET nomeUnidadeSaude = ?, ruaUnidadeSaude = ?, bairroUnidadeSaude = ?, telefoneUnidadeSaude = ?, idTipoUnidade = ? WHERE idUnidadeSaude = ?";

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $array[1]);
            $stmt->bindValue(2, $array[2]);
            $stmt->bindValue(3, $array[3]);
            $stmt->bindValue(4, $array[4]);
            $stmt->bindValue(5, $array[5]);
            $stmt->bindValue(6, $array[0]);

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
            $sql = 'DELETE FROM UNIDADE_SAUDE WHERE idUnidadeSaude = ?';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);

            $stmt->execute();

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
