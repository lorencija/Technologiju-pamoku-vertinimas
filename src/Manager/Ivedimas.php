<?php declare(strict_types=1);

namespace PROJ\Manager;

use Exception;

class Ivedimas
{
    private $arr;
    private $zinute;

    public function __construct()
    {
        $this->arr = [];
    }

    public function tikrintiIvedima(): string
    {
        try {
            if (empty($_POST['name'])) {
                throw new Exception('Neįvesta reikšmė!');
            } else {
                $this->zinute = 'OK';
            }
        } catch (Exception $exception) {
            $this->zinute = $exception->getMessage();
        }
        return $this->zinute;
    }

    public function ivestiObjekta(): array
    {
        if (!empty($_POST['name'])) {
            $this->arr['cname'] = $_POST['name'];
        }
        if (!empty($_POST['text'])) {
            $this->arr['ctext'] = $_POST['text'];
        }
        return $this->arr;
    }
}
