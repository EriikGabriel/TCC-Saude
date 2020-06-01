<?php

namespace conn;

class Especialidade{
    private $idEspecialidade, $tipoEspecialidade;

    public function getIdEspecialidade()
    {
        return $this->idEspecialidade;
    }

    public function setIdEspecialidade($idEspecialidade)
    {
        $this->idEspecialidade= $idEspecialidade;

        return $this;
    }

    public function getTipoEspecialidade()
    {
        return $this->idEspecialidade;
    }

    public function setTipoEspecialidade($tipoEspecialidade)
    {
        $this->tipoEspecialidade= $tipoEspecialidade;

        return $this;
    }
}