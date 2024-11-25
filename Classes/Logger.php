<?php
namespace Classes;

class Logger
{

    private $format;
    private $delivery;

    public function __construct(FormatInterface $format, DeliveryInterface $delivery)
    {
        $this->format = $format;
        $this->delivery = $delivery;
    }

    public function log($string)
    {
        $formatint = $this->format->format($string);
        $this->delivery->delivery($formatint);
    }

}

