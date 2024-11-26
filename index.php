<?php
require_once __DIR__ . '/vendor/autoload.php';
use Classes\Controller;
use Classes\Mongodb;
use Classes\Mysql;

$db1 = new Mongodb();
$db2 = new Mysql();

$contr = new Controller($db2);
var_dump($contr->getinfo());

$contr1 = new Controller($db1);
var_dump($contr1->getinfo());


