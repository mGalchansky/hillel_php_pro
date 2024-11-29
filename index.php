<?php
require_once 'vendor/autoload.php';

use Classes\CarFactory;
use Classes\EconomTaxi;
use Classes\StandartTaxi;
use Classes\LuxTaxi;


function requestTaxi(CarFactory $taxi)
{
    $taxi->getCarModel();
    $taxi->getPrice();
   // var_dump($taxi->getCarModel());
   // var_dump($taxi->getPrice());
}

requestTaxi(new EconomTaxi());
requestTaxi(new StandartTaxi());
requestTaxi(new LuxTaxi());


