<?php

namespace Classes;

class EconomCar implements TaxiInterface
{
    public function getCarModel()
    {
        echo 'Daewoo Lanos'. "<br>";
        return 'Daewoo Lanos';

    }
    public function getPrice()
    {
        echo '40.5'. "<br>";
        return 40.5;
    }
}