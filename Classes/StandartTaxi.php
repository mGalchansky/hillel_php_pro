<?php

namespace Classes;

class StandartTaxi extends CarFactory
{
    public function createCar(): TaxiInterface
    {
        return new StandartCar();
    }
}