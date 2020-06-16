<?php

namespace conn;

class UnidadeSaude
{
    private $idUnidadeSaude, $nomeUnidadeSaude, $ruaUnidadeSaude, $bairroUnidadeSaude, $telefoneUnidadeSaude, $idTipoUnidade;

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
     * Get the value of nomeUnidadeSaude
     */
    public function getNomeUnidadeSaude()
    {
        return $this->nomeUnidadeSaude;
    }

    /**
     * Set the value of nomeUnidadeSaude
     *
     * @return  self
     */
    public function setNomeUnidadeSaude($nomeUnidadeSaude)
    {
        $this->nomeUnidadeSaude = $nomeUnidadeSaude;

        return $this;
    }

    /**
     * Get the value of ruaUnidadeSaude
     */
    public function getRuaUnidadeSaude()
    {
        return $this->ruaUnidadeSaude;
    }

    /**
     * Set the value of ruaUnidadeSaude
     *
     * @return  self
     */
    public function setRuaUnidadeSaude($ruaUnidadeSaude)
    {
        $this->ruaUnidadeSaude = $ruaUnidadeSaude;

        return $this;
    }

    /**
     * Get the value of bairroUnidadeSaude
     */
    public function getBairroUnidadeSaude()
    {
        return $this->bairroUnidadeSaude;
    }

    /**
     * Set the value of bairroUnidadeSaude
     *
     * @return  self
     */
    public function setBairroUnidadeSaude($bairroUnidadeSaude)
    {
        $this->bairroUnidadeSaude = $bairroUnidadeSaude;

        return $this;
    }

    /**
     * Get the value of telefoneUnidadeSaude
     */
    public function getTelefoneUnidadeSaude()
    {
        return $this->telefoneUnidadeSaude;
    }

    /**
     * Set the value of telefoneUnidadeSaude
     *
     * @return  self
     */
    public function setTelefoneUnidadeSaude($telefoneUnidadeSaude)
    {
        $this->telefoneUnidadeSaude = $telefoneUnidadeSaude;

        return $this;
    }

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
}
