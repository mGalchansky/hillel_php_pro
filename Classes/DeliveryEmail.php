<?php

namespace Classes;

use Classes\DeliveryInterface;

class DeliveryEmail implements DeliveryInterface
{
    public function delivery(string $string)
    {
        echo "Вывод формата ({$string}) по имейл <br>";
    }

}