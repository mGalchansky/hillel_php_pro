<?php
require_once __DIR__ . '/Classes/User.php';

use Classes\User;

try {
    $test = new User();

    $test->setName('Anton');
    $test->setAge(22);
    $test->setEmail('anton@gmail.com');

    var_dump($test->getAll());
} catch (MyException $e) {
    echo $e->getMessage();
}
