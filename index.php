<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';
// REFRESINIMAS
//PRIDEJIMAS NE PO VIENA

//suprastinti TemplateEngine

//klases ir mokinio ivedimas sujungti
/// atidaro naujam lange

//sukurti nauja duombaze
//mokinio ivedimas neveikia


use PROJ\Manager\Skaityti;
use PROJ\DB\Db;
use PROJ\Entity\Klase;
use PROJ\Manager\KlasesIvedimas;
use PROJ\Manager\MokinioIvedimas;
use PROJ\DTO\KlaseDTO;
use PROJ\Service\TemplateEngineService;
use PROJ\Entity\Mokinys;

$action = $_REQUEST['action'];
if ($action) {
    if ($action == 'entering') {
        $ivedimas = new KlasesIvedimas();
        $klas = new Klase();
        $A = $ivedimas->ivestiKlase();

        $klas->setKlase($A['cname']);
        $klas->setKlasesaprasymas($A['ctext']);

        $duomenuBaze = new Db();
        $duomenuBaze->saveToKlase($klas);
        $duomenuBaze->close();
    } elseif ($action == 'visosklases') {
        //$obj=(new Skaityti())->skaitytiKlase($_GET['name']);
        $duomenuBaze = new Db();
        $klasiuMasyvas = $duomenuBaze->findAllKlases();
        $duomenuBaze->close();
        $naujosKlases = [];
        /** @var Klase $klase */
        foreach ($klasiuMasyvas as $klase) {
            $naujaKlase = new KlaseDTO();
            $naujaKlase->id = $klase->getID();
            $naujaKlase->klase = $klase->getKlase();
            $naujaKlase->klases_aprasymas = $klase->getKlasesaprasymas();
            $naujosKlases[] = $naujaKlase;
        }
        echo json_encode($naujosKlases);
    } elseif ($action == 'mp_sarasas') {
        $name = $_GET['name'];
        $templateEngineService = new TemplateEngineService(__DIR__ . '\mokiniai_pamokos.html');
        $templateEngineService->setParameters(['klases_id' => $name]);
        $templateEngineService->render();
    } elseif ($action == 'mokiniu_sarasas') {
        $name = $_GET['name'];
//        $kl=$db->findKlase($name);
//        $templateEngineService->setParameters(['klases_id' => $kl->getID()]);


        $templateEngineService = new TemplateEngineService(__DIR__ . '\mokiniu_sarasas.html');
        $templateEngineService->setParameters(['klases_id' => $name]);
        $templateEngineService->render();
    } elseif ($action == 'trintiklases') {

        try {
            $allID = json_decode(file_get_contents('php://input'));
            if (empty($allID)) {
                throw new \Exception('Nenurodyta klase');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteKlases($allID);
            $duomenuBaze->close();
            header('Location: index.html');
        } catch (\Exception $e) {
            echo 'Klaida trinant klase';
        }
    } elseif ($action == 'trintiklase') {

        try {
            $name = $_GET['name'];
            if (empty($name )) {
                throw new \Exception('Nenurodyta klase');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteKlaseById((int)$name);
            $duomenuBaze->close();
            header('Location: index.html');
        } catch (\Exception $e) {
            echo 'Klaida trinant klase';
        }
    }elseif ($action == 'enteringmokiniai') {
        $name = $_GET['name'];
        var_dump($name);
        $ivedimas = new MokinioIvedimas();
        $klas = new Mokinys();
        $A = $ivedimas->ivestiMokini();

        $klas->setMokinys($A['cname']);
        $klas->setMokinioAprasymas($A['ctext']);
        $duomenuBaze = new Db();
       $duomenuBaze->createTableMokinys($name);
       $duomenuBaze->saveToMokinys($klas, $name);
       $duomenuBaze->close();
    } else {
        echo 'klaida action';
    }
}