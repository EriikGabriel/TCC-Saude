<?php

namespace conn;

class PacienteDao
{

    //? Create
    public function create(Paciente $p)
    {
        try {
            $sql = 'INSERT INTO PACIENTE (nomePaciente, ruaPaciente, bairroPaciente, telefonePaciente, numeroSUS, gravidade) 
                    VALUES (?, ?, ?, ?, ?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $p->getNomePaciente());
            $stmt->bindValue(2, $p->getRuaPaciente());
            $stmt->bindValue(3, $p->getBairroPaciente());
            $stmt->bindValue(4, $p->getTelefonePaciente());
            $stmt->bindValue(5, $p->getNumeroSUS());
            $stmt->bindValue(6, $p->getGravidade());

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

            $sql = 'SELECT * FROM PACIENTE WHERE 1 = 1 ';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->execute();

            $registerCount = $stmt->rowCount();

            $filter = $requestData['search']['value'];

            if (!empty($filter)) {
                $sql .= " AND (idPaciente LIKE '$filter%' 
                          OR nomePaciente LIKE '$filter%' 
                          OR ruaPaciente LIKE '$filter%' 
                          OR bairroPaciente LIKE '$filter%' 
                          OR telefonePaciente LIKE '$filter%' 
                          OR numeroSUS LIKE '$filter%' 
                          OR gravidade LIKE '$filter%') ";
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

    public function search($id)
    {
        try {
            $sql = 'SELECT * FROM PACIENTE WHERE idPaciente = ?';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);
            $stmt->execute();

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
            $sql = "UPDATE PACIENTE SET nomePaciente = ?, ruaPaciente = ?, bairroPaciente = ?, 
            telefonePaciente = ?,  numeroSUS = ?, gravidade = ? WHERE idPaciente = ?";

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
            $sql = 'DELETE FROM PACIENTE WHERE idPaciente = ?';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);

            $stmt->execute();

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
