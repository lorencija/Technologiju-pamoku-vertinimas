<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use PROJ\Entity\Klase;
use PROJ\DB\Db;


$A=array();

//if (isset($_POST['first_name'],$_POST['last_name'])){
$A['cname'] = $_POST['classname'];
$A['ctext'] = $_POST['classtext'];

//}

var_dump($A);
echo json_encode($A);
$klas = new Klase();
$klas->setName($A['cname']);
$klas->setDescription($A['ctext']);

$duomenuBaze=new Db();
$duomenuBaze->saveToDb($klas);
$duomenuBaze->close();
