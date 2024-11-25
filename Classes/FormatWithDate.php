<?php

namespace Classes;
use Classes\FormatInterface;
class FormatWithDate implements FormatInterface
{
public function format(string $string){
    return date('Y-m-d H:i:s') . $string;
}
}