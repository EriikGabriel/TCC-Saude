<?php

namespace conn;

class EncaminhamentoDao
{

    //? Create
    public function create(Encaminhamento $en)
    {
        try {
            $sql = 'INSERT INTO ENCAMINHAMENTO (dataEncaminhamento, idUnidadeSaude, idPaciente, idHospital, idUsuario) 
                    VALUES (?, ?, ?, ?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $en->getDataEncaminhamento());
            $stmt->bindValue(2, $en->getIdUnidadeSaude());
            $stmt->bindValue(3, $en->getIdPaciente());
            $stmt->bindValue(4, $en->getIdHospital());
            $stmt->bindValue(5, $en->getIdUsuario());

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

            $sql = 'SELECT `ENCAMINHAMENTO`.`idEncaminhamento`, `PACIENTE`.`nomePaciente`, `UNIDADE_SAUDE`.`nomeUnidadeSaude`, 
			`UNIDADE_SAUDE`.`ruaUnidadeSaude`, `UNIDADE_SAUDE`.`bairroUnidadeSaude`, `MEDICO`.`nomeMedico`,
            DATE_FORMAT(`MEDICO_ATENDE_UNIDADE`.`horarioMedico`, "%d/%m/%Y") AS horario,
            `HOSPITAL`.`nomeHospital`, `USUARIO`.`nomeUsuario`
            FROM ENCAMINHAMENTO
            INNER JOIN UNIDADE_SAUDE ON (`ENCAMINHAMENTO`.`idUnidadeSaude` = `UNIDADE_SAUDE`.`idUnidadeSaude`)
            INNER JOIN PACIENTE ON (`ENCAMINHAMENTO`.`idPaciente` = `PACIENTE`.`idPaciente`)
            INNER JOIN MEDICO_ATENDE_UNIDADE ON (`ENCAMINHAMENTO`.`idUnidadeSaude` = `UNIDADE_SAUDE`.`idUnidadeSaude`)
            INNER JOIN MEDICO ON (`MEDICO`.`CRM` = `MEDICO_ATENDE_UNIDADE`.`CRM`) 
            INNER JOIN HOSPITAL ON (`ENCAMINHAMENTO`.`idHospital` = `HOSPITAL`.`idHospital`) 
            INNER JOIN USUARIO ON (`ENCAMINHAMENTO`.`idUsuario` = `USUARIO`.`idUsuario`)
            WHERE 1 = 1 ';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->execute();

            $registerCount = $stmt->rowCount();

            $filter = $requestData['search']['value'];

            if (!empty($filter)) {
                $sql .= " AND (CRM LIKE '$filter%' 
                          OR nomeMedico LIKE '$filter%' 
                          OR tipoEspecialidade LIKE '$filter%') ";
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
            $sql = "UPDATE MEDICO SET CRM = ?, nomeMedico = ?, idEspecialidade = ? WHERE CRM = ?";

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
            $sql = 'DELETE FROM ENCAMINHAMENTO WHERE idEncaminhamento = ?';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);

            $stmt->execute();

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}
