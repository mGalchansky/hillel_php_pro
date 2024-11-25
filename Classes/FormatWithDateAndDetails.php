<?php

namespace Classes;
use Classes\FormatInterface;

class FormatWithDateAndDetails implements FormatInterface
{
    public function format(string $string)
    {
        return date('Y-m-d H:i:s') . $string . ' - With some details';
    }
}