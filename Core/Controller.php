<?php

namespace Core;

class Controller
{
    public function before(string $action, array $params = []): bool
    {
        return true;
    }

    public function after(string $action, array $params = []): void
    {
if(empty($responce)){
    throw new \Exception(__CLASS__ . "::$action - empty response");
}
    }
}