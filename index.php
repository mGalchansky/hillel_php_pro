<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = __DIR__ . "/$class.php";

    if (!file_exists($file)) {
        throw new \Exception('Class "' . $class . '" not found');
    }
    require_once $file;
});

use Classes\A\ClassOneA;
use Classes\A\ClassTwoA;
use Classes\B\ClassOneB;
use Classes\B\ClassTwoB;
use Classes\C\ClassOneC;
use Classes\C\ClassTwoC;
use Classes\D\ClassOneD;
use Classes\D\ClassTwoD;

try {

    $test1 = new ClassOneA();
    echo $test1->test();
    echo "<br>";

    $test2 = new ClassTwoA();
    echo $test2->test();
    echo "<br>";


    $test3 = new ClassOneB();
    echo $test3->test();
    echo "<br>";

    $test4 = new ClassTwoB();
    echo $test4->test();
    echo "<br>";


    $test5 = new ClassOneC();
    echo $test5->test();
    echo "<br>";

    $test6 = new ClassTwoC();
    echo $test6->test();
    echo "<br>";


    $test7 = new ClassOneD();
    echo $test7->test();
    echo "<br>";

    $test8 = new ClassTwoD();
    echo $test8->test();
    echo "<br>";

} catch (Exception $e) {
    echo $e->getMessage();
}