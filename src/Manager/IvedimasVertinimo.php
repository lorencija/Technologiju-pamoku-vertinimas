<?php declare(strict_types=1);

namespace PROJ\Manager;

use Exception;

class IvedimasVertinimo
{
    private $arr;
    private $zinute;

    public function __construct()
    {
        $this->arr = [];
    }

    public function tikrintiIvedimaVertinimo(): string
    {
        try {
            if ((empty($_POST['p1']))OR(empty($_POST['p2']))OR(empty($_POST['p3']))OR(empty($_POST['p4']))OR(empty($_POST['p5']))OR(empty($_POST['p6']))) {
                throw new Exception('Nepasirinkta reikšmė!');
            } else {
                $this->zinute = 'OK';
            }
        } catch (Exception $exception) {
            $this->zinute = $exception->getMessage();
        }
        return $this->zinute;
    }

    public function ivestiObjektaVertinimo(): array
    {
        if (!empty($_POST['p1'])) {
            $this->arr['p1'] = $_POST['p1'];
        }
        if (!empty($_POST['p2'])) {
            $this->arr['p2'] = $_POST['p2'];
        }
        if (!empty($_POST['p3'])) {
            $this->arr['p3'] = $_POST['p3'];
        }
        if (!empty($_POST['p4'])) {
            $this->arr['p4'] = $_POST['p4'];
        }
        if (!empty($_POST['p5'])) {
            $this->arr['p5'] = $_POST['p5'];
        }
        if (!empty($_POST['p6'])) {
            $this->arr['p6'] = $_POST['p6'];
        }
        return $this->arr;
    }

}