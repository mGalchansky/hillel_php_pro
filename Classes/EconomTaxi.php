<?php

namespace Classes;
class EconomTaxi extends CarFactory
{
    public function createCar(): TaxiInterface
    {
        return new EconomCar();
    }
}