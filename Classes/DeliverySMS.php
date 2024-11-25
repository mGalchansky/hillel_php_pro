<?php

namespace Classes;

use Classes\DeliveryInterface;

class DeliverySMS implements DeliveryInterface
{
    public function delivery(string $string)
    {
        echo "Вывод формата ({$string}) в смс <br>";
    }
}