<?php

namespace Classes;

use Classes\FormatInterface;

class FormatRaw implements FormatInterface
{
public function format(string $string)
{
    return $string;
}
}