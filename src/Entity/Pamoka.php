<?php declare(strict_types=1);

namespace PROJ\Entity;

class Pamoka
{
    private $id;
    private $pamoka;
    private $klases_id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Pamoka
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPamoka()
    {
        return $this->pamoka;
    }

    /**
     * @param mixed $pamoka
     * @return Pamoka
     */
    public function setPamoka($pamoka)
    {
        $this->pamoka = $pamoka;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKlasesId()
    {
        return $this->klases_id;
    }

    /**
     * @param mixed $klases_id
     * @return Pamoka
     */
    public function setKlasesId($klases_id)
    {
        $this->klases_id = $klases_id;
        return $this;
    }

}