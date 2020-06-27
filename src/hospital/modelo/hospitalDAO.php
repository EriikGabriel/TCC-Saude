<?php

namespace conn;

class HospitalDao
{

    //? Create
    public function create(Hospital $h)
    {
        try {
            $sql = 'INSERT INTO HOSPITAL (nomeHospital, ruaHospital, bairroHospital, cepHospital, telefoneHospital, idUsuario) 
                    VALUES (?, ?, ?, ?, ?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $h->getNomeHospital());
            $stmt->bindValue(2, $h->getRuaHospital());
            $stmt->bindValue(3, $h->getBairroHospital());
            $stmt->bindValue(4, $h->getCepHospital());
            $stmt->bindValue(5, $h->getTelefoneHospital());
            $stmt->bindValue(6, $h->getIdUsuario());

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

            $sql = 'SELECT `HOSPITAL`.`idHospital`, `HOSPITAL`.`nomeHospital`, `HOSPITAL`.`ruaHospital`, `HOSPITAL`.`bairroHospital`, 
            `HOSPITAL`.`cepHospital`, `HOSPITAL`.`telefoneHospital`, `USUARIO`.`nomeUsuario`
            FROM HOSPITAL 
            INNER JOIN USUARIO ON (`HOSPITAL`.`idUsuario` = `USUARIO`.`idUsuario`)';

            $stmt = Conexao::getConn()->prepare($sql);

            $stmt->execute();

            $registerCount = $stmt->rowCount();

            $columnOrder = $requestData['order'][0]['column'];
            $order = $columnData[$columnOrder]['data'];
            $direction = $requestData['order'][0]['dir'];

            $limitStart = $requestData['start'];
            $limitLenght = $requestData['length'];

            $totalFiltred = 0;

            $sql .= " ORDER BY $order $direction LIMIT $limitStart, $limitLenght ";

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
            $sql = "UPDATE HOSPITAL SET nomeHospital = ?, ruaHospital = ?, bairroHospital = ?, cepHospital = ?, telefoneHospital = ?, idUsuario = ? WHERE idHospital = ?";

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $array[1]);
            $stmt->bindValue(2, $array[2]);
            $stmt->bindValue(3, $array[3]);
            $stmt->bindValue(4, $array[4]);
            $stmt->bindValue(5, $array[5]);
            $stmt->bindValue(6, $array[6]);
            $stmt->bindValue(7, $array[0]);

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
            $sql = 'DELETE FROM HOSPITAL WHERE idHospital = ?';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);

            $stmt->execute();

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
