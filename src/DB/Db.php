<?php declare(strict_types=1);

namespace PROJ\DB;

use PROJ\Entity\Pamoka;
use PROJ\Entity\Klase;
use PROJ\Entity\Mokinys;

class Db
{
    private $connect;

    public function __construct()
    {
        $db = new Config();
        $con = $db->connectToDb();
        try {
            $this->connect = new \PDO('mysql:host=' . $con['host'] . ';dbname=' . $con['database'], $con['username'], $con['pass']);
        } catch (\PDOException $exception) {
            echo "Error - check connection to data base";
        }
    }

    function saveToKlase(Klase $klase): string
    {
        $klasesvardas = $klase->getKlase();
        $klasesaprasas = $klase->getKlasesaprasymas();
        $stmt = $this->connect->prepare('INSERT INTO klases (klase, klases_aprasymas) values (:kvardas, :kaprasas);');
        $stmt->bindValue(':kvardas', $klasesvardas);
        $stmt->bindValue(':kaprasas', $klasesaprasas);
        $stmt->execute();
        return $this->connect->lastInsertId();
    }

    function saveToMokinys(Mokinys $mokinys): string
    {
        $mokiniovardas = $mokinys->getMokinys();
        $mokinioaprasas = $mokinys->getMokinioAprasymas();
        $mokinioklase = $mokinys->getKlasesId();
        $stmt = $this->connect->prepare('INSERT INTO mokiniai (mokinys, mokinio_aprasymas, klases_id) values (:mvardas, :maprasas, :mklase);');
        $stmt->bindValue(':mvardas', $mokiniovardas);
        $stmt->bindValue(':maprasas', $mokinioaprasas);
        $stmt->bindValue(':mklase', $mokinioklase);
        $stmt->execute();
        return $this->connect->lastInsertId();
    }

    function saveToGaminimoPamoka(Pamoka $pamoka): string
    {
        $pamokosvardas = $pamoka->getPamoka();
        $pamokosklase = $pamoka->getKlasesId();
        $stmt = $this->connect->prepare('INSERT INTO maisto_pamokos (pamoka, klases_id) values (:mvardas, :mklase);');
        $stmt->bindValue(':mvardas', $pamokosvardas);
        $stmt->bindValue(':mklase', $pamokosklase);
        $stmt->execute();
        return $this->connect->lastInsertId();
    }

    public function findAllKlases(): array
    {
        $stmt = $this->connect->prepare('SELECT * FROM klases ORDER BY id');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Klase::class);
        $rezultatai = $stmt->fetchAll();
        return $rezultatai;
    }

    public function findAllMokiniai($searchId): array
    {
        $stmt = $this->connect->prepare('SELECT id, mokinys, mokinio_aprasymas, klases_id FROM mokiniai WHERE klases_id=' . $searchId . ' ORDER BY id');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Mokinys::class);
        $rezultatai = $stmt->fetchAll();
        return $rezultatai;
    }
    public function findAllGaminimoPamokos($searchId): array
    {
        $stmt = $this->connect->prepare('SELECT id, pamoka, klases_id FROM maisto_pamokos WHERE klases_id=' . $searchId . ' ORDER BY id');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Pamoka::class);
        $rezultatai = $stmt->fetchAll();
        return $rezultatai;
    }

    public function findMokiniById($searchId): array
    {
        $stmt = $this->connect->prepare('SELECT mokinys FROM mokiniai WHERE klases_id=' . $searchId);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Mokinys::class);
        $rezultatai = $stmt->fetchAll();
        return $rezultatai;
    }

    public function deleteKlaseById(int $id): void
    {
        $stmt = $this->connect->prepare('DELETE FROM klases WHERE id = ' . $id);
        $stmt->execute();
    }

    public function deleteMokiniById(int $id): void
    {
        $stmt = $this->connect->prepare('DELETE FROM mokiniai WHERE id = ' . $id);
        $stmt->execute();
    }

    public function deleteMokiniByIdSuKlase(int $id): void
    {
        $stmt = $this->connect->prepare('DELETE FROM mokiniai WHERE klases_id = ' . $id);
        $stmt->execute();
    }

    public function findKlase(int $id): array
    {
        $stmt = $this->connect->prepare('select klases_id FROM mokiniai WHERE id = ' . $id);
        $stmt->execute();
        $rezultatai = $stmt->fetchAll();
        return $rezultatai;
    }

    public function deleteKlases(array $klases): void
    {
        foreach ($klases as $klase) {
            $this->deleteKlaseById((int)$klase->id);
        }

    }

    public function deleteMokinius(array $mokiniai): void
    {
        foreach ($mokiniai as $mokinys) {
            $this->deleteMokiniById((int)$mokinys->id);
        }

    }
    public function deleteMaistoPamokaById(int $id): void
    {
        $stmt = $this->connect->prepare('DELETE FROM maisto_pamokos WHERE id = ' . $id);
        $stmt->execute();
    }

    public function deleteMaistoPamokas(array $pamokos): void
    {
        foreach ($pamokos as $pamoka) {
            $this->deleteMaistoPamokaById((int)$pamoka->id);
        }

    }
    public function deleteMokiniusSuKlase(array $mokiniai): void
    {
        foreach ($mokiniai as $mokinys) {
            $this->deleteMokiniByIdSuKlase((int)$mokinys->id);
        }

    }
    public function deleteMaistoPamokasSuKlase(array $mokiniai): void
    {
        foreach ($mokiniai as $mokinys) {
            $this->deleteMaistiPmakonkasByIdSuKlase((int)$mokinys->id);
        }

    }
    public function deleteMaistiPmakonkasByIdSuKlase(int $id): void
    {
        $stmt = $this->connect->prepare('DELETE FROM maisto_pamokos WHERE klases_id = ' . $id);
        $stmt->execute();
    }

    function edditMokinys(Mokinys $mokinys): void
    {
        $mokiniovardas = $mokinys->getMokinys();
        $mokinioaprasas = $mokinys->getMokinioAprasymas();
        $mokinioklase = $mokinys->getKlasesId();
        $mokinioid = $mokinys->getId();
        $sql = 'UPDATE mokiniai SET mokinys = :mvardas, mokinio_aprasymas = :maprasas WHERE klases_id = :mklase AND id = :mid;';
        $stmt = $this->connect->prepare($sql);
        $stmt->bindValue(':mvardas', $mokiniovardas);
        $stmt->bindValue(':maprasas', $mokinioaprasas);
        $stmt->bindValue(':mklase', $mokinioklase);
        $stmt->bindValue(':mid', $mokinioid);
        $stmt->execute();
    }

    function edditMaistoPamoka(Pamoka $pamoka): void
    {
        $pamokosvardas = $pamoka->getPamoka();
        $pamokosklase = $pamoka->getKlasesId();
        $pamokosid = $pamoka->getId();
        $sql = 'UPDATE maisto_pamokos SET pamoka = :pvardas WHERE klases_id = :pklase AND id = :pid;';
        $stmt = $this->connect->prepare($sql);
        $stmt->bindValue(':pvardas', $pamokosvardas);
        $stmt->bindValue(':pklase', $pamokosklase);
        $stmt->bindValue(':pid', $pamokosid);
        $stmt->execute();
    }

    public function close(): void
    {
        $this->connect = null;
    }
}