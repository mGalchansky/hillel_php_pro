<?php

namespace Classes;

class LuxCar implements TaxiInterface
{
    public function getCarModel()
    {
        echo 'Chevrolet Lacetti'. "<br>";
        return 'Chevrolet Lacetti';

    }
    public function getPrice()
    {
        echo '80.2'. "<br>";
        return 80.2;
    }
}