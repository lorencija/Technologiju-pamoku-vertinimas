<?php declare(strict_types=1);

namespace PROJ\Entity;

class Vertinimas
{
    private $id;
    private $klases_id;
    private $pamokos_id;
    private $mokinio_id;
    private $p1;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Vertinimas
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Vertinimas
     */
    public function setKlasesId($klases_id)
    {
        $this->klases_id = $klases_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPamokosId()
    {
        return $this->pamokos_id;
    }

    /**
     * @param mixed $pamokos_id
     * @return Vertinimas
     */
    public function setPamokosId($pamokos_id)
    {
        $this->pamokos_id = $pamokos_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMokinioId()
    {
        return $this->mokinio_id;
    }

    /**
     * @param mixed $mokinio_id
     * @return Vertinimas
     */
    public function setMokinioId($mokinio_id)
    {
        $this->mokinio_id = $mokinio_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getP1()
    {
        return $this->p1;
    }

    /**
     * @param mixed $p1
     * @return Vertinimas
     */
    public function setP1($p1)
    {
        $this->p1 = $p1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getP2()
    {
        return $this->p2;
    }

    /**
     * @param mixed $p2
     * @return Vertinimas
     */
    public function setP2($p2)
    {
        $this->p2 = $p2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getP3()
    {
        return $this->p3;
    }

    /**
     * @param mixed $p3
     * @return Vertinimas
     */
    public function setP3($p3)
    {
        $this->p3 = $p3;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getP4()
    {
        return $this->p4;
    }

    /**
     * @param mixed $p4
     * @return Vertinimas
     */
    public function setP4($p4)
    {
        $this->p4 = $p4;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getP5()
    {
        return $this->p5;
    }

    /**
     * @param mixed $p5
     * @return Vertinimas
     */
    public function setP5($p5)
    {
        $this->p5 = $p5;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getP6()
    {
        return $this->p6;
    }

    /**
     * @param mixed $p6
     * @return Vertinimas
     */
    public function setP6($p6)
    {
        $this->p6 = $p6;
        return $this;
    }
    private $p2;
    private $p3;
    private $p4;
    private $p5;
    private $p6;


}