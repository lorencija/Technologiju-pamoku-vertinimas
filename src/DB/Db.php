<?php declare(strict_types=1);

namespace PROJ\DB;

use PROJ\Entity\Klase;

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

    function saveToDb(Klase $klase): void
    {
        $klasesvardas=$klase->getName();
        $klasesaprasas=$klase->getDescription();
        $stmt = $this->connect->prepare('INSERT INTO klases (klase, klases_aprasymas) values (:kvardas, :kaprasas);');
        $stmt->bindValue(':kvardas', $klasesvardas);
        $stmt->bindValue(':kaprasas', $klasesaprasas);
        $stmt->execute();
    }

    public function showAllKlases(): array
    {        $stmt = $this->connect->prepare('SELECT * FROM klases');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Klase::class);
        $rezultatai = $stmt->fetchAll();
        return $rezultatai;
    }

    public function close(): void
    {
        $this->connect = null;
    }
}