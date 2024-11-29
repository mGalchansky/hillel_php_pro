<?php

namespace Classes;

class StandartCar implements TaxiInterface
{
    public function getCarModel()
    {
        echo 'Chevrolet Aveo'. "<br>";
        return 'Chevrolet Aveo';

    }
    public function getPrice()
    {
        echo '60.8'. "<br>";
        return 60.8;
    }
}