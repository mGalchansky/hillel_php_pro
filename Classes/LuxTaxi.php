<?php

namespace Classes;

class LuxTaxi extends CarFactory
{
    public function createCar(): TaxiInterface
    {
        return new LuxCar();
    }
}