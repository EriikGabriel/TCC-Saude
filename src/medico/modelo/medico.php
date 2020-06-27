<?php

namespace conn;

class Medico
{
    private $crm, $nomeMedico, $idEspecialidade;

    /**
     * Get the value of crm
     */
    public function getCrm()
    {
        return $this->crm;
    }

    /**
     * Set the value of crm
     *
     * @return  self
     */
    public function setCrm($crm)
    {
        $this->crm = $crm;

        return $this;
    }

    /**
     * Get the value of nomeMedico
     */
    public function getNomeMedico()
    {
        return $this->nomeMedico;
    }

    /**
     * Set the value of nomeMedico
     *
     * @return  self
     */
    public function setNomeMedico($nomeMedico)
    {
        $this->nomeMedico = $nomeMedico;

        return $this;
    }

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
}
