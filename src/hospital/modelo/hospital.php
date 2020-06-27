<?php

namespace conn;

class Hospital
{
    private $idHospital, $nomeHospital, $ruaHospital, $bairroHospital, $cepHospital, $telefoneHospital, $idUsuario;

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
     * Get the value of nomeHospital
     */
    public function getNomeHospital()
    {
        return $this->nomeHospital;
    }

    /**
     * Set the value of nomeHospital
     *
     * @return  self
     */
    public function setNomeHospital($nomeHospital)
    {
        $this->nomeHospital = $nomeHospital;

        return $this;
    }

    /**
     * Get the value of ruaHospital
     */
    public function getRuaHospital()
    {
        return $this->ruaHospital;
    }

    /**
     * Set the value of ruaHospital
     *
     * @return  self
     */
    public function setRuaHospital($ruaHospital)
    {
        $this->ruaHospital = $ruaHospital;

        return $this;
    }

    /**
     * Get the value of bairroHospital
     */
    public function getBairroHospital()
    {
        return $this->bairroHospital;
    }

    /**
     * Set the value of bairroHospital
     *
     * @return  self
     */
    public function setBairroHospital($bairroHospital)
    {
        $this->bairroHospital = $bairroHospital;

        return $this;
    }

    /**
     * Get the value of cepHospital
     */
    public function getCepHospital()
    {
        return $this->cepHospital;
    }

    /**
     * Set the value of cepHospital
     *
     * @return  self
     */
    public function setCepHospital($cepHospital)
    {
        $this->cepHospital = $cepHospital;

        return $this;
    }

    /**
     * Get the value of telefoneHospital
     */
    public function getTelefoneHospital()
    {
        return $this->telefoneHospital;
    }

    /**
     * Set the value of telefoneHospital
     *
     * @return  self
     */
    public function setTelefoneHospital($telefoneHospital)
    {
        $this->telefoneHospital = $telefoneHospital;

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
