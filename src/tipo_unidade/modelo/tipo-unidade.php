<?php 

namespace conn;

class TipoUnidade {
    private $idTipoUnidade, $tipoUnidade;

    /**
     * Get the value of idTipoUnidade
     */ 
    public function getIdTipoUnidade()
    {
        return $this->idTipoUnidade;
    }

    /**
     * Set the value of idTipoUnidade
     *
     * @return  self
     */ 
    public function setIdTipoUnidade($idTipoUnidade)
    {
        $this->idTipoUnidade = $idTipoUnidade;

        return $this;
    }

    /**
     * Get the value of tipoUnidade
     */ 
    public function getTipoUnidade()
    {
        return $this->tipoUnidade;
    }

    /**
     * Set the value of tipoUnidade
     *
     * @return  self
     */ 
    public function setTipoUnidade($tipoUnidade)
    {
        $this->tipoUnidade = $tipoUnidade;

        return $this;
    }
}