<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use PROJ\DB\Db;
use PROJ\Entity\Klase;
use PROJ\Entity\Mokinys;
use PROJ\Manager\Ivedimas;
use PROJ\DTO\KlaseDTO;
use PROJ\DTO\MokinioDTO;
use PROJ\Service\TemplateEngineService;

$action = $_REQUEST['action'];
if ($action) {

    if ($action == 'entering') {
        $ivedimas = new Ivedimas();
        $klas = new Klase();
        $zinute = $ivedimas->tikrintiIvedima();
        if ($zinute === 'OK') {
            $A = $ivedimas->ivestiObjekta();
            $klas->setKlase($A['cname']);
            $klas->setKlasesaprasymas($A['ctext']);
            $duomenuBaze = new Db();
            $lastID = $duomenuBaze->saveToKlase($klas);
            $duomenuBaze->close();
            echo '{"id":"' . $lastID . '","zinute":"' . $zinute . '"}';
        } else {
            echo '{"id":"0","zinute":"' . $zinute . '"}';
        }

    } elseif ($action == 'enteringmokiniai') {
        $name = $_GET['name'];
        $ivedimas = new Ivedimas();
        $mok = new Mokinys();
        $zinute = $ivedimas->tikrintiIvedima();
        if ($zinute === 'OK') {
            $A = $ivedimas->ivestiObjekta();
            $mok->setMokinys($A['cname']);
            $mok->setMokinioAprasymas($A['ctext']);
            $mok->setKlasesId($name);
            $duomenuBaze = new Db();
            $lastID = $duomenuBaze->saveToMokinys($mok);
            $duomenuBaze->close();
            echo '{"id":"' . $lastID . '","zinute":"' . $zinute . '"}';
        } else {
            echo '{"id":"0","zinute":"' . $zinute . '"}';
        }

    } elseif ($action == 'visosklases') {
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

    } elseif ($action == 'visimokiniai') {
        $name = $_GET['name'];
        $duomenuBaze = new Db();
        $mokiniuMasyvas = $duomenuBaze->findAllMokiniai($name);
        $duomenuBaze->close();
        $naujiMokiniai = [];
        /** @var Mokinys $mokinys */
        foreach ($mokiniuMasyvas as $mokinys) {
            $naujasMokinys = new MokinioDTO();
            $naujasMokinys->id = $mokinys->getId();
            $naujasMokinys->mokinys = $mokinys->getMokinys();
            $naujasMokinys->mokinio_aprasymas = $mokinys->getMokinioAprasymas();
            $naujasMokinys->klases_id = $mokinys->getKlasesId();
            $naujiMokiniai[] = $naujasMokinys;
        }
        echo json_encode($naujiMokiniai);

    }elseif ($action == 'mokiniopasirinkimas') {
        $name = $_GET['name'];
        $templateEngineService = new TemplateEngineService(__DIR__ . '\mokinys.html');
        $templateEngineService->setParameters(['klases_id' => $name]);
        $templateEngineService->render();
//        $name = $_GET['name'];
//        $duomenuBaze = new Db();
//        $pasirinktasmokinys = $duomenuBaze->findMokiniById($name);
//        $duomenuBaze->close();
//        echo '{"mokiniovardas":"' . $pasirinktasmokinys . '"}';

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
                throw new \Exception('Nenurodyta klasė');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteKlases($allID);
            $duomenuBaze->close();
        } catch (\Exception $e) {
            echo 'Klaida trinant klasę';
        }

    } elseif ($action == 'trintiklase') {
        try {
            $name = $_GET['name'];
            if (empty($name)) {
                throw new \Exception('Nenurodyta klasė');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteKlaseById((int)$name);
            $duomenuBaze->close();
            header('Location: index.html');
        } catch (\Exception $e) {
            echo 'Klaida trinant klasę';
        }

    } else {
        echo 'klaida action';
    }
}