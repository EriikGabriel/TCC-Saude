<?php

namespace conn;

class Paciente
{
    private $idPaciente, $nomePaciente, $ruaPaciente, $bairroPaciente, $numeroSUS, $telefonePaciente, $gravidade;

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
     * Get the value of nomePaciente
     */
    public function getNomePaciente()
    {
        return $this->nomePaciente;
    }

    /**
     * Set the value of nomePaciente
     *
     * @return  self
     */
    public function setNomePaciente($nomePaciente)
    {
        $this->nomePaciente = $nomePaciente;

        return $this;
    }

    /**
     * Get the value of ruaPaciente
     */
    public function getRuaPaciente()
    {
        return $this->ruaPaciente;
    }

    /**
     * Set the value of ruaPaciente
     *
     * @return  self
     */
    public function setRuaPaciente($ruaPaciente)
    {
        $this->ruaPaciente = $ruaPaciente;

        return $this;
    }

    /**
     * Get the value of bairroPaciente
     */
    public function getBairroPaciente()
    {
        return $this->bairroPaciente;
    }

    /**
     * Set the value of bairroPaciente
     *
     * @return  self
     */
    public function setBairroPaciente($bairroPaciente)
    {
        $this->bairroPaciente = $bairroPaciente;

        return $this;
    }

    /**
     * Get the value of numeroSUS
     */
    public function getNumeroSUS()
    {
        return $this->numeroSUS;
    }

    /**
     * Set the value of numeroSUS
     *
     * @return  self
     */
    public function setNumeroSUS($numeroSUS)
    {
        $this->numeroSUS = $numeroSUS;

        return $this;
    }

    /**
     * Get the value of telefonePaciente
     */
    public function getTelefonePaciente()
    {
        return $this->telefonePaciente;
    }

    /**
     * Set the value of telefonePaciente
     *
     * @return  self
     */
    public function setTelefonePaciente($telefonePaciente)
    {
        $this->telefonePaciente = $telefonePaciente;

        return $this;
    }

    /**
     * Get the value of gravidade
     */
    public function getGravidade()
    {
        return $this->gravidade;
    }

    /**
     * Set the value of gravidade
     *
     * @return  self
     */
    public function setGravidade($gravidade)
    {
        $this->gravidade = $gravidade;

        return $this;
    }
}
