<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class).'.php';
    $file = __DIR__ . "/$class";
    if (file_exists($file)) {
        throw new Exception("Class $class not found!");
    }
    require_once $file;
});