<?php

namespace conn;

class Usuario{
    private $idUsuario, $nomeUsuario, $senhaUsuario, $idTipoUsuario, $idHospital;

    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of nomeUsuario
     */ 
    public function getNomeUsuario()
    {
        return $this->nomeUsuario;
    }

    /**
     * Set the value of nomeUsuario
     *
     * @return  self
     */ 
    public function setNomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;

        return $this;
    }

    /**
     * Get the value of senhaUsuario
     */ 
    public function getSenhaUsuario()
    {
        return $this->senhaUsuario;
    }

    /**
     * Set the value of senhaUsuario
     *
     * @return  self
     */ 
    public function setSenhaUsuario($senhaUsuario)
    {
        $this->senhaUsuario = $senhaUsuario;

        return $this;
    }

    /**
     * Get the value of idTipoUsuario
     */ 
    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }

    /**
     * Set the value of idTipoUsuario
     *
     * @return  self
     */ 
    public function setIdTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;

        return $this;
    }

    /**
     * Get the value of idHospital
     */ 
    public function getIdHospital()
    {
        return $this->idHospital;
    }

    /**
     * Set the value of idHospital
     *
     * @return  self
     */ 
    public function setIdHospital($idHospital)
    {
        $this->idHospital = $idHospital;

        return $this;
    }
}