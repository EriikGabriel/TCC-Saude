<?php

namespace conn;

class Encaminhamento
{
    private $idEncaminhamento, $dataEncaminhamento, $idUnidadeSaude, $idPaciente, $idHospital, $idUsuario;

    /**
     * Get the value of idEncaminhamento
     */
    public function getIdEncaminhamento()
    {
        return $this->idEncaminhamento;
    }

    /**
     * Set the value of idEncaminhamento
     *
     * @return  self
     */
    public function setIdEncaminhamento($idEncaminhamento)
    {
        $this->idEncaminhamento = $idEncaminhamento;

        return $this;
    }

    /**
     * Get the value of dataEncaminhamento
     */
    public function getDataEncaminhamento()
    {
        return $this->dataEncaminhamento;
    }

    /**
     * Set the value of dataEncaminhamento
     *
     * @return  self
     */
    public function setDataEncaminhamento($dataEncaminhamento)
    {
        $this->dataEncaminhamento = $dataEncaminhamento;

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
     * Get the value of idPaciente
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * Set the value of idPaciente
     *
     * @return  self
     */
    public function setIdPaciente($idPaciente)
    {
        $this->idPaciente = $idPaciente;

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
}
