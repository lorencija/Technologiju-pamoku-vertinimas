<?php

namespace PROJ\Entity;

class Klase
{
    private $id;
    private $klase;
    private $klases_aprasymas;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Klase
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKlase()
    {
        return $this->klase;
    }

    /**
     * @param mixed $klase
     * @return Klase
     */
    public function setKlase($klase)
    {
        $this->klase = $klase;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKlasesaprasymas()
    {
        return $this->klases_aprasymas;
    }

    /**
     * @param mixed $klases_aprasymas
     * @return Klase
     */
    public function setKlasesaprasymas($klases_aprasymas)
    {
        $this->klases_aprasymas = $klases_aprasymas;
        return $this;
    }

}