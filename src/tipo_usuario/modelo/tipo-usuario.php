<?php

namespace conn;

class TipoUsuario {
    private $idTipoUsuario, $tipoUsuario;

    

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
     * Get the value of tipoUsuario
     */ 
    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    /**
     * Set the value of tipoUsuario
     *
     * @return  self
     */ 
    public function setTipoUsuario($tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;

        return $this;
    }
}