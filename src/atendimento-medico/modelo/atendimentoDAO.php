<?php

namespace conn;

class AtendimentoMedicoDao
{

    //? Create
    public function create(AtendimentoMedico $at)
    {
        try {
            $sql = 'INSERT INTO MEDICO_ATENDE_UNIDADE (horarioMedico, idUnidadeSaude, CRM) 
                    VALUES (?, ?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $at->getHorarioMedico());
            $stmt->bindValue(2, $at->getIdUnidadeSaude());
            $stmt->bindValue(3, $at->getCrm());

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

            $sql = 'SELECT `MEDICO`.`CRM`, `MEDICO`.`nomeMedico`, `ESPECIALIDADE`.`tipoEspecialidade`, 
			`MEDICO_ATENDE_UNIDADE`.`horarioMedico`, `UNIDADE_SAUDE`.`nomeUnidadeSaude`
            FROM MEDICO 
            INNER JOIN ESPECIALIDADE ON (`MEDICO`.`idEspecialidade` = `ESPECIALIDADE`.`idEspecialidade`)
            INNER JOIN MEDICO_ATENDE_UNIDADE ON (`MEDICO`.`CRM` = `MEDICO_ATENDE_UNIDADE`.`CRM`)
            INNER JOIN UNIDADE_SAUDE ON (`MEDICO_ATENDE_UNIDADE`.`idUnidadeSaude` = `UNIDADE_SAUDE`.`idUnidadeSaude`)
            WHERE 1 = 1';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->execute();

            $registerCount = $stmt->rowCount();

            $filter = $requestData['search']['value'];

            if (!empty($filter)) {
                $sql .= " AND (idHospital LIKE '$filter%' 
                          OR nomeHospital LIKE '$filter%'
                          OR ruaHospital LIKE '$filter%'
                          OR bairroHospital LIKE '$filter%'
                          OR cepHospital LIKE '$filter%'
                          OR telefoneHospital LIKE '$filter%' 
                          OR nomeUsuario LIKE '$filter%') ";
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
            $sql = "UPDATE MEDICO_ATENDE_UNIDADE SET horarioMedico = ?, idUnidadeSaude = ?, CRM = ? 
            WHERE CRM = ?";

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $array[1]);
            $stmt->bindValue(2, $array[2]);
            $stmt->bindValue(3, $array[0]);
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
