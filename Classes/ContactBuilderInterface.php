<?php

namespace Classes;

interface ContactBuilderInterface
{

    public function name(string $name);

    public function email(string $email);

    public function phone(string $phone);

    public function surname(string $surname);

    public function address(string $address);


}