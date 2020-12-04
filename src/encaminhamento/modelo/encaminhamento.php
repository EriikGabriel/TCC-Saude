<?php

namespace conn;

class Encaminhamento
{
    private $idEncaminhamento, $idUnidadeSaude, $idPaciente, $idAtendimento, $idHospital, $idUsuario, $situacao;

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
     * Get the value of idAtendimento
     */
    public function getIdAtendimento()
    {
        return $this->idAtendimento;
    }

    /**
     * Set the value of idAtendimento
     *
     * @return  self
     */
    public function setIdAtendimento($idAtendimento)
    {
        $this->idAtendimento = $idAtendimento;

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

    /**
     * Get the value of situacao
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set the value of situacao
     *
     * @return  self
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }
}
