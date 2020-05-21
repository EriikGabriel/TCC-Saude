<?php

namespace conn;

class HospitalDao {

    //? Create
    public function create(Hospital $h) {
        try {
            $sql = 'INSERT INTO HOSPITAL (nomeHospital, ruaHospital, bairroHospital, cepHospital, telefoneHospital) 
                    VALUES (?, ?, ?, ?, ?)';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $h->getNomeHospital());
            $stmt->bindValue(2, $h->getRuaHospital());
            $stmt->bindValue(3, $h->getBairroHospital());
            $stmt->bindValue(4, $h->getCepHospital());
            $stmt->bindValue(5, $h->getTelefoneHospital());

            $stmt->execute();

            echo "true";
        } catch (\PDOException $e) {
            echo $e->getMessage();
        } 
    }

    //? Select
    public function select($id) {
        try {
            $sql = 'SELECT * FROM HOSPITAL WHERE id = ?';

            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);

            $stmt->execute();

            if($stmt->rowCount() > 0) {
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }
        } catch (\PDOException $e) {
            echo $e->getCode();
        } 
    }

    //? Delete
    public function delete($id) {
        try {
            $sql = 'DELETE FROM HOSPITAL WHERE id = ?';
    
            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(1, $id);
            
            $stmt->execute();     
        } catch (\PDOException $e) {
            echo $e->getCode();
        }
    }
}