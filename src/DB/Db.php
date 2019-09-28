<?php declare(strict_types=1);

namespace PROJ\DB;

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
        $stmt = $this->connect->prepare('SELECT id, mokinys, mokinio_aprasymas, klases_id FROM mokiniai WHERE klases_id='.$searchId.' ORDER BY id');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Mokinys::class);
        $rezultatai = $stmt->fetchAll();
        return $rezultatai;
    }

    public function findMokiniById($searchId): array
    {
        $stmt = $this->connect->prepare('SELECT mokinys FROM mokiniai WHERE klases_id='.$searchId);
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

    public function deleteKlases(array $klases)
    {
        foreach ($klases as $klase) {
            $this->deleteKlaseById((int)$klase->id);
        }

    }
    public function close(): void
    {
        $this->connect = null;
    }
}