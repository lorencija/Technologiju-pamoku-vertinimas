<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use PROJ\DB\Db;
use PROJ\Entity\Klase;
use PROJ\Entity\Mokinys;
use PROJ\Entity\Pamoka;
use PROJ\Manager\Ivedimas;
use PROJ\DTO\KlaseDTO;
use PROJ\DTO\MokinioDTO;
use PROJ\DTO\PamokosDTO;
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

    } elseif ($action == 'enteringMaistoPamokos') {
        $name = $_GET['name'];
        $ivedimas = new Ivedimas();
        $pam = new Pamoka();
        $zinute = $ivedimas->tikrintiIvedima();
        if ($zinute === 'OK') {
            $A = $ivedimas->ivestiObjekta();
            $pam->setPamoka($A['cname']);
            $pam->setKlasesId($name);
            $duomenuBaze = new Db();
            $lastID = $duomenuBaze->saveToGaminimoPamoka($pam);
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

    }elseif ($action == 'visosgaminimopamokos') {
        $name = $_GET['name'];
        $duomenuBaze = new Db();
        $pamokuMasyvas = $duomenuBaze->findAllGaminimoPamokos($name);
        $duomenuBaze->close();
        $naujosPamokos = [];
        /** @var Pamoka $pam */
        foreach ($pamokuMasyvas as $pam) {
            $naujaPamoka = new PamokosDTO();
            $naujaPamoka->id = $pam->getId();
            $naujaPamoka->pamoka = $pam->getPamoka();
            $naujaPamoka->klases_id = $pam->getKlasesId();
            $naujosPamokos[] = $naujaPamoka;
        }
             echo json_encode($naujosPamokos);

    } elseif ($action == 'mokiniopasirinkimas') {
        $name = $_GET['name'];
        $klase = $_GET['klase'];
        $templateEngineService = new TemplateEngineService(__DIR__ . '\mokinys.html');
        $templateEngineService->setParameters(['mokinio_id' => $name, 'klases_id' => $klase]);
        $templateEngineService->render();

    } elseif ($action == 'mp_sarasas') {
        $name = $_GET['name'];
        $templateEngineService = new TemplateEngineService(__DIR__ . '\mokiniai_pamokos.html');
        $templateEngineService->setParameters(['klases_id' => $name]);
        $templateEngineService->render();

    } elseif ($action == 'mokiniu_sarasas') {
        $name = $_GET['name'];
        $templateEngineService = new TemplateEngineService(__DIR__ . '\mokiniu_sarasas.html');
        $templateEngineService->setParameters(['klases_id' => $name]);
        $templateEngineService->render();

    } elseif ($action == 'pamokos') {
        $name = $_GET['name'];
        $templateEngineService = new TemplateEngineService(__DIR__ . '\pamokos.html');
        $templateEngineService->setParameters(['klases_id' => $name]);
        $templateEngineService->render();

    } elseif ($action == 'maisto_gaminimas') {
        $name = $_GET['name'];
        $templateEngineService = new TemplateEngineService(__DIR__ . '\maisto_gaminimas.html');
        $templateEngineService->setParameters(['klases_id' => $name]);
        $templateEngineService->render();

    } elseif ($action == 'maistopasirinkimas') {
        $name = $_GET['name'];
        $pamoka = $_GET['pamoka'];
        $templateEngineService = new TemplateEngineService(__DIR__ . '\maistogaminimo_vertinimas.html');
        $templateEngineService->setParameters(['pamokos_id' => $pamoka, 'klases_id' => $name]);
        $templateEngineService->render();
       }
    elseif ($action == 'trintiklases') {
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
                throw new \Exception('Nenurodyta klasė!');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteKlaseById((int)$name);
            $duomenuBaze->close();
            header('Location: index.html');
        } catch (\Exception $e) {
            echo 'Klaida trinant klasę!';
        }

    } elseif ($action == 'trintimokinius') {
        try {
            $allID = json_decode(file_get_contents('php://input'));
            if (empty($allID)) {
                throw new \Exception('Nenurodytas mokinys!');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteMokinius($allID);
            $duomenuBaze->close();
        } catch (\Exception $e) {
            echo 'Klaida trinant mokinį!';
        }

    } elseif ($action == 'trintimokiniusSuKlase') {
        try {
            $allID = json_decode(file_get_contents('php://input'));
            if (empty($allID)) {
                throw new \Exception('Nenurodytas mokinys!');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteMokiniusSuKlase($allID);
            $duomenuBaze->close();
        } catch (\Exception $e) {
            echo 'Klaida trinant mokinį!';
        }

    } elseif ($action == 'trintimokini') {
        try {
            $name = $_GET['name'];
            $klase = $_GET['klase'];
            if (empty($name)) {
                throw new \Exception('Nenurodytas mokinys!');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteMokiniById((int)$name);
            $duomenuBaze->close();
            header('Location: index.php?action=mokiniu_sarasas&name=' . $klase);
        } catch (\Exception $e) {
            echo 'Klaida trinant mokinį!';
        }

    }
     elseif ($action == 'trintiMaistoPamoka') {
         try {
             $name = $_GET['name'];
             $pamoka = $_GET['pamoka'];
             if (empty($name)) {
                 throw new \Exception('Nenurodyta pamoka!');
             }
             $duomenuBaze = new Db();
             $duomenuBaze->deleteMaistoPamokaById((int)$name);
             $duomenuBaze->close();
             header('Location: index.php?action=maisto_gaminimas&name=' . $pamoka);
         } catch (\Exception $e) {
             echo 'Klaida trinant pamoką!';
         }

     }  elseif ($action == 'trintiMaistoPamokas') {
        try {
            $allID = json_decode(file_get_contents('php://input'));
            if (empty($allID)) {
                throw new \Exception('Nenurodyta pamoka!');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteMaistoPamokas($allID);
            $duomenuBaze->close();
            header('Location: index.php?action=mokiniu_sarasas&name=' . $klase);
        } catch (\Exception $e) {
            echo 'Klaida trinant pamoką!';
        }

    } elseif ($action == 'trintiMaistopamokasSuKlase') {
        try {
            $allID = json_decode(file_get_contents('php://input'));
            if (empty($allID)) {
                throw new \Exception('Nenurodytas mokinys!');
            }
            $duomenuBaze = new Db();
            $duomenuBaze->deleteMaistoPamokasSuKlase($allID);
            $duomenuBaze->close();
        } catch (\Exception $e) {
            echo 'Klaida trinant mokinį!';
        }

    }elseif ($action == 'redaguotimokini') {
        $name = $_GET['name'];//klase
        $edditId = $_GET['id'];
        $ivedimas = new Ivedimas();
        $mok = new Mokinys();
        $zinute = $ivedimas->tikrintiIvedima();
        if ($zinute === 'OK') {
            $A = $ivedimas->ivestiObjekta();
            $mok->setMokinys($A['cname']);
            $mok->setMokinioAprasymas($A['ctext']);
            $mok->setKlasesId($name);
            $mok->setId($edditId);
            $duomenuBaze = new Db();
            $duomenuBaze->edditMokinys($mok);
            $duomenuBaze->close();
            echo '{"id":"' . $edditId . '","zinute":"' . $zinute . '"}';
        } else {
            echo '{"id":"0","zinute":"' . $zinute . '"}';
        }

    } elseif ($action == 'redaguotiMaistoPamoka') {
        $name = $_GET['name'];//klase
        $edditId = $_GET['id'];
        $ivedimas = new Ivedimas();
        $pam = new Pamoka();
        $zinute = $ivedimas->tikrintiIvedima();
        if ($zinute === 'OK') {
            $A = $ivedimas->ivestiObjekta();
            $pam->setPamoka($A['cname']);
            $pam->setKlasesId($name);
            $pam->setId($edditId);
            $duomenuBaze = new Db();
            $duomenuBaze->edditMaistoPamoka($pam);
            $duomenuBaze->close();
            echo '{"id":"' . $edditId . '","zinute":"' . $zinute . '"}';
        } else {
            echo '{"id":"0","zinute":"' . $zinute . '"}';
        }

    } else {
        echo 'klaida action';
    }
}