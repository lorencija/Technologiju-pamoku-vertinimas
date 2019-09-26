<?php declare(strict_types=1);

namespace PROJ\Manager;

class KlasesIvedimas
{
    private $arr;

    public function __construct()
    {
        $this->arr = [];
    }

    public function ivestiKlase()
    {
        if (!empty($_POST['classname'])) {
            $this->arr['cname'] = $_POST['classname'];
        }
        if (!empty($_POST['classtext'])) {
            $this->arr['ctext'] = $_POST['classtext'];
        }
        return $this->arr;
    }
}