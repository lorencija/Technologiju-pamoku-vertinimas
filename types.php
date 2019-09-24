<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

$A=array();

//if (isset($_POST['first_name'],$_POST['last_name'])){
$A['cname'] = $_POST['classname'];
$A['ctext'] = $_POST['classtext'];

//}

var_dump($A);
echo json_encode($A);
