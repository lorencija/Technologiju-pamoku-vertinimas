<?php declare(strict_types=1);

namespace PROJ\Manager;

class MokinioIvedimas
{
    private $arr;

    public function __construct()
    {
        $this->arr = [];
    }

    public function ivestiMokini()
    {
        if (!empty($_POST['studentname'])) {
            $this->arr['cname'] = $_POST['studentname'];
        }
        if (!empty($_POST['studenttext'])) {
            $this->arr['ctext'] = $_POST['studenttext'];
        }
        return $this->arr;
    }

}


