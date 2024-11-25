<?php

namespace Classes;

use Classes\DeliveryInterface;

class DeliveryConsole implements DeliveryInterface
{
    public function delivery(string $string)
    {
        echo "Вывод формата ({$string}) в консоль <br>";
    }
}