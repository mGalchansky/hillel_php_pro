<?php

namespace Classes;

class ContactBuilder implements ContactBuilderInterface
{
    private $name;
    private $email;
    private $phone;
    private $address;
    private $surname;

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function email(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function phone(string $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function address(string $address)
    {
        $this->address = $address;
        return $this;
    }

    public function surname(string $surname)
    {
        $this->surname = $surname;
        return $this;
    }

    public function build()
    {
        $contact = new ContactBuilder();
        $contact->name = $this->name;
        $contact->surname = $this->surname;
        $contact->email = $this->email;
        $contact->phone = $this->phone;
        $contact->address = $this->address;
        return $contact;
    }

    public function getContact()
    {
        echo "Name - " .    $this->name .    "<br>" .
             "Surname - " . $this->surname . "<br>" .
             "Email - " .   $this->email .   "<br>" .
             "Phone - " .   $this->phone .   "<br>" .
             "Address - " . $this->address . "<br>";
    }
}