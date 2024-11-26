<?php

namespace Classes;

class Mongodb implements DBinterface
{
    public function getData(): string
    {
        echo 'some data from mongodb database <br>';
        return 'some data from mongodb database';

    }
}