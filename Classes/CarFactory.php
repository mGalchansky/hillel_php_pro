<?php

namespace Classes;

use Classes\TaxiInterface;

abstract class CarFactory
{
    abstract public function createCar(): TaxiInterface;

    public function getCarModel()
    {
        $car = $this->createCar();
        $car->getCarModel();
    }

    public function getPrice()
    {
        $car = $this->createCar();
        $car->getPrice();
    }
}