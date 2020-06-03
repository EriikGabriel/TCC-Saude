<?php

namespace conn;

class Especialidade{
    private $idEspecialidade, $tipoEspecialidade;

    /**
     * Get the value of idEspecialidade
     */ 
    public function getIdEspecialidade()
    {
        return $this->idEspecialidade;
    }

    /**
     * Set the value of idEspecialidade
     *
     * @return  self
     */ 
    public function setIdEspecialidade($idEspecialidade)
    {
        $this->idEspecialidade = $idEspecialidade;

        return $this;
    }

    /**
     * Get the value of tipoEspecialidade
     */ 
    public function getTipoEspecialidade()
    {
        return $this->tipoEspecialidade;
    }

    /**
     * Set the value of tipoEspecialidade
     *
     * @return  self
     */ 
    public function setTipoEspecialidade($tipoEspecialidade)
    {
        $this->tipoEspecialidade = $tipoEspecialidade;

        return $this;
    }
}