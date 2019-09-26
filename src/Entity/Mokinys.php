<?php declare(strict_types=1);

namespace PROJ\Entity;

class Mokinys
{ private $id;
private $mokinys;
    private $mokinio_aprasymas;

    /**
     * @return mixed
     */
    public function getMokinioAprasymas()
    {
        return $this->mokinio_aprasymas;
    }

    /**
     * @param mixed $mokinio_aprasymas
     * @return Mokinys
     */
    public function setMokinioAprasymas($mokinio_aprasymas)
    {
        $this->mokinio_aprasymas = $mokinio_aprasymas;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Mokinys
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMokinys()
    {
        return $this->mokinys;
    }

    /**
     * @param mixed $mokinys
     * @return Mokinys
     */
    public function setMokinys($mokinys)
    {
        $this->mokinys = $mokinys;
        return $this;
    }

}