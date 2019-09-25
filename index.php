<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use PROJ\Manager\Skaityti;
use PROJ\DB\Db;
use PROJ\Entity\Klase;
use PROJ\Ivedimas\KlasesIvedimas;

//AR GERI METODAI
// VARDUMP???
//LINKAS PHP AR HTML

$action = $_REQUEST['action'];
if ($action) {
    if ($action == 'entering') {
        $ivedimas = new KlasesIvedimas();
        $klas = new Klase();
        $A = $ivedimas->ivestiKlase();

        $klas->setName($A['cname']);
        $klas->setDescription($A['ctext']);

        $duomenuBaze = new Db();
        $duomenuBaze->saveToDb($klas);
        $duomenuBaze->close();
    }
    if ($action == 'skaityti') {

       //$obj=(new Skaityti())->skaitytiKlase($_GET['name']);
        $duomenuBaze = new Db();
        $klasiusarasas=$duomenuBaze->showAllKlases();
        $duomenuBaze->close();
      //var_dump($klasiusarasas);
        echo json_encode($klasiusarasas);



    } else {
        echo 'klaida action';
    }
}