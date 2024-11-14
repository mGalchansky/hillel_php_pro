<?php
require_once __DIR__ . '/Classes/User.php';

use Classes\User;

try {
    $test = new User();

    $test->setName('Name');
    $test->setAge(-5);
    $test->setEmail('anton@gmail.com');

    var_dump($test->getAll());
} catch (Exception $e) {
    echo $e->getMessage();
}
