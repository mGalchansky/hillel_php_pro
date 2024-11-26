<?php

namespace Classes;

class Controller
{
    private $adapter;

    public function __construct(DBinterface $db)
    {
        $this->adapter = $db;
    }

    public function getinfo()
    {
        $this->adapter->getData();
    }

}