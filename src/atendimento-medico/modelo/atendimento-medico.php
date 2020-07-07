<?php

namespace conn;

class AtendimentoMedico
{
    private $horarioMedico, $idUnidadeSaude, $crm;

    /**
     * Get the value of horarioMedico
     */
    public function getHorarioMedico()
    {
        return $this->horarioMedico;
    }

    /**
     * Set the value of horarioMedico
     *
     * @return  self
     */
    public function setHorarioMedico($horarioMedico)
    {
        $this->horarioMedico = $horarioMedico;

        return $this;
    }

    /**
     * Get the value of idUnidadeSaude
     */
    public function getIdUnidadeSaude()
    {
        return $this->idUnidadeSaude;
    }

    /**
     * Set the value of idUnidadeSaude
     *
     * @return  self
     */
    public function setIdUnidadeSaude($idUnidadeSaude)
    {
        $this->idUnidadeSaude = $idUnidadeSaude;

        return $this;
    }

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
}
