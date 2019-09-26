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

    function saveToKlase(Klase $klase): void
    {
        $klasesvardas = $klase->getKlase();
        $klasesaprasas = $klase->getKlasesaprasymas();
        $stmt = $this->connect->prepare('INSERT INTO klases (klase, klases_aprasymas) values (:kvardas, :kaprasas);');
        $stmt->bindValue(':kvardas', $klasesvardas);
        $stmt->bindValue(':kaprasas', $klasesaprasas);
        $stmt->execute();
    }

    function createTableMokinys(string $pavadinimas): void
    {
        $stmt = $this->connect->prepare('CREATE TABLE '.$pavadinimas.' ( id int NOT NULL AUTO_INCREMENT, vardaspavarde varchar(50), vardaspavarde_aprasymas varchar(50), PRIMARY KEY (id));');
        $stmt->execute();
    }

    function saveToMokinys(Mokinys $mokinys, string $pavadinimas): void
    {
        $mokiniovardas = $mokinys->getMokinys();
        $mokinioaprasas = $mokinys->getMokinioAprasymas();
        $stmt = $this->connect->prepare('INSERT INTO ' . $pavadinimas . ' (mokinys, mokinio_aprasymas) values (:mvardas, :maprasas);');
        $stmt->bindValue(':mvardas', $mokiniovardas);
        $stmt->bindValue(':maprasas', $mokinioaprasas);
        $stmt->execute();
    }

    public function findAllKlases(): array
    {
        $stmt = $this->connect->prepare('SELECT * FROM klases order by id');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Klase::class);
        $rezultatai = $stmt->fetchAll();
        return $rezultatai;
    }
//SET @last_id_in_table1 = LAST_INSERT_ID();
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