<?php

namespace Classes;

class Mysql implements DBinterface
{
    public function getData(): string
    {
        echo 'some data from mysql database <br>';
        return 'some data from mysql database';
    }
}