<?php declare(strict_types=1);
namespace PROJ\Manager;

use PROJ\DB\Db;


class Skaityti
{
    public function skaitytiKlase(string $klasespavadinimas): array
    {
        $duomenuBaze = new Db();
        $klasiusarasas=$duomenuBaze->showAllKlases();
        $duomenuBaze->close();
        return $klasiusarasas;
    }
}



